<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class MonthlyBackupDBController extends \BaseController {

	/**
     * Mengambil Index Page Monthy backup database
     */
	public function getIndex()
	{
		// get alls Vendors
		$monthlyBackupDBs = MonthlyBackupDB::orderBy('id', 'DESC')->get();
        
        // Application Master
        $masterDBs = array('' => '');
        foreach(MasterDB::where('status','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterDBs[$row->id] = $row->database_name;
            
        // User    
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;
            
        // Status
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','backupDB')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

		// ajax request : reload only content container
		if(Request::ajax())
		{
			$html = View::make(Config::get('adminlte::views.monthlybackupDBs-list'), array('monthlyBackupDBs' => $monthlyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss))->render();

			return Response::json(array('html' => $html));
		}

		$this->layout = View::make(Config::get('adminlte::views.monthlybackupDBs-index'), array('monthlyBackupDBs' => $monthlyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss));
		$this->layout->title = "Database Monthly Backup";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.monthlyBackupDBs');
	}

	/**
     * Melakukan proses pencarian inputan data
     */
    public function postSearch()
    {
        // Project Name
        $databaseMaster = Input::get('databaseMasterSearch');
        $userBackup = Input::get('userBackupSearch');
        $backupStatus = Input::get('backupStatusSearch');
        $activated = Input::get('activatedSearch');
        $period = Input::get('periodSearch');
        $receiverDate = Input::get('receiverDateSearch');
        $backupDate = Input::get('backupDateSearch');
        
        if (empty($databaseMaster)) {
            $monthlyBackupDBs = MonthlyBackupDB::orderBy('id', 'DESC')->get();

            if (empty($userBackup)) {
                $monthlyBackupDBs = MonthlyBackupDB::orderBy('id', 'DESC')->get();

                if (empty($backupStatus)) {
                    $monthlyBackupDBs = MonthlyBackupDB::orderBy('id', 'DESC')->get();

                    if (empty($period)) {
                            $monthlyBackupDBs = MonthlyBackupDB::orderBy('id', 'DESC')->get();

                            if (empty($backupDate)) {
                            	$monthlyBackupDBs = MonthlyBackupDB::orderBy('id', 'DESC')->get();

                            	if (empty($receiverDate)) {
									$monthlyBackupDBs = MonthlyBackupDB::orderBy('id', 'DESC')->get();                            		
                            	} else {
                            		$monthlyBackupDBs = MonthlyBackupDB::where('receiver_date', 'LIKE', '%'.$receiverDate.'%')
		                            ->orderBy('id', 'DESC')
		                            ->get();
                            	}
                            } else {
                            	$monthlyBackupDBs = MonthlyBackupDB::where('backup_date', 'LIKE', '%'.$backupDate.'%')
	                            ->orderBy('id','DESC')
	                            ->get();
                            }
                        } else {
                            $monthlyBackupDBs = MonthlyBackupDB::where('period', 'LIKE', '%'.$period.'%')
                            ->orderBy('id','DESC')
                            ->get();
                        }
                } else {
                    $monthlyBackupDBs = MonthlyBackupDB::where('id_master_status', 'LIKE', '%'.$backupStatus.'%')
                            ->orderBy('id','DESC')
                            ->get();
                }
            } else {
                $monthlyBackupDBs = MonthlyBackupDB::where('user_backup', 'LIKE', '%'.$userBackup.'%')
                            ->orderBy('id','DESC')
                            ->get();
            }
        } else {
            $monthlyBackupDBs = MonthlyBackupDB::where('id_master_DB', 'LIKE', '%'.$databaseMaster.'%')
                            ->orderBy('id','DESC')
                            ->get();
        }
		
		$monthlyBackupDBs = MonthlyBackupDB::where('status_activated', '=', $activated)
                            ->orderBy('id','DESC')
                            ->get();
        
        // Database master select option
        $masterDBs = array('' => '');
        foreach(MasterDB::where('status','=','1')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterDBs[$row->id] = $row->database_name;
            
        // User select option
        $users = array('' => '');
        foreach(User::all() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $users[$row->id] = $row->username;
            
        // Status master select option
        $masterstatuss = array('' => '');
        foreach(MasterStatus::where('group','=','backupDB')->get() as $row)
            //$return .= "<option value='$row->id'>$row->nm_vendor</option>";
            $masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

        // ajax request : reload only content container
        if(Request::ajax())
        {
            $html = View::make(Config::get('adminlte::views.monthlybackupDBs-list'), array('monthlyBackupDBs' => $monthlyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('adminlte::views.monthlybackupDBs-index'), array('monthlyBackupDBs' => $monthlyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Database Monthly Backup";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.monthlyBackupDBs');
    }

	/**
     * Menampilkan form create monthly backup database
     */
	public function getCreate()
	{
		$masterDBs = array('' => '');
		foreach(MasterDB::where('status','=','1')->get() as $row)
			//$return .= "<option value='$row->id'>$row->nm_vendor</option>";
			$masterDBs[$row->id] = $row->database_name;

		$masterstatuss = array('' => '');
		foreach(MasterStatus::where('group','=','backupDB')->get() as $row)
			//$return .= "<option value='$row->id'>$row->nm_vendor</option>";
			$masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

		$this->layout = View::make(Config::get('adminlte::views.monthlybackupDB-create'), array('masterDBs' => $masterDBs, 'masterstatuss' => $masterstatuss));
		$this->layout->title = "New Database Monthly Backup";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_monthlyBackupDB');
	}

	/**
     * Melakukan proses create monthly backup database baru
     */
	public function postCreate()
	{
		$aturan = array(
			'id_master_DB' => 'required',
			'dp3' => 'required',
			//'user_backup' => 'required',
			'datepicker' => 'required',
			//'status' => 'required',
			'id_master_status' => 'required',
			'remark' => 'required',
		);

		$validasi = Validator::make(Input::all(), $aturan);

		if($validasi->passes()) {
			$monthlybackupDB = new MonthlyBackupDB;
			# Buatkan variabel tiap inputan
			$monthlybackupDB->id_master_DB = Input::get('id_master_DB');
			$monthlybackupDB->period = Input::get('dp3');
			$monthlybackupDB->user_backup = Input::get('user_backup');
			$monthlybackupDB->backup_date = Input::get('datepicker');
			$monthlybackupDB->id_master_status = Input::get('id_master_status');
			$monthlybackupDB->remark = Input::get('remark');
			$monthlybackupDB->status_activated = 0;
			$monthlybackupDB->user_created = Input::get('user_created');
			$monthlybackupDB->save();

			$daily_report = new DailyReport;
            $daily_report->backup_db_monthly_id = $monthlybackupDB->id;
            $daily_report->job = $monthlybackupDB->masterDB->database_name;
            $daily_report->description = $monthlybackupDB->remark;
            $daily_report->status_job_daily_report = $monthlybackupDB->id_master_status;
            $daily_report->target_finish = $monthlybackupDB->receiver_date;
            $daily_report->note = 'Approval :'.$monthlybackupDB->approval_dba.' - '.$monthlybackupDB->approval_itd_dev.' - '.$monthlybackupDB->approval_itd_head_dev;
            $daily_report->create_date = $monthlybackupDB->backup_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - New Monthly Backup Database Created';
            $autoemail->subject = $monthlybackupDB->backup_date;
            $autoemail->message = 'ID Master Database : '.$monthlybackupDB->masterDB->database_name
                                    .'<br /> Period : '.$monthlybackupDB->period
                                    .'<br /> User Backup :'.$monthlybackupDB->user->username
                                    .'<br /> Backup Date :'.$monthlybackupDB->backup_date
                                    .'<br /> Status :'.$monthlybackupDB->masterstatus->status_name
                                    .'<br /> Remark :'.$monthlybackupDB->remark
                                    .'<br /> Activated :'.$monthlybackupDB->status_activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::success('New Database Monthly Backup has been added.');
			return Redirect::route('listMonthlyBackupDBs');

		} else {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
		}
	}

	/**
     * Menampilkan form edit monthly backup database
     */
	public function getShow($monthlyBackupDBId)
	{
		try
		{
			$monthlybackupDBs = MonthlyBackupDB::find($monthlyBackupDBId);

			$masterDBs = array('' => '');
			foreach(MasterDB::where('status','=','1')->get() as $row)
				//$return .= "<option value='$row->id'>$row->nm_vendor</option>";
				$masterDBs[$row->id] = $row->database_name;

			$masterstatuss = array('' => '');
			foreach(MasterStatus::where('group','=','backupDB')->get() as $row)
				//$return .= "<option value='$row->id'>$row->nm_vendor</option>";
				$masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

			$this->layout = View::make(Config::get('adminlte::views.monthlybackupDB-edit'), array(
				'monthlybackupDBs' => $monthlybackupDBs,
				'masterDBs' => $masterDBs,
				'masterstatuss' => $masterstatuss,
			));

			$this->layout->title = $monthlybackupDBs->masterDB->database_name;
			$this->layout->breadcrumb = array(
				array(
					'title' => "Database Monthly Backup",
					'link' => URL::route('listMonthlyBackupDBs'),
					'icon' => 'glyphicon-th'
				),
				array(
					'title' => $monthlybackupDBs->masterDB->database_name,
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
     * Melakukan proses update monthly backup database ke database
     */
	public function putShow($monthlyBackupDBId)
	{
		$aturan = array(
			'id_master_DB' => 'required',
			'dp3' => 'required',
			//'user_backup' => 'required',
			'datepicker' => 'required',
			//'status' => 'required',
			'id_master_status' => 'required',
			'remark' => 'required',
		);

		$validasi = Validator::make(Input::all(), $aturan);

		if($validasi->fails()) {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
			# Bila validasi sukses
		} else {
			$monthlybackupDBs = MonthlyBackupDB::find($monthlyBackupDBId);
			# Buatkan variabel tiap inputan
			$monthlybackupDBs->id_master_DB = Input::get('id_master_DB');
			$monthlybackupDBs->period = Input::get('dp3');
			$monthlybackupDBs->user_backup = Input::get('user_backup');
			$monthlybackupDBs->backup_date = Input::get('datepicker');
			//$monthlybackupDBs->receiver_date = Input::get('datepicker2');
			$monthlybackupDBs->id_master_status = Input::get('id_master_status');
			$monthlybackupDBs->remark = Input::get('remark');
			//$monthlybackupDBs->status_activated = Input::get('status');
			$monthlybackupDBs->user_updated = Input::get('user_updated');
			$monthlybackupDBs->save();

			$daily_report = new DailyReport;
            $daily_report->backup_db_monthly_id = $monthlybackupDBs->id;
            $daily_report->job = $monthlybackupDBs->masterDB->database_name;
            $daily_report->description = $monthlybackupDBs->remark;
            $daily_report->status_job_daily_report = $monthlybackupDBs->id_master_status;
            $daily_report->target_finish = $monthlybackupDBs->receiver_date;
            $daily_report->note = 'Approval :'.$monthlybackupDBs->approval_dba.' - '.$monthlybackupDBs->approval_itd_dev.' - '.$monthlybackupDBs->approval_itd_head_dev;
            $daily_report->create_date = $monthlybackupDBs->backup_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();

            $autoemail = new Autoemail;
            $autoemail->setConnection('mysqlemail');
            $autoemail->to = 'ou_it@pancaran-group.com';
            $autoemail->from = Sentry::getUser()->email;
            $autoemail->cc = 'ndaru@pancaran-group.com';
            $autoemail->judul = 'ITMS - Monthly Backup Database Updated';
            $autoemail->subject = $monthlybackupDBs->backup_date;
            $autoemail->message = 'ID Master Database : '.$monthlybackupDBs->masterDB->database_name
                                    .'<br /> Period : '.$monthlybackupDBs->period
                                    .'<br /> User Backup :'.$monthlybackupDBs->user->username
                                    .'<br /> Backup Date :'.$monthlybackupDBs->backup_date
                                    .'<br /> Status :'.$monthlybackupDBs->masterstatus->status_name
                                    .'<br /> Remark :'.$monthlybackupDBs->remark
                                    .'<br /> Activated :'.$monthlybackupDBs->status_activated;
            $autoemail->tglinput = date('Y-m-d H:i:s');
            $autoemail->userinput = Sentry::getUser()->username;
            $autoemail->tglupdate = date('Y-m-d H:i:s');
            $autoemail->userupdate = Sentry::getUser()->username;
            $autoemail->status = 1;
            $autoemail->save();

            Notification::info('Database Monthly Backup has been changed.');
			return Redirect::route('listMonthlyBackupDBs');
		}
	}

	/**
     * Melakukan approval oleh DBA
     */
	public function approveDBA($monthlyBackupDBId)
	{
		$approveDBAs = MonthlyBackupDB::find($monthlyBackupDBId);
		$approveDBAs->approval_dba = 1;
		$approveDBAs->save();

		$daily_report = new DailyReport;
        $daily_report->backup_db_monthly_id = $approveDBAs->id;
        $daily_report->job = $approveDBAs->masterDB->database_name;
        $daily_report->description = $approveDBAs->remark;
        $daily_report->status_job_daily_report = $approveDBAs->id_master_status;
        $daily_report->target_finish = $approveDBAs->receiver_date;
        $daily_report->note = 'Approval :'.$approveDBAs->approval_dba.' - '.$approveDBAs->approval_itd_dev.' - '.$approveDBAs->approval_itd_head_dev;
        $daily_report->create_date = $approveDBAs->backup_date;
        $daily_report->user_created = Sentry::getUser()->id;
        $daily_report->save();

        $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_itd@pancaran-group.com';
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

		return Redirect::route('listMonthlyBackupDBs');
	}

	/**
     * Melakukan approval oleh Supervisor ITD
     */
	public function approveITDSPV($monthlyBackupDBId)
	{
		$approveITDSPVs = MonthlyBackupDB::find($monthlyBackupDBId);
		$approveITDSPVs->approval_itd_dev = 1;
		$approveITDSPVs->save();

		$daily_report = new DailyReport;
        $daily_report->backup_db_monthly_id = $approveITDSPVs->id;
        $daily_report->job = $approveITDSPVs->masterDB->database_name;
        $daily_report->description = $approveITDSPVs->remark;
        $daily_report->status_job_daily_report = $approveITDSPVs->id_master_status;
        $daily_report->target_finish = $approveITDSPVs->receiver_date;
        $daily_report->note = 'Approval :'.$approveITDSPVs->approval_dba.' - '.$approveITDSPVs->approval_itd_dev.' - '.$approveITDSPVs->approval_itd_head_dev;
        $daily_report->create_date = $approveITDSPVs->backup_date;
        $daily_report->user_created = Sentry::getUser()->id;
        $daily_report->save();

        $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_itd@pancaran-group.com';
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

		return Redirect::route('listMonthlyBackupDBs');
	}

	/**
     * Melakukan approval oleh Head ITD
     */
	public function approveITDHead($monthlyBackupDBId)
	{
		$approveITDHeads = MonthlyBackupDB::find($monthlyBackupDBId);
		$approveITDHeads->approval_itd_head_dev = 1;
		$approveITDHeads->status_activated = 1;
		$approveITDHeads->receiver_date = date('Y-m-d H:i:s');
		$approveITDHeads->user_updated = Sentry::getUser()->id;
		$approveITDHeads->updated_at = date('Y-m-d H:i:s');
		$approveITDHeads->save();

		$daily_report = new DailyReport;
        $daily_report->backup_db_monthly_id = $approveITDHeads->id;
        $daily_report->job = $approveITDHeads->masterDB->database_name;
        $daily_report->description = $approveITDHeads->remark;
        $daily_report->status_job_daily_report = $approveITDHeads->id_master_status;
        $daily_report->target_finish = $approveITDHeads->receiver_date;
        $daily_report->note = 'Approval :'.$approveITDHeads->approval_dba.' - '.$approveITDHeads->approval_itd_dev.' - '.$approveITDHeads->approval_itd_head_dev;
        $daily_report->create_date = $approveITDHeads->backup_date;
        $daily_report->user_created = Sentry::getUser()->id;
        $daily_report->save();

        $autoemails = new Autoemail;
            $autoemails->setConnection('mysqlemail');
            $autoemails->to = 'ou_itd@pancaran-group.com';
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

		return Redirect::route('listMonthlyBackupDBs');
	}

}