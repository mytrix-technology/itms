<?php

class ReportController extends \BaseController {

    /**
     * Menampilkan laporan project
     */
	public function getReportProject()
    {
        // get alls Project Report
        $reportprojects = Project::orderBy('id','DESC')->get();
        
        // Project Status
        $statusProjects = array('' => '');
        foreach(MasterStatus::where('group','=','project')->get() as $row)
            $statusProjects[$row->id] = $row->group.' - '.$row->status_name;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reportprojects-list'), array('reportprojects' => $reportprojects, 'statusProjects' => $statusProjects))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportprojects-index'), array('reportprojects' => $reportprojects, 'statusProjects' => $statusProjects));
        $this->layout->title = "Report Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportprojects');
    }

    /**
     * Melakukan proses pencarian inputan data project
     */
    public function postSearchProject()
    {
        // get alls Vendors
        $reportprojects = Project::orderBy('id','DESC')->get();
        
        // Project Name
        $projectName = Input::get('projectNameSearch');
        if(!empty($projectName))
        {
            $reportprojects = Project::where('name_project', 'LIKE', '%'.$projectName.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Reference Number
        $referenceNo = Input::get('referenceNoSearch');
        if(!empty($referenceNo))
        {
            $reportprojects = Project::where('reference', 'LIKE', '%'.$referenceNo.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Request User
        $requestUser = Input::get('requestUserSearch');
        if(!empty($requestUser))
        {
            $reportprojects = Project::where('user_request', 'LIKE', '%'.$requestUser.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Status Project
        $status = Input::get('statusSearch');
        if(!empty($status))
        {
            $reportprojects = Project::where('status_project_request', 'LIKE', '%'.$status.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Project Status
        $statusProjects = array('' => '');
        foreach(MasterStatus::where('group','=','project')->get() as $row)
            $statusProjects[$row->id] = $row->group.' - '.$row->status_name;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reportprojects-list'), array('reportprojects' => $reportprojects, 'statusProjects' => $statusProjects))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportprojects-index'), array('reportprojects' => $reportprojects, 'statusProjects' => $statusProjects));
        $this->layout->title = "Report Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportprojects');
    }

	/**
     * Menampilkan laporan assesment
     */
	public function getReportAssesment()
	{
		// get alls Assesment Report
		$reportassesments = Assesment::orderBy('id','DESC')->get();
		
		// User Name
        $users = array('' => '');
        foreach(User::all() as $row)
            $users[$row->id] = $row->username;

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.reportassesments-list'), array('reportassesments' => $reportassesments, 'users' => $users))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reportassesments-index'), array('reportassesments' => $reportassesments, 'users' => $users));
		$this->layout->title = "Report Assesment";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportassesments');
	}

    /**
     * Melakukan proses pencarian inputan data assesment
     */
    public function postSearchAssesment()
    {
        // get alls Vendors
        $reportassesments = Assesment::orderBy('id','DESC')->get();
        
        // Project Name
        $projectName = Input::get('projectNameSearch');
        if(!empty($projectName))
        {
            $reportassesments = Assesment::where('name_project', 'LIKE', '%'.$projectName.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Reference Number
        $assesmentDate = Input::get('assesmentDateSearch');
        if(!empty($assesmentDate))
        {
            $reportassesments = Assesment::where('assesment_date', 'LIKE', '%'.$assesmentDate.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Request User
        $assesmentUser = Input::get('assesmentUserSearch');
        if(!empty($assesmentUser))
        {
            $reportassesments = Assesment::where('assesment_user', 'LIKE', '%'.$assesmentUser.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // User Name
        $users = array('' => '');
        foreach(User::all() as $row)
            $users[$row->id] = $row->username;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reportassesments-list'), array('reportassesments' => $reportassesments, 'users' => $users))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportassesments-index'), array('reportassesments' => $reportassesments, 'users' => $users));
        $this->layout->title = "Report Assesment";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportassesments');
    }

	/**
     * Menampilkan laporan training
     */
	public function getReportTraining()
	{
		// get alls Training Report
		$reporttrainings = Training::orderBy('id','DESC')->get();
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            $projectNames[$row->id] = $row->name_project;
        
        // User    
        $users = array('' => '');
        foreach(User::all() as $row)
            $users[$row->id] = $row->username;

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.reporttrainings-list'), array('reporttrainings' => $reporttrainings, 'users' => $users, 'projectNames' => $projectNames))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reporttrainings-index'), array('reporttrainings' => $reporttrainings, 'users' => $users, 'projectNames' => $projectNames));
		$this->layout->title = "Report Training";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reporttrainings');
	}
    
    /**
     * Melakukan proses pencarian inputan data training
     */
    public function postSearchTraining()
    {
        // get alls Vendors
        $reporttrainings = Training::orderBy('id','DESC')->get();
        
        // Project Name
        $projectName = Input::get('projectNameSearch');
        if(!empty($projectName))
        {
            $reporttrainings = Training::where('id', 'LIKE', '%'.$projectName.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Training Target
        $trainingTarget = Input::get('trainingTargetSearch');
        if(!empty($trainingTarget))
        {
            $reporttrainings = Training::where('training_target', 'LIKE', '%'.$trainingTarget.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Training Actual Date
        $trainingActualDate = Input::get('trainingActualDateSearch');
        if(!empty($trainingActualDate))
        {
            $reporttrainings = Training::where('training_actual_date', 'LIKE', '%'.$trainingActualDate.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Trainer
        $trainer = Input::get('trainerSearch');
        if(!empty($trainer))
        {
            $reporttrainings = Training::where('trainer', 'LIKE', '%'.$trainer.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            $projectNames[$row->id] = $row->name_project;
        
        // User    
        $users = array('' => '');
        foreach(User::all() as $row)
            $users[$row->id] = $row->username;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reporttrainings-list'), array('reporttrainings' => $reporttrainings, 'users' => $users, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reporttrainings-index'), array('reporttrainings' => $reporttrainings, 'users' => $users, 'projectNames' => $projectNames));
        $this->layout->title = "Report Training";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reporttrainings');
    }

	/**
     * Menampilkan laporan design
     */
	public function getReportDesign()
	{
		// get alls Design Report
		$reportdesigns = Design::orderBy('id','DESC')->get();
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.reportdesigns-list'), array('reportdesigns' => $reportdesigns, 'projectNames' => $projectNames))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reportdesigns-index'), array('reportdesigns' => $reportdesigns, 'projectNames' => $projectNames));
		$this->layout->title = "Report Design";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportdesigns');
	}
    
    /**
     * Melakukan proses pencarian inputan data design
     */
    public function postSearchDesign()
    {
        // get alls Vendors
        $reportdesigns = Design::orderBy('id','DESC')->get();
        
        // Project Name
        $projectName = Input::get('projectNameSearch');
        if(!empty($projectName))
        {
            $reportdesigns = Design::where('project_id', 'LIKE', '%'.$projectName.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            $projectNames[$row->id] = $row->name_project;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reportdesigns-list'), array('reportdesigns' => $reportdesigns, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportdesigns-index'), array('reportdesigns' => $reportdesigns, 'projectNames' => $projectNames));
        $this->layout->title = "Report design";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportdesigns');
    }

	/**
     * Menampilkan laporan SIT/Testing
     */
	public function getReportSit()
	{
		// get alls Vendors
		$reportsits = Testing::orderBy('id','DESC')->get();
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
        
        // Status SIT
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','sit')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.reportsits-list'), array('reportsits' => $reportsits, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reportsits-index'), array('reportsits' => $reportsits, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss));
		$this->layout->title = "Report Testing";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportSITs');
	}
    
    /**
     * Melakukan proses pencarian inputan data SIT/Testing
     */
    public function postSearchSit()
    {
        // get alls Vendors
        $reportsits = Testing::orderBy('id','DESC')->get();
        
        // Project Name
        $projectName = Input::get('projectNameSearch');
        if(!empty($projectName))
        {
            $reportsits = Testing::where('project_id', 'LIKE', '%'.$projectName.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // SIT Date
        $sitDate = Input::get('sitDateSearch');
        if(!empty($sitDate))
        {
            $reportsits = Testing::where('sit_date', 'LIKE', '%'.$sitDate.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // SIT Status
        $sitStatus = Input::get('statusSearch');
        if(!empty($sitStatus))
        {
            $reportsits = Testing::where('status_sit', 'LIKE', '%'.$sitStatus.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
        
        // Status SIT
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','sit')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reportsits-list'), array('reportsits' => $reportsits, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportsits-index'), array('reportsits' => $reportsits, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Report Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportsits');
    }

	/**
     * Menampilkan laporan UAT
     */
	public function getReportUat()
	{
		// get alls Vendors
		$reportuats = Uat::orderBy('id','DESC')->get();
		
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
			$html = View::make(Config::get('adminlte::views.reportuats-list'), array('reportuats' => $reportuats, 'users' => $users, 'projectNames' => $projectNames))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reportuats-index'), array('reportuats' => $reportuats, 'users' => $users, 'projectNames' => $projectNames));
		$this->layout->title = "Report User Accept Test";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportUATs');
	}
    
    /**
     * Melakukan proses pencarian inputan data UAT
     */
    public function postSearchUat()
    {
        // get alls Vendors
        $reportuats = Uat::orderBy('id','DESC')->get();
        
        // Project Name
        $projectName = Input::get('projectNameSearch');
        if(!empty($projectName))
        {
            $reportuats = Uat::where('project_apps_id', 'LIKE', '%'.$projectName.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Actual UAT Date
        $actualUATDate = Input::get('actualUATDateSearch');
        if(!empty($actualUATDate))
        {
            $reportuats = Uat::where('uat_actual_date', 'LIKE', '%'.$actualUATDate.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // User UAT
        $userUAT = Input::get('userUATSearch');
        if(!empty($userUAT))
        {
            $reportuats = Uat::where('uat_user', 'LIKE', '%'.$userUAT.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Revision
        $revision = Input::get('revisionSearch');
        if(!empty($revision))
        {
            $reportuats = Uat::where('uat_revision', 'LIKE', '%'.$revision.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
        
        // User    
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reportuats-list'), array('reportuats' => $reportuats, 'users' => $users, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportuats-index'), array('reportuats' => $reportuats, 'users' => $users, 'projectNames' => $projectNames));
        $this->layout->title = "Report Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportuats');
    }

	/**
     * Menampilkan laporan tasklist
     */
	public function getReportTasklist()
	{
		// get alls Tasklist Report
		$reporttasklists = TaskList::orderBy('id','DESC')->get();
		
		// Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
		
        // Status Tasklist
		$masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;
        
        // Priority
        $masterstatuss1 = array('' => '');
        foreach(MasterStatus::where('group','=','priority')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss1[$row->id] = $row->group.' - '.$row->status_name;
            
       $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.reporttasklists-list'), array('reporttasklists' => $reporttasklists, 'projectNames' => $projectNames,  'users' => $users, 'masterstatuss' => $masterstatuss, 'masterstatuss1' => $masterstatuss1))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reporttasklists-index'), array('reporttasklists' => $reporttasklists, 'projectNames' => $projectNames, 'users' => $users, 'masterstatuss' => $masterstatuss, 'masterstatuss1' => $masterstatuss1));
		$this->layout->title = "Report TaskList";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reporttasklists');
	}

    /**
     * Melakukan proses pencarian inputan data tasklist
     */
    public function postSearchTasklist()
    {
        // get alls Vendors
        $reporttasklists = TaskList::orderBy('id','DESC')->get();
        
        // Subject
        $subject = Input::get('subjectSearch');
        if(!empty($projectName))
        {
            $reporttasklists = TaskList::where('subject', 'LIKE', '%'.$subject.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Assignment To
        $assignmentTo = Input::get('assignmentToSearch');
        if(!empty($assignmentTo))
        {
            $reporttasklists = TaskList::where('assignment_to', 'LIKE', '%'.$assignmentTo.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Status 
        $status = Input::get('statusSearch');
        if(!empty($status))
        {
            $reporttasklists = TaskList::where('status_tasklist', 'LIKE', '%'.$status.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Priority
        $priority = Input::get('prioritySearch');
        if(!empty($priority))
        {
            $reporttasklists = TaskList::where('priority', 'LIKE', '%'.$priority.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Actual Finish Date
        $actualFinishDate = Input::get('actualFinishDateSearch');
        if(!empty($actualFinishDate))
        {
            $reporttasklists = TaskList::where('actual_finish_date', 'LIKE', '%'.$actualFinishDate.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Reference
        $reference = Input::get('referenceSearch');
        if(!empty($reference))
        {
            $reporttasklists = TaskList::where('reference', 'LIKE', '%'.$reference.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
        
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;
            
        $masterstatuss1 = array('' => '');
        foreach(MasterStatus::where('group','=','priority')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss1[$row->id] = $row->group.' - '.$row->status_name;
            
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reporttasklists-list'), array('reporttasklists' => $reporttasklists, 'projectNames' => $projectNames, 'users' => $users, 'masterstatuss' => $masterstatuss, 'masterstatuss1' => $masterstatuss1))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reporttasklists-index'), array('reporttasklists' => $reporttasklists, 'projectNames' => $projectNames, 'users' => $users, 'masterstatuss' => $masterstatuss, 'masterstatuss1' => $masterstatuss1));
        $this->layout->title = "Report Tasklist";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reporttasklists');
    }

    /**
     * Menampilkan laporan daily report
     */
	public function getReportDailyReport()
	{
		// get alls Vendors
		$reportdailyreports = DailyReport::orderBy('id','DESC')->get();
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
            
        // Tasklist
        $tasklists = array('' => '');
        foreach(Tasklist::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $tasklists[$row->id] = $row->subject;
        
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.reportdailyreports-list'), array('reportdailyreports' => $reportdailyreports, 'projectNames' => $projectNames, 'tasklists' => $tasklists, 'masterstatuss' => $masterstatuss))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reportdailyreports-index'), array('reportdailyreports' => $reportdailyreports, 'projectNames' => $projectNames, 'tasklists' => $tasklists, 'masterstatuss' => $masterstatuss));
		$this->layout->title = "Report Job Daily Report";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportdailyreports');
	}
    
    /**
     * Melakukan proses pencarian inputan data daily report
     */
    public function postSearchDailyReport()
    {
        // get alls Vendors
        $reportdailyreports = DailyReport::orderBy('id','DESC')->get();
        
        // Project Name
        $projectName = Input::get('projectNameSearch');
        if(!empty($projectName))
        {
            $reportdailyreports = DailyReport::where('reference', 'LIKE', '%'.$projectName.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Tasklist
        $tasklist = Input::get('tasklistSearch');
        if(!empty($tasklist))
        {
            $reportdailyreports = DailyReport::where('tasklist_id', 'LIKE', '%'.$tasklist.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Target Finish Date
        $targetFinish = Input::get('targetFinishSearch');
        if(!empty($targetFinish))
        {
            $reportdailyreports = DailyReport::where('target_finish', 'LIKE', '%'.$targetFinish.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Actual Finish Date
        $actualFinishDate = Input::get('actualFinishDateSearch');
        if(!empty($actualFinishDate))
        {
            $reportdailyreports = DailyReport::where('actual_finish_date', 'LIKE', '%'.$actualFinishDate.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Status
        $status = Input::get('statusSearch');
        if(!empty($status))
        {
            $reportdailyreports = DailyReport::where('status_job_daily_report', 'LIKE', '%'.$status.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;
            
        // Tasklist
        $tasklists = array('' => '');
        foreach(Tasklist::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $tasklists[$row->id] = $row->subject;
        
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;
            
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.reportdailyreports-list'), array('reportdailyreports' => $reportdailyreports, 'projectNames' => $projectNames, 'tasklists' => $tasklists, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportdailyreports-index'), array('reportdailyreports' => $reportdailyreports, 'projectNames' => $projectNames, 'tasklists' => $tasklists, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Report Project";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportdailyreports');
    }

    /**
     * Menampilkan laporan update aplikasi
     */
	public function getReportUpdateApps()
	{
		// get alls Vendors
		$reportupdateappss = UpdateApps::orderBy('id','DESC')->get();
        
        // Application Master
        $masterappss = array('' => '');
        foreach(MasterApps::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterappss[$row->id] = $row->name_apps;
        
        // Modul Master
        $mastermoduls = array('' => '');
        foreach(MasterModul::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $mastermoduls[$row->id] = $row->name_modul;
        
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
			$html = View::make(Config::get('adminlte::views.reportupdateappss-list'), array('reportupdateappss' => $reportupdateappss, 'users' => $users, 'masterappss' => $masterappss, 'mastermoduls' => $mastermoduls, 'masterstatuss' => $masterstatuss))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.reportupdateappss-index'), array('reportupdateappss' => $reportupdateappss, 'users' => $users, 'masterappss' => $masterappss, 'mastermoduls' => $mastermoduls, 'masterstatuss' => $masterstatuss));
		$this->layout->title = "Report Application Update";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportupdateappss');
	}
    
    /**
     * Melakukan proses pencarian inputan data update aplikasi
     */
    public function postSearchUpdateApps()
    {
        // get alls Vendors
        $reportupdateappss = UpdateApps::orderBy('id','DESC')->get();
        
        // Application Master
        $appsMaster = Input::get('appsMasterSearch');
        if(!empty($appsMaster))
        {
            $reportupdateappss = UpdateApps::where('master_apps_id', 'LIKE', '%'.$appsMaster.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Modul Master
        $modulMaster = Input::get('modulMasterSearch');
        if(!empty($modulMaster))
        {
            $reportupdateappss = UpdateApps::where('master_modul_id', 'LIKE', '%'.$modulMaster.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Database Change
        $databaseChange = Input::get('databaseChangeSearch');
        if(!empty($databaseChange))
        {
            $reportupdateappss = UpdateApps::where('database_change', 'LIKE', '%'.$databaseChange.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Application Change
        $appsChange = Input::get('appsChangeSearch');
        if(!empty($appsChange))
        {
            $reportupdateappss = UpdateApps::where('apps_change', 'LIKE', '%'.$appsChange.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Application Version
        $appsVersion = Input::get('appsVersionSearch');
        if(!empty($appsVersion))
        {
            $reportupdateappss = UpdateApps::where('apps_version', 'LIKE', '%'.$appsVersion.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // User Request
        $userRequest = Input::get('userRequestSearch');
        if(!empty($userRequest))
        {
            $reportupdateappss = UpdateApps::where('user_request', 'LIKE', '%'.$userRequest.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Update Date
        $updateDate = Input::get('updateDateSearch');
        if(!empty($updateDate))
        {
            $reportupdateappss = UpdateApps::where('update_date', 'LIKE', '%'.$updateDate.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Status
        $status = Input::get('statusSearch');
        if(!empty($status))
        {
            $reportupdateappss = UpdateApps::where('status_update_apps', 'LIKE', '%'.$status.'%')
                          ->orderBy('id')
                          ->get();
        }
        
        // Application Master
        $masterappss = array('' => '');
        foreach(MasterApps::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterappss[$row->id] = $row->name_apps;
        
        // Modul Master
        $mastermoduls = array('' => '');
        foreach(MasterModul::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $mastermoduls[$row->id] = $row->name_modul;
        
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
            $html = View::make(Config::get('adminlte::views.reportupdateappss-list'), array('reportupdateappss' => $reportupdateappss, 'users' => $users, 'masterappss' => $masterappss, 'mastermoduls' => $mastermoduls, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.reportupdateappss-index'), array('reportupdateappss' => $reportupdateappss, 'users' => $users, 'masterappss' => $masterappss, 'mastermoduls' => $mastermoduls, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Report Application Update";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.reportupdateappss');
    }

    public function autoemailProject()
    {
    	if ( strtotime( date('H:i') ) <= strtotime('17:30') || strtotime( date('H:i') ) >= strtotime('17:35') )
    		die( "bukan jam nya" );

    	// get alls Project Report
        $reportprojectemails = Project::where('status_project_request','!=',4)
        							->orderBy('status_project_request','ASC')
        							->orderBy('due_date','DESC')
        							->get();

        $html = '<html><body>'
	                    . '<h2 align="center">Report Application Project IT Department</h2>'
	                    . '<table border="1/2px">'
	                        . '<thead><tr>'
	                            . '<th>#</th>'
	                            . '<th>Project Name</th>'
	                            . '<th>Reference Number</th>'
	                            . '<th>Master Application</th>'
	                            . '<th>Master Modul</th>'
	                            . '<th>User Request</th>'
	                            . '<th>Date Request</th>'
	                            . '<th>Due Date</th>'
	                            . '<th>Description</th>'
	                            . '<th>Status</th>'
	                        . '</tr></thead><tbody>';

        foreach ($reportprojectemails as $projectemail) {
        	if ($projectemail->master_apps_id != null) {
	        	$apps_name = $projectemail->masterapps->name_apps;
        	}
	        
	        if ($projectemail->master_modul_id != null) {
	        	$modul_name = $projectemail->mastermodul->name_modul;
	        }
	        
	        	$html .= '<tr>'
	                        . '<td>&nbsp;'.$projectemail->id.'</td>'
	                        . '<td>&nbsp;'.$projectemail->name_project.'</td>'
	                        . '<td>&nbsp;'.$projectemail->reference.'</td>'
	                        . '<td>&nbsp;'.$apps_name.'</td>'
	                        . '<td>&nbsp;'.$modul_name.'</td>'
	                        . '<td>&nbsp;'.$projectemail->user_request.'</td>'
	                        . '<td>&nbsp;'.$projectemail->project_request_date.'</td>'
	                        . '<td>&nbsp;'.$projectemail->due_date.'</td>'
	                        . '<td>&nbsp;'.$projectemail->desc_project.'</td>'
	                        . '<td>&nbsp;'.$projectemail->masterstatus->status_name.'</td>'
	                        . '</tr>';
	    }

        $html .= '</tbody></table>'
	                    . '</body></html>';

	    //echo $html;exit;
        
	    $autoemail = new Autoemail;
	    $autoemail->setConnection('mysqlemail');
	    $autoemail->to = 'ndaru@pancaran-group.com';
	    $autoemail->from = 'ou_it_pdt@pancaran-group.com';
	    $autoemail->cc = 'ou_it_pdt@pancaran-group.com';
	    $autoemail->judul = 'IT Management System';
	    $autoemail->subject = 'Report Application Project';
	    $autoemail->message = $html;
	    $autoemail->tglinput = date('Y-m-d H:i:s');
	    $autoemail->userinput = '';
	    $autoemail->tglupdate = date('Y-m-d H:i:s');
	    $autoemail->userupdate = '';
	    $autoemail->status = 1;
	    $autoemail->save();
	}

    public function autoemailTasklist()
    {
    	if ( strtotime( date('H:i') ) <= strtotime('17:30') || strtotime( date('H:i') ) >= strtotime('17:35') )
    		die( "bukan jam nya" );

    	// get alls Tasklist Report
		$reporttasklistemails = TaskList::where('status_tasklist','!=',9)
										->orderBy('assignment_to','ASC')
                                        ->orderBy('status_tasklist', 'ASC')
										->orderBy('due_date', 'DESC')
										->get();
		
		$html = '<html><body>'
	                    . '<h2 align="center">Report Tasklist IT Department</h2>'
	                    . '<table border="1px">'
	                        . '<thead><tr>'
	                            . '<th>#</th>'
	                            . '<th>Subject</th>'
	                            . '<th>Assignment From</th>'
	                            . '<th>Assignment To</th>'
	                            . '<th>Assignment Date</th>'
	                            . '<th>Due Date</th>'
	                            . '<th>Reference Project</th>'
	                            . '<th>Reference Design</th>'
	                            . '<th>Priority</th>'
	                            . '<th>Status</th>'
	                        . '</tr></thead><tbody>';

		foreach ($reporttasklistemails as $tasklistemail) {
			if ($tasklistemail->reference != null) {
				$reff_project = $tasklistemail->project->name_project;
			}
			
			if ($tasklistemail->reference_design != null) {
				$reff_design = $tasklistemail->design->remark;
			}
	        
	        	$html .= '<tr>'
	                        . '<td>&nbsp;'.$tasklistemail->id.'</td>'
	                        . '<td>&nbsp;'.$tasklistemail->subject.'</td>'
	                        . '<td>&nbsp;'.$tasklistemail->user1->username.'</td>'
	                        . '<td>&nbsp;'.$tasklistemail->user2->username.'</td>'
	                        . '<td>&nbsp;'.$tasklistemail->assignment_date.'</td>'
	                        . '<td>&nbsp;'.$tasklistemail->due_date.'</td>'
	                        . '<td>&nbsp;'.$reff_project.'</td>'
	                        . '<td>&nbsp;'.$reff_project.'</td>'
	                        . '<td>&nbsp;'.$tasklistemail->masterstatus1->status_name.'</td>'
	                        . '<td>&nbsp;'.$tasklistemail->masterstatus->status_name.'</td>'
	                        . '</tr>';
	    }

		$html .= '</tbody></table>'
	                    . '</body></html>';

		//echo $html;exit;

		$autoemail = new Autoemail;
	    $autoemail->setConnection('mysqlemail');
	    $autoemail->to = 'ndaru@pancaran-group.com';
	    $autoemail->from = 'ou_it_pdt@pancaran-group.com';
	    $autoemail->cc = 'ou_it_pdt@pancaran-group.com';
	    $autoemail->judul = 'IT Management System';
	    $autoemail->subject = 'Report Tasklist';
	    $autoemail->message = $html;
	    $autoemail->tglinput = date('Y-m-d H:i:s');
	    $autoemail->userinput = '';
	    $autoemail->tglupdate = date('Y-m-d H:i:s');
	    $autoemail->userupdate = '';
	    $autoemail->status = 1;
	    $autoemail->save();
	}

    public function getExportPDFDailyReport()
    {
        $jobdailyreports = DB::select('select jd.*, u.username as usercreated
                                        from job_daily_report as jd
                                        left join users as u on jd.user_created = u.id
                                        where date(jd.create_date) = curdate()');
        
        $html = '<html><body>'
                    . '<h2 align="center">Report Job Daily All ITD Employee</h2>'
                    . '<table border="1px">'
                        . '<thead><tr>'
                            . '<th>#</th>'
                            . '<th>Job</th>'
                            . '<th>Description</th>'
                            . '<th>Status</th>'
                            . '<th>Target Finish</th>'
                            . '<th>Note</th>'
                            . '<th>Created User</th>'
                            . '<th>Created Date</th>'
                        . '</tr></thead><tbody>';
        foreach ($jobdailyreports as $jobdailyreport) {
            if ($jobdailyreport->user_created != null) {
                $html .= '<tr>'
                        . '<td>&nbsp;'.$jobdailyreport->id.'</td>'
                        . '<td>&nbsp;'.$jobdailyreport->job.'</td>'
                        . '<td>&nbsp;'.$jobdailyreport->description.'</td>'
                        . '<td>&nbsp;'.$jobdailyreport->status_job_daily_report.'</td>'
                        . '<td>&nbsp;'.$jobdailyreport->target_finish.'</td>'
                        . '<td>&nbsp;'.$jobdailyreport->note.'</td>'
                        . '<td>&nbsp;'.$jobdailyreport->usercreated.'</td>'
                        . '<td>&nbsp;'.$jobdailyreport->created_at.'</td>'
                        . '</tr>';
                    
            }
        }
        
        $html .= '</tbody></table>'
                    . '</body></html>';
        
        define('BUDGETS_DIR', public_path('uploads')); // I define this in a constants.php file

        if (!is_dir(BUDGETS_DIR)){
            mkdir(BUDGETS_DIR, 0755, true);
        }

        $outputName = str_random(10); // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
        $pdfPath = BUDGETS_DIR.'/'.$outputName.'.pdf';
        File::put($pdfPath, PDF::load($html, 'A4', 'portrait')->output());

        foreach ($jobdailyreports as $jobdailyreport) {
            $data = array(
                'job' => $jobdailyreport->job
            );

            Mail::send('emails.emailjobdailyreport', $data, function($message) use ($pdfPath){
                $message->from('ou_itd@pancaran-group.com', 'IT Management System');
                $message->to('yudhistiro@pancaran-group.com');
                $message->attach($pdfPath);
            });
        }
        
        return Redirect::route('listReportDailyReports');
    }
}