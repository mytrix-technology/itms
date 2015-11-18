<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class TrainingController extends \BaseController {

	/**
     * Mengambil Index Page Training
     */
	public function getIndex()
    {
        // get alls Vendors
        $trainings = Training::orderBy('id', 'DESC')->get();
        
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
            $html = View::make(Config::get('adminlte::views.trainings-list'), array('trainings' => $trainings, 'users' => $users, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.trainings-index'), array('trainings' => $trainings, 'users' => $users, 'projectNames' => $projectNames));
        $this->layout->title = "Training";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.trainings');
    }

    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $projectName = Input::get('projectNameSearch');
        $trainingTarget = Input::get('trainingTargetSearch');
        $trainingActualDate = Input::get('trainingActualDateSearch');
        $trainer = Input::get('trainerSearch');
        
        if (empty($projectName)) {
            $trainings = Training::orderBy('id','DESC')->get();

            if (empty($trainingTarget)) {
                $trainings = Training::orderBy('id','DESC')->get();

                if (empty($trainingActualDate)) {
                    $trainings = Training::orderBy('id','DESC')->get();

                    if (empty($trainer)) {
                        $trainings = Training::orderBy('id','DESC')->get();
                    } else {
                        $trainings = Training::where('trainer', 'LIKE', '%'.$trainer.'%')
                            ->orderBy('id','DESC')
                            ->get();
                    }
                } else {
                    $trainings = Training::where('training_actual_date', 'LIKE', '%'.$trainingActualDate.'%')
                            ->orderBy('id','DESC')
                            ->get();
                }
            } else {
                $trainings = Training::where('training_target', 'LIKE', '%'.$trainingTarget.'%')
                            ->orderBy('id','DESC')
                            ->get();
            }
        } else {
            $trainings = Training::where('id', 'LIKE', '%'.$projectName.'%')
                            ->orderBy('id','DESC')
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
            $html = View::make(Config::get('adminlte::views.trainings-list'), array('trainings' => $trainings, 'users' => $users, 'projectNames' => $projectNames))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.trainings-index'), array('trainings' => $trainings, 'users' => $users, 'projectNames' => $projectNames));
        $this->layout->title = "Training";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.trainings');
    }

	/**
     * Menampilkan form edit training
     */
	public function getShow($projectId)
    {
        try
        {
            $trainings = Training::find($projectId);
            
            $users = array('' => '');
            foreach(User::all() as $row)
                //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
                $users[$row->id] = $row->username;
            
            $this->layout = View::make(Config::get('adminlte::views.training-edit'), array(
                'trainings' => $trainings,
                'users' => $users,
            ));

            $this->layout->title = $trainings->name_project;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Training",
                        'link' => URL::route('listTrainings'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $trainings->name_project,
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
     * Melakukan proses update training ke database
     */
	public function putShow($projectId)
    {
        $aturan = array(
            'training_target' => 'required', 
            'training_actual_date' => 'required', 
            'trainer' => 'required',
        );

        $trainingname = Input::get('project');

        if (Input::hasFile('fileTraining')){
            $fileTraining = Input::file('fileTraining');
            $destinationPath = 'uploads/';
            $extension = $fileTraining->getClientOriginalExtension();
            $filenameTraining =  $trainingname.'-training.'.$extension;
            $upload_success = $fileTraining->move($destinationPath, $filenameTraining);
        } else {
            $filenameTraining = Input::get('training_file');
        }

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $trainings = Training::find($projectId);
            # Buatkan variabel tiap inputan
            $trainings->training_target = Input::get('training_target');
            $trainings->training_actual_date = Input::get('training_actual_date');
            $trainings->trainer = Input::get('trainer');
            $trainings->training_file = $filenameTraining;
            $trainings->user_updated = Input::get('user_updated');
            $trainings->save();

            $daily_report = new DailyReport;
            $daily_report->project_id = $trainings->id;
            $daily_report->job = $trainings->name_project;
            $daily_report->description = $trainings->training_target;
            $daily_report->status_job_daily_report = $trainings->status_project_request;
            $daily_report->target_finish = $trainings->due_date;
            $daily_report->note = $trainings->user->username.'<br />'.$trainings->training_file;
            $daily_report->create_date = $trainings->training_actual_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Training Updated';
            $autoemail->subject = $trainings->training_target;
            $autoemail->message = 'Training Target : '.$trainings->training_target
                                    .'<br /> Training Actual Date : '.$trainings->training_actual_date
                                    .'<br /> Trainer :'.$trainings->user->username;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Training has been Changed');
            return Redirect::route('listTrainings');
        }
    }

    /**
     * Melakukan proses download manual book project
     */
    public function getDownloadTrainingFile($projectId)
    {
        $trainingfiles = Project::find($projectId);
        $filetrainings = public_path().'/uploads/'.$trainingfiles->training_file;
        $response = Response::download($filetrainings);
        return $response;
    }

}