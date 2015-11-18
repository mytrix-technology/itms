<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MasterStatusController extends \BaseController {

	/**
     * Mengambil Index Page Master Status
     */
	public function getIndex()
    {
        // get alls Vendors
        $masterstatuss = MasterStatus::orderBy('id','DESC')->get();

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.masterstatuss-list'), array('masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.masterstatuss-index'), array('masterstatuss' => $masterstatuss));
        $this->layout->title = "Master Status";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterstatuss');
    }
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Application Name
        $groupName = Input::get('groupNameSearch');
        $activated = Input::get('activatedSearch');

        if (empty($groupName)) {
            $masterstatuss = MasterStatus::orderBy('id','DESC')->get();
		} else {
            $masterstatuss = MasterStatus::where('group', 'LIKE', '%'.$groupName.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
        }
		
		$masterstatuss = MasterStatus::where('activated', '=', $activated)
                            ->orderBy('id', 'DESC')
                            ->get();
        
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.masterstatuss-list'), array('masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.masterstatuss-index'), array('masterstatuss' => $masterstatuss));
        $this->layout->title = "Master Status";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterstatuss');
    }

	/**
     * Menampilkan form create master status
     */
	public function getCreate()
    {
        $this->layout = View::make(Config::get('adminlte::views.masterstatus-create'));
        $this->layout->title = "New Master Status";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_masterstatus');
    }

	/**
     * Melakukan proses create master status
     */
	public function postCreate()
    {
        $aturan = array(
            'group' => 'required', 
            'status_name' => 'required|min:3', 
            'status_desc' => 'required',
        );

        $groupname = Input::get('group');

        $version = DB::table('master_status')
                        ->select(DB::raw('max(status_version) as newVersion'))
                        ->where('group',$groupname)
                        ->groupBy('group')
                        ->first();
        if ($version == null) {
            $status_version = 1;
        } else {
            $newV = $version->newVersion;
            $status_version = $newV+1;    
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $masterstatus = new MasterStatus;
            # Buatkan variabel tiap inputan
            $masterstatus->group = Input::get('group');
            $masterstatus->status_name = Input::get('status_name');
            $masterstatus->status_desc = Input::get('status_desc');
            $masterstatus->activated = 1;
            $masterstatus->status_version = $status_version;
            $masterstatus->user_created = Input::get('user_created');
            $masterstatus->save();

            $daily_report = new DailyReport;
            $daily_report->master_status_id = $masterstatus->id;
            $daily_report->job = $masterstatus->status_name;
            $daily_report->description = $masterstatus->status_desc;
            $daily_report->status_job_daily_report = $masterstatus->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterstatus->group;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Status Created';
            $autoemail->subject = $masterstatus->status_name;
            $autoemail->message = 'Group : '.$masterstatus->group
                                    .'<br /> Status Name : '.$masterstatus->status_name
                                    .'<br /> Status Description :'.$masterstatus->status_desc
                                    .'<br /> Activated :'.$masterstatus->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New Status Master has been Added');
            return Redirect::route('listMasterStatuss');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit master status
     */
	public function getShow($masterstatusId)
    {
        try
        {
            $masterstatuss = MasterStatus::find($masterstatusId);
            
            $this->layout = View::make(Config::get('adminlte::views.masterstatus-edit'), array(
                'masterstatuss' => $masterstatuss,
            ));

            $this->layout->title = $masterstatuss->group;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Master Status",
                        'link' => URL::route('listMasterStatuss'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $masterstatuss->group." - ".$masterstatuss->status_name,
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
     * Melakukan proses update master status ke database
     */
	public function putShow($masterstatusId)
    {
        $aturan = array(
            'group' => 'required', 
            'status_name' => 'required|min:3', 
            'status_desc' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $masterstatuss = MasterStatus::find($masterstatusId);
            # Buatkan variabel tiap inputan
            $masterstatuss->group = Input::get('group');
            $masterstatuss->status_name = Input::get('status_name');
            $masterstatuss->status_desc = Input::get('status_desc');
            $masterstatuss->activated = Input::get('activated');
            $masterstatuss->user_updated = Input::get('user_updated');
            $masterstatuss->save();

            $daily_report = new DailyReport;
            $daily_report->master_status_id = $masterstatuss->id;
            $daily_report->job = $masterstatuss->status_name;
            $daily_report->description = $masterstatuss->status_desc;
            $daily_report->status_job_daily_report = $masterstatuss->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterstatuss->group;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Master Status Updated';
            $autoemail->subject = $masterstatuss->status_name;
            $autoemail->message = 'Group : '.$masterstatuss->group
                                    .'<br /> Status Name : '.$masterstatuss->status_name
                                    .'<br /> Status Description :'.$masterstatuss->status_desc
                                    .'<br /> Activated :'.$masterstatuss->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Status Master has been Changed');
            return Redirect::route('listMasterStatuss');
        }
    }

    /**
     * Melakukan aktifasi master status
     */
    public function active($masterstatusId)
    {
        $masterstatuss = MasterStatus::find($masterstatusId);
        $masterstatuss->activated = 1;
        $masterstatuss->save();

            $daily_report = new DailyReport;
            $daily_report->master_status_id = $masterstatuss->id;
            $daily_report->job = $masterstatuss->status_name;
            $daily_report->description = $masterstatuss->status_desc;
            $daily_report->status_job_daily_report = $masterstatuss->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterstatuss->group;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_it@pancaran-group.com';
            $autoemails->from = Sentry::getUser()->email;
            $autoemails->cc = 'ndaru@pancaran-group.com';
            $autoemails->judul = 'ITMS - Job Daily Report';
            $autoemails->subject = $daily_report->job;
            $autoemails->message = 'Description : '.$daily_report->description
                                    .'<br /> Note :'.$daily_report->note
                                    .'<br /> Target Finish :'.$daily_report->target_finish
                                    .'<br /> Status : '.$daily_report->status_job_daily_report
                                    .'<br /> Create Date :'.$daily_report->create_date
                                    .'<br /> User Created :'.$daily_report->user_created;
            $autoemails->tglinput = date('Y-m-d H:i:s');
            $autoemails->userinput = Sentry::getUser()->username;
            $autoemails->tglupdate = date('Y-m-d H:i:s');
            $autoemails->userupdate = Sentry::getUser()->username;
            $autoemails->status = 1;
            $autoemails->save();

        //Notification:success('Application Update has been Activated');
        return Redirect::route('listMasterStatuss');
    }
    
    /**
     * Melakukan non-aktifasi master status
     */
    public function nonactive($masterstatusId)
    {
        $masterstatuss = MasterStatus::find($masterstatusId);
        $masterstatuss->activated = 0;
        $masterstatuss->save();

            $daily_report = new DailyReport;
            $daily_report->master_status_id = $masterstatuss->id;
            $daily_report->job = $masterstatuss->status_name;
            $daily_report->description = $masterstatuss->status_desc;
            $daily_report->status_job_daily_report = $masterstatuss->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterstatuss->group;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_it@pancaran-group.com';
            $autoemails->from = Sentry::getUser()->email;
            $autoemails->cc = 'ndaru@pancaran-group.com';
            $autoemails->judul = 'ITMS - Job Daily Report';
            $autoemails->subject = $daily_report->job;
            $autoemails->message = 'Description : '.$daily_report->description
                                    .'<br /> Note :'.$daily_report->note
                                    .'<br /> Target Finish :'.$daily_report->target_finish
                                    .'<br /> Status : '.$daily_report->status_job_daily_report
                                    .'<br /> Create Date :'.$daily_report->create_date
                                    .'<br /> User Created :'.$daily_report->user_created;
            $autoemails->tglinput = date('Y-m-d H:i:s');
            $autoemails->userinput = Sentry::getUser()->username;
            $autoemails->tglupdate = date('Y-m-d H:i:s');
            $autoemails->userupdate = Sentry::getUser()->username;
            $autoemails->status = 1;
            $autoemails->save();

        //Notification:success('Status Master has been Non Activated');
        return Redirect::route('listMasterStatuss');
    }
}