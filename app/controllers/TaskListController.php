<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class TaskListController extends \BaseController {

    /**
     * Mengambil Index Page Tasklist
     */
    public function getIndex()
    {
        $users = Sentry::getUser();
        
        $adm = Sentry::findGroupByName('Admin');
        $head = Sentry::findGroupByName('HeadITDev');
        $coordITDev = Sentry::findGroupByName('CoordinatorITDev');
        $coordITInf = Sentry::findGroupByName('CoordinatorITInf');
        $staffITDev = Sentry::findGroupByName('StaffITDev');
        $staffITInf = Sentry::findGroupByName('StaffITInf');
        $assignFrom = Sentry::getUser()->id;
        $assignTo = Sentry::getUser()->id;

        $mainAccess = $users->inGroup($adm) || $users->inGroup($head) || $users->inGroup($coordITDev) || $users->inGroup($coordITInf);

        if ($mainAccess) {
        // get alls Vendors
            if ($users->inGroup($coordITDev)) {
                $taskOpens = TaskList::join('users','tasklist.assignment_from','=','users.id')
                                ->join('users_groups','users.id','=','users_groups.user_id')
                                ->join('groups','groups.id','=','users_groups.group_id')
                                ->where('tasklist.status_tasklist','<>',9)
                                ->where(function($query)
                                {
                                    $query->where('groups.name','=', 'CoordinatorITDev')
                                          ->orWhere('groups.name','=', 'StaffITDev')
                                          ->orWhere('groups.name','=', 'Admin');
                                })
                                ->orderBy('tasklist.due_date', 'DESC')
                                ->orderBy('tasklist.id', 'DESC')
                                ->get();
            } elseif ($users->inGroup($coordITInf)) {
                $taskOpens = TaskList::join('users','tasklist.assignment_from','=','users.id')
                                ->join('users_groups','users.id','=','users_groups.user_id')
                                ->join('groups','groups.id','=','users_groups.group_id')
                                ->where('tasklist.status_tasklist','<>',9)
                                ->where(function($query)
                                {
                                    $query->where('groups.name','=', 'CoordinatorITInf')
                                          ->orWhere('groups.name','=', 'StaffITInf');
                                })
                                ->orderBy('tasklist.due_date', 'DESC')
                                ->orderBy('tasklist.id', 'DESC')
                                ->get();
            } else {
                $taskOpens = TaskList::where('status_tasklist','<>',9)
                                ->orderBy('due_date', 'DESC')
                                ->orderBy('id', 'DESC')
                                ->get();
            }
                        
        } elseif ($assignTo) {
            $taskOpens = TaskList::where('status_tasklist','<>',9)
                                ->where('assignment_to','=', $assignTo)
                                ->where(function($query)
                                {
                                    $query->where('status_tasklist','=', 5)
                                          ->orWhere('status_tasklist','=', 6)
                                          ->orWhere('status_tasklist','=', 8)
                                          ->orWhere('status_tasklist','=', 29);
                                })
                                ->orderBy('due_date', 'DESC')
                                ->orderBy('id', 'DESC')
                                ->get();
            
        }

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
            $html = View::make(Config::get('adminlte::views.tasks-list'),
                        array(  'taskOpens' => $taskOpens,
                                'projectNames' => $projectNames, 
                                'users' => $users,
                                'masterstatuss' => $masterstatuss,
                                'masterstatuss1' => $masterstatuss1))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.tasks-index'),
                        array(  'taskOpens' => $taskOpens,
                                'projectNames' => $projectNames, 
                                'users' => $users,
                                'masterstatuss' => $masterstatuss,
                                'masterstatuss1' => $masterstatuss1));

        $this->layout->title = "Tasklist Open";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.tasks');
    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Subject
        $subject = Input::get('subjectSearch');
        $assignmentTo = Input::get('assignmentToSearch');
        $status = Input::get('statusSearch');
        $priority = Input::get('prioritySearch');
        $actualFinishDate = Input::get('actualFinishDateSearch');
        $reference = Input::get('referenceSearch');
        
        $taskOpens = TaskList::where('status_tasklist','=',9)->orderBy('id', 'DESC')->get();
        $assignTo = Sentry::getUser()->id;

        if (empty($subject)) {
            $taskOpens;
        } else {
            $taskOpens = TaskList::where('subject', 'LIKE', '%'.$subject.'%')
                                    ->where('status_tasklist','=',9)
                                    ->orderBy('id', 'DESC')
                                    ->get();
        }
                
        if (empty($assignmentTo)) {
            $taskOpens;
        } else {
            $taskOpens = TaskList::where('assignment_to', '=', $assignmentTo)
                                        ->where('status_tasklist','=',9)
                                        ->orderBy('id','DESC')
                                        ->get();
        }
                    
        if (empty($status)) {
            $taskOpens;
        } else {
            $taskOpens = TaskList::where('status_tasklist', '=', $status)
                                    ->orderBy('id','DESC')
                                    ->get();
        }
        
        if (empty($priority)) {
            $taskOpens;
        } else {
            $taskOpens = TaskList::where('priority', '=', $priority)
                                                ->where('status_tasklist','=',9)
                                                ->orderBy('id','DESC')
                                                ->get();
        }

        if (empty($actualFinishDate)) {
            $taskOpens;
        } else {
            $taskOpens = TaskList::where('actual_finish_date', 'LIKE', '%'.$actualFinishDate.'%')
                                                    ->where('status_tasklist','=',9)
                                                    ->orderBy('id','DESC')
                                                    ->get();
        }
                                
        if (empty($reference)) {
            $taskOpens;
        } else {
            $taskOpens = TaskList::where('reference', '=', $reference)
                                                        ->where('status_tasklist','=',9)
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
        }
        
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
            $html = View::make(Config::get('adminlte::views.tasks-list'),
                    array(  'taskOpens' => $taskOpens,
                            'projectNames' => $projectNames, 
                            'users' => $users,
                            'masterstatuss' => $masterstatuss,
                            'masterstatuss1' => $masterstatuss1))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.tasks-index'),
                        array(  'taskOpens' => $taskOpens,
                                'projectNames' => $projectNames, 
                                'users' => $users,
                                'masterstatuss' => $masterstatuss,
                                'masterstatuss1' => $masterstatuss1));

        $this->layout->title = "Tasklist Open";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.tasks');
    }

    /**
     * Mengambil Index Page Tasklist
     */
    public function getIndexClose()
    {
        $users = Sentry::getUser();
        $adm = Sentry::findGroupByName('Admin');
        $head = Sentry::findGroupByName('HeadITDev');
        $coord = Sentry::findGroupByName('CoordinatorITDev');

        $assignFrom = Sentry::getUser()->id;

        $mainAccess = $users->inGroup($adm) || $users->inGroup($head) || $users->inGroup($coord) || $assignFrom;

        if ($mainAccess) {
            $taskCloses = TaskList::where('status_tasklist','=',9)
                                    ->orderBy('due_date', 'DESC')
                                    ->orderBy('id', 'DESC')
                                    ->get();
        }
        
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
            $html = View::make(Config::get('adminlte::views.tasks-list-close'),
                    array(  'taskCloses' => $taskCloses,
                            'projectNames' => $projectNames, 
                            'users' => $users,
                            'masterstatuss' => $masterstatuss,
                            'masterstatuss1' => $masterstatuss1))
                    ->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.tasks-index-close'),
                        array(  'taskCloses' => $taskCloses,
                                'projectNames' => $projectNames, 
                                'users' => $users,
                                'masterstatuss' => $masterstatuss,
                                'masterstatuss1' => $masterstatuss1));

        $this->layout->title = "Tasklist Close";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.taskcloses');
    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearchClose()
    {
        // Subject
        $subject = Input::get('subjectSearch');
        $assignmentTo = Input::get('assignmentToSearch');
        $status = Input::get('statusSearch');
        $priority = Input::get('prioritySearch');
        $actualFinishDate = Input::get('actualFinishDateSearch');
        $reference = Input::get('referenceSearch');

        $taskCloses = TaskList::orderBy('id', 'DESC')->get();

        if (empty($subject)) {
                $taskCloses;
            } else {
                $taskCloses = TaskList::where('subject', 'LIKE', '%'.$subject.'%')
                                    ->orderBy('id', 'DESC')
                                    ->get();
            }
                
                if (empty($assignmentTo)) {
                    $taskCloses;
                } else {
                    $taskCloses = TaskList::where('assignment_to', '=', $assignmentTo)
                                        ->orderBy('id','DESC')
                                        ->get();
                }
                    
                    if (empty($status)) {
                        $taskCloses;
                    } else {
                        $taskCloses = TaskList::where('status_tasklist', '=', $status)
                                            ->orderBy('id','DESC')
                                            ->get();
                    }
                        if (empty($priority)) {
                            $taskCloses;
                        } else {
                            $taskCloses = TaskList::where('priority', '=', $priority)
                                                ->orderBy('id','DESC')
                                                ->get();
                        }

                            if (empty($actualFinishDate)) {
                                $taskCloses;
                            } else {
                                $taskCloses = TaskList::where('actual_finish_date', 'LIKE', '%'.$actualFinishDate.'%')
                                                    ->orderBy('id','DESC')
                                                    ->get();
                            }
                                
                                if (empty($reference)) {
                                    $taskCloses;
                                } else {
                                    $taskCloses = TaskList::where('reference', '=', $reference)
                                                        ->orderBy('id', 'DESC')
                                                        ->get();
                                }
        
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
            $html = View::make(Config::get('adminlte::views.tasks-list-close'),
                    array(  'taskCloses' => $taskCloses,
                            'projectNames' => $projectNames,  
                            'users' => $users, 
                            'masterstatuss' => $masterstatuss, 
                            'masterstatuss1' => $masterstatuss1))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.tasks-index-close'),
                        array(  'taskCloses' => $taskCloses, 
                                'projectNames' => $projectNames,  
                                'users' => $users, 
                                'masterstatuss' => $masterstatuss, 
                                'masterstatuss1' => $masterstatuss1));

        $this->layout->title = "Tasklist Close";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.taskcloses');
    }

    /**
     * Menampilkan list tasklist berdasarkan status tasklist pada halaman dashboard
     */
    public function getDashStatusTasklist($taskStatus)
    {
        // get alls Vendors
        $tasklists = TaskList::where('status_tasklist', '=', $taskStatus)->get(array('id','subject','desc_tasklist','assignment_from','assignment_to','due_date','reference','master_task_type_id','upload_file','status_tasklist','priority'));
        
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
            $html = View::make(Config::get('adminlte::views.tasks-list'), array('tasklists' => $tasklists, 'projectNames' => $projectNames,  'users' => $users, 'masterstatuss' => $masterstatuss, 'masterstatuss1' => $masterstatuss1))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.tasks-index'), array('tasklists' => $tasklists, 'projectNames' => $projectNames,  'users' => $users, 'masterstatuss' => $masterstatuss, 'masterstatuss1' => $masterstatuss1));
        $this->layout->title = "Task-list";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.tasks');
    }

    /**
     * Menampilkan form create tasklist
     */
    public function getCreate()
    {
        $projects = array('' => '');
        foreach(Project::where('status_project_request','=','2')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projects[$row->id] = $row->name_project;
        
        $mastertasktypes = array('' => '');
        foreach(MasterTaskType::where('activated','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $mastertasktypes[$row->id] = $row->name_task_type;

        $prioritys = array('' => '');
        foreach(MasterStatus::where('group','=','priority')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $prioritys[$row->id] = $row->status_name;
            
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;
            //$users[$row->email] = $row->username;
            
        $users1 = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users1[$row->id] = $row->email;

        $this->layout = View::make(Config::get('adminlte::views.task-create'), array('users' => $users, 'users1' => $users1,'projects' => $projects, 'prioritys' => $prioritys,'mastertasktypes' => $mastertasktypes));
        $this->layout->title = "New Tasklist";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_task');
    }

    /**
     * Melakukan proses create tasklist baru
     */
    public function postCreate()
    {
        $aturan = array(
            'subject' => 'required', 
            'assignment_to' => 'required',
            'mytextarea' => 'required',
            'datepicker1' => 'required', 
            //'reference' => 'required',
            'master_task_type_id' => 'required',
            'parameter_reminder' => 'required|numeric',
            'priority' => 'required',
        );

        //echo "<pre>";print_r($_POST);exit;

        switch(Input::get('type')):
            case 'reference_design':
                $return = '<option value=""></option>';
                foreach(Design::where('project_id', Input::get('id'))
                                ->where('status_design','=','34')
                                ->get() as $row)
                    $return .= "<option value='$row->id'>$row->design_name_version</option>";
                return $return;
            break;
        endswitch;

        $subjectname = Input::get('subject');

        if (Input::hasFile('fileTask')){
            $fileTask = Input::file('fileTask');
            $destinationPath = 'uploads/';
            $extension = $fileTask->getClientOriginalExtension();
            $filename =  $subjectname.'.'.$extension;
            $upload_success = $fileTask->move($destinationPath, $filename);
        } else {
            $filename = "";
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $tasklist = new TaskList;
            # Buatkan variabel tiap inputan
            $tasklist->subject = Input::get('subject');
            $tasklist->assignment_from = Input::get('assignment_from');
            $tasklist->assignment_to = Input::get('assignment_to');
            $tasklist->desc_tasklist = Input::get('mytextarea');;
            $tasklist->priority = Input::get('priority');
            $tasklist->assignment_date = date('Y-m-d H:i:s');
            $tasklist->due_date = Input::get('datepicker1');
            $tasklist->reference = Input::get('reference');
            $tasklist->reference_design = Input::get('reference_design');
            $tasklist->status_tasklist = 5;
            $tasklist->parameter_reminder = Input::get('parameter_reminder');
            $tasklist->upload_file = $filename;
            $tasklist->master_task_type_id = Input::get('master_task_type_id');
            $tasklist->database_change = Input::get('database_change');
            $tasklist->apps_file_change = Input::get('apps_file_change');
            $tasklist->user_created = Input::get('user_created');
            $tasklist->save();

            $tasklistusercc = new TasklistUserCc;
            $tasklistusercc->tasklist_id = $tasklist->id;
            $tasklistusercc->user_id = Input::get('assignment_cc');;
            $tasklistusercc->view = 1;
            $tasklistusercc->user_created = Sentry::getUser()->id;
            $tasklistusercc->save();

            $daily_report = new DailyReport;
            $daily_report->tasklist_id = $tasklist->id;
            $daily_report->job = $tasklist->subject;
            $daily_report->description = $tasklist->desc_tasklist;
            $daily_report->status_job_daily_report = $tasklist->status_tasklist;
            $daily_report->target_finish = $tasklist->due_date;
            $daily_report->note = $tasklist->database_change.'<br />'.$tasklist->apps_file_change;
            $daily_report->create_date = $tasklist->assignment_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = $tasklist->user2->email;
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = Sentry::getUser()->email;
            $autoemail->judul = 'ITMS - New Tasklist Created';
            $autoemail->subject = $tasklist->subject;
            $autoemail->message = 'Description : '.$tasklist->desc_tasklist
                                    .'<br /> Assignment From : '.$tasklist->user1->username
                                    .'<br /> Assignment To : '.$tasklist->user2->username
                                    .'<br /> Assignment Date : '.$tasklist->assignment_date
                                    .'<br /> Due Date :'.$tasklist->due_date
                                    .'<br /> Priority :'.$tasklist->masterstatus1->status_name
                                    .'<br /> Reference Project :'.$tasklist->reference
                                    .'<br /> Reference Project :'.$tasklist->reference_design
                                    .'<br /> Parameter Reminder :'.$tasklist->parameter_reminder
                                    .'<br /> Database Change :'.$tasklist->database_change
                                    .'<br /> Apps FIle Change :'.$tasklist->apps_file_change
                                    .'<br /> Status :'.$tasklist->masterstatus->status_name;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New Task has been Added');
            return Redirect::route('listTasks');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

    /**
     * Menampilkan page detail tasklist serta memasukkan data otomatis ke dalam daily report
     */
    public function postDetail($taskId)
    {
        try
        {
            $taskdetails = TaskList::find($taskId);

            $this->layout = View::make(Config::get('adminlte::views.tasks-detail'), array(
                'taskdetails' => $taskdetails,
            ));

            $this->layout->title = $taskdetails->subject;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "Detail Task",
                    'link' => URL::route('listTasks'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $taskdetails->subject,
                    'link' => URL::current(),
                    'icon' => ''
                )
            );

            $taskdetails->status_tasklist = 6;
            $taskdetails->save();

            $daily_report = new DailyReport;
            $daily_report->tasklist_id = $taskdetails->id;
            $daily_report->job = $taskdetails->subject;
            $daily_report->description = $taskdetails->desc_tasklist;
            $daily_report->target_finish = $taskdetails->due_date;
            $daily_report->status_job_daily_report = $taskdetails->status_tasklist;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = $taskdetails->user2->email;
            $autoemails->from = Sentry::getUser()->email;
            $autoemails->cc = Sentry::getUser()->email;
            $autoemails->judul = 'ITMS - Tasklist Detail';
            $autoemails->subject = $taskdetails->subject;
            $autoemails->message = 'Subject : '.$taskdetails->subject
                                    .'<br /> Status has been '.$taskdetails->masterstatus->status_name;
            $autoemails->tglinput = date('Y-m-d H:i:s');
            $autoemails->userinput = Sentry::getUser()->username;
            $autoemails->tglupdate = date('Y-m-d H:i:s');
            $autoemails->userupdate = Sentry::getUser()->username;
            $autoemails->status = 1;
            $autoemails->save();
        }
        catch (\Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            $this->layout = View::make(Config::get('syntara::views.error'), array('message' => trans('syntara::users.messages.not-found')));
        }
    }

    /**
     * Menampilkan page detail tasklist serta memasukkan data otomatis ke dalam daily report
     */
    public function getTimeline($taskId)
    {
        try
        {
            $timelineTasks = TaskList::find($taskId);

            $this->layout = View::make(Config::get('adminlte::views.tasks-timeline'), array(
                'timelineTasks' => $timelineTasks,
            ));

            $this->layout->title = $timelineTasks->subject;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "Timeline History Task",
                    'link' => URL::route('listTasks'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $timelineTasks->subject,
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
     * Menampilkan form edit tasklist
     */
    public function getShow($taskId)
    {
        try
        {
            $tasks = TaskList::find($taskId);
            $projects = array('' => '');
            foreach(Project::where('status_project_request','!=','4')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $projects[$row->id] = $row->name_project;

            $designs = array('' => '');
            foreach(Design::where('status_design','=','34')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $designs[$row->id] = $row->design_name_version;

            $mastertasktypes = array('' => '');
            foreach(MasterTaskType::where('activated','=','1')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $mastertasktypes[$row->id] = $row->name_task_type;

            $masterstatuss = array('' => '');
            foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterstatuss[$row->id] = $row->status_name;

            $masterstatuss1 = array('' => '');
            foreach(MasterStatus::where('group','=','priority')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterstatuss1[$row->id] = $row->status_name;

            $users = array('' => '');
            foreach(User::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $users[$row->id] = $row->username;

            $this->layout = View::make(Config::get('adminlte::views.task-edit'), array(
                'tasks' => $tasks,
                'projects' => $projects,
                'designs' => $designs,
                'users' => $users,
                'mastertasktypes' => $mastertasktypes,
                'masterstatuss' => $masterstatuss,
                'masterstatuss1' => $masterstatuss1,
            ));

            $this->layout->title = $tasks->subject;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "Tasklist",
                    'link' => URL::route('listTasks'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $tasks->subject,
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
     * Melakukan proses update tasklist ke database
     */
    public function putShow($taskId)
    {
        $aturan = array(
            'subject' => 'required',
            //'assignment_from' => 'required',
            //'assignment_to' => 'required',
            'mytextarea' => 'required',
            'datepicker' => 'required',
            'datepicker1' => 'required',
            'status_tasklist' => 'required',
            //'reference' => 'required',
            'master_task_type_id' => 'required',
            'parameter_reminder' => 'required',
            'priority' => 'required',
        );

        switch(Input::get('type')):
            case 'reference_design':
                $return = '<option value=""></option>';
                foreach(Design::where('project_id', Input::get('id'))
                                ->where('status_design','=','34')
                                ->get() as $row)
                    $return .= "<option value='$row->id'>$row->design_name_version</option>";
                return $return;
            break;
        endswitch;

        $subjectname = Input::get('subject');

        if (Input::hasFile('fileTask')){
            $fileTask = Input::file('fileTask');
            $destinationPath = 'uploads/';
            $extension = $fileTask->getClientOriginalExtension();
            $filename =  $subjectname.'.'.$extension;
            $upload_success = $fileTask->move($destinationPath, $filename);
        } else {
            $filename = Input::get('upload_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
            # Bila validasi sukses
        } else {
            $tasklists = TaskList::find($taskId);
            # Buatkan variabel tiap inputan
            $tasklists->assignment_from = Input::get('assignment_from');
            $tasklists->assignment_to = Input::get('assignment_to');
            $tasklists->subject = Input::get('subject');
            $tasklists->desc_tasklist = Input::get('mytextarea');
            $tasklists->assignment_date = Input::get('datepicker');
            $tasklists->due_date = Input::get('datepicker1');
            $tasklists->status_tasklist = Input::get('status_tasklist');
            $tasklists->reference = Input::get('reference');
            $tasklists->reference_design = Input::get('reference_design');
            $tasklists->master_task_type_id = Input::get('master_task_type_id');
            $tasklists->parameter_reminder = Input::get('parameter_reminder');
            $tasklists->upload_file = $filename;
            $tasklists->priority = Input::get('priority');
            $tasklists->database_change = Input::get('database_change');
            $tasklists->apps_file_change = Input::get('apps_file_change');
            $tasklists->user_updated = Input::get('user_updated');
            $tasklists->save();

            $history = new HistoryTasklist;
            $history->tasklist_id = $tasklists->id;
            $history->title_history = Input::get('title_history');
            $history->note_history = Input::get('note_history');
            $history->user_created = Sentry::getUser()->id;
            $history->user_updated = Sentry::getUser()->id;
            $history->save();

            $daily_report = new DailyReport;
            $daily_report->tasklist_id = $tasklists->id;
            $daily_report->job = $tasklists->subject;
            $daily_report->description = $tasklists->desc_tasklist.'<br />'.$history->note_history;
            $daily_report->status_job_daily_report = $tasklists->status_tasklist;
            $daily_report->target_finish = $tasklists->due_date;
            $daily_report->note = $tasklists->database_change.'<br />'.$tasklists->apps_file_change;
            $daily_report->create_date = $tasklists->assignment_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = $tasklists->user2->email;
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = Sentry::getUser()->email;
            $autoemail->judul = 'ITMS - Tasklist Updated';
            $autoemail->subject = $tasklists->subject.'-'.$history->title_history;
            $autoemail->message = 'Description : '.$tasklists->desc_tasklist.'<br />'.$history->note_history
                                    .'<br /> Assignment From : '.$tasklists->user1->username
                                    .'<br /> Assignment To : '.$tasklists->user2->username
                                    .'<br /> Assignment Date : '.$tasklists->assignment_date
                                    .'<br /> Due Date :'.$tasklists->due_date
                                    .'<br /> Priority :'.$tasklists->masterstatus1->status_name
                                    .'<br /> Reference Project :'.$tasklists->reference
                                    .'<br /> Reference Project :'.$tasklists->reference_design
                                    .'<br /> Parameter Reminder :'.$tasklists->parameter_reminder
                                    .'<br /> Database Change :'.$tasklists->database_change
                                    .'<br /> Apps FIle Change :'.$tasklists->apps_file_change
                                    .'<br /> Status :'.$tasklists->masterstatus->status_name;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Task has been Changed');
            return Redirect::route('listTasks');
        }
    }

    /**
     * Melakukan proses download file tasklist
     */
    public function getDownload($taskId)
    {
        $tasks = TaskList::find($taskId);
        $filetasks = public_path().'/uploads/'.$tasks->upload_file;
        $response = Response::download($filetasks);
        return $response;
    }
}
