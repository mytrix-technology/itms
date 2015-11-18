<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MasterModulController extends \BaseController {

	/**
     * Mengambil Index Page Master Modul
     */
	public function getIndex()
    {
        // get alls Vendors
        $mastermoduls = MasterModul::orderBy('id', 'DESC')->get();
        
        $masterappss = array('' => '');
        foreach(MasterApps::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterappss[$row->id] = $row->name_apps;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.mastermoduls-list'), array('mastermoduls' => $mastermoduls, 'masterappss' => $masterappss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.mastermoduls-index'), array('mastermoduls' => $mastermoduls, 'masterappss' => $masterappss));
        $this->layout->title = "Modul Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.mastermoduls');
    }
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Modul Name
        $modulName = Input::get('modulNameSearch');
        $appsName = Input::get('appsNameSearch');
        $activated = Input::get('activatedSearch');

        if (empty($modulName)) {
            $mastermoduls = MasterModul::orderBy('id', 'DESC')->get();

            if (empty($appsName)) {
                $mastermoduls = MasterModul::orderBy('id', 'DESC')->get();

                if (empty($activated)) {
                    $mastermoduls = MasterModul::orderBy('id', 'DESC')->get();
                } else {
                    $mastermoduls = MasterModul::where('activated', 'LIKE', '%'.$activated.'%')
                            ->orderBy('id','DESC')
                            ->get();
                }
            } else {
                $mastermoduls = MasterModul::where('master_apps_id', 'LIKE', '%'.$appsName.'%')
                            ->orderBy('id','DESC')
                            ->get();
            }
        } else {
            $mastermoduls = MasterModul::where('name_modul','LIKE','%'.$modulName.'%')
                                ->orderBy('id','DESC')
                                ->get();
        }
        
        $masterappss = array('' => '');
        foreach(MasterApps::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterappss[$row->id] = $row->name_apps;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.mastermoduls-list'), array('mastermoduls' => $mastermoduls, 'masterappss' => $masterappss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.mastermoduls-index'), array('mastermoduls' => $mastermoduls, 'masterappss' => $masterappss));
        $this->layout->title = "Modul Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.mastermoduls');
    }

	/**
     * Menampilkan form create master modul baru
     */
	public function getCreate()
    {
        $masterappss = array('' => '');
        foreach(MasterApps::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterappss[$row->id] = $row->name_apps;

        $this->layout = View::make(Config::get('adminlte::views.mastermodul-create'), array('masterappss' => $masterappss));
        $this->layout->title = "New Modul Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_mastermodul');
    }

	/**
     * Melakukan proses create master modul baru
     */
	public function postCreate()
    {
        $aturan = array(
            'name_modul' => 'required', 
            'desc_modul' => 'required|min:10', 
            'master_apps_id' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $mastermodul = new MasterModul;
            # Buatkan variabel tiap inputan
            $mastermodul->name_modul = Input::get('name_modul');
            $mastermodul->desc_modul = Input::get('desc_modul');
            $mastermodul->master_apps_id = Input::get('master_apps_id');
            $mastermodul->activated = 1;
            $mastermodul->user_created = Input::get('user_created');
            $mastermodul->save();

            $daily_report = new DailyReport;
            $daily_report->master_modul_id = $mastermodul->id;
            $daily_report->job = $mastermodul->name_modul;
            $daily_report->description = $mastermodul->desc_modul;
            $daily_report->status_job_daily_report = $mastermodul->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastermodul->masterapps->name_apps;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Modul Created';
            $autoemail->subject = $mastermodul->name_modul;
            $autoemail->message = 'Modul Name : '.$mastermodul->name_modul
                                    .'<br /> Modul Description : '.$mastermodul->desc_modul
                                    .'<br /> ID Master Application :'.$mastermodul->masterapps->name_apps
                                    .'<br /> Activated :'.$mastermodul->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('Modul Master has been added.');
            return Redirect::route('listMasterModuls');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit master modul
     */
	public function getShow($mastermodulId)
    {
        try
        {
            $mastermoduls = MasterModul::find($mastermodulId);
            $masterappss = array('' => '');
            foreach(MasterApps::where('activated','=','1')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterappss[$row->id] = $row->name_apps;
            
            $this->layout = View::make(Config::get('adminlte::views.mastermodul-edit'), array(
                'mastermoduls' => $mastermoduls,
                'masterappss' => $masterappss,
            ));

            $this->layout->title = $mastermoduls->name_modul;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Modul Master",
                        'link' => URL::route('listMasterModuls'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $mastermoduls->name_modul,
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
     * Melakukan proses update master modul ke database
     */
	public function putShow($mastermodulId)
    {
        $aturan = array(
            'name_modul' => 'required', 
            'desc_modul' => 'required|min:10', 
            'master_apps_id' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $mastermoduls = MasterModul::find($mastermodulId);
            # Buatkan variabel tiap inputan
            $mastermoduls->name_modul = Input::get('name_modul');
            $mastermoduls->desc_modul = Input::get('desc_modul');
            $mastermoduls->master_apps_id = Input::get('master_apps_id');
            $mastermoduls->activated = Input::get('activated');
            $mastermoduls->user_updated = Input::get('user_updated');
            $mastermoduls->save();

            $daily_report = new DailyReport;
            $daily_report->master_modul_id = $mastermoduls->id;
            $daily_report->job = $mastermoduls->name_modul;
            $daily_report->description = $mastermoduls->desc_modul;
            $daily_report->status_job_daily_report = $mastermoduls->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastermoduls->masterapps->name_apps;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Master Modul Updated';
            $autoemail->subject = $mastermoduls->name_modul;
            $autoemail->message = 'Modul Name : '.$mastermoduls->name_modul
                                    .'<br /> Modul Description : '.$mastermoduls->desc_modul
                                    .'<br /> ID Master Application :'.$mastermoduls->masterapps->name_apps
                                    .'<br /> Activated :'.$mastermoduls->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Modul Master has been Changed.');
            return Redirect::route('listMasterModuls');
        }
    }

    /**
     * Melakukan proses aktifasi master modul
     */
    public function active($mastermodulId)
    {
        $mastermoduls = MasterModul::find($mastermodulId);
        $mastermoduls->activated = 1;
        $mastermoduls->save();

            $daily_report = new DailyReport;
            $daily_report->master_modul_id = $mastermoduls->id;
            $daily_report->job = $mastermoduls->name_modul;
            $daily_report->description = $mastermoduls->desc_modul;
            $daily_report->status_job_daily_report = $mastermoduls->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastermoduls->masterapps->name_apps;
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
        return Redirect::route('listMasterModuls');
    }
    
    /**
     * Melakukan proses non-aktifasi master modul
     */
    public function nonactive($mastermodulId)
    {
        $mastermoduls = MasterModul::find($mastermodulId);
        $mastermoduls->activated = 0;
        $mastermoduls->save();

            $daily_report = new DailyReport;
            $daily_report->master_modul_id = $mastermoduls->id;
            $daily_report->job = $mastermoduls->name_modul;
            $daily_report->description = $mastermoduls->desc_modul;
            $daily_report->status_job_daily_report = $mastermoduls->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastermoduls->masterapps->name_apps;
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
        return Redirect::route('listMasterModuls');
    }
    
	/**
     * Melakukan proses delete master modul
     */
	public function delete($mastermodulId)
    {
        $mastermoduls = MasterModul::find($mastermodulId);
        $mastermoduls->delete();

        return Redirect::route('listMasterModuls')->withPesan('Modul Master has been deleted.');
    }

}