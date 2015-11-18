<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class WeeklyMeetingController extends \BaseController {

    /**
     * Mengambil Index Page Weekly Meeting
     */
    public function getIndex()
    {
        // get alls Vendors
        $weeklymeetings = WeeklyMeeting::orderBy('id', 'DESC')->get();

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.weeklymeetings-list'), array('weeklymeetings' => $weeklymeetings))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.weeklymeetings-index'), array('weeklymeetings' => $weeklymeetings));
        $this->layout->title = "Weekly Meeting";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.weeklymeetings');
    }
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $weeklyMeetingDate = Input::get('weeklyMeetingDateSearch');
        if(empty($weeklyMeetingDate))
        {
            $weeklymeetings = WeeklyMeeting::orderBy('id', 'DESC')->get();
            
        } else {
            $weeklymeetings = WeeklyMeeting::where('weekly_meeting_date', 'LIKE', '%'.$weeklyMeetingDate.'%')
                            ->orderBy('id')
                            ->get();
        }
        
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.weeklymeetings-list'), array('weeklymeetings' => $weeklymeetings))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.weeklymeetings-index'), array('weeklymeetings' => $weeklymeetings));
        $this->layout->title = "Weekly Meeting";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.weeklymeetings');
    }

    /**
     * Menampilkan form create weekly meeting baru
     */
    public function getCreate()
    {
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;

        $this->layout = View::make(Config::get('adminlte::views.weeklymeeting-create'), array('users' => $users));
        $this->layout->title = "New Weekly Meeting";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_weeklymeetings');
    }

    /**
     * Melakukan proses create weekly meeting baru
     */
    public function postCreate()
    {
        $aturan = array(
            'weekly_meeting_subject' => 'required',
            'weekly_meeting_date' => 'required',
            'weekly_meeting_trainer' => 'required', 
            'weekly_meeting_user' => 'required|numeric',
            'weekly_meeting_time' => 'required|numeric',
            'weekly_meeting_note' => 'required',
        );

        $weeklymeetingname = Input::get('weekly_meeting_subject');

        if (Input::hasFile('fileWeeklyMeeting')){
            $fileWeeklyMeeting = Input::file('fileWeeklyMeeting');
            $destinationPath = 'uploads/';
            $extension = $fileWeeklyMeeting->getClientOriginalExtension();
            $filenameWeeklyMeeting =  $weeklymeetingname.'.'.$extension;
            $upload_success = $fileWeeklyMeeting->move($destinationPath, $filenameWeeklyMeeting);
        } else {
            $filenameWeeklyMeeting = "";
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $weeklymeeting = new WeeklyMeeting;
            # Buatkan variabel tiap inputan
            $weeklymeeting->weekly_meeting_subject = Input::get('weekly_meeting_subject');
            $weeklymeeting->weekly_meeting_date = Input::get('weekly_meeting_date');
            $weeklymeeting->weekly_meeting_trainer = Input::get('weekly_meeting_trainer');
            $weeklymeeting->weekly_meeting_user = Input::get('weekly_meeting_user');
            $weeklymeeting->weekly_meeting_time = Input::get('weekly_meeting_time');
            $weeklymeeting->weekly_meeting_note = Input::get('weekly_meeting_note');
            $weeklymeeting->weekly_meeting_file = $filenameWeeklyMeeting;
            $weeklymeeting->user_created = Input::get('user_created');
            $weeklymeeting->save();

            $daily_report = new DailyReport;
            $daily_report->weekly_meeting_id = $weeklymeeting->id;
            $daily_report->job = $weeklymeeting->weekly_meeting_subject;
            $daily_report->description = $weeklymeeting->weekly_meeting_note;
            //$daily_report->status_job_daily_report = $weeklymeeting->project->status_project_request;
            $daily_report->target_finish = $weeklymeeting->weekly_meeting_date;
            $daily_report->note = $weeklymeeting->weekly_meeting_user.'<br />'.$weeklymeeting->weekly_meeting_file.'<br />'.$weeklymeeting->weekly_meeting_note;
            $daily_report->create_date = $weeklymeeting->weekly_meeting_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it_pdt@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com,delvi@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Weekly Meeting Created';
            $autoemail->subject = $weeklymeeting->weekly_meeting_subject;
            $autoemail->message = 'Subject : '.$weeklymeeting->weekly_meeting_subject
                                    .'<br /> Date : '.$weeklymeeting->weekly_meeting_date
                                    .'<br /> Trainer :'.$weeklymeeting->user1->username
                                    .'<br /> Participants :'.$weeklymeeting->weekly_meeting_user
                                    .'<br /> Times :'.$weeklymeeting->weekly_meeting_time
                                    .'<br /> Note :'.$weeklymeeting->weekly_meeting_note;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('Weekly Meeting has been Added');
            return Redirect::route('listWeeklyMeetings');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

    /**
     * Menampilkan form edit weekly meeting
     */
    public function getShow($weeklymeetingId)
    {
        try
        {
            $weeklymeetings = WeeklyMeeting::find($weeklymeetingId);

            $users = array('' => '');
            foreach(User::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $users[$row->id] = $row->username;
            
            $this->layout = View::make(Config::get('adminlte::views.weeklymeeting-edit'), array(
                'weeklymeetings' => $weeklymeetings,
                'users' => $users,
            ));

            $this->layout->title = $weeklymeetings->weekly_meeting_date;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Weekly Meeting",
                        'link' => URL::route('listWeeklyMeetings'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $weeklymeetings->weekly_meeting_date,
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
     * Melakukan proses update weekly meeting ke database
     */
    public function putShow($weeklymeetingId)
    {
        $aturan = array(
            'weekly_meeting_subject' => 'required',
            'weekly_meeting_date' => 'required',
            'weekly_meeting_trainer' => 'required', 
            'weekly_meeting_user' => 'required|numeric',
            'weekly_meeting_time' => 'required|numeric',
            'weekly_meeting_note' => 'required',
        );

        $weeklymeetingname = Input::get('weekly_meeting_subject');

        if (Input::hasFile('fileWeeklyMeeting')){
            $fileWeeklyMeeting = Input::file('fileWeeklyMeeting');
            $destinationPath = 'uploads/';
            $extension = $fileWeeklyMeeting->getClientOriginalExtension();
            $filenameWeeklyMeeting =  $weeklymeetingname.'.'.$extension;
            $upload_success = $fileWeeklyMeeting->move($destinationPath, $filenameWeeklyMeeting);
        } else {
            $filenameWeeklyMeeting = Input::get('weekly_meeting_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $weeklymeetings = WeeklyMeeting::find($weeklymeetingId);
            # Buatkan variabel tiap inputan
            $weeklymeetings->weekly_meeting_subject = Input::get('weekly_meeting_subject');
            $weeklymeetings->weekly_meeting_date = Input::get('weekly_meeting_date');
            $weeklymeetings->weekly_meeting_trainer = Input::get('weekly_meeting_trainer');
            $weeklymeetings->weekly_meeting_user = Input::get('weekly_meeting_user');
            $weeklymeetings->weekly_meeting_time = Input::get('weekly_meeting_time');
            $weeklymeetings->weekly_meeting_note = Input::get('weekly_meeting_note');
            $weeklymeetings->weekly_meeting_file = $filenameWeeklyMeeting;
            $weeklymeetings->user_updated = Input::get('user_updated');
            $weeklymeetings->save();

            $daily_report = new DailyReport;
            $daily_report->weekly_meeting_id = $weeklymeetings->id;
            $daily_report->job = $weeklymeetings->weekly_meeting_subject;
            $daily_report->description = $weeklymeetings->weekly_meeting_note;
            //$daily_report->status_job_daily_report = $weeklymeeting->project->status_project_request;
            $daily_report->target_finish = $weeklymeetings->weekly_meeting_date;
            $daily_report->note = $weeklymeetings->weekly_meeting_user.'<br />'.$weeklymeetings->weekly_meeting_file.'<br />'.$weeklymeetings->weekly_meeting_note;
            $daily_report->create_date = $weeklymeetings->weekly_meeting_date;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it_pdt@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com,delvi@pancaran-group.com';
            $autoemail->judul = 'ITMS - Weekly Meeting Updated';
            $autoemail->subject = $weeklymeetings->weekly_meeting_subject;
            $autoemail->message = 'Subject : '.$weeklymeetings->weekly_meeting_subject
                                    .'<br /> Date : '.$weeklymeetings->weekly_meeting_date
                                    .'<br /> Trainer :'.$weeklymeetings->user1->username
                                    .'<br /> Participants :'.$weeklymeetings->weekly_meeting_user
                                    .'<br /> Times :'.$weeklymeetings->weekly_meeting_time
                                    .'<br /> Note :'.$weeklymeetings->weekly_meeting_note;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Weekly Meeting has been changed.');
            return Redirect::route('listWeeklyMeetings');
        }
    }

    /**
     * Melakukan proses download manual book project
     */
    public function getDownloadWeeklyMeetingFile($weeklymeetingId)
    {
        $weeklymeetingfiles = WeeklyMeeting::find($weeklymeetingId);
        $fileweeklymeetings = public_path().'/uploads/'.$weeklymeetingfiles->weekly_meeting_file;
        $response = Response::download($fileweeklymeetings);
        return $response;
    }

}