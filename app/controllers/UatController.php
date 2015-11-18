<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class UatController extends \BaseController {

	/**
     * Mengambil Index Page UAT
     */
	public function getIndex()
    {
        // get alls Vendors
        $uats = Uat::orderBy('id', 'DESC')->get();
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
            
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.uats-list'), array('uats' => $uats, 'users' => $users, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.uats-index'), array('uats' => $uats, 'users' => $users, 'projectNames' => $projectNames));
        $this->layout->title = "User Accept Test";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.uats');
    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $projectName = Input::get('projectNameSearch');
        $actualUATDate = Input::get('actualUATDateSearch');
        $userUAT = Input::get('userUATSearch');
        $revision = Input::get('revisionSearch');
        
        if (empty($projectName)) {
            $uats = Uat::orderBy('id','DESC')->get();

            if (empty($actualUATDate)) {
                $uats = Uat::orderBy('id','DESC')->get();

                if (empty($userUAT)) {
                    $uats = Uat::orderBy('id','DESC')->get();

                    if (empty($revision)) {
                        $uats = Uat::orderBy('id','DESC')->get();
                    } else {
                        $uats = Uat::where('uat_revision', 'LIKE', '%'.$revision.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
                    }
                } else {
                    $uats = Uat::where('uat_user', 'LIKE', '%'.$userUAT.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
                }
            } else {
                $uats = Uat::where('uat_actual_date', 'LIKE', '%'.$actualUATDate.'%')
                            ->orderBy('id','DESC')
                            ->get();
            }
        } else {
            $uats = Uat::where('project_apps_id', 'LIKE', '%'.$projectName.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
            
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.uats-list'), array('uats' => $uats, 'users' => $users, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.uats-index'), array('uats' => $uats, 'users' => $users, 'projectNames' => $projectNames));
        $this->layout->title = "User Accept Test";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.uats');
    }

	/**
     * Menampilkan form create UAT
     */
	public function getCreate()
    {
        $projects = array('' => '');
        foreach(DB::table('design_apps')
                ->join('project','design_apps.project_id','=','project.id')
                ->join('master_status','design_apps.status_sit','=','master_status.id')
                ->where('design_apps.status_sit','=','15')
                ->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projects[$row->id] = $row->name_project;
            
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        $this->layout = View::make(Config::get('adminlte::views.uat-create'), array('projects' => $projects, 'users' => $users));
        $this->layout->title = "New User Accept Test";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_uat');
    }

	/**
     * Melakukan proses create UAT
     */
	public function postCreate()
    {
        $aturan = array(
            'sequence' => 'required|numeric|max:2',
            'project_apps_id' => 'required', 
            'uat_target' => 'required',
            'uat_actual_date' => 'required',
            'uat_user' => 'required',
            'uat_note' => 'required', 
            'uat_revision' => 'required',
        );
		
		$projectname = Input::get('project_apps_id');

        $seq = DB::table('uat')
                        ->select(DB::raw('max(sequence) as newSequence'))
                        ->where('project_apps_id',$projectname)
                        ->groupBy('project_apps_id')
                        ->first();
        if ($seq == null) {
            $sequence = 1;
        } else {
            $newSeq = $seq->newSequence;
            $sequence = $newSeq+1;    
        }

        if (Input::hasFile('fileUat')){
            $fileUat = Input::file('fileUat');
            $destinationPath = 'uploads/';
            $extension = $fileUat->getClientOriginalExtension();
            $filenameUat =  $projectname.'-uat.'.$extension;
            $upload_success = $fileUat->move($destinationPath, $filenameUat);
        } else {
            $filenameUat = Input::get('uat_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $uat = new uat;
            # Buatkan variabel tiap inputan
            $uat->sequence = $sequence;
            $uat->project_apps_id = Input::get('project_apps_id');
            $uat->uat_target = Input::get('uat_target');
            $uat->uat_user = Input::get('uat_user');
            $uat->uat_actual_date = Input::get('uat_actual_date');
            $uat->uat_note = Input::get('uat_note');
            $uat->uat_revision = Input::get('uat_revision');
            $uat->uat_file = $filenameUat;
            $uat->uat_status = 26;
            $uat->user_created = Input::get('user_created');
            $uat->save();

            $testing = Testing::where('project_id','=',$uat->project_apps_id)->update(array('status_sit' => 14));

            $daily_report = new DailyReport;
            $daily_report->uat_id = $uat->id;
            $daily_report->job = $uat->project->name_project;
            $daily_report->description = $uat->uat_target;
            $daily_report->status_job_daily_report = $uat->uat_status;
            $daily_report->target_finish = $uat->uat_actual_date;
            $daily_report->note = $uat->uat_note;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New User Accept Test Created';
            $autoemail->subject = $uat->uat_target;
            $autoemail->message = 'Sequence : '.$uat->sequence
                                    .'<br /> ID Project : '.$uat->project_apps_id
                                    .'<br /> UAT Target :'.$uat->uat_target
                                    .'<br /> UAT User :'.$uat->user->username
                                    .'<br /> UAT Actual Date :'.$uat->uat_actual_date
                                    .'<br /> UAT Note :'.$uat->uat_note
                                    .'<br /> UAT Revision :'.$uat->uat_revision
                                    .'<br /> UAT Status :'.$uat->uat_status;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New User Accept Test has been Added');
            return Redirect::route('listUats');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit UAT
     */
	public function getShow($uatId)
    {
        try
        {
            $uats = Uat::find($uatId);
            
            $projects = array('' => '');
            foreach(DB::table('design_apps')
                    ->join('project','design_apps.project_id','=','project.id')
                    ->join('master_status','design_apps.status_sit','=','master_status.id')
                    ->where('design_apps.status_sit','=','15')
                    ->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $projects[$row->id] = $row->name_project;
                
            $users = array('' => '');
            foreach(User::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $users[$row->id] = $row->username;

            $this->layout = View::make(Config::get('adminlte::views.uat-edit'), array(
                'uats' => $uats,
                'projects' => $projects,
                'users' => $users,
            ));

            $this->layout->title = $uats->project->name_project;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "User Accept Test",
                    'link' => URL::route('listUats'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $uats->project->name_project,
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
     * Melakukan proses update UAT ke database
     */
	public function putShow($uatId)
    {
        $aturan = array(
            'sequence' => 'required',
            'project_apps_id' => 'required', 
            'uat_target' => 'required',
            'uat_actual_date' => 'required',
            'uat_user' => 'required',
            'uat_note' => 'required', 
            'uat_revision' => 'required',
        );

        $projectname = Input::get('project_apps_id');

        if (Input::hasFile('fileUat')){
            $fileUat = Input::file('fileUat');
            $destinationPath = 'uploads/';
            $extension = $fileUat->getClientOriginalExtension();
            $filenameUat =  $projectname.'-uat.'.$extension;
            $upload_success = $fileUat->move($destinationPath, $filenameUat);
        } else {
            $filenameUat = Input::get('uat_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
            # Bila validasi sukses
        } else {
            $uats = Uat::find($uatId);
            # Buatkan variabel tiap inputan
            $uats->sequence = Input::get('sequence');
            $uats->project_apps_id = Input::get('project_apps_id');
            $uats->uat_target = Input::get('uat_target');
            $uats->uat_actual_date = Input::get('uat_actual_date');
            $uats->uat_user = Input::get('uat_user');
            $uats->uat_note = Input::get('uat_note');
            $uats->uat_revision = Input::get('uat_revision');
            $uats->uat_file = $filenameUat;
            $uats->user_updated = Input::get('user_updated');
            $uats->save();

            $daily_report = new DailyReport;
            $daily_report->uat_id = $uats->id;
            $daily_report->job = $uats->project->name_project;
            $daily_report->description = $uats->uat_target;
            $daily_report->status_job_daily_report = $uats->uat_status;
            $daily_report->target_finish = $uats->uat_actual_date;
            $daily_report->note = $uat->uats_note;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New User Accept Test Created';
            $autoemail->subject = $uat->uat_target;
            $autoemail->message = 'Sequence : '.$uat->sequence
                                    .'<br /> ID Project : '.$uat->project_apps_id
                                    .'<br /> UAT Target :'.$uat->uat_target
                                    .'<br /> UAT User :'.$uat->user->username
                                    .'<br /> UAT Actual Date :'.$uat->uat_actual_date
                                    .'<br /> UAT Note :'.$uat->uat_note
                                    .'<br /> UAT Revision :'.$uat->uat_revision
                                    .'<br /> UAT Status :'.$uat->uat_status;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('User Accept Test has been changed.');
            return Redirect::route('listUats');
        }
    }

	/**
     * Melakukan proses delete UAT
     */
	public function delete($uatId)
    {
        $uats = Uat::find($uatIdId);
        $uats->delete();

        return Redirect::route('listUats')->withPesan('User Accept Test has been deleted.');
    }

    /**
     * Melakukan proses download manual book project
     */
    public function getDownloadUatFile($uatId)
    {
        $uatfiles = Project::find($uatId);
        $fileuats = public_path().'/uploads/'.$uatfiles->uat_file;
        $response = Response::download($fileuats);
        return $response;
    }

}