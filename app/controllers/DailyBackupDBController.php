<?php
use MrJuliuss\Syntara\Controllers\BaseController;

class DailyBackupDBController extends \BaseController {

	/**
	 * Mengambil Index Page Daily Backup Database
	 */
	public function getIndex()
	{
		// get alls Vendors
        $dailyBackupDBs = DailyBackupDB::orderBy('id', 'DESC')->get();
        
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
            $html = View::make(Config::get('adminlte::views.dailybackupDBs-list'), array('dailyBackupDBs' => $dailyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('adminlte::views.dailybackupDBs-index'), array('dailyBackupDBs' => $dailyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Database Daily Backup";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.dailyBackupDBs');
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
        $period = Input::get('dp3');
        $backupDate = Input::get('datepicker');
        $receiverDate = Input::get('datepicker2');
        
        if (empty($databaseMaster)) {
            $dailyBackupDBs = DailyBackupDB::orderBy('id', 'DESC')->get();

            if (empty($userBackup)) {
                $dailyBackupDBs = DailyBackupDB::orderBy('id', 'DESC')->get();

                if (empty($backupStatus)) {
                    $dailyBackupDBs = DailyBackupDB::orderBy('id', 'DESC')->get();

                        if (empty($period)) {
                            $dailyBackupDBs = DailyBackupDB::orderBy('id', 'DESC')->get();

                            if (empty($backupDate)) {
                            	$dailyBackupDBs = DailyBackupDB::orderBy('id', 'DESC')->get();

                            	if (empty($receiverDate)) {
									$dailyBackupDBs = DailyBackupDB::orderBy('id', 'DESC')->get();                            		
                            	} else {
                            		$dailyBackupDBs = DailyBackupDB::where('receiver_date', 'LIKE', '%'.$receiverDate.'%')
		                            ->orderBy('id')
		                            ->get();
                            	}
                            } else {
                            	$dailyBackupDBs = DailyBackupDB::where('backup_date', 'LIKE', '%'.$backupDate.'%')
	                            ->orderBy('id')
	                            ->get();
                            }
                        } else {
                             $dailyBackupDBs = DailyBackupDB::where('period', 'LIKE', '%'.$period.'%')
                            ->orderBy('id')
                            ->get();
                        }
                } else {
                    $dailyBackupDBs = DailyBackupDB::where('id_master_status', 'LIKE', '%'.$backupStatus.'%')
                            ->orderBy('id')
                            ->get();
                }
            } else {
                $dailyBackupDBs = DailyBackupDB::where('user_backup', 'LIKE', '%'.$userBackup.'%')
                            ->orderBy('id')
                            ->get();
            }
        } else {
            $dailyBackupDBs = DailyBackupDB::where('id_master_DB', 'LIKE', '%'.$databaseMaster.'%')
                            ->orderBy('id')
                            ->get();
        }
		
		$dailyBackupDBs = DailyBackupDB::where('status_activated', '=', $activated)
                            ->orderBy('id')
                            ->get();
        
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
            $html = View::make(Config::get('adminlte::views.dailybackupDBs-list'), array('dailyBackupDBs' => $dailyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss))->render();

            return Response::json(array('html' => $html));
        }

        $this->layout = View::make(Config::get('adminlte::views.dailybackupDBs-index'), array('dailyBackupDBs' => $dailyBackupDBs, 'masterDBs' => $masterDBs, 'users' => $users, 'masterstatuss' => $masterstatuss));
        $this->layout->title = "Database Daily Backup";
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.dailyBackupDBs');
    }

	/**
	 * Menampilkan form create daily backup database
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

		$this->layout = View::make(Config::get('adminlte::views.dailybackupDB-create'), array('masterDBs' => $masterDBs, 'masterstatuss' => $masterstatuss));
		$this->layout->title = "New Database Daily Backup";
		$this->layout->breadcrumb = Config::get('syntara::breadcrumbs.create_dailyBackupDB');
	}

	/**
	 * Melakukan proses create daily backup database
	 */
	public function postCreate()
	{
		$aturan = array(
			'id_master_DB' => 'required',
			'dp3' => 'required',
			'datepicker' => 'required',
			'id_master_status' => 'required',
			'remark' => 'required',
		);

		$validasi = Validator::make(Input::all(), $aturan);

		if($validasi->passes()) {
			$dailybackupDB = new DailyBackupDB;
			# Buatkan variabel tiap inputan
			$dailybackupDB->id_master_DB = Input::get('id_master_DB');
			$dailybackupDB->period = Input::get('dp3');
			$dailybackupDB->user_backup = Input::get('user_backup');
			$dailybackupDB->backup_date = Input::get('datepicker');
			$dailybackupDB->id_master_status = Input::get('id_master_status');
			$dailybackupDB->remark = Input::get('remark');
			$dailybackupDB->status_activated = Input::get('status_activated');
			$dailybackupDB->user_created = Input::get('user_created');
			$dailybackupDB->save();

			$daily_report = new DailyReport;
            $daily_report->backup_db_daily_id = $dailybackupDB->id;
            $daily_report->job = $dailybackupDB->masterDB->database_name;
            $daily_report->description = $dailybackupDB->remark;
            $daily_report->status_job_daily_report = $dailybackupDB->id_master_status;
            $daily_report->target_finish = $dailybackupDB->receiver_date;
            $daily_report->note = 'Approval :'.$dailybackupDB->approval_dba.' - '.$dailybackupDB->approval_itd_dev;
            $daily_report->create_date = $dailybackupDB->backup_date;
            $daily_report->user_created = Sentry::getUser()->id;
            $daily_report->save();
            
            Notification::success('New Database Daily Backup has been added.');
			return Redirect::route('listDailyBackupDBs');

		} else {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
		}
	}

	/**
	 * Menampilkan form edit daily backup database
	 */
	public function getShow($dailyBackupDBId)
	{
		try
		{
			$dailybackupDBs = DailyBackupDB::find($dailyBackupDBId);

			$masterDBs = array('' => '');
			foreach(MasterDB::where('status','=','1')->get() as $row)
				//$return .= "<option value='$row->id'>$row->nm_vendor</option>";
				$masterDBs[$row->id] = $row->database_name;

			$masterstatuss = array('' => '');
			foreach(MasterStatus::where('group','=','backupDB')->get() as $row)
				//$return .= "<option value='$row->id'>$row->nm_vendor</option>";
				$masterstatuss[$row->id] = $row->group.' - '.$row->status_name;

			$this->layout = View::make(Config::get('adminlte::views.dailybackupDB-edit'), array(
				'dailybackupDBs' => $dailybackupDBs,
				'masterDBs' => $masterDBs,
				'masterstatuss' => $masterstatuss,
			));

			$this->layout->title = $dailybackupDBs->masterDB->database_name;
			$this->layout->breadcrumb = array(
				array(
					'title' => "Database Daily Backup",
					'link' => URL::route('listDailyBackupDBs'),
					'icon' => 'glyphicon-th'
				),
				array(
					'title' => $dailybackupDBs->masterDB->database_name,
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
	 * Melakukan proses update daily backup DB ke database
	 */
	public function putShow($dailyBackupDBId)
	{
		$aturan = array(
			'id_master_DB' => 'required',
			'dp3' => 'required',
			'user_backup' => 'required',
			'datepicker' => 'required',
			'status' => 'required',
			'id_master_status' => 'required',
			'remark' => 'required',
		);

		$validasi = Validator::make(Input::all(), $aturan);

		if($validasi->fails()) {
			# Kembali kehalaman yang sama dengan pesan error
			return Redirect::back()->withErrors($validasi)->withInput();
			# Bila validasi sukses
		} else {
			$dailybackupDBs = DailyBackupDB::find($dailyBackupDBId);
			# Buatkan variabel tiap inputan
			$dailybackupDBs->id_master_DB = Input::get('id_master_DB');
			$dailybackupDBs->period = Input::get('dp3');
			$dailybackupDBs->user_backup = Input::get('user_backup');
			$dailybackupDBs->backup_date = Input::get('datepicker');
			$dailybackupDBs->receiver_date = Input::get('datepicker2');
			$dailybackupDBs->id_master_status = Input::get('id_master_status');
			$dailybackupDBs->remark = Input::get('remark');
			$dailybackupDBs->status_activated = Input::get('status');
			$dailybackupDBs->user_updated = Input::get('user_updated');
			$dailybackupDBs->save();

			$daily_report = new DailyReport;
            $daily_report->backup_db_daily_id = $dailybackupDBs->id;
            $daily_report->job = $dailybackupDBs->masterDB->database_name;
            $daily_report->description = $dailybackupDBs->remark;
            $daily_report->status_job_daily_report = $dailybackupDBs->id_master_status;
            $daily_report->target_finish = $dailybackupDBs->receiver_date;
            $daily_report->note = 'Approval : '.$dailybackupDBs->approval_dba.' - '.$dailybackupDBs->approval_itd_dev;
            $daily_report->create_date = $dailybackupDBs->backup_date;
            $daily_report->user_updated = Sentry::getUser()->id;
            $daily_report->save();
            
            Notification::info('Database Daily Backup has been changed.');
			return Redirect::route('listDailyBackupDBs');
		}
	}

	/**
	 * Melakukan proses approval oleh DBA
	 */
	public function approveDBA($dailyBackupDBId)
	{
		$approveDBAs = DailyBackupDB::find($dailyBackupDBId);
		$approveDBAs->approval_dba = 1;
		$approveDBAs->save();

		$daily_report = new DailyReport;
        $daily_report->backup_db_daily_id = $approveDBAs->id;
        $daily_report->job = $approveDBAs->masterDB->database_name;
        $daily_report->description = $approveDBAs->remark;
        $daily_report->status_job_daily_report = $approveDBAs->id_master_status;
        $daily_report->target_finish = $approveDBAs->receiver_date;
        $daily_report->note = 'Approval : '.$approveDBAs->approval_dba.' - '.$approveDBAs->approval_itd_dev;
        $daily_report->create_date = $approveDBAs->backup_date;
        $daily_report->user_updated = Sentry::getUser()->id;
        $daily_report->save();

		return Redirect::route('listDailyBackupDBs');
	}

	/**
	 * Melakukan proses approval oleh Supervisor ITD
	 */
	public function approveITDSPV($dailyBackupDBId)
	{
		$approveITDSPVs = DailyBackupDB::find($dailyBackupDBId);
		$approveITDSPVs->approval_itd_dev = 1;
		$approveITDSPVs->save();

		$daily_report = new DailyReport;
        $daily_report->backup_db_daily_id = $approveITDSPVs->id;
        $daily_report->job = $approveITDSPVs->masterDB->database_name;
        $daily_report->description = $approveITDSPVs->remark;
        $daily_report->status_job_daily_report = $approveITDSPVs->id_master_status;
        $daily_report->target_finish = $approveITDSPVs->receiver_date;
        $daily_report->note = 'Approval : '.$approveITDSPVs->approval_dba.' - '.$approveITDSPVs->approval_itd_dev;
        $daily_report->create_date = $approveITDSPVs->backup_date;
        $daily_report->user_updated = Sentry::getUser()->id;
        $daily_report->save();

		return Redirect::route('listDailyBackupDBs');
	}

}