<?php

return array(
    'dashboard' => array(
        array(
            'title' => "Dashboard",
            'link' => URL::current(),
            'icon' => 'glyphicon-dashboard'
        )
    ),
    'login' => array(
        array(
            'title' => "Login",
            'link' => URL::route('getLogin'),
            'icon' => 'glyphicon-user'
        )
    ),
    'panel_setting' => array(
        array(
            'title' => "Setting Panel",
            'link' => URL::current(),
            'icon' => 'glyphicon-cog'
        )
    ),
    'panel_master' => array(
        array(
            'title' => "Master Panel",
            'link' => URL::current(),
            'icon' => 'glyphicon-hdd'
        )
    ),
    'panel_project' => array(
        array(
            'title' => "Project Panel",
            'link' => URL::current(),
            'icon' => 'glyphicon-tower'
        )
    ),
    'panel_design' => array(
        array(
            'title' => "Design Panel",
            'link' => URL::current(),
            'icon' => 'glyphicon-tint'
        )
    ),
    'panel_tasklist' => array(
        array(
            'title' => "Tasklist Panel",
            'link' => URL::current(),
            'icon' => 'glyphicon-credit-card'
        )
    ),
    'panel_database' => array(
        array(
            'title' => "Database Panel",
            'link' => URL::current(),
            'icon' => 'glyphicon-home'
        )
    ),
    'panel_report' => array(
        array(
            'title' => "Report Panel",
            'link' => URL::current(),
            'icon' => 'glyphicon-book'
        )
    ),
    'users' => array(
        array(
            'title' => "User",
            'link' => URL::route('listUsers'),
            'icon' => 'glyphicon-user'
        )
    ),
    'create_user' => array(
        array(
            'title' => "User",
            'link' => URL::route('listUsers'),
            'icon' => 'glyphicon-user'
        ), 
        array(
            'title' => "New User",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'groups' => array(
        array(
            'title' => "Group",
            'link' => URL::route('listGroups'),
            'icon' => 'glyphicon-list-alt'
        )
    ),
    'create_group' => array(
        array(
            'title' => "Group",
            'link' => URL::route('listGroups'),
            'icon' => 'glyphicon-list-alt'
        ),
        array(
            'title' => "New Group",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'permissions' => array(
       array(
            'title' => "Permission User",
            'link' => URL::route('listPermissions'),
            'icon' => 'glyphicon-ban-circle'
        )
    ),
    'create_permission' => array(
        array(
            'title' => "Permission User",
            'link' => URL::route('listPermissions'),
            'icon' => 'glyphicon-ban-circle'
        ),
        array(
            'title' => "New Permission",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'masterappss' => array(
        array(
            'title' => "Application Master",
            'link' => URL::route('listMasterAppss'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_masterapps' => array(
        array(
            'title' => "Application Master",
            'link' => URL::route('listMasterAppss'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Application Master",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'mastermoduls' => array(
        array(
            'title' => "Modul Master",
            'link' => URL::route('listMasterModuls'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_mastermodul' => array(
        array(
            'title' => "Modul Master",
            'link' => URL::route('listMasterModuls'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Modul Master",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'masterprojecttypes' => array(
        array(
            'title' => "Project Type Master",
            'link' => URL::route('listMasterProjectTypes'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_masterprojecttype' => array(
        array(
            'title' => "Project Type Master",
            'link' => URL::route('listMasterProjectTypes'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Project Type Master",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'mastertasktypes' => array(
        array(
            'title' => "Task Type Master",
            'link' => URL::route('listMasterTaskTypes'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_mastertasktype' => array(
        array(
            'title' => "Task Type Master",
            'link' => URL::route('listMasterTaskTypes'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Task Type Master",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'masterstatuss' => array(
        array(
            'title' => "Status Master",
            'link' => URL::route('listMasterStatuss'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_masterstatus' => array(
        array(
            'title' => "Status Master",
            'link' => URL::route('listMasterStatuss'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Status Master",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'masterDBs' => array(
        array(
            'title' => "Database Master",
            'link' => URL::route('listMasterDBs'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_masterDB' => array(
        array(
            'title' => "Database Master",
            'link' => URL::route('listMasterDBs'),
            'icon' => 'glyphicon-th'
        ),
        array(
            'title' => "New Database Master",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'projects' => array(
        array(
            'title' => "Application Project",
            'link' => URL::route('listProjects'),
            'icon' => 'glyphicon-th'
        )
    ),
    'detailprojects' => array(
        array(
            'title' => "Application Project Detail",
            'link' => URL::route('detailProjects'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_project' => array(
        array(
            'title' => "Application Project",
            'link' => URL::route('listProjects'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Application Project",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'assesments' => array(
        array(
            'title' => "Assesment",
            'link' => URL::route('listAssesments'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_assesment' => array(
        array(
            'title' => "Assesment",
            'link' => URL::route('listAssesments'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Assesment",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'uats' => array(
        array(
            'title' => "User Accept Test",
            'link' => URL::route('listUats'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_uat' => array(
        array(
            'title' => "User Accept Test",
            'link' => URL::route('listUats'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New User Accept Test",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'trainings' => array(
        array(
            'title' => "Training",
            'link' => URL::route('listTrainings'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_training' => array(
        array(
            'title' => "Training",
            'link' => URL::route('listTrainings'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Training",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'designs' => array(
        array(
            'title' => "Designs",
            'link' => URL::route('listDesigns'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_design' => array(
        array(
            'title' => "Designs",
            'link' => URL::route('listDesigns'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Design",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'designdetails' => array(
        array(
            'title' => "Detail Design",
            'link' => URL::route('listDesignDetails'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_design_detail' => array(
        array(
            'title' => "Detail Design",
            'link' => URL::route('listDesignDetails'),
            'icon' => 'glyphicon-th'
        ), 
        array(
            'title' => "New Detail Design",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'testings' => array(
        array(
            'title' => "Testing",
            'link' => URL::route('listTestings'),
            'icon' => 'glyphicon-tower'
        )
    ),
    'create_testing' => array(
        array(
            'title' => "Testing",
            'link' => URL::route('listTestings'),
            'icon' => 'glyphicon-tower'
        ), 
        array(
            'title' => "New Testing",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'tasks' => array(
        array(
            'title' => "Task Open",
            'link' => URL::route('listTasks'),
            'icon' => 'glyphicon-credit-card'
        )
    ),
    'taskcloses' => array(
        array(
            'title' => "Task Close",
            'link' => URL::route('listTaskCloses'),
            'icon' => 'glyphicon-credit-card'
        )
    ),
    'create_task' => array(
        array(
            'title' => "Tasklist",
            'link' => URL::route('listTasks'),
            'icon' => 'glyphicon-credit-card'
        ), 
        array(
            'title' => "New Tasklist",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'taskdetails' => array(
        array(
            'title' => "Detail Tasklist",
            'link' => URL::route('listTaskDetails'),
            'icon' => 'glyphicon-credit-card'
        )
    ),
    'create_task_detail' => array(
        array(
            'title' => "Detail Tasklist",
            'link' => URL::route('listTaskDetails'),
            'icon' => 'glyphicon-credit-card'
        ), 
        array(
            'title' => "New Detail Tasklist",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'dailyreports' => array(
        array(
            'title' => "Job Daily Report",
            'link' => URL::route('listDailyReports'),
            'icon' => 'glyphicon-shopping-cart'
        )
    ),
    'updateappss' => array(
        array(
            'title' => "Application Update",
            'link' => URL::route('listUpdateAppss'),
            'icon' => 'glyphicon-user'
        )
    ),
    'create_updateapps' => array(
        array(
            'title' => "Application Update",
            'link' => URL::route('listUpdateAppss'),
            'icon' => 'glyphicon-user'
        ), 
        array(
            'title' => "New Application Update",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'weeklymeetings' => array(
        array(
            'title' => "Weekly Meeting",
            'link' => URL::route('listWeeklyMeetings'),
            'icon' => 'glyphicon-user'
        )
    ),
    'create_weeklymeetings' => array(
        array(
            'title' => "Weekly Meeting",
            'link' => URL::route('listWeeklyMeetings'),
            'icon' => 'glyphicon-user'
        ), 
        array(
            'title' => "New Weekly Meeting",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'dailyBackupDBs' => array(
        array(
            'title' => "Database Daily Backup",
            'link' => URL::route('listDailyBackupDBs'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_dailyBackupDB' => array(
        array(
            'title' => "Database Daily Backup",
            'link' => URL::route('listDailyBackupDBs'),
            'icon' => 'glyphicon-th'
        ),
        array(
            'title' => "New Database Daily Backup",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'monthlyBackupDBs' => array(
        array(
            'title' => "Database Monthly Backup",
            'link' => URL::route('listMonthlyBackupDBs'),
            'icon' => 'glyphicon-th'
        )
    ),
    'create_monthlyBackupDB' => array(
        array(
            'title' => "Database Monthly Backup",
            'link' => URL::route('listMonthlyBackupDBs'),
            'icon' => 'glyphicon-th'
        ),
        array(
            'title' => "New Database Monthly Backup",
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'mailboxes' => array(
        array(
            'title' => "ITMS Mail",
            'link' => URL::route('listMailboxes'),
            'icon' => 'glyphicon-envelope'
        )
    ),
    'reportprojects' => array(
        array(
            'title' => "Project Report",
            'link' => URL::route('listReportProjects'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reportassesments' => array(
        array(
            'title' => "Assesment Report",
            'link' => URL::route('listReportAssesments'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reportdesigns' => array(
        array(
            'title' => "Design Report",
            'link' => URL::route('listReportDesigns'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reporttasklists' => array(
        array(
            'title' => "Tasklist Report",
            'link' => URL::route('listReportTasklists'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reportdailyreports' => array(
        array(
            'title' => "Daily-Report Report",
            'link' => URL::route('listReportDailyReports'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reportSITs' => array(
        array(
            'title' => "SIT Report",
            'link' => URL::route('listReportSits'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reportUATs' => array(
        array(
            'title' => "User Accept Test Report",
            'link' => URL::route('listReportUats'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reporttrainings' => array(
        array(
            'title' => "Training Report",
            'link' => URL::route('listReportTrainings'),
            'icon' => 'glyphicon-user'
        )
    ),
    'reportupdateappss' => array(
        array(
            'title' => "Application Update Report",
            'link' => URL::route('listReportUpdateAppss'),
            'icon' => 'glyphicon-user'
        )
    ),
);
