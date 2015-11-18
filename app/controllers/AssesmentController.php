<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class AssesmentController extends \BaseController {

	/**
	 * Mengambil Index Page Assesment
	 */
	public function getIndex()
    {
        // get alls Vendors
        $assesments = Assesment::orderBy('id', 'DESC')->get(); // akses modul dirutkan berdasarkan ID
        
        // mengambil data user untuk akses pada select option
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.assesments-list'), array('assesments' => $assesments,'users' => $users))->render();

            return Response::json(array('html' => $html));
        }
        
        // menampilkan data di index page
        $this->layout = View::make(Config::get('adminlte::views.assesments-index'), array('assesments' => $assesments,'users' => $users));
        $this->layout->title = "Assesment";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.assesments');
    }
    
    /**
     * Melakukan proses pencarian data
     */
    public function postSearch()
    {
        // Project Name
        $projectName = Input::get('projectNameSearch'); // mengambil inputan nama project
        $assesmentDate = Input::get('assesmentDateSearch'); // mengambil inputan tgl assesment
        $assesmentUser = Input::get('assesmentUserSearch'); // mengambil inputan user assesment
        
        // proses pencarian pengambilan data
        if (empty($projectName)) {
            $assesments = Assesment::orderBy('id', 'DESC')->get();

            if (empty($assesmentDate)) {
                $assesments = Assesment::orderBy('id', 'DESC')->get();

                if (empty($assesmentUser)) {
                    $assesments = Assesment::orderBy('id', 'DESC')->get();
                } else {
                    $assesments = Assesment::where('assesment_user', 'LIKE', '%'.$assesmentUser.'%')
                            ->orderBy('id')
                            ->get();
                }
            } else {
                $assesments = Assesment::where('assesment_date', '=', $assesmentDate)
                            ->orderBy('id')
                            ->get();
            }
        } else {
            $assesments = Assesment::where('name_project', 'LIKE', '%'.$projectName.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
        }
        
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.assesments-list'), array('assesments' => $assesments,'users' => $users))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.assesments-index'), array('assesments' => $assesments,'users' => $users));
        $this->layout->title = "Assesment";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.assesments');
    }

    /**
     * Menampilkan page detail tasklist serta memasukkan data otomatis ke dalam daily report
     */
    public function getTimeline($projectId)
    {
        try
        {
            $timelineAssesments = Assesment::find($projectId);

            $this->layout = View::make(Config::get('adminlte::views.assesments-timeline'), array(
                'timelineAssesments' => $timelineAssesments,
            ));

            $this->layout->title = $timelineAssesments->name_project;
            $this->layout->breadcrumb = array(
                array(
                    'title' => "Timeline History Assesment",
                    'link' => URL::route('listAssesments'),
                    'icon' => 'glyphicon-th'
                ),
                array(
                    'title' => $timelineAssesments->name_project,
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
     * Mengambil Form Edit Page
     */
	public function getShow($projectId)
    {
        try
        {
            $assesments = Assesment::find($projectId);
            
            $this->layout = View::make(Config::get('adminlte::views.assesment-edit'), array(
                'assesments' => $assesments,
            ));

            $this->layout->title = $assesments->name_project;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Assesment",
                        'link' => URL::route('listAssesments'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $assesments->name_project,
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
     * Melakukan proses update data ke database
     */
	public function putShow($projectId)
    {
        $aturan = array(
            'assesment_date' => 'required', 
            //'assesment_user' => 'required', 
            'assesment_note' => 'required',
        );

        $assesmentname = Input::get('project');

        if (Input::hasFile('fileAssesment')){
            $fileAssesment = Input::file('fileAssesment');
            $destinationPath = 'uploads/';
            $extension = $fileAssesment->getClientOriginalExtension();
            $filenameAssesment =  $assesmentname.'-assesment.'.$extension;
            $upload_success = $fileAssesment->move($destinationPath, $filenameAssesment);
        } else {
            $filenameAssesment = Input::get('assesment_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $assesments = Assesment::find($projectId);
            # Buatkan variabel tiap inputan
            $assesments->assesment_date = Input::get('assesment_date');
            $assesments->assesment_user = Input::get('assesment_user');
            $assesments->assesment_note = Input::get('assesment_note');
            $assesments->assesment_file = $filenameAssesment;
            $assesments->user_updated = Input::get('user_updated');
            $assesments->save();

            $history = new HistoryAssesment;
            $history->project_id = $assesments->id;
            $history->title_history = Input::get('title_history');
            $history->note_history = Input::get('note_history');
            $history->user_created = Sentry::getUser()->id;
            $history->user_updated = Sentry::getUser()->id;
            $history->save();

            $daily_report = new DailyReport;
            $daily_report->project_id = $assesments->id;
            $daily_report->job = $assesments->name_project;
            $daily_report->description = $assesments->assesment_note;
            $daily_report->status_job_daily_report = $assesments->status_project_request;
            $daily_report->target_finish = $assesments->due_date;
            $daily_report->note = $assesments->assesment_note.'<br />'.$assesments->assesment_file;
            $daily_report->create_date = $assesments->assesment_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Assesment Updated';
            $autoemail->subject = $assesments->assesment_date;
            $autoemail->message = 'Assesment Date : '.$assesments->assesment_date
                                    .'<br /> Assesment User : '.$assesments->assesment_user
                                    .'<br /> Assesment Note :'.$assesments->assesment_note
                                    .'<br /> Assesment File :'.$assesments->assesment_file
                                    .'<br /> Id Project :'.$history->project_id
                                    .'<br /> Title History :'.$history->title_history
                                    .'<br /> Note History :'.$history->note_history;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Assesment has been Changed');
            return Redirect::route('listAssesments');
        }
    }

    /**
     * Melakukan proses download manual book project
     */
    public function getDownloadAssesmentFile($projectId)
    {
        $assesmentfiles = Project::find($projectId);
        $fileassesments = public_path().'/uploads/'.$assesmentfiles->assesment_file;
        $response = Response::download($fileassesments);
        return $response;
    }
}