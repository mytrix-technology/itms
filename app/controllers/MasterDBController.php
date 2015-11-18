<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MasterDBController extends \BaseController {

	/**
     * Mengambil Index Page Master Database
     */
	public function getIndex()
	{
		// get alls Vendors
		$masterDBs = MasterDB::orderBy('id', 'DESC')->get();

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.masterDBs-list'), array('masterDBs' => $masterDBs))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.masterDBs-index'), array('masterDBs' => $masterDBs));
		$this->layout->title = "Database Master";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterDBs');
	}
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $serverName = Input::get('serverNameSearch');
        $databaseName = Input::get('databaseNameSearch');
        $activated = Input::get('activatedSearch');

        if (empty($serverName)) {
            $masterDBs = MasterDB::orderBy('id', 'DESC')->get();

            if (empty($databaseName)) {
                $masterDBs = MasterDB::orderBy('id', 'DESC')->get();
			} else {
                $masterDBs = MasterDB::where('database_name', 'LIKE', '%'.$databaseName.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
            }
        } else {
            $masterDBs = MasterDB::where('server_name', 'LIKE', '%'.$serverName.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
        }
		
		$masterDBs = MasterDB::where('status', '=', $activated)
                            ->orderBy('id', 'DESC')
                            ->get();
        
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.masterDBs-list'), array('masterDBs' => $masterDBs))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('adminlte::views.masterDBs-index'), array('masterDBs' => $masterDBs));
        $this->layout->title = "Database Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterDBs');
    }

	/**
     * Menampilkan form create master database
     */
	public function getCreate()
	{
		$this->layout = View::make(Config::get('adminlte::views.masterDB-create'));
		$this->layout->title = "New Database Master";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_masterDB');
	}

	/**
     * Melakukan proses create master database
     */
	public function postCreate()
	{
		$aturan = array(
			'server_name' => 'required',
			'database_name' => 'required',
		);

		$validasi = Validator::make(Input::all(), $aturan);

		if($validasi->passes()) {
			$masterDB = new MasterDB;
			# Buatkan variabel tiap inputan
			$masterDB->server_name = Input::get('server_name');
			$masterDB->database_name = Input::get('database_name');
			$masterDB->status = 1;
			$masterDB->user_created = Input::get('user_created');
			$masterDB->save();

			$daily_report = new DailyReport;
            $daily_report->master_db_id = $masterDB->id;
            $daily_report->job = $masterDB->server_name;
            $daily_report->description = $masterDB->database_name;
            $daily_report->status_job_daily_report = $masterDB->status;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterDB->server_name.'<br />'.$masterDB->database_name;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Database Created';
            $autoemail->subject = $masterDB->database_name;
            $autoemail->message = 'Server Name : '.$masterDB->server_name
                                    .'<br /> Database Name : '.$masterDB->database_name
                                    .'<br /> Activated :'.$masterDB->status;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();
            
            Notification::success('New Database Master has been added.');
			return Redirect::route('listMasterDBs');

		} else {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
		}
	}

	/**
     * Menampilkan form edit master database
     */
	public function getShow($masterDBId)
	{
		try
		{
			$masterDBs = MasterDB::find($masterDBId);

			$this->layout = View::make(Config::get('adminlte::views.masterDB-edit'), array(
				'masterDBs' => $masterDBs,
			));

			$this->layout->title = $masterDBs->database_name;
			$this->layout->breadcrumb = array(
				array(
					'title' => "Database Master",
					'link' => URL::route('listMasterDBs'),
					'icon' => 'glyphicon-th'
				),
				array(
					'title' => $masterDBs->database_name,
					'link' => URL::current(),
					'icon' => ''
				)
			);
		}
		catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$this->layout = View::make(Config::get('syntara::views.error'), array('message' => trans('syntara::users.messages.not-found')));
		}
	}

	/**
     * Melakukan proses update master database ke database
     */
	public function putShow($masterDBId)
	{
		$aturan = array(
			'server_name' => 'required',
			'database_name' => 'required',
		);

		$validasi = Validator::make(Input::all(), $aturan);

		if($validasi->fails()) {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
			# Bila validasi sukses
		} else {
			$masterDBs = MasterDB::find($masterDBId);
			# Buatkan variabel tiap inputan
			$masterDBs->server_name = Input::get('server_name');
			$masterDBs->database_name = Input::get('database_name');
			$masterDBs->user_updated = Input::get('user_updated');
			$masterDBs->save();

			$daily_report = new DailyReport;
            $daily_report->master_db_id = $masterDBs->id;
            $daily_report->job = $masterDBs->server_name;
            $daily_report->description = $masterDBs->database_name;
            $daily_report->status_job_daily_report = $masterDBs->status;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterDBs->server_name.'<br />'.$masterDBs->database_name;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Master Database Updated';
            $autoemail->subject = $masterDBs->database_name;
            $autoemail->message = 'Server Name : '.$masterDBs->server_name
                                    .'<br /> Database Name : '.$masterDBs->database_name
                                    .'<br /> Activated :'.$masterDBs->status;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Database Master has been changed.');
			return Redirect::route('listMasterDBs');
		}
	}

	/**
     * Melakukan proses aktifasi master database
     */
	public function active($masterDBId)
    {
        $masterDBs = MasterDB::find($masterDBId);
        $masterDBs->status = 1;
        $masterDBs->save();

        $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Master Database Updated';
            $autoemail->subject = $masterDBs->database_name;
            $autoemail->message = 'Server Name : '.$masterDBs->server_name
                                    .'<br /> Database Name : '.$masterDBs->database_name
                                    .'<br /> Activated :'.$masterDBs->status;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

        //Notification:success('Application Update has been Activated');
        return Redirect::route('listMasterDBs');
    }
    
    /**
     * Melakukan proses non-aktifasi master database
     */
    public function nonactive($masterDBId)
    {
        $masterDBs = MasterDB::find($masterDBId);
        $masterDBs->status = 0;
        $masterDBs->save();

        $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Master Database Updated';
            $autoemail->subject = $masterDBs->database_name;
            $autoemail->message = 'Server Name : '.$masterDBs->server_name
                                    .'<br /> Database Name : '.$masterDBs->database_name
                                    .'<br /> Activated :'.$masterDBs->status;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

        //Notification:success('Status Master has been Non Activated');
        return Redirect::route('listMasterDBs');
    }

}