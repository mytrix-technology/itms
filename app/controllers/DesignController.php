<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class DesignController extends \BaseController {

	/**
     * Mengambil Index Page Design
     */
    public function getIndex()
    {
        // get alls Vendors
        $designs = Design::orderBy('id', 'DESC')->get();
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.designs-list'), array('designs' => $designs, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.designs-index'), array('designs' => $designs, 'projectNames' => $projectNames));
        $this->layout->title = "Designs";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.designs');
    }
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $projectName = Input::get('projectNameSearch');

        if (empty($projectName)) {
            $designs = Design::orderBy('id', 'DESC')->get();
        } else {
            $designs = Design::where('project_id', 'LIKE', '%'.$projectName.'%')
                            ->orderBy('id','DESC')
                            ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.designs-list'), array('designs' => $designs, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.designs-index'), array('designs' => $designs, 'projectNames' => $projectNames));
        $this->layout->title = "Designs";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.designs');
    }
    
    /**
     * Menampilkan detail page daily report
     */
    public function getDetail()
    {
        // get alls Vendors
        $designdetails = DesignDetail::paginate(20);

        $this->layout = View::make(Config::get('adminlte::views.designs-detail'), array('designdetails' => $designdetails));
        $this->layout->title = "Vendors";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.designdetails');
    }

	/**
     * Menampilkan form create design baru
     */
	public function getCreate()
    {
        $projects = array('' => '');
        foreach(Project::where('status_project_request','!=','4')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projects[$row->id] = $row->name_project;

        $this->layout = View::make(Config::get('adminlte::views.design-create'), array('projects' => $projects));
        $this->layout->title = "New Design";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_design');
    }

	/**
     * Melakukan proses create design baru
     */
	public function postCreate()
    {
        $aturan = array(
            'project_apps_id' => 'required', 
            'rule' => 'required',
            'remark' => 'required|min:10',
            //'desc_table_file' => 'required',
        );

        $projectname = Input::get('project_apps_id');

        $version = DB::table('design_apps')
                        ->select(DB::raw('max(design_name_version) as newVersion'))
                        ->where('project_id',$projectname)
                        ->groupBy('project_id')
                        ->first();
        if ($version == null) {
            $design_version = 1;
        } else {
            $newV = $version->newVersion;
            $design_version = $newV+1;    
        }
        
        //$projectname = Input::get('project_apps_id');

        if (Input::hasFile('fileTable')){
            $fileTable = Input::file('fileTable');
            $destinationPath = 'uploads/';
            $extension = $fileTable->getClientOriginalExtension();
            $filenameTable =  $projectname.'-design.'.$extension;
            $upload_success = $fileTable->move($destinationPath, $filenameTable);
        } else {
            $filenameTable = "";
        }

        /*if (Input::hasFile('fileForm')){
            $fileForm = Input::file('fileForm');
            $destinationPath = 'uploads/';
            $extension = $fileForm->getClientOriginalExtension();
            $filenameForm =  $projectname.'-designform.'.$extension;
            $upload_success = $fileForm->move($destinationPath, $filenameForm);
        }*/

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $design = new Design;
            # Buatkan variabel tiap inputan
            $design->project_id = Input::get('project_apps_id');
            $design->design_name_version = $design_version;
            $design->rule = Input::get('rule');
            $design->remark = Input::get('remark');
            $design->design_table_file = $filenameTable;
            $design->desc_table_file = Input::get('desc_table_file');
            $design->status_design = 34;
            $design->user_created = Input::get('user_created');
            $design->save();

            $project = Project::where('id','=',$design->project_id)->update(array('status_project_request' => 2));

            $daily_report = new DailyReport;
            $daily_report->design_id = $design->id;
            $daily_report->job = $design->project->name_project;
            $daily_report->description = $design->desc_table_file;
            $daily_report->status_job_daily_report = $design->project->status_project_request;
            $daily_report->target_finish = $design->project->due_date;
            $daily_report->note = $design->rule.'<br />'.$design->remark;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ndaru@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ou_it@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Design Created';
            $autoemail->subject = $design->design_table_file;
            $autoemail->message = 'ID Project : '.$design->project_id
                                    .'<br /> Design Name Version : '.$design->design_name_version
                                    .'<br /> Rule : '.$design->rule
                                    .'<br /> Remark :'.$design->remark
                                    .'<br /> Design Table File :'.$design->design_table_file
                                    .'<br /> Description Table File :'.$design->desc_table_file;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New Design has been Added');
            return Redirect::route('listDesigns');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit design
     */
	public function getShow($designId)
    {
        try
        {
            $designs = Design::find($designId);
            $masterappss = array('' => '');
            foreach(Project::where('status_project_request','!=','4')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $projects[$row->id] = $row->name_project;
            
            $this->layout = View::make(Config::get('adminlte::views.design-edit'), array(
                'designs' => $designs,
                'projects' => $projects,
            ));

            $this->layout->title = $designs->project->name_project;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Design",
                        'link' => URL::route('listDesigns'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $designs->project->name_project,
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
     * Melakukan proses update design ke database
     */
	public function putShow($designId)
    {
        $aturan = array(
            'project_apps_id' => 'required', 
            'rule' => 'required',
            'remark' => 'required|min:10',
            //'desc_table_file' => 'required',
        );
        
        $projectname = Input::get('project_apps_id');

        if (Input::hasFile('fileTable')){
            $fileTable = Input::file('fileTable');
            $destinationPath = 'uploads/';
            $extension = $fileTable->getClientOriginalExtension();
            $filenameTable =  $projectname.'-designtable.'.$extension;
            $upload_success = $fileTable->move($destinationPath, $filenameTable);
        } else {
            $filenameTable = Input::get('design_table_file');
        }

        /*if (Input::hasFile('fileForm')){
            $fileForm = Input::file('fileForm');
            $destinationPath = 'uploads/';
            $extension = $fileForm->getClientOriginalExtension();
            $filenameForm =  $projectname.'-designform.'.$extension;
            $upload_success = $fileForm->move($destinationPath, $filenameForm);
        } else {
            $filenameForm = Input::get('design_form_file');
        }*/

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $designs = Design::find($designId);
            # Buatkan variabel tiap inputan
            $designs->project_id = Input::get('project_apps_id');
            $designs->design_name_version = Input::get('design_name_version');
            $designs->rule = Input::get('rule');
            $designs->remark = Input::get('remark');
            $designs->design_table_file = $filenameTable;
            $designs->desc_table_file = Input::get('desc_table_file');
            $designs->user_updated = Input::get('user_updated');
            $designs->save();

            $daily_report = new DailyReport;
            $daily_report->design_id = $designs->id;
            $daily_report->job = $designs->project->name_project;
            $daily_report->description = $designs->desc_table_file;
            $daily_report->status_job_daily_report = $designs->project->status_project_request;
            $daily_report->target_finish = $designs->project->due_date;
            $daily_report->note = $designs->rule.'<br />'.$designs->remark;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ndaru@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ou_it@pancaran-group.com';
            $autoemail->judul = 'ITMS - Design Updated';
            $autoemail->subject = $designs->design_table_file;
            $autoemail->message = 'ID Project : '.$designs->project_id
                                    .'<br /> Design Name Version : '.$designs->design_name_version
                                    .'<br /> Rule : '.$designs->rule
                                    .'<br /> Remark :'.$designs->remark
                                    .'<br /> Design Table File :'.$designs->design_table_file
                                    .'<br /> Description Table File :'.$designs->desc_table_file;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Design has been Changed');
            return Redirect::route('listDesigns');
        }
    }

	/**
     * Melakukan proses download dari upload design table
     */
	public function getDownloadTable($designId)
	{
        $designtables = Design::find($designId);
        $filetables = public_path().'/uploads/'.$designtables->design_table_file;
        $response = Response::download($filetables);
        return $response;
	}

    /**
     * Melakukan proses download dari upload design form
     */
    public function getDownloadForm($designId)
    {
        $designforms = Design::find($designId);
        $fileforms = public_path().'/uploads/'.$designforms->design_form_file;
        $response = Response::download($fileforms);
        return $response;
    }

}