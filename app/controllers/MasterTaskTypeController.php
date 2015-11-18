<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MasterTaskTypeController extends \BaseController {

	/**
     * Mengambil Index Page Master Tipe Tugas
     */
	public function getIndex()
    {
        // get alls Vendors
        $mastertasktypes = MasterTaskType::orderBy('id','DESC')->get();

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.mastertasktypes-list'), array('mastertasktypes' => $mastertasktypes))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.mastertasktypes-index'), array('mastertasktypes' => $mastertasktypes));
        $this->layout->title = "Task Type Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.mastertasktypes');
    }
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Application Name
        $tasktTypeName = Input::get('taskTypeNameSearch');
        $activated = Input::get('activatedSearch');

        if (empty($tasktTypeName)) {
            $mastertasktypes = MasterTaskType::orderBy('id','DESC')->get();
		} else {
            $mastertasktypes = MasterTaskType::where('name_task_type', 'LIKE', '%'.$tasktTypeName.'%')
                            ->orderBy('id', 'DESC')
                            ->get();
        }
		
		$mastertasktypes = MasterTaskType::where('activated', '=', $activated)
                            ->orderBy('id','DESC')
                            ->get();
        
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.mastertasktypes-list'), array('mastertasktypes' => $mastertasktypes))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.mastertasktypes-index'), array('mastertasktypes' => $mastertasktypes));
        $this->layout->title = "Task Type Master";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.mastertasktypes');
    }

	/**
     * Menampilkan form create master tipe tugas
     */
	public function getCreate()
    {
        $this->layout = View::make(Config::get('adminlte::views.mastertasktype-create'));
        $this->layout->title = "New Master Task Type";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_mastertasktype');
    }

	/**
     * Melakukan proses create master tipe tugas
     */
	public function postCreate()
    {
        $aturan = array(
            'name_task_type' => 'required', 
            'desc_task_type' => 'required', 
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $mastertasktype = new MasterTaskType;
            # Buatkan variabel tiap inputan
            $mastertasktype->name_task_type = Input::get('name_task_type');
            $mastertasktype->desc_task_type = Input::get('desc_task_type');
            $mastertasktype->activated = 1;
            $mastertasktype->user_created = Input::get('user_created');
            $mastertasktype->save();

            $daily_report = new DailyReport;
            $daily_report->master_task_type_id = $mastertasktype->id;
            $daily_report->job = $mastertasktype->name_task_type;
            $daily_report->description = $mastertasktype->desc_task_type;
            $daily_report->status_job_daily_report = $mastertasktype->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastertasktype->desc_task_type;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Task Type Created';
            $autoemail->subject = $mastertasktype->name_task_type;
            $autoemail->message = 'Task Type Name : '.$mastertasktype->name_task_type
                                    .'<br /> Task Type Description : '.$mastertasktype->desc_task_type
                                    .'<br /> Activated :'.$mastertasktype->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New Task Type Master has been Added');
            return Redirect::route('listMasterTaskTypes');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit master tipe tugas
     */
	public function getShow($mastertasktypeId)
    {
        try
        {
            $mastertasktypes = MasterTaskType::find($mastertasktypeId);
            
            $this->layout = View::make(Config::get('adminlte::views.mastertasktype-edit'), array(
                'mastertasktypes' => $mastertasktypes,
            ));

            $this->layout->title = $mastertasktypes->name_task_type;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Master Tipe Tugas",
                        'link' => URL::route('listMasterTaskTypes'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $mastertasktypes->name_task_type,
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
     * Melakukan proses update master tipe tugas ke database
     */
	public function putShow($mastertasktypeId)
    {
        $aturan = array(
            'name_task_type' => 'required', 
            'desc_task_type' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $mastertasktypes = MasterTaskType::find($mastertasktypeId);
            # Buatkan variabel tiap inputan
            $mastertasktypes->name_task_type = Input::get('name_task_type');
            $mastertasktypes->desc_task_type = Input::get('desc_task_type');
            $mastertasktypes->activated = Input::get('activated');
            $mastertasktypes->user_updated = Input::get('user_updated');
            $mastertasktypes->save();

            $daily_report = new DailyReport;
            $daily_report->master_task_type_id = $mastertasktypes->id;
            $daily_report->job = $mastertasktypes->name_task_type;
            $daily_report->description = $mastertasktypes->desc_task_type;
            $daily_report->status_job_daily_report = $mastertasktypes->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastertasktypes->desc_task_type;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Master Task Type Updated';
            $autoemail->subject = $mastertasktypes->name_task_type;
            $autoemail->message = 'Task Type Name : '.$mastertasktypes->name_task_type
                                    .'<br /> Task Type Description : '.$mastertasktypes->desc_task_type
                                    .'<br /> Activated :'.$mastertasktypes->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Task Type Master has been Changed');
            return Redirect::route('listMasterTaskTypes');
        }
    }

    /**
     * Melakukan aktifasi Master Tipe Tugas
     */
    public function active($mastertasktypeId)
    {
        $mastertasktypes = MasterTaskType::find($mastertasktypeId);
        $mastertasktypes->activated = 1;
        $mastertasktypes->save();

            $daily_report = new DailyReport;
            $daily_report->master_task_type_id = $mastertasktypes->id;
            $daily_report->job = $mastertasktypes->name_task_type;
            $daily_report->description = $mastertasktypes->desc_task_type;
            $daily_report->status_job_daily_report = $mastertasktypes->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastertasktypes->desc_task_type;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_it@pancaran-group.com';
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
            $autoemails->save();

        //Notification:success('Application Update has been Activated');
        return Redirect::route('listMasterTaskTypes');
    }
    
    /**
     * Melakukan non-aktifasi Master Tipe Tugas
     */
    public function nonactive($mastertasktypeId)
    {
        $mastertasktypes = MasterTaskType::find($mastertasktypeId);
        $mastertasktypes->activated = 0;
        $mastertasktypes->save();

            $daily_report = new DailyReport;
            $daily_report->master_task_type_id = $mastertasktypes->id;
            $daily_report->job = $mastertasktypes->name_task_type;
            $daily_report->description = $mastertasktypes->desc_task_type;
            $daily_report->status_job_daily_report = $mastertasktypes->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $mastertasktypes->desc_task_type;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_it@pancaran-group.com';
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
            $autoemails->save();

        //Notification:success('Status Master has been Non Activated');
        return Redirect::route('listMasterTaskTypes');
    }

	/**
     * Melakukan proses delete Master Tipe Tugas
     */
	public function delete($mastertasktypeId)
    {
        $mastertasktypes = MasterTaskType::find($mastertasktypeId);
        $mastertasktypes->delete();

        return Redirect::route('listMasterTaskTypes')->withPesan('Master Tipe Tugas berhasil dihapus.');
    }

}