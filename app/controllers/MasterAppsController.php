<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MasterAppsController extends \BaseController {

	/**
     * Mengambil Index Page Master Aplikasi
     */
	public function getIndex()
    {
        // get alls Vendors
        $masterappss = MasterApps::orderBy('id','DESC')->get();
        
        // User Name
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.masterappss-list'), array('masterappss' => $masterappss, 'users' => $users))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.masterappss-index'), array('masterappss' => $masterappss, 'users' => $users));
        $this->layout->title = "Application Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterappss');
    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Application Name
        $appsName = Input::get('appsNameSearch');
        $buildDate = Input::get('buildDateSearch');
        $developmentBy = Input::get('developmentBySearch');
        $activated = Input::get('activatedSearch');
        $version = Input::get('versionSearch');
        
        if (empty($appsName)) {
            $masterappss = MasterApps::orderBy('id','DESC')->get();

            if (empty($buildDate)) {
                $masterappss = MasterApps::orderBy('id','DESC')->get();

                if (empty($developmentBy)) {
                    $masterappss = MasterApps::orderBy('id','DESC')->get();

                    if (empty($version)) {
                            $masterappss = MasterApps::orderBy('id','DESC')->get();
                        } else {
                             $masterappss = MasterApps::where('version', 'LIKE', '%'.$version.'%')
                            ->orderBy('id','DESC')
                            ->get();
                        }
                } else {
                    $masterappss = MasterApps::where('development_by', 'LIKE', '%'.$developmentBy.'%')
                            ->orderBy('id','DESC')
                            ->get();
                }
            } else {
                $masterappss = MasterApps::where('build_date', '=', $buildDate)
                            ->orderBy('id','DESC')
                            ->get();
            }
        } else {
            $masterappss = MasterApps::where('name_apps', 'LIKE', '%'.$appsName.'%')
                            ->orderBy('id','DESC')
                            ->get();
        }
		
		$masterappss = MasterApps::where('activated', '=', $activated)
                            ->orderBy('id','DESC')
                            ->get();
        
        // User Name
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.masterappss-list'), array('masterappss' => $masterappss, 'users' => $users))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.masterappss-index'), array('masterappss' => $masterappss, 'users' => $users));
        $this->layout->title = "Application Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterappss');
    }

	/**
     * Menampilkan form create master aplikasi
     */
	public function getCreate()
    {
        $this->layout = View::make(Config::get('adminlte::views.masterapps-create'));
        $this->layout->title = "New Application Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_masterapps');
    }

	/**
     * Melakukan proses create master aplikasi
     */
	public function postCreate()
    {
        $aturan = array(
            'name_apps' => 'required', 
            'desc_apps' => 'required', 
            'datepicker' => 'required',
            'version' => 'required',
            'note' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $masterapps = new MasterApps;
            # Buatkan variabel tiap inputan
            $masterapps->name_apps = Input::get('name_apps');
            $masterapps->desc_apps = Input::get('desc_apps');
            $masterapps->build_date = Input::get('datepicker');
            $masterapps->development_by = Input::get('development_by');
            $masterapps->version = Input::get('version');
            $masterapps->note = Input::get('note');
            $masterapps->activated = 1;
            $masterapps->user_created = Input::get('user_created');
            $masterapps->save();

            $daily_report = new DailyReport;
            $daily_report->master_apps_id = $masterapps->id;
            $daily_report->job = $masterapps->name_apps;
            $daily_report->description = $masterapps->desc_apps;
            $daily_report->status_job_daily_report = $masterapps->activated;
            $daily_report->target_finish = $masterapps->build_date;
            $daily_report->note = $masterapps->note;
            $daily_report->create_date = $masterapps->build_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ndaru@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ou_it@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Application Created';
            $autoemail->subject = $masterapps->name_apps;
            $autoemail->message = 'Application Name : '.$masterapps->name_apps
                                    .'<br /> Application Description : '.$masterapps->desc_apps
                                    .'<br /> Build Date :'.$masterapps->build_date
                                    .'<br /> Development By :'.$masterapps->development_by
                                    .'<br /> Version :'.$masterapps->version
                                    .'<br /> Note :'.$masterapps->note
                                    .'<br /> Activated :'.$masterapps->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('Application Master has been Added.');
            return Redirect::route('listMasterAppss');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit master aplikasi
     */
	public function getShow($masterappsId)
    {
        try
        {
            $masterappss = MasterApps::find($masterappsId);
            
            $this->layout = View::make(Config::get('adminlte::views.masterapps-edit'), array(
                'masterappss' => $masterappss,
            ));

            $this->layout->title = $masterappss->name_apps;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Application Master",
                        'link' => URL::route('listMasterAppss'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $masterappss->name_apps,
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
     * Melakukan proses update master aplikasi ke database
     */
	public function putShow($masterappsId)
    {
        $aturan = array(
            'name_apps' => 'required', 
            'desc_apps' => 'required', 
            'datepicker' => 'required',
            'version' => 'required',
            'note' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $masterappss = MasterApps::find($masterappsId);
            # Buatkan variabel tiap inputan
            $masterappss->name_apps = Input::get('name_apps');
            $masterappss->desc_apps = Input::get('desc_apps');
            $masterappss->build_date = Input::get('datepicker');
            $masterappss->development_by = Input::get('development_by');
            $masterappss->version = Input::get('version');
            $masterappss->note = Input::get('note');
            $masterappss->activated = Input::get('activated');
            $masterappss->user_updated = Input::get('user_updated');
            $masterappss->save();

            $daily_report = new DailyReport;
            $daily_report->master_apps_id = $masterappss->id;
            $daily_report->job = $masterappss->name_apps;
            $daily_report->description = $masterappss->desc_apps;
            $daily_report->status_job_daily_report = $masterappss->activated;
            $daily_report->target_finish = $masterappss->build_date;
            $daily_report->note = $masterappss->note;
            $daily_report->create_date = $masterappss->build_date;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ndaru@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ou_it@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Application Created';
            $autoemail->subject = $masterappss->name_apps;
            $autoemail->message = 'Application Name : '.$masterappss->name_apps
                                    .'<br /> Application Description : '.$masterappss->desc_apps
                                    .'<br /> Build Date :'.$masterappss->build_date
                                    .'<br /> Development By :'.$masterappss->development_by
                                    .'<br /> Version :'.$masterappss->version
                                    .'<br /> Note :'.$masterappss->note
                                    .'<br /> Activated :'.$masterappss->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Application Master has been changed.');
            return Redirect::route('listMasterAppss');
        }
    }

    /**
     * Melakukan proses aktifasi master aplikasi
     */
    public function active($masterappsId)
    {
        $masterappss = MasterApps::find($masterappsId);
        $masterappss->activated = 1;
        $masterappss->save();

        $daily_report = new DailyReport;
        $daily_report->master_apps_id = $masterappss->id;
        $daily_report->job = $masterappss->name_apps;
        $daily_report->description = $masterappss->desc_apps;
        $daily_report->status_job_daily_report = $masterappss->activated;
        $daily_report->target_finish = $masterappss->build_date;
        $daily_report->note = $masterappss->note;
        $daily_report->create_date = $masterappss->build_date;
        $daily_report->user_updated = Sentry::getUser()->id;
        $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_itd@pancaran-group.com';
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
        return Redirect::route('listMasterAppss');
    }
    
    /**
     * Melakukan proses non-aktifasi master aplikasi
     */
    public function nonactive($masterappsId)
    {
        $masterappss = MasterApps::find($masterappsId);
        $masterappss->activated = 0;
        $masterappss->save();

        $daily_report = new DailyReport;
        $daily_report->master_apps_id = $masterappss->id;
        $daily_report->job = $masterappss->name_apps;
        $daily_report->description = $masterappss->desc_apps;
        $daily_report->status_job_daily_report = $masterappss->activated;
        $daily_report->target_finish = $masterappss->build_date;
        $daily_report->note = $masterappss->note;
        $daily_report->create_date = $masterappss->build_date;
        $daily_report->user_updated = Sentry::getUser()->id;
        $daily_report->save();

        $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_itd@pancaran-group.com';
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
        return Redirect::route('listMasterAppss');
    }

	/**
     * Melakukan proses delete master aplikasi
     */
	public function delete($masterappsId)
    {
        $masterappss = MasterApps::find($masterappsId);
        $masterappss->delete();

        return Redirect::route('listMasterAppss')->withPesan('Application Master has been deleted.');
    }

}