<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class DailyReportController extends \BaseController {

    /**
     * Mengambil Index Page Daily Report
     */
    public function getIndex()
    {
        // get alls Vendors
        $dailyreports = DailyReport::orderBy('id','DESC')->get();
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;

        // Status
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

        // Tasklist
        $tasklists = array('' => '');
        foreach(TaskList::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $tasklists[$row->id] = $row->subject;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.dailyreports-list'), array('dailyreports' => $dailyreports, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss, 'tasklists' => $tasklists))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.dailyreports-index'), array('dailyreports' => $dailyreports, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss, 'tasklists' => $tasklists));
        $this->layout->title = "Job Daily Report";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.dailyreports');
    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Subject
        $tasklist = Input::get('tasklistSearch');
        $reference = Input::get('referenceSearch');
        $targetfinish = Input::get('targetFinishSearch');
        $actualFinishDate = Input::get('actualFinishDateSearch');
        $status = Input::get('statusSearch');
        
        if (empty($tasklist)) {
            $dailyreports = DailyReport::orderBy('id','DESC')->get();

            if (empty($reference)) {
                $dailyreports = DailyReport::orderBy('id','DESC')->get();

                if (empty($targetfinish)) {
                    $dailyreports = DailyReport::orderBy('id','DESC')->get();

                    if (empty($actualFinishDate)) {
                        $dailyreports = DailyReport::orderBy('id','DESC')->get();

                        if (empty($status)) {
                            $dailyreports = DailyReport::orderBy('id','DESC')->get();
                        } else {
                             $dailyreports = DailyReport::where('status_job_daily_report', 'LIKE', '%'.$status.'%')
                                            ->orderBy('id','DESC')
                                            ->get();
                        }
                    } else {
                        $dailyreports = DailyReport::where('actual_finish_date', '=', $actualFinishDate)
                            ->orderBy('id','DESC')
                            ->get();
                    }
                } else {
                    $dailyreports = DailyReport::where('target_finish', '=', $targetfinish)
                            ->orderBy('id','DESC')
                            ->get();
                }
            } else {
                $dailyreports = DailyReport::where('reference', 'LIKE', '%'.$reference.'%')
                            ->orderBy('id','DESC')
                            ->get();
            }
        } else {
            $dailyreports = DailyReport::where('tasklist_id', 'LIKE', '%'.$tasklist.'%')
                            ->orderBy('id','DESC')
                            ->get();
        } 
        
        // Project Name
        $projectNames = array('' => '');
        foreach(Project::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $projectNames[$row->id] = $row->name_project;

        // Status
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

        // Tasklist
        $tasklists = array('' => '');
        foreach(TaskList::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $tasklists[$row->id] = $row->subject;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.dailyreports-list'), array('dailyreports' => $dailyreports, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss, 'tasklists' => $tasklists))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.dailyreports-index'), array('dailyreports' => $dailyreports, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss, 'tasklists' => $tasklists));
        $this->layout->title = "Job Daily Report";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.dailyreports');
    }

    /**
     * Menampilkan form edit daily report
     */
    public function getShow($dailyreportId)
    {
        try
        {
            $dailyreports = DailyReport::find($dailyreportId);
            
            // Project Name
            $projectNames = array('' => '');
            foreach(Project::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $projectNames[$row->id] = $row->name_project;

            // Status
            $masterstatuss = array('' => '');
            foreach(MasterStatus::where('group','=','tasklist')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

            // Tasklist
            $tasklists = array('' => '');
            foreach(TaskList::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $tasklists[$row->id] = $row->subject;

            $this->layout = View::make(Config::get('adminlte::views.dailyreport-edit'), array(
                'dailyreports' => $dailyreports,
                'projectNames' => $projectNames,
                'tasklists' => $tasklists,
                'masterstatuss' => $masterstatuss,
            ));

            $this->layout->title = $dailyreports->tasklist->subject;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "Job Daily Report",
                    'link' => URL::route('listDailyReports'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $dailyreports->tasklist->subject,
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
     * Melakukan proses update daily report ke database
     */
    public function putShow($dailyreportId)
    {
        $aturan = array(
            'datepicker2' => 'required',
            'note' => 'required',
            'status_job_daily_report' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
            # Bila validasi sukses
        } else {
            $dailyreports = DailyReport::find($dailyreportId);
            # Buatkan variabel tiap inputan
            $dailyreports->actual_finish_date = Input::get('datepicker2');
            $dailyreports->note = Input::get('note');
            $dailyreports->status_job_daily_report = Input::get('status_job_daily_report');
            $dailyreports->user_updated = Input::get('user_updated');
            $dailyreports->save();

            $tasklist = TaskList::where('id','=',$dailyreports->tasklist_id)->update(array('actual_finish_date' => $dailyreports->actual_finish_date, 'close_by' => Sentry::getUser()->id));
            
            Notification::info('Daily Report has been Changed');
            return Redirect::route('listDailyReports');
        }
    }
}