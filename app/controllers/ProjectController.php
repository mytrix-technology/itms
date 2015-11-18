<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class ProjectController extends \BaseController {

	/**
     * Mengambil Index Page Project
     */
	public function getIndex()
    {
        // get alls Vendors
        $projects = Project::orderBy('id','DESC')->get();
        
        // Status 
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','project')
							->where('activated','=','1')
							->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.projects-list'), array('projects' => $projects,'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.projects-index'), array('projects' => $projects,'masterstatuss' => $masterstatuss));
        $this->layout->title = "Application Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.projects');
    }
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $projectName = Input::get('projectNameSearch');
        $referenceNo = Input::get('referenceNoSearch');
        $userRequest = Input::get('requestUserSearch');
        $status = Input::get('statusSearch');

        if (empty($projectName)) {
            $projects = Project::orderBy('id','DESC')->get();

            if (empty($referenceNo)) {
                $projects = Project::orderBy('id','DESC')->get();

                if (empty($userRequest)) {
                    $projects = Project::orderBy('id','DESC')->get();

                    if (empty($status)) {
                        $projects = Project::orderBy('id','DESC')->get();
                    } else {
                        $projects = Project::where('status_project_request', 'LIKE', '%'.$status.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
                    }
                } else {
                    $projects = Project::where('user_request', 'LIKE', '%'.$userRequest.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
                }
            } else {
                $projects = Project::where('reference', 'LIKE', '%'.$referenceNo.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
            }
        } else {
            $projects = Project::where('name_project', 'LIKE', '%'.$projectName.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
        }
        
        // Status 
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','project')
							->where('activated','=','1')
							->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.projects-list'), array('projects' => $projects,'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.projects-index'), array('projects' => $projects,'masterstatuss' => $masterstatuss));
        $this->layout->title = "Application Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.projects');
    }

    /**
     * Menampilkan list project berdasarkan status pada halaman dashboard
     */
    public function getDashStatusProject($projectStatus)
    {
        // get alls Vendors
        $projects = Project::where('status_project_request', '=', $projectStatus)->get(array('id','name_project','reference','master_apps_id','master_modul_id','master_type_project_id','desc_project','user_request','status_project_request','manual_book_file','doc_project_file'));
        
        // Status 
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','project')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.projects-list'), array('projects' => $projects,'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.projects-index'), array('projects' => $projects,'masterstatuss' => $masterstatuss));
        $this->layout->title = "Application Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.projects');
    }
    
    /**
     * Menampilkan page detail project
     */
    public function getDetail($projectId)
    {
        try
        {
            $detailprojects = Project::find($projectId);

            $this->layout = View::make(Config::get('adminlte::views.projects-detail'), array(
                'detailprojects' => $detailprojects,
            ));

            $this->layout->title = $detailprojects->name_project;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "Project",
                    'link' => URL::route('listProjects'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $detailprojects->name_project,
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
     * Menampilkan form create project
     */
	public function getCreate()
    {
        $masterappss = array('' => '');
        foreach(MasterApps::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterappss[$row->id] = $row->name_apps;

        $mastermoduls = array('' => '');
        foreach(MasterModul::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $mastermoduls[$row->id] = $row->name_modul;

        $masterprojecttypes = array('' => '');
        foreach(MasterProjectType::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterprojecttypes[$row->id] = $row->name_project_type;

		$this->layout = View::make(Config::get('adminlte::views.project-create'), array('masterappss' => $masterappss, 'mastermoduls' => $mastermoduls, 'masterprojecttypes' => $masterprojecttypes));
        $this->layout->title = "New Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_project');
    }
    
	/**
     * Melakukan proses create project
     */
	public function postCreate()
    {
        $aturan = array(
            'name_project' => 'required', 
            //'reference' => 'required',
            'desc_project' => 'required',
            'user_request' => 'required',
            //'status_project_request' => 'required',
			//'fileManual' => 'required',
			'fileDoc' => 'required', 
            //'apps' => 'required',
            //'modul' => 'required',
            'master_type_project_id' => 'required',
        );

        switch(Input::get('type')):
            case 'modul':
                $return = '<option value=""></option>';
                foreach(MasterModul::where('master_apps_id', Input::get('id'))
									->where('activated','=','1')
									->get() as $row)
                    $return .= "<option value='$row->id'>$row->name_modul</option>";
                return $return;
            break;
        endswitch;

        $projectname = Input::get('name_project');

        /*if (Input::hasFile('fileManual')){
            $fileManual = Input::file('fileManual');
            $destinationPath = 'uploads/';
            $extension = $fileManual->getClientOriginalExtension();
            $filenameManual =  $projectname.'-manualbook.'.$extension;
            $upload_success = $fileManual->move($destinationPath, $filenameManual);
        }*/

        if (Input::hasFile('fileDoc')){
            $fileDoc = Input::file('fileDoc');
            $destinationPath = 'uploads/';
            $extension = $fileDoc->getClientOriginalExtension();
            $filenameDoc =  $projectname.'-docproject.'.$extension;
            $upload_success = $fileDoc->move($destinationPath, $filenameDoc);
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $project = new Project;
            # Buatkan variabel tiap inputan
            $project->name_project = Input::get('name_project');
            $project->reference = Input::get('reference');
            $project->desc_project = Input::get('desc_project');
            $project->user_request = Input::get('user_request');
            $project->status_project_request = 1;
            $project->master_apps_id = Input::get('apps');
            $project->master_modul_id = Input::get('modul');
            $project->master_type_project_id = Input::get('master_type_project_id');
            $project->project_request_date = date('Y-m-d H:i:s');
            $project->due_date = Input::get('datepicker');
            $project->doc_project_file = $filenameDoc;
            $project->user_created = Input::get('user_created');
            $project->save();

            $daily_report = new DailyReport;
            $daily_report->project_id = $project->id;
            $daily_report->job = $project->name_project;
            $daily_report->description = $project->desc_project;
            $daily_report->status_job_daily_report = $project->status_project_request;
            $daily_report->create_date = $project->project_request_date;
            $daily_report->target_finish = $project->due_date;
            $daily_report->note = $project->user_request;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = Sentry::getUser()->email;
            $autoemail->judul = 'ITMS - New Application Update Created';
            $autoemail->subject = $project->name_project;
            $autoemail->message = 'Project Name : '.$project->name_project
                                    .'<br /> Reference Number : '.$project->reference
                                    .'<br /> Project Description :'.$project->desc_project
                                    .'<br /> User Request :'.$project->user_request
                                    .'<br /> Status :'.$project->masterstatus->status_name
                                    .'<br /> Master Application :'.$project->masterapps->name_apps
                                    .'<br /> Master Modul :'.$project->mastermodul->name_modul
                                    .'<br /> Master Type Project :'.$project->masterprojecttype->name_project_type
                                    .'<br /> Project Request Date :'.$project->project_request_date
                                    .'<br /> Due Date :'.$project->due_date
                                    .'<br /> Doc Project File :'.$project->doc_project_file;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New Project has been Added');
            return Redirect::route('listProjects');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit project
     */
    public function getShow($projectId)
    {
        try
        {
            $projects = Project::find($projectId);
            $masterappss = array('' => '');
            foreach(MasterApps::where('activated','=','1')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterappss[$row->id] = $row->name_apps;

            $mastermoduls = array('' => '');
            foreach(MasterModul::where('activated','=','1')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $mastermoduls[$row->id] = $row->name_modul;

            $masterprojecttypes = array('' => '');
            foreach(MasterProjectType::where('activated','=','1')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterprojecttypes[$row->id] = $row->name_project_type;

            $masterstatuss = array('' => '');
            foreach(MasterStatus::where('group','=','project')
								->where('activated','=','1')
								->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

            $this->layout = View::make(Config::get('adminlte::views.project-edit'), array(
                'projects' => $projects,
                'masterappss' => $masterappss,
                'mastermoduls' => $mastermoduls,
                'masterprojecttypes' => $masterprojecttypes,
                'masterstatuss' => $masterstatuss,
            ));

            $this->layout->title = $projects->name_project;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "Project",
                    'link' => URL::route('listProjects'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $projects->name_project,
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
     * Melakukan proses update project ke database
     */
    public function putShow($projectId)
    {
        $aturan = array(
            'name_project' => 'required',
            //'reference' => 'required',
            'desc_project' => 'required|min:10',
            'user_request' => 'required',
            //'status_project_request' => 'required',
            'apps' => 'required',
            'modul' => 'required',
            'master_type_project_id' => 'required',
        );
		
		switch(Input::get('type')):
            case 'modul':
                $return = '<option value=""></option>';
                foreach(MasterModul::where('master_apps_id', Input::get('id'))
									->where('activated','=','1')
									->get() as $row)
                    $return .= "<option value='$row->id'>$row->name_modul</option>";
                return $return;
            break;
        endswitch;

        $projectname = Input::get('name_project');

        if (Input::hasFile('fileDoc')){
            $fileDoc = Input::file('fileDoc');
            $destinationPath = 'uploads/';
            $extension = $fileDoc->getClientOriginalExtension();
            $filenameDoc =  $projectname.'-docproject.'.$extension;
            $upload_success = $fileDoc->move($destinationPath, $filenameDoc);
        } else {
            $filenameDoc = Input::get('doc_project_file');
        }

        $statusproject = Input::get('status_project_request');
        
        if ($statusproject == 4) {
            $tasks = Project::join('tasklist','project.id','=','tasklist.reference')
                            ->where('project.id','=',$projectId)
                            ->get();

            if ($tasks) {
                    ?>
                    <script type="text/javascript">
                        alert('This project still has some task list');
                        window.location.href='<?php $projectId ?>';
                    </script>
                    <?php
                }
        } else {
            $validasi = Validator::make(Input::all(), $aturan);

            if($validasi->fails()) {
                # Kembali kehalaman yang sama dengan pesan error
                return Redirect::back()->withErrors($validasi)->withInput();
                # Bila validasi sukses
            } else {
                $projects = Project::find($projectId);
                # Buatkan variabel tiap inputan
                $projects->name_project = Input::get('name_project');
                $projects->reference = Input::get('reference');
                $projects->desc_project = Input::get('desc_project');
                $projects->user_request = Input::get('user_request');
                $projects->status_project_request = Input::get('status_project_request');
                $projects->master_apps_id = Input::get('apps');
                $projects->master_modul_id = Input::get('modul');
                $projects->master_type_project_id = Input::get('master_type_project_id');
                $projects->due_date = Input::get('datepicker');
                $projects->doc_project_file = $filenameDoc;
                $projects->user_updated = Input::get('user_updated');
                $projects->save();

                $daily_report = new DailyReport;
                $daily_report->project_id = $projects->id;
                $daily_report->job = $projects->name_project;
                $daily_report->description = $projects->desc_project;
                $daily_report->status_job_daily_report = $projects->status_project_request;
                $daily_report->create_date = $projects->project_request_date;
                $daily_report->target_finish = $projects->due_date;
                $daily_report->note = $projects->user_request;
                $daily_report->user_updated = Sentry::getUser()->id;
                $daily_report->save();

                $autoemail = new Autoemail;
                $autoemail->setConnection('mysqlemail');
                $autoemail->to = 'ou_it_pdt@pancaran@pancaran-group.com';
                $autoemail->from = Sentry::getUser()->email;
                $autoemail->cc = 'ndaru@pancaran-group.com';
                $autoemail->judul = 'ITMS - New Project Created';
                $autoemail->subject = $projects->name_project;
                $autoemail->message = 'Project Name : '.$projects->name_project
                                        .'<br /> Reference Number : '.$projects->reference
                                        .'<br /> Project Description :'.$projects->desc_project
                                        .'<br /> User Request :'.$projects->user_request
                                        .'<br /> Status :'.$projects->masterstatus->status_name
                                        .'<br /> Master Application :'.$projects->masterapps->name_apps
                                        .'<br /> Master Modul :'.$projects->mastermodul->name_modul
                                        .'<br /> Master Type Project :'.$projects->masterprojecttype->name_project_type
                                        .'<br /> Project Request Date :'.$projects->project_request_date
                                        .'<br /> Due Date :'.$projects->due_date
                                        .'<br /> Doc Project File :'.$projects->doc_project_file;
                $autoemail->tglinput = date('Y-m-d H:i:s');
                $autoemail->userinput = Sentry::getUser()->username;
                $autoemail->tglupdate = date('Y-m-d H:i:s');
                $autoemail->userupdate = Sentry::getUser()->username;
                $autoemail->status = 1;
                $autoemail->save();

                //kirim mesej ke webpdt status project development
                //hardcode untuk development
                //ati2hardcode nyaaa
                if( $projects->status_project_request == 24 )
                    $this->getExportProject($projects,2);

                Notification::info('Project has been Changed');
                return Redirect::route('listProjects');
            }
        }
    }

    public function getExportProject($projects,$setVal)
    {
        //echo "tes";
        $url = "http://localhost/webpdt/sp/pengembangan/updateProses";

        $data = array('siYear'=>$projects['projectYear'],'nuDevNo'=>$projects['reference'],'status'=>$setVal);
        //echo "<pre>";print_r($data);exit;
        $ch = curl_init($url);
        $data_string = urlencode(json_encode($data));
        
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, array("datakirim"=>$data_string));
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        echo $result;
        
        //return $result;
        
        //$data = $this->input->post();
    }

    public function showData()
    {
        //json_decode(urldecode($_POST['datakirim']),true)
        print_r(urldecode( $_POST['datakirim']));
    }

	/**
     * Melakukan proses closing status project
     */
    public function close($projectId)
    {
        $projects = Project::find($projectId);
        $projects->status_project_request = 4;
        $projects->save();

        $tasklist = Tasklist::where('reference','=',$projects->id)->update(array('status_tasklist' => 9));
        $testing = Testing::where('project_id','=',$projects->id)->update(array('status_sit' => 15));

        //kirim mesej ke webpdt status project close
        //hardcode untuk development
        //ati2hardcode nyaaa
        $this->getExportProject($projects,3);


        return Redirect::route('listProjects');
    }

    public function closeStatus($projectId)
    {
        $project = Project::find($projectId);
        $project->status_project_request = 4;
        $project->save();

        /*$daily_report = new DailyReport;
        $daily_report->project_id = $project->id;
        $daily_report->job = $project->name_project;
        $daily_report->description = $project->desc_project;
        $daily_report->status_job_daily_report = $project->status_project_request;
        $daily_report->target_finish = $project->due_date;
        $daily_report->note = $project->user_request;
        $daily_report->create_date = $project->project_request_date;
        $daily_report->user_updated = Sentry::getUser()->id;
        $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_it_pdt@pancaran-group.com';
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
            $autoemails->save();*/

        //Notification:success('Application Update has been Activated');
        return Redirect::route('listProjects');
    }

    public function open($projectId)
    {
        $projects = Project::find($projectId);
        $projects->status_project_request = 1;
        $projects->save();

        /*$daily_report = new DailyReport;
        $daily_report->project_id = $projects->id;
        $daily_report->job = $projects->name_project;
        $daily_report->description = $projects->desc_project;
        $daily_report->status_job_daily_report = $projects->status_project_request;
        $daily_report->target_finish = $projects->due_date;
        $daily_report->note = $projects->user_request;
        $daily_report->create_date = $projects->project_request_date;
        $daily_report->user_updated = Sentry::getUser()->id;
        $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_it_pdt@pancaran-group.com';
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
            $autoemails->save();*/

        //Notification:success('Application Update has been Activated');
        return Redirect::route('listProjects');
    }

    

    /**
     * Melakukan proses download manual book project
     */
    public function getDownloadManualBook($projectId)
    {
        $manualbooks = Project::find($projectId);
        $filemanualbooks = public_path().'/uploads/'.$manualbooks->manual_book_file;
        $response = Response::download($filemanualbooks);
        return $response;
    }

    /**
     * Melakukan proses download dokumentasi project
     */
    public function getDownloadDocProject($projectId)
    {
        $docprojects = Project::find($projectId);
        $filedocprojects = public_path().'/uploads/'.$docprojects->doc_project_file;
        $response = Response::download($filedocprojects);
        return $response;
    }

	/*
	 * to pa Yudhis
	 * untuk email harus dimasukkan ke method yang terpisah
	 */
    public function getimportProject()
    {
        $importData = json_decode(urldecode($_POST['datakirim']),true);
        
        if( !isset( $importData['nuDevNo'] )){
            echo "no data";
            exit;
        }
        else{
                $project = new Project;
                # Buatkan variabel tiap inputan
                $project->name_project = $importData['chText'];
                $project->reference = $importData['nuDevNo'];
				$project->projectYear = $importData['siYear'];
                $project->desc_project = $importData['txAnalisa'];
                $project->user_request = $importData['chRequestor'];
                $project->dept_user_request = $importData['id_dep1'];
                $project->dept_on_project = $importData['id_dep2'].','.$importData['id_dep3'].','.$importData['id_dep4'];
                $project->priority = $importData['priority'];
                $project->status_project_request = 1;
                $project->master_type_project_id = $importData['kategori'];
                $project->project_request_date = date('Y-m-d H:i:s');
                //$project->due_date = $importData[''];
                $project->head_itd_approve = $importData['approvel'];
                $project->date_approve = $importData['tgl_app'];
                $project->remark = isset($importData['txRemark']) ? $importData['txRemark'] : '-';
                
                //~ echo "<pre>";print_r($project);exit;
                
                $project->save();

                $daily_report = new DailyReport;
                $daily_report->project_id = $project->id;
                $daily_report->job = $project->name_project;
                $daily_report->description = $project->desc_project;
                $daily_report->status_job_daily_report = $project->status_project_request;
                $daily_report->create_date = $project->project_request_date;
                $daily_report->target_finish = $project->due_date;
                $daily_report->note = $project->user_request;
                $daily_report->save();

                $autoemail = new Autoemail;
                $autoemail->setConnection('mysqlemail');
                $autoemail->to = 'ou_it@pancaran-group.com';
                $autoemail->from = Sentry::getUser()->email;
                $autoemail->cc = 'ndaru@pancaran-group.com';
                $autoemail->judul = 'ITMS - New Application Update Created';
                $autoemail->subject = $project->name_project;
                $autoemail->message = 'Project Name : '.$project->name_project
                                    .'<br /> Reference Number : '.$project->reference
                                    .'<br /> Project Description :'.$project->desc_project
                                    .'<br /> User Request :'.$project->user_request
                                    .'<br /> Status :'.$project->masterstatus->status_name
                                    .'<br /> Master Application :'.$project->masterapps->name_apps
                                    .'<br /> Master Modul :'.$project->mastermodul->name_modul
                                    .'<br /> Master Type Project :'.$project->masterprojecttype->name_project_type
                                    .'<br /> Project Request Date :'.$project->project_request_date
                                    .'<br /> Due Date :'.$project->due_date
                                    .'<br /> Doc Project File :'.$project->doc_project_file;
                $autoemail->tglinput = date('Y-m-d H:i:s');
                $autoemail->tglupdate = date('Y-m-d H:i:s');
                $autoemail->status = 1;
                $autoemail->save();

                return json_encode(array('status' => 'success', 'messageType' => 'info'));
         }
    }

}
