<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class UpdateAppsController extends \BaseController {

	/**
     * Mengambil Index Page Update aplikasi
     */
	public function getIndex()
    {
        // get alls Vendors
        $updateappss = UpdateApps::orderBy('id','DESC')->get();
        
        // Application Master
        $projectNames = array('' => '');
        foreach(Project::where('status_project_request','!=','4')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
        
        // Status
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','approveUpdate')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;
        
        // User    
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.updateappss-list'), array('updateappss' => $updateappss, 'users' => $users, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.updateappss-index'), array('updateappss' => $updateappss, 'users' => $users, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Application Update";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.updateappss');
    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $appsProject = Input::get('appsProjectSearch');
        //$modulMaster = Input::get('modulMasterSearch');
        $databaseChange = Input::get('databaseChangeSearch');
        $appsChange = Input::get('appsChangeSearch');
        $appsVersion = Input::get('appsVersionSearch');
        $userRequest = Input::get('userRequestSearch');
        $updateDate = Input::get('updateDateSearch');
        $status = Input::get('statusSearch');
        
        if (empty($appsProject)) {
            $updateappss = UpdateApps::orderBy('id','DESC')->get();

            if (empty($databaseChange)) {
                    $updateappss = UpdateApps::orderBy('id','DESC')->get();

                    if (empty($appsChange)) {
                        $updateappss = UpdateApps::orderBy('id','DESC')->get();

                        if (empty($appsVersion)) {
                            $updateappss = UpdateApps::orderBy('id','DESC')->get();
                            
                            if (empty($userRequest)) {
                                $updateappss = UpdateApps::orderBy('id','DESC')->get();

                                if (empty($updateDate)) {
                                    $updateappss = UpdateApps::orderBy('id','DESC')->get();

                                    if (empty($status)) {
                                       $updateappss = UpdateApps::orderBy('id','DESC')->get();
                                    } else {
                                        $updateappss = UpdateApps::where('status_update_apps', 'LIKE', '%'.$status.'%')
                                                ->orderBy('id')
                                                ->get();
                                    }
                                } else {
                                    $updateappss = UpdateApps::where('update_date', 'LIKE', '%'.$updateDate.'%')
                                                ->orderBy('id')
                                                ->get();
                                }
                            } else {
                                $updateappss = UpdateApps::where('user_request', 'LIKE', '%'.$userRequest.'%')
                                            ->orderBy('id')
                                            ->get();
                            }
                        } else {
                            $updateappss = UpdateApps::where('apps_version', 'LIKE', '%'.$appsVersion.'%')
                                        ->orderBy('id')
                                        ->get();
                        }
                    } else {
                        $updateappss = UpdateApps::where('apps_change', 'LIKE', '%'.$appsChange.'%')
                            ->orderBy('id')
                            ->get();
                    }
                } else {
                    $updateappss = UpdateApps::where('database_change', 'LIKE', '%'.$databaseChange.'%')
                            ->orderBy('id')
                            ->get();
                }
            
        } else {
            $updateappss = UpdateApps::where('project_id', '=', $appsProject)
                            ->orderBy('id')
                            ->get();  
        }
        
        // Application Master
        $projectNames = array('' => '');
        foreach(Project::where('status_project_request','!=','4')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
        
        // Status
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','approveUpdate')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;
        
        // User    
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.updateappss-list'), array('updateappss' => $updateappss, 'users' => $users, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.updateappss-index'), array('updateappss' => $updateappss, 'users' => $users, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Application Update";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.updateappss');
    }

	/**
     * Menampilkan form create update aplikasi
     */
	public function getCreate()
    {
        $users = array('' => '');
            foreach(User::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $users[$row->id] = $row->username;

         // Project Name
            $projectNames = array('' => '');
            foreach(Project::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $projectNames[$row->id] = $row->name_project;

            
            
        $this->layout = View::make(Config::get('adminlte::views.updateapps-create'), array('projectNames' => $projectNames, 'users' => $users));
        $this->layout->title = "New Update Application";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_updateapps');
    }

	/**
     * Melakukan proses create update aplikasi
     */
	public function postCreate()
    {
        $aturan = array(
            'id_project' => 'required', 
            'filename_update' => 'required',
            'database_change' => 'required',
            'apps_change' => 'required', 
            'apps_version' => 'required|min:3',
            'pic' => 'required',
            'request_date' => 'required',
            //'update_date' => 'required',
            'remark' => 'required',
        );

        $projectname = Input::get('id_project');

        if (Input::hasFile('fileManual')){
            $fileManual = Input::file('fileManual');
            $destinationPath = 'uploads/';
            $extension = $fileManual->getClientOriginalExtension();
            $filenameManual =  $projectname.'-manualbook.'.$extension;
            $upload_success = $fileManual->move($destinationPath, $filenameManual);
        } else {
            $filenameManual = Input::get('manual_book_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $updateapps = new UpdateApps;
            # Buatkan variabel tiap inputan
            $updateapps->project_id = Input::get('id_project');
            $updateapps->filename_update = Input::get('filename_update');
            $updateapps->database_change = Input::get('database_change');
            $updateapps->apps_change = Input::get('apps_change');
            $updateapps->apps_version = Input::get('apps_version');
            $updateapps->user_request = Input::get('user_request');
            $updateapps->request_date = Input::get('request_date');
            $updateapps->update_date = Input::get('update_date');
            $updateapps->pic = Input::get('pic');
            $updateapps->remark = Input::get('remark');
            $updateapps->manual_book_file = $filenameManual;
            $updateapps->status_update_apps = 16;
            $updateapps->user_created = Input::get('user_created');
            $updateapps->save();

            $project = Project::where('id','=',$updateapps->project_id)->update(array('update_apps_id' => $updateapps->id));

            $daily_report = new DailyReport;
            $daily_report->update_apps_id = $updateapps->id;
            $daily_report->job = $updateapps->project1->name_project;
            $daily_report->description = $updateapps->filename_update;
            $daily_report->status_job_daily_report = $updateapps->status_update_apps;
            $daily_report->target_finish = $updateapps->confirmation_date;
            $daily_report->note = $updateapps->database_change.'<br />'.$updateapps->apps_change;
            $daily_report->create_date = $updateapps->update_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = $updateapps->user->email;
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Application Update Created';
            $autoemail->subject = $updateapps->project1->name_project;
            $autoemail->message = 'Database Change : '.$updateapps->database_change
                                    .'<br /> Application Change : '.$updateapps->apps_change
                                    .'<br /> Version :'.$updateapps->apps_version
                                    .'<br /> User Request :'.$updateapps->user_request
                                    .'<br /> Date Request :'.$updateapps->request_date
                                    .'<br /> Date Update :'.$updateapps->update_date
                                    .'<br /> PIC :'.$updateapps->user->username
                                    .'<br /> Remark :'.$updateapps->remark;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('Application Update has been Added');
            return Redirect::route('listUpdateAppss');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit update aplikasi
     */
	public function getShow($updateappsId)
    {
        try
        {
            $updateappss = UpdateApps::find($updateappsId);
            
            $users = array('' => '');
            foreach(User::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $users[$row->id] = $row->username;

            // Project Name
            $projectNames = array('' => '');
            foreach(Project::where('status_project_request','!=','4')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $projectNames[$row->id] = $row->name_project;

            $this->layout = View::make(Config::get('adminlte::views.updateapps-edit'), array(
                'updateappss' => $updateappss,
                'users' => $users,
                'projectNames' => $projectNames,
            ));

            $this->layout->title = $updateappss->project1->name_project;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Update Application",
                        'link' => URL::route('listUpdateAppss'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $updateappss->project1->name_project,
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
     * Melakukan proses update pada modul update aplikasi ke database
     */
	public function putShow($updateappsId)
    {
        $aturan = array(
            'id_project' => 'required', 
            'filename_update' => 'required',
            'database_change' => 'required',
            'apps_change' => 'required', 
            'apps_version' => 'required|min:3',
            'pic' => 'required',
            'request_date' => 'required',
            //'update_date' => 'required',
            'remark' => 'required',
        );

        $projectname = Input::get('id_project');

        if (Input::hasFile('fileManual')){
            $fileManual = Input::file('fileManual');
            $destinationPath = 'uploads/';
            $extension = $fileManual->getClientOriginalExtension();
            $filenameManual =  $projectname.'-manualbook.'.$extension;
            $upload_success = $fileManual->move($destinationPath, $filenameManual);
        } else {
            $filenameManual = Input::get('manual_book_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $updateappss = UpdateApps::find($updateappsId);
            # Buatkan variabel tiap inputan
            $updateappss->project_id = Input::get('id_project');
            $updateappss->filename_update = Input::get('filename_update');
            $updateappss->database_change = Input::get('database_change');
            $updateappss->apps_change = Input::get('apps_change');
            $updateappss->apps_version = Input::get('apps_version');
            $updateappss->user_request = Input::get('user_request');
            $updateappss->request_date = Input::get('request_date');
            $updateappss->update_date = Input::get('update_date');
            $updateappss->pic = Input::get('pic');
            $updateappss->remark = Input::get('remark');
            $updateappss->manual_book_file = $filenameManual;
            $updateappss->user_updated = Input::get('user_updated');
            $updateappss->save();

            $daily_report = new DailyReport;
            $daily_report->update_apps_id = $updateappss->id;
            $daily_report->job = $updateappss->project1->name_project;
            $daily_report->description = $updateapps->filename_update;
            $daily_report->status_job_daily_report = $updateappss->status_update_apps;
            $daily_report->target_finish = $updateappss->confirmation_date;
            $daily_report->note = $updateappss->database_change.'<br />'.$updateappss->apps_change;
            $daily_report->create_date = $updateappss->update_date;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = $updateappss->user->email;
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Application Update Created';
            $autoemail->subject = $updateappss->project1->name_project;
            $autoemail->message = 'Database Change : '.$updateappss->database_change
                                    .'<br /> Application Change : '.$updateappss->apps_change
                                    .'<br /> Version :'.$updateappss->apps_version
                                    .'<br /> User Request :'.$updateappss->user_request
                                    .'<br /> Date Request :'.$updateappss->request_date
                                    .'<br /> Date Update :'.$updateappss->update_date
                                    .'<br /> PIC :'.$updateappss->user->username
                                    .'<br /> Remark :'.$updateappss->remark;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Application Update has been Changed');
            return Redirect::route('listUpdateAppss');
        }
    }

	/**
     * Melakukan approval update aplikasi
     */
    public function approve($updateappsId)
    {
        $updateappsapprove = UpdateApps::find($updateappsId);
        $updateappsapprove->status_update_apps = 17;
        $updateappsapprove->user_confirmation = Sentry::getUser()->id;
        $updateappsapprove->confirmation_date = date("Y-m-d");
        $updateappsapprove->user_updated = Sentry::getUser()->id;
        $updateappsapprove->save();

        $autoemail = new Autoemail;
        $autoemail->setConnection('mysqlemail');
        $autoemail->to = $updateappsapprove->user->email;
        $autoemail->from = Sentry::getUser()->email;
        $autoemail->cc = 'ndaru@pancaran-group.com';
        $autoemail->judul = 'ITMS - New Application Update Created';
        $autoemail->subject = $updateappsapprove->project1->name_project;
        $autoemail->message = 'Database Change : '.$updateappsapprove->database_change
                                    .'<br /> Application Change : '.$updateappsapprove->apps_change
                                    .'<br /> Version :'.$updateappsapprove->apps_version
                                    .'<br /> User Request :'.$updateappsapprove->user_request
                                    .'<br /> Date Request :'.$updateappsapprove->request_date
                                    .'<br /> Date Update :'.$updateappsapprove->update_date
                                    .'<br /> PIC :'.$updateappsapprove->user->username
                                    .'<br /> Remark :'.$updateappsapprove->remark
                                    .'<br /> Status :'.$updateappsapprove->masterstatus->status_name;
        $autoemail->tglinput = date('Y-m-d H:i:s');
        $autoemail->userinput = Sentry::getUser()->username;
        $autoemail->tglupdate = date('Y-m-d H:i:s');
        $autoemail->userupdate = Sentry::getUser()->username;
        $autoemail->status = 1;
        $autoemail->save();

        //Notification:success('Application Update has been Approved');
        return Redirect::route('listUpdateAppss');
    }

    /**
     * Melakukan reject update aplikasi
     */
    public function reject($updateappsId)
    {
        $updateappsreject = UpdateApps::find($updateappsId);
        $updateappsreject->status_update_apps = 16;
        $updateappsreject->user_confirmation = Sentry::getUser()->id;
        $updateappsreject->confirmation_date = date("Y-m-d");
        $updateappsreject->user_updated = Sentry::getUser()->id;
        $updateappsreject->save();

        $autoemail = new Autoemail;
        $autoemail->setConnection('mysqlemail');
        $autoemail->to = $updateappsreject->user->email;
        $autoemail->from = Sentry::getUser()->email;
        $autoemail->cc = 'ndaru@pancaran-group.com';
        $autoemail->judul = 'ITMS - New Application Update Created';
        $autoemail->subject = $updateappsreject->project1->name_project;
        $autoemail->message = 'Database Change : '.$updateappsreject->database_change
                                    .'<br /> Application Change : '.$updateappsreject->apps_change
                                    .'<br /> Version :'.$updateappsreject->apps_version
                                    .'<br /> User Request :'.$updateappsreject->user_request
                                    .'<br /> Date Request :'.$updateappsreject->request_date
                                    .'<br /> Date Update :'.$updateappsreject->update_date
                                    .'<br /> PIC :'.$updateappsreject->user->username
                                    .'<br /> Remark :'.$updateappsreject->remark
                                    .'<br /> Status :'.$updateappsreject->masterstatus->status_name;
        $autoemail->tglinput = date('Y-m-d H:i:s');
        $autoemail->userinput = Sentry::getUser()->username;
        $autoemail->tglupdate = date('Y-m-d H:i:s');
        $autoemail->userupdate = Sentry::getUser()->username;
        $autoemail->status = 1;
        $autoemail->save();

        //Notification:warning('Application Update has been Rejected');
        return Redirect::route('listUpdateAppss');
    }

    /**
     * Melakukan proses download manual book project
     */
    public function getDownloadManualBook($updateappsId)
    {
        $manualbooks = Project::find($updateappsId);
        $filemanualbooks = public_path().'/uploads/'.$manualbooks->manual_book_file;
        $response = Response::download($filemanualbooks);
        return $response;
    }

}