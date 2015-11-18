<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class TestingController extends \BaseController {

	/**
     * Mengambil Index Page Testing
     */
	public function getIndex()
    {
        // get alls Vendors
        $testings = Testing::orderBy('id', 'DESC')->get();
        
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
            $html = View::make(Config::get('adminlte::views.testings-list'), array('testings' => $testings, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('adminlte::views.testings-index'), array('testings' => $testings, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Testing";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.testings');

    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $projectName = Input::get('projectNameSearch');
        $sitDate = Input::get('sitDateSearch');
        $status = Input::get('statusSearch');
        if (empty($projectName)) {
            $testings = Testing::orderBy('id','DESC')->get();

            if (empty($sitDate)) {
                $testings = Testing::orderBy('id','DESC')->get();

                if (empty($status)) {
                    $testings = Testing::orderBy('id','DESC')->get();
                } else {
                    $testings = Testing::where('status_sit', 'LIKE', '%'.$status.'%')
                            ->orderBy('id')
                            ->get();
                }
            } else {
                $testings = Testing::where('sit_date', 'LIKE', '%'.$sitDate.'%')
                            ->orderBy('id')
                            ->get();
            }
        } else {
            $testings = Testing::where('project_id', 'LIKE', '%'.$projectName.'%')
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
            $html = View::make(Config::get('adminlte::views.testings-list'), array('testings' => $testings, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('adminlte::views.testings-index'), array('testings' => $testings, 'projectNames' => $projectNames, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Testing";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.testings');
    }

	/**
     * Menampilkan form edit testing
     */
	public function getShow($designId)
    {
        try
        {
            $testings = Testing::find($designId);
            
            $masterstatuss = array('' => '');
            foreach(MasterStatus::where('group','=','sit')->get() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;
            
            $this->layout = View::make(Config::get('adminlte::views.testing-edit'), array(
                'testings' => $testings,
                'masterstatuss' => $masterstatuss,
            ));

            $this->layout->title = $testings->project->name_project;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Testing",
                        'link' => URL::route('listTestings'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $testings->project->name_project,
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
     * Melakukan proses update testing ke database
     */
	public function putShow($designId)
    {
        $aturan = array(
            'requirement_testing' => 'required', 
            'sit' => 'required', 
            'sit_date' => 'required',
            'status_sit' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $testings = Testing::find($designId);
            # Buatkan variabel tiap inputan
            $testings->requirement_testing = Input::get('requirement_testing');
            $testings->sit = Input::get('sit');
            $testings->sit_date = Input::get('sit_date');
            $testings->status_sit = Input::get('status_sit');
            $testings->user_updated = Input::get('user_updated');
            $testings->save();

            $project = Project::where('id','=',$testings->project_id)->update(array('status_project_request' => 3));
            $tasklist = Tasklist::where('reference','=',$testings->project_id)->update(array('status_tasklist' => 7));

            $daily_report = new DailyReport;
            $daily_report->design_id = $testings->id;
            $daily_report->job = $testings->sit;
            $daily_report->description = $testings->requirement_testing;
            $daily_report->status_job_daily_report = $testings->status_sit;
            $daily_report->target_finish = $testings->project->due_date;
            $daily_report->note = $testings->rule.'<br />'.$testings->remark;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - System Integrated Test Updated';
            $autoemail->subject = $testings->sit;
            $autoemail->message = 'Design ID : '.$daily_report->design_id
                                    .'<br /> Project Name : '.$testings->project->name_project
                                    .'<br /> Requirement : '.$testings->requirement_testing
                                    .'<br /> Subject :'.$testings->sit
                                    .'<br /> Date :'.$testings->sit_date
                                    .'<br /> Status :'.$testings->masterstatus->status_name;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Testing has been Changed');
            return Redirect::route('listTestings');
        }
    }
}