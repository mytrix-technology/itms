<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MasterProjectTypeController extends \BaseController {

	/**
     * Mengambil Index Page Master Tipe Proyek
     */
	public function getIndex()
    {
        // get alls Vendors
        $masterprojecttypes = MasterProjectType::orderBy('id','DESC')->get();

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.masterprojecttypes-list'), array('masterprojecttypes' => $masterprojecttypes))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.masterprojecttypes-index'), array('masterprojecttypes' => $masterprojecttypes));
        $this->layout->title = "Master Tipe Proyek";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterprojecttypes');
    }
    
    /**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Application Name
        $projectTypeName = Input::get('projectTypeNameSearch');
        $activated = Input::get('activatedSearch');

        if (empty($projectTypeName)) {
            $masterprojecttypes = MasterProjectType::orderBy('id','DESC')->get();
		} else {
            $masterprojecttypes = MasterProjectType::where('name_project_type', 'LIKE', '%'.$projectTypeName.'%')
                            ->orderBy('id','DESC')
                            ->get();
        }
		
		$masterprojecttypes = MasterProjectType::where('activated', '=', $activated)
                            ->orderBy('id','DESC')
                            ->get();
        
        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.masterprojecttypes-list'), array('masterprojecttypes' => $masterprojecttypes))->render();

            return Response::json(array('html' => $html));
        }
        
        $this->layout = View::make(Config::get('adminlte::views.masterprojecttypes-index'), array('masterprojecttypes' => $masterprojecttypes));
        $this->layout->title = "Master Tipe Proyek";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.masterprojecttypes');
    }

	/**
     * Menampilkan form create master tipr proyek
     */
	public function getCreate()
    {
        $this->layout = View::make(Config::get('adminlte::views.masterprojecttype-create'));
        $this->layout->title = "New Master Project Type";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_masterprojecttype');
    }

	/**
     * Melakukan proses create master tipe proyek
     */
	public function postCreate()
    {
        $aturan = array(
            'name_project_type' => 'required', 
            'desc_project_type' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->passes()) {
            $masterprojecttype = new MasterProjectType;
            # Buatkan variabel tiap inputan
            $masterprojecttype->name_project_type = Input::get('name_project_type');
            $masterprojecttype->desc_project_type = Input::get('desc_project_type');
            $masterprojecttype->activated = 1;
            $masterprojecttype->user_created = Input::get('user_created');
            $masterprojecttype->save();

            $daily_report = new DailyReport;
            $daily_report->master_project_type_id = $masterprojecttype->id;
            $daily_report->job = $masterprojecttype->name_project_type;
            $daily_report->description = $masterprojecttype->desc_project_type;
            $daily_report->status_job_daily_report = $masterprojecttype->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterprojecttype->desc_project_type;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Project Type Created';
            $autoemail->subject = $masterprojecttype->name_project_type;
            $autoemail->message = 'Project Type Name : '.$masterprojecttype->name_project_type
                                    .'<br /> Project Type Description : '.$masterprojecttype->desc_project_type
                                    .'<br /> Activated :'.$masterprojecttype->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New Project Type Master has been Added.');
            return Redirect::route('listMasterProjectTypes');
            
        } else {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        }
    }

	/**
     * Menampilkan form edit master tipe proyek
     */
	public function getShow($masterprojecttypeId)
    {
        try
        {
            $masterprojecttypes = MasterProjectType::find($masterprojecttypeId);
            
            $this->layout = View::make(Config::get('adminlte::views.masterprojecttype-edit'), array(
                'masterprojecttypes' => $masterprojecttypes,
            ));

            $this->layout->title = $masterprojecttypes->name_project_type;
            $this->layout->breadcrumb = array(
                    array(
                        'title' => "Project Type Master",
                        'link' => URL::route('listMasterProjectTypes'),
                        'icon' => 'glyphicon-th'
                    ),
                    array(
                     'title' => $masterprojecttypes->name_project_type,
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
     * Melakukan proses update master tipe proyek ke database
     */
	public function putShow($masterprojecttypeId)
    {
        $aturan = array(
            'name_project_type' => 'required', 
            'desc_project_type' => 'required',
        );

        $validasi = Validator::make(Input::all(), $aturan);

        if($validasi->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validasi)->withInput();
        # Bila validasi sukses
        } else {
            $masterprojecttypes = MasterProjectType::find($masterprojecttypeId);
            # Buatkan variabel tiap inputan
            $masterprojecttypes->name_project_type = Input::get('name_project_type');
            $masterprojecttypes->desc_project_type = Input::get('desc_project_type');
            $masterprojecttypes->activated = Input::get('activated');
            $masterprojecttypes->user_updated = Input::get('user_updated');
            $masterprojecttypes->save();

            $daily_report = new DailyReport;
            $daily_report->master_project_type_id = $masterprojecttypes->id;
            $daily_report->job = $masterprojecttypes->name_project_type;
            $daily_report->description = $masterprojecttypes->desc_project_type;
            $daily_report->status_job_daily_report = $masterprojecttypes->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterprojecttypes->desc_project_type;
            $daily_report->create_date = date('Y-m-d H:i:s');
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Master Project Type Created';
            $autoemail->subject = $masterprojecttypes->name_project_type;
            $autoemail->message = 'Project Type Name : '.$masterprojecttypes->name_project_type
                                    .'<br /> Project Type Description : '.$masterprojecttypes->desc_project_type
                                    .'<br /> Activated :'.$masterprojecttypes->activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Project Type Master has been Changed.');
            return Redirect::route('listMasterProjectTypes');
        }
    }

    /**
     * Melakukan aktifasi master tipe proyek
     */
    public function active($masterprojecttypeId)
    {
        $masterprojecttypes = MasterProjectType::find($masterprojecttypeId);
        $masterprojecttypes->activated = 1;
        $masterprojecttypes->save();

            $daily_report = new DailyReport;
            $daily_report->master_project_type_id = $masterprojecttypes->id;
            $daily_report->job = $masterprojecttypes->name_project_type;
            $daily_report->description = $masterprojecttypes->desc_project_type;
            $daily_report->status_job_daily_report = $masterprojecttypes->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterprojecttypes->desc_project_type;
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
        return Redirect::route('listMasterProjectTypes');
    }
    
    /**
     * Melakukan non-aktifasi master tipe proyek
     */
    public function nonactive($masterprojecttypeId)
    {
        $masterprojecttypes = MasterProjectType::find($masterprojecttypeId);
        $masterprojecttypes->activated = 0;
        $masterprojecttypes->save();

            $daily_report = new DailyReport;
            $daily_report->master_project_type_id = $masterprojecttypes->id;
            $daily_report->job = $masterprojecttypes->name_project_type;
            $daily_report->description = $masterprojecttypes->desc_project_type;
            $daily_report->status_job_daily_report = $masterprojecttypes->activated;
            $daily_report->target_finish = date('Y-m-d H:i:s');
            $daily_report->note = $masterprojecttypes->desc_project_type;
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
        return Redirect::route('listMasterProjectTypes');
    }

	/**
     * Melakukan proses delete master tipe proyek
     */
	public function delete($masterprojecttypeId)
    {
        $masterprojecttypes = MasterProjectType::find($masterprojecttypeId);
        $masterprojecttypes->delete();

        return Redirect::route('listMasterProjectTypes')->withPesan('Project Type Master has been Deleted.');
    }

}