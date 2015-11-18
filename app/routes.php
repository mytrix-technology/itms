<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Logged routes without permission
 */
Route::group(array('before' => 'basicAuth', 'prefix' => Config::get('config.config.uri')), function()
{
    // route untuk halaman dashboard
    Route::get('', array(
        'as' => 'indexDashboard',
        'uses' => 'DashboardController@getIndex')
    );

    // route untuk kirim quick email
    Route::post('email/new', array(
        'as' => 'newEmailPost',
        'uses' => 'DashboardController@postEmail')
    );

    // route untuk proses logout
    Route::get('logout', array(
        'as' => 'logout',
        'uses' => 'DashboardController@getLogout')
    );

    // route untuk hak akses yang salah
    Route::get('access-denied', array(
        'as' => 'accessDenied',
        'uses' => 'DashboardController@getAccessDenied')
    );
});

/**
 * Loggued routes with permissions
 */
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('config.config.uri')), function()
{
    /**
     * Panel routes
     */
    Route::get('panelsettings', array(
        'as' => 'listPanelSettings',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'PanelController@getPanelSetting')
    );
    
    Route::get('panelmasters', array(
        'as' => 'listPanelMasters',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'PanelController@getPanelMaster')
    );

    Route::get('panelprojects', array(
        'as' => 'listPanelProjects',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'PanelController@getPanelProject')
    );

    Route::get('paneldesigns', array(
        'as' => 'listPanelDesigns',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'PanelController@getPanelDesign')
    );

    Route::get('paneltasklists', array(
        'as' => 'listPanelTasklists',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'PanelController@getPanelTasklist')
    );

    Route::get('paneldatabases', array(
        'as' => 'listPanelDatabases',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'PanelController@getPanelDatabase')
    );

    Route::get('panelreports', array(
        'as' => 'listPanelReports',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'PanelController@getPanelReport')
    );

    /**
     * User routes
     */
    Route::get('users', array(
        'as' => 'listUsers',
        'uses' => 'UserController@getIndex')
    );

    // route untuk delete user
    Route::delete('user/{userId}', array(
        'as' => 'deleteUsers',
        'uses' => 'UserController@delete')
    );

    // route untuk proses create user
    Route::post('user/new', array(
        'as' => 'newUserPost',
        'uses' => 'UserController@postCreate')
    );

    // route untuk form create user
    Route::get('user/new', array(
        'as' => 'newUser',
        'uses' => 'UserController@getCreate')
    );

    // route untuk form edit user
    Route::get('user/{userId}', array(
        'as' => 'showUser',
        'uses' => 'UserController@getShow')
    );

    // route untuk proses update user
    Route::put('user/{userId}', array(
        'as' => 'putUser',
        'uses' => 'UserController@putShow')
    );

    // route untuk aktifasi user
    Route::put('user/{userId}/activate', array(
        'as' => 'putActivateUser',
        'uses' => 'UserController@putActivate')
    );

    /**
     * Group routes
     */
    Route::get('groups', array(
        'as' => 'listGroups',
        'uses' => 'GroupController@getIndex')
    );

    // route untuk proses create group baru
    Route::post('group/new', array(
        'as' => 'newGroupPost',
        'uses' => 'GroupController@postCreate')
    );
 
    // route untuk form create group
    Route::get('group/new', array(
        'as' => 'newGroup',
        'uses' => 'GroupController@getCreate')
    );

    // route untuk hapus group
    Route::delete('group/{groupId}', array(
        'as' => 'deleteGroup',
        'uses' => 'GroupController@delete')
    );

    // route untuk form edit group
    Route::get('group/{groupId}', array(
        'as' => 'showGroup',
        'uses' => 'GroupController@getShow')
    );

    // route untuk proses update group
    Route::put('group/{groupId}', array(
        'as' => 'putGroup',
        'uses' => 'GroupController@putShow')
    );

    // route untuk hapus user yang terdaftar di group
    Route::delete('group/{groupId}/user/{userId}', array(
        'as' => 'deleteUserGroup',
        'uses' => 'GroupController@deleteUserFromGroup')
    );

    // route untuk tambah user kedalam group
    Route::post('group/{groupId}/user/{userId}', array(
        'as' => 'addUserGroup',
        'uses' => 'GroupController@addUserInGroup')
    );

    /**
     * Permission routes
     */
    Route::get('permissions', array(
        'as' => 'listPermissions',
        'uses' => 'PermissionController@getIndex')
    );

    // route untuk hapus permission
    Route::delete('permission/{permissionId}',array(
        'as' => 'deletePermission',
        'uses' => 'PermissionController@delete')
    );

    // route untuk form create permission
    Route::get('permission/new', array(
        'as' => 'newPermission',
        'uses' => 'PermissionController@getCreate')
    );

    // route untuk proses create permission
    Route::post('permission/new', array(
        'as' => 'newPermissionPost',
        'uses' => 'PermissionController@postCreate')
    );

    // route untuk form edit permission
    Route::get('permission/{permissionId}', array(
        'as' => 'showPermission',
        'uses' => 'PermissionController@getShow')
    );

    // route untuk proses update permission
    Route::put('permission/{permissionId}', array(
        'as' => 'putPermission',
        'uses' => 'PermissionController@putShow')
    );
    
    /**
     * Master Aplikasi routes
     */
    Route::get('masterappss', array(
        'as' => 'listMasterAppss',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'MasterAppsController@getIndex')
    );
    
    // route untuk proses pencarian master aplikasi
    Route::post('masterappss', array(
        'as' => 'searchMasterAppss',
        //'before' => 'basicAuth|hasPermissions:newMasterApps',
        'uses' => 'MasterAppsController@postSearch')
    );
    
    // route untuk proses aktifasi master aplikasi
    Route::post('activeMasterApps/{masterappsId}', array(
        'as' => 'activeMasterApps',
        'uses' => 'MasterAppsController@active')
    );
    
    // route untuk proses non-aktifasi master aplikasi
    Route::post('nonactiveMasterApps/{masterappsId}', array(
        'as' => 'nonactiveMasterApps',
        'uses' => 'MasterAppsController@nonactive')
    );

    // route untuk form create master aplikasi
    Route::get('masterapps/new', array(
        'as' => 'newMasterApps',
        'uses' => 'MasterAppsController@getCreate')
    );

    // route untuk proses create master aplikasi
    Route::post('masterapps/new', array(
        'as' => 'newMasterAppsPost',
        'uses' => 'MasterAppsController@postCreate')
    );

    // route untuk proses hapus master aplikasi
    Route::delete('masterapps/{masterappsId}',array(
        'as' => 'deleteMasterApps',
        'uses' => 'MasterAppsController@delete')
    );

    // route untuk form edit master aplikasi
    Route::get('masterapps/{masterappsId}', array(
        'as' => 'showMasterApps',
        'uses' => 'MasterAppsController@getShow')
    );

    // route untuk proses update master aplikasi
    Route::put('masterapps/{masterappsId}', array(
        'as' => 'putMasterApps',
        'uses' => 'MasterAppsController@putShow')
    );
    
    /**
     * Master Modul routes
     */
    Route::get('mastermoduls', array(
        'as' => 'listMasterModuls',
        //'before' => 'basicAuth|hasPermissions:newMasterModul',
        'uses' => 'MasterModulController@getIndex')
    );
    
    // route untuk proses pencarian master modul
    Route::post('mastermoduls', array(
        'as' => 'searchMasterModuls',
        //'before' => 'basicAuth|hasPermissions:newMasterModul',
        'uses' => 'MasterModulController@postSearch')
    );

    // route untuk proses aktifasi master modul
    Route::post('activeMasterModul/{mastermodulId}', array(
        'as' => 'activeMasterModul',
        'uses' => 'MasterModulController@active')
    );
    
    // route untuk non-aktifasi master modul 
    Route::post('nonactiveMasterModul/{mastermodulId}', array(
        'as' => 'nonactiveMasterModul',
        'uses' => 'MasterModulController@nonactive')
    );

    // route untuk form create master modul 
    Route::get('mastermodul/new', array(
        'as' => 'newMasterModul',
        'uses' => 'MasterModulController@getCreate')
    );

    // route untuk proses create master modul
    Route::post('mastermodul/new', array(
        'as' => 'newMasterModulPost',
        'uses' => 'MasterModulController@postCreate')
    );

    // route untuk proses hapus master modul
    Route::post('mastermodul/{mastermodulId}',array(
        'as' => 'deleteMasterModul',
        'uses' => 'MasterModulController@delete')
    );

    // route untuk form edit master modul
    Route::get('mastermodul/{mastermodulId}', array(
        'as' => 'showMasterModul',
        'uses' => 'MasterModulController@getShow')
    );

    // route untuk proses update master modul
    Route::put('mastermodul/{mastermodulId}', array(
        'as' => 'putMasterModul',
        'uses' => 'MasterModulController@putShow')
    );
    
    /**
     * Master Project Type routes
     */
    Route::get('masterprojecttypes', array(
        'as' => 'listMasterProjectTypes',
        //'before' => 'basicAuth|hasPermissions:newMasterProjectType',
        'uses' => 'MasterProjectTypeController@getIndex')
    );
    
    Route::post('masterprojecttypes', array(
        'as' => 'searchMasterProjectTypes',
        //'before' => 'basicAuth|hasPermissions:newMasterProjectType',
        'uses' => 'MasterProjectTypeController@postSearch')
    );

    Route::post('activeMasterProjectType/{masterprojecttypeId}', array(
        'as' => 'activeMasterProjectType',
        'uses' => 'MasterProjectTypeController@active')
    );
    
    Route::post('nonactiveMasterProjectType/{masterprojecttypeId}', array(
        'as' => 'nonactiveMasterProjectType',
        'uses' => 'MasterProjectTypeController@nonactive')
    );

    Route::get('masterprojecttype/new', array(
        'as' => 'newMasterProjectType',
        'uses' => 'MasterProjectTypeController@getCreate')
    );

    Route::post('masterprojecttype/new', array(
        'as' => 'newMasterProjectTypePost',
        'uses' => 'MasterProjectTypeController@postCreate')
    );

    Route::delete('masterprojecttype/{masterprojecttypeId}',array(
        'as' => 'deleteMasterProjectType',
        'uses' => 'MasterProjectTypeController@delete')
    );

    Route::get('masterprojecttype/{masterprojecttypeId}', array(
        'as' => 'showMasterProjectType',
        'uses' => 'MasterProjectTypeController@getShow')
    );

    Route::put('masterprojecttype/{masterprojecttypeId}', array(
        'as' => 'putMasterProjectType',
        'uses' => 'MasterProjectTypeController@putShow')
    );
    
    /**
     * Master Task Type routes
     */
    Route::get('mastertasktypes', array(
        'as' => 'listMasterTaskTypes',
        //'before' => 'basicAuth|hasPermissions:newMasterTaskType',
        'uses' => 'MasterTaskTypeController@getIndex')
    );
    
    Route::post('mastertasktypes', array(
        'as' => 'searchMasterTaskTypes',
        //'before' => 'basicAuth|hasPermissions:newMasterTaskType',
        'uses' => 'MasterTaskTypeController@postSearch')
    );

    Route::post('activeMasterTaskType/{mastertasktypeId}', array(
        'as' => 'activeMasterTaskType',
        'uses' => 'MasterTaskTypeController@active')
    );
    
    Route::post('nonactiveMasterTaskType/{mastertasktypeId}', array(
        'as' => 'nonactiveMasterTaskType',
        'uses' => 'MasterTaskTypeController@nonactive')
    );

    Route::get('mastertasktype/new', array(
        'as' => 'newMasterTaskType',
        'uses' => 'MasterTaskTypeController@getCreate')
    );

    Route::post('mastertasktype/new', array(
        'as' => 'newMasterTaskTypePost',
        'uses' => 'MasterTaskTypeController@postCreate')
    );

    Route::delete('mastertasktype/{mastertasktypeId}',array(
        'as' => 'deleteMasterTaskType',
        'uses' => 'MasterTaskTypeController@delete')
    );

    Route::get('mastertasktype/{mastertasktypeId}', array(
        'as' => 'showMasterTaskType',
        'uses' => 'MasterTaskTypeController@getShow')
    );

    Route::put('mastertasktype/{mastertasktypeId}', array(
        'as' => 'putMasterTaskType',
        'uses' => 'MasterTaskTypeController@putShow')
    );
    
    /**
     * Master Status routes
     */
    Route::get('masterstatuss', array(
        'as' => 'listMasterStatuss',
        //'before' => 'basicAuth|hasPermissions:newMasterStatus',
        'uses' => 'MasterStatusController@getIndex')
    );
    
    Route::post('masterstatuss', array(
        'as' => 'searchMasterStatuss',
        //'before' => 'basicAuth|hasPermissions:newMasterStatus',
        'uses' => 'MasterStatusController@postSearch')
    );
    
    Route::post('activeMasterStatus/{masterstatusId}', array(
        'as' => 'activeMasterStatus',
        'uses' => 'MasterStatusController@active')
    );
    
    Route::post('nonactiveMasterStatus/{masterstatusId}', array(
        'as' => 'nonactiveMasterStatus',
        'uses' => 'MasterStatusController@nonactive')
    );

    Route::get('masterstatus/new', array(
        'as' => 'newMasterStatus',
        'uses' => 'MasterStatusController@getCreate')
    );

    Route::post('masterstatus/new', array(
        'as' => 'newMasterStatusPost',
        'uses' => 'MasterStatusController@postCreate')
    );

    Route::get('masterstatus/{masterstatusId}', array(
        'as' => 'showMasterStatus',
        'uses' => 'MasterStatusController@getShow')
    );

    Route::put('masterstatus/{masterstatusId}', array(
        'as' => 'putMasterStatus',
        'uses' => 'MasterStatusController@putShow')
    );

    /**
     * Master Database routes
     */
    Route::get('masterDBs', array(
            'as' => 'listMasterDBs',
            //'before' => 'basicAuth|hasPermissions:newMasterDB',
            'uses' => 'MasterDBController@getIndex')
    );
    
    Route::post('masterDBs', array(
            'as' => 'searchMasterDBs',
            //'before' => 'basicAuth|hasPermissions:newMasterDB',
            'uses' => 'MasterDBController@postSearch')
    );

    Route::post('activeMasterDB/{masterDBId}', array(
        'as' => 'activeMasterDB',
        'uses' => 'MasterDBController@active')
    );
    
    Route::post('nonactiveMasterDB/{masterDBId}', array(
        'as' => 'nonactiveMasterDB',
        'uses' => 'MasterDBController@nonactive')
    );

    Route::get('masterDB/new', array(
            'as' => 'newMasterDB',
            'uses' => 'MasterDBController@getCreate')
    );

    Route::post('masterDB/new', array(
            'as' => 'newMasterDBPost',
            'uses' => 'MasterDBController@postCreate')
    );

    Route::get('masterDB/{masterDBId}', array(
            'as' => 'showMasterDB',
            'uses' => 'MasterDBController@getShow')
    );

    Route::put('masterDB/{masterDBId}', array(
            'as' => 'putMasterDB',
            'uses' => 'MasterDBController@putShow')
    );
    
    /**
     * Project routes
     */
    Route::get('projects', array(
        'as' => 'listProjects',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'ProjectController@getIndex')
    );
    
    Route::post('projects', array(
        'as' => 'searchProjects',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'ProjectController@postSearch')
    );


    Route::get('dashprojects/{projectStatus}', array(
        'as' => 'dashProjects',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'ProjectController@getDashStatusProject')
    );
    
    Route::get('detailprojects/{projectId}', array(
        'as' => 'detailProjects',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'ProjectController@getDetail')
    );

    Route::get('downloadmanualbook/{projectId}', array(
        'as' => 'downloadManualBooks',
        'uses' => 'ProjectController@getDownloadManualBook')
    );

    Route::get('downloaddocproject/{projectId}', array(
        'as' => 'downloadDocProjects',
        'uses' => 'ProjectController@getDownloadDocProject')
    );

    Route::get('project/new', array(
        'as' => 'newProject',
        'uses' => 'ProjectController@getCreate')
    );

    Route::post('project/new', array(
        'as' => 'newProjectPost',
        'uses' => 'ProjectController@postCreate')
    );
    
    Route::delete('project/{projectId}',array(
        'as' => 'deleteProject',
        'uses' => 'ProjectController@delete')
    );

    Route::post('project/{projectId}',array(
            'as' => 'closeProject',
            'uses' => 'ProjectController@close')
    );

    Route::post('project/{projectId}',array(
            'as' => 'closeStatus',
            'uses' => 'ProjectController@closeStatus')
    );

    Route::post('project/{projectId}',array(
            'as' => 'openProject',
            'uses' => 'ProjectController@open')
    );

    Route::get('project/{projectId}', array(
        'as' => 'showProject',
        'uses' => 'ProjectController@getShow')
    );

    Route::put('project/{projectId}', array(
        'as' => 'putProject',
        'uses' => 'ProjectController@putShow')
    );
    
    /**
     * Assesment routes
     */
    Route::get('assesments', array(
        'as' => 'listAssesments',
        //'before' => 'basicAuth|hasPermissions:newAssesment',
        'uses' => 'AssesmentController@getIndex')
    );
    
    Route::post('assesments', array(
        'as' => 'searchAssesments',
        //'before' => 'basicAuth|hasPermissions:newAssesment',
        'uses' => 'AssesmentController@postSearch')
    );

    Route::get('downloadassesmentfile/{projectId}', array(
        'as' => 'downloadAssesmentFiles',
        'uses' => 'AssesmentController@getDownloadAssesmentFile')
    );

    Route::get('timelineassesment/{taskId}',array(
            'as' => 'timelineAssesments',
            'uses' => 'AssesmentController@getTimeline')
    );

    Route::get('assesment/new', array(
        'as' => 'newAssesment',
        'uses' => 'AssesmentController@getCreate')
    );

    Route::post('assesment/new', array(
        'as' => 'newAssesmentPost',
        'uses' => 'AssesmentController@postCreate')
    );

    Route::delete('assesment/{assesmentId}',array(
        'as' => 'deleteAssesment',
        'uses' => 'AssesmentController@delete')
    );

    Route::get('assesment/{projectId}', array(
        'as' => 'showAssesment',
        'uses' => 'AssesmentController@getShow')
    );

    Route::put('assesment/{projectId}', array(
        'as' => 'putAssesment',
        'uses' => 'AssesmentController@putShow')
    );

    /**
     * Design routes
     */
    Route::get('designs', array(
        'as' => 'listDesigns',
        //'before' => 'basicAuth|hasPermissions:newDesign',
        'uses' => 'DesignController@getIndex')
    );
    
    Route::post('designs', array(
        'as' => 'searchDesigns',
        //'before' => 'basicAuth|hasPermissions:newDesign',
        'uses' => 'DesignController@postSearch')
    );

    Route::get('design/new', array(
        'as' => 'newDesign',
        'uses' => 'DesignController@getCreate')
    );

    Route::post('design/new', array(
        'as' => 'newDesignPost',
        'uses' => 'DesignController@postCreate')
    );

    Route::delete('design/{designId}',array(
        'as' => 'deleteDesign',
        'uses' => 'DesignController@delete')
    );

    Route::get('design/{designId}', array(
        'as' => 'showDesign',
        'uses' => 'DesignController@getShow')
    );

    Route::put('design/{designId}', array(
        'as' => 'putDesign',
        'uses' => 'DesignController@putShow')
    );

    Route::get('downloadtable/{designId}', array(
        'as' => 'downloadTables',
        'uses' => 'DesignController@getDownloadTable')
    );

    Route::get('downloadform/{designId}', array(
        'as' => 'downloadForms',
        'uses' => 'DesignController@getDownloadForm')
    );
    
    /**
     * Design Detail routes
     */
    Route::get('designdetails', array(
        'as' => 'listDesignDetails',
        //'before' => 'basicAuth|hasPermissions:newDesignDetail',
        'uses' => 'DesignController@getDetail')
    );

    Route::get('designdetail/new', array(
        'as' => 'newDesignDetail',
        'uses' => 'DesignController@getCreateDetail')
    );

    Route::post('designdetail/new', array(
        'as' => 'newDesignDetailPost',
        'uses' => 'DesignController@postCreateDetail')
    );

    Route::delete('designdetail/{designdetailId}',array(
        'as' => 'deleteDesignDetail',
        'uses' => 'DesignController@deleteDetail')
    );

    Route::get('designdetail/{designdetailId}', array(
        'as' => 'showDesignDetail',
        'uses' => 'DesignController@getShowDetail')
    );

    Route::put('designdetail/{designdetailId}', array(
        'as' => 'putDesignDetail',
        'uses' => 'DesignController@putShowDetail')
    );
    
    /**
     * Tasklist routes
     */
    Route::get('tasks', array(
        'as' => 'listTasks',
        //'before' => 'basicAuth|hasPermissions:newRuteHarga',
        'uses' => 'TaskListController@getIndex')
    );
    
    Route::post('tasks', array(
        'as' => 'searchTasks',
        //'before' => 'basicAuth|hasPermissions:newRuteHarga',
        'uses' => 'TaskListController@postSearch')
    );

    Route::get('dashtasks/{taskStatus}', array(
        'as' => 'dashTasks',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'TaskListController@getDashStatusTasklist')
    );

    Route::post('detailtask/{taskId}',array(
            'as' => 'detailTasks',
            'uses' => 'TaskListController@postDetail')
    );

    Route::get('timelinetask/{taskId}',array(
            'as' => 'timelineTasks',
            'uses' => 'TaskListController@getTimeline')
    );

    Route::get('downloadtask/{taskId}', array(
        'as' => 'downloadTasks',
        'uses' => 'TasklistController@getDownload')
    );

    Route::delete('task/{taskId}',array(
        'as' => 'deleteTask',
        'uses' => 'TaskListController@delete')
    );

    Route::get('task/new', array(
        'as' => 'newTask',
        'uses' => 'TaskListController@getCreate')
    );

    Route::post('task/new', array(
        'as' => 'newTaskPost',
        'uses' => 'TaskListController@postCreate')
    );

    Route::get('task/{taskId}', array(
        'as' => 'showTask',
        'uses' => 'TasklistController@getShow')
    );

    Route::put('task/{taskId}', array(
        'as' => 'putTask',
        'uses' => 'TaskListController@putShow')
    );

    Route::get('taskcloses', array(
        'as' => 'listTaskCloses',
        'uses' => 'TaskListController@getIndexClose')
    );
    
    Route::post('taskcloses', array(
        'as' => 'searchTaskCloses',
        'uses' => 'TaskListController@postSearchClose')
    );
    
    /**
     * Tasklist Detail routes
     */
    Route::get('taskdetails', array(
        'as' => 'listTaskDetails',
        //'before' => 'basicAuth|hasPermissions:newRuteHarga',
        'uses' => 'TaskListController@getDetail')
    );

    Route::delete('taskdetail/{taskdetailId}',array(
        'as' => 'deleteTaskDetail',
        'uses' => 'TaskListController@deleteDetail')
    );

    Route::get('taskdetail/new', array(
        'as' => 'newTaskDetail',
        'uses' => 'TaskListController@getCreateDetail')
    );

    Route::post('taskdetail/new', array(
        'as' => 'newTaskDetailPost',
        'uses' => 'TaskListController@postCreateDetail')
    );

    Route::get('taskdetail/{taskdetailId}', array(
        'as' => 'showTaskDetail',
        'uses' => 'TaskliskController@getShowDetail')
    );

    Route::put('taskdetail/{taskdetailId}', array(
        'as' => 'putTaskDetail',
        'uses' => 'TaskListController@putShowDetail')
    );

    /**
     * Testing routes
     */
    Route::get('testings', array(
        'as' => 'listTestings',
        //'before' => 'basicAuth|hasPermissions:newArmada',
        'uses' => 'TestingController@getIndex')
    );
    
    Route::post('testings', array(
        'as' => 'searchTestings',
        //'before' => 'basicAuth|hasPermissions:newArmada',
        'uses' => 'TestingController@postSearch')
    );

    Route::delete('testing/{testingId}',array(
        'as' => 'deleteTesting',
        'uses' => 'TestingController@delete')
    );

    Route::get('testing/new', array(
        'as' => 'newTesting',
        'uses' => 'TestingController@getCreate')
    );

    Route::post('testing/new', array(
        'as' => 'newTestingPost',
        'uses' => 'TestingController@postCreate')
    );

    Route::get('testing/{designId}', array(
        'as' => 'showTesting',
        'uses' => 'TestingController@getShow')
    );

    Route::put('testing/{designId}', array(
        'as' => 'putTesting',
        'uses' => 'TestingController@putShow')
    );
    
    /**
     * UAT routes
     */
    Route::get('uats', array(
        'as' => 'listUats',
        //'before' => 'basicAuth|hasPermissions:newRuteHarga',
        'uses' => 'UatController@getIndex')
    );
    
    Route::post('uats', array(
        'as' => 'searchUats',
        //'before' => 'basicAuth|hasPermissions:newRuteHarga',
        'uses' => 'UatController@postSearch')
    );

    Route::get('downloaduatfile/{uatId}', array(
        'as' => 'downloadUatFiles',
        'uses' => 'UatController@getDownloadUatFile')
    );

    Route::delete('uat/{uatId}',array(
        'as' => 'deleteUat',
        'uses' => 'UatController@delete')
    );

    Route::get('uat/new', array(
        'as' => 'newUat',
        'uses' => 'UatController@getCreate')
    );

    Route::post('uat/new', array(
        'as' => 'newUatPost',
        'uses' => 'UatController@postCreate')
    );

    Route::get('uat/{uatId}', array(
        'as' => 'showUat',
        'uses' => 'UatController@getShow')
    );

    Route::put('uat/{uatId}', array(
        'as' => 'putUat',
        'uses' => 'UatController@putShow')
    );
    
    /**
     * Training routes
     */
    Route::get('trainings', array(
        'as' => 'listTrainings',
        //'before' => 'basicAuth|hasPermissions:newRuteHarga',
        'uses' => 'TrainingController@getIndex')
    );
    
    Route::post('trainings', array(
        'as' => 'searchTrainings',
        //'before' => 'basicAuth|hasPermissions:newRuteHarga',
        'uses' => 'TrainingController@postSearch')
    );

    Route::get('downloadtrainingfile/{projectId}', array(
        'as' => 'downloadTrainingFiles',
        'uses' => 'TrainingController@getDownloadTrainingFile')
    );

    Route::delete('training/{trainingId}',array(
        'as' => 'deleteTraining',
        'uses' => 'TrainingController@delete')
    );

    Route::get('training/new', array(
        'as' => 'newTraining',
        'uses' => 'TrainingController@getCreate')
    );

    Route::post('training/new', array(
        'as' => 'newTrainingPost',
        'uses' => 'TrainingController@postCreate')
    );

    Route::get('training/{trainingId}', array(
        'as' => 'showTraining',
        'uses' => 'TrainingController@getShow')
    );

    Route::put('training/{trainingId}', array(
        'as' => 'putTraining',
        'uses' => 'TrainingController@putShow')
    );
    
    /**
     * Daily Report routes
     */
    Route::get('dailyreports', array(
        'as' => 'listDailyReports',
        //'before' => 'basicAuth|hasPermissions:newOrder',
        'uses' => 'DailyReportController@getIndex')
    );
    
    Route::post('dailyreports', array(
        'as' => 'searchDailyReports',
        //'before' => 'basicAuth|hasPermissions:newOrder',
        'uses' => 'DailyReportController@postSearch')
    );

    Route::get('dailyreport/{dailyreportId}', array(
        'as' => 'showDailyReport',
        'uses' => 'DailyReportController@getShow')
    );

    Route::put('dailyreport/{dailyreportId}', array(
        'as' => 'putDailyReport',
        'uses' => 'DailyReportController@putShow')
    );
    
    /**
     * Update Apps routes
     */
    Route::get('updateappss', array(
        'as' => 'listUpdateAppss',
        'uses' => 'UpdateAppsController@getIndex')
    );
    
    Route::post('updateappss', array(
        'as' => 'searchUpdateAppss',
        'uses' => 'UpdateAppsController@postSearch')
    );

    Route::post('approveupdateapps/{updateappsId}',array(
        'as' => 'approveUpdateApps',
        'uses' => 'UpdateAppsController@approve')
    );

    Route::delete('rejectupdateapps/{updateappsId}',array(
            'as' => 'rejectUpdateApps',
            'uses' => 'UpdateAppsController@reject')
    );

    Route::get('downloadmanualbook/{updateappsId}', array(
        'as' => 'downloadManualBooks',
        'uses' => 'UpdateAppsController@getDownloadManualBook')
    );

    Route::get('updateapps/new', array(
        'as' => 'newUpdateApps',
        'uses' => 'UpdateAppsController@getCreate')
    );

    Route::post('updateapps/new', array(
        'as' => 'newUpdateAppsPost',
        'uses' => 'UpdateAppsController@postCreate')
    );

    Route::get('updateapps/{updateappsId}', array(
        'as' => 'showUpdateApps',
        'uses' => 'UpdateAppsController@getShow')
    );

    Route::put('updateapps/{updateappsId}', array(
        'as' => 'putUpdateApps',
        'uses' => 'UpdateAppsController@putShow')
    );
    
    /**
     * Weekly Meeting routes
     */
    Route::get('weeklymeetings', array(
        'as' => 'listWeeklyMeetings',
        //'before' => 'basicAuth|hasPermissions:newCustomer',
        'uses' => 'WeeklyMeetingController@getIndex')
    );
    
    Route::post('weeklymeetings', array(
        'as' => 'searchWeeklyMeetings',
        //'before' => 'basicAuth|hasPermissions:newCustomer',
        'uses' => 'WeeklyMeetingController@postSearch')
    );

    Route::get('downloadweeklymeetingfile/{weeklymeetingId}', array(
        'as' => 'downloadWeeklyMeetingFiles',
        'uses' => 'WeeklyMeetingController@getDownloadWeeklyMeetingFile')
    );

    Route::get('weeklymeeting/new', array(
        'as' => 'newWeeklyMeeting',
        'uses' => 'WeeklyMeetingController@getCreate')
    );

    Route::post('weeklymeeting/new', array(
        'as' => 'newWeeklyMeetingPost',
        'uses' => 'WeeklyMeetingController@postCreate')
    );

    Route::get('weeklymeeting/{weeklymeetingId}', array(
        'as' => 'showWeeklyMeeting',
        'uses' => 'WeeklyMeetingController@getShow')
    );

    Route::put('weeklymeeting/{weeklymeetingId}', array(
        'as' => 'putWeeklyMeeting',
        'uses' => 'WeeklyMeetingController@putShow')
    );

    /**
     * Daily Backup Database routes
     */
    Route::get('dailyBackupDBs', array(
            'as' => 'listDailyBackupDBs',
            //'before' => 'basicAuth|hasPermissions:newCustomer',
            'uses' => 'DailyBackupDBController@getIndex')
    );
    
    Route::post('dailyBackupDBs', array(
            'as' => 'searchDailyBackupDBs',
            //'before' => 'basicAuth|hasPermissions:newCustomer',
            'uses' => 'DailyBackupDBController@postSearch')
    );

    Route::post('approveDBADailyBackupDB/{dailyBackupDBId}',array(
            'as' => 'approveDBADailyBackupDB',
            'uses' => 'DailyBackupDBController@approveDBA')
    );

    Route::post('approveITDSPVDailyBackupDB/{dailyBackupDBId}',array(
            'as' => 'approveITDSPVDailyBackupDB',
            'uses' => 'DailyBackupDBController@approveITDSPV')
    );

    Route::get('dailyBackupDB/new', array(
            'as' => 'newDailyBackupDB',
            'uses' => 'DailyBackupDBController@getCreate')
    );

    Route::post('dailyBackupDB/new', array(
            'as' => 'newDailyBackupDBPost',
            'uses' => 'DailyBackupDBController@postCreate')
    );

    Route::get('dailyBackupDB/{dailyBackupDBId}', array(
            'as' => 'showDailyBackupDB',
            'uses' => 'DailyBackupDBController@getShow')
    );

    Route::put('dailyBackupDB/{dailyBackupDBId}', array(
            'as' => 'putDailyBackupDB',
            'uses' => 'DailyBackupDBController@putShow')
    );

    /**
     * Monthly Backup Database routes
     */
    Route::get('monthlyBackupDBs', array(
            'as' => 'listMonthlyBackupDBs',
            //'before' => 'basicAuth|hasPermissions:newCustomer',
            'uses' => 'MonthlyBackupDBController@getIndex')
    );
    
    Route::post('monthlyBackupDBs', array(
            'as' => 'searchMonthlyBackupDBs',
            //'before' => 'basicAuth|hasPermissions:newCustomer',
            'uses' => 'MonthlyBackupDBController@postSearch')
    );

    Route::post('approveDBAmonthlyBackupDB/{monthlyBackupDBId}',array(
            'as' => 'approveDBAMonthlyBackupDB',
            'uses' => 'MonthlyBackupDBController@approveDBA')
    );

    Route::post('approveITDSPVmonthlyBackupDB/{monthlyBackupDBId}',array(
            'as' => 'approveITDSPVMonthlyBackupDB',
            'uses' => 'MonthlyBackupDBController@approveITDSPV')
    );

    Route::post('approveITDHeadmonthlyBackupDB/{monthlyBackupDBId}',array(
            'as' => 'approveITDHeadMonthlyBackupDB',
            'uses' => 'MonthlyBackupDBController@approveITDHead')
    );

    Route::get('monthlyBackupDB/new', array(
            'as' => 'newMonthlyBackupDB',
            'uses' => 'MonthlyBackupDBController@getCreate')
    );

    Route::post('monthlyBackupDB/new', array(
            'as' => 'newMonthlyBackupDBPost',
            'uses' => 'MonthlyBackupDBController@postCreate')
    );

    Route::get('monthlyBackupDB/{monthlyBackupDBId}', array(
            'as' => 'showMonthlyBackupDB',
            'uses' => 'MonthlyBackupDBController@getShow')
    );

    Route::put('monthlyBackupDB/{monthlyBackupDBId}', array(
            'as' => 'putMonthlyBackupDB',
            'uses' => 'MonthlyBackupDBController@putShow')
    );

    /**
     * Mailbox routes
     */
    Route::get('mailboxes', array(
            'as' => 'listMailboxes',
            //'before' => 'basicAuth|hasPermissions:newCustomer',
            'uses' => 'MailboxController@getIndex')
    );
    
    /**
     * Report routes
     */
    Route::get('reportprojects', array(
        'as' => 'listReportProjects',
        'uses' => 'ReportController@getReportProject')
    );
    
    Route::post('searchprojects',array(
        'as' => 'searchReportProjects',
        'uses' => 'ReportController@postSearchProject')
    );

    

    Route::get('reportassesments', array(
        'as' => 'listReportAssesments',
        'uses' => 'ReportController@getReportAssesment')
    );
    
    Route::post('searchassesments',array(
        'as' => 'searchReportAssesments',
        'uses' => 'ReportController@postSearchAssesment')
    );
    
    Route::get('reportdesigns', array(
        'as' => 'listReportDesigns',
        'uses' => 'ReportController@getReportDesign')
    );
    
    Route::post('searchdesigns',array(
        'as' => 'searchReportDesigns',
        'uses' => 'ReportController@postSearchDesign')
    );
    
    Route::get('reporttasklists', array(
        'as' => 'listReportTasklists',
        'uses' => 'ReportController@getReportTasklist')
    );
    
    Route::post('searchtasklists',array(
        'as' => 'searchReportTasklists',
        'uses' => 'ReportController@postSearchTasklist')
    );

    
    
    Route::get('reportdailyreports', array(
        'as' => 'listReportDailyReports',
        'uses' => 'ReportController@getReportDailyReport')
    );
    
    Route::post('searchdailyreports',array(
        'as' => 'searchReportDailyReports',
        'uses' => 'ReportController@postSearchDailyReport')
    );

    Route::get('exportpdf', array(
        'as' => 'exportPDFDailyReports',
        'uses' => 'ReportController@getExportPDFDailyReport')
    );
    
    Route::get('reportsits', array(
        'as' => 'listReportSits',
        'uses' => 'ReportController@getReportSit')
    );
    
    Route::post('searchsits',array(
        'as' => 'searchReportSITs',
        'uses' => 'ReportController@postSearchSIT')
    );
    
    Route::get('reportuats', array(
        'as' => 'listReportUats',
        'uses' => 'ReportController@getReportUat')
    );
    
    Route::post('searchuats',array(
        'as' => 'searchReportUATs',
        'uses' => 'ReportController@postSearchUAT')
    );
    
    Route::get('reporttrainings', array(
        'as' => 'listReportTrainings',
        'uses' => 'ReportController@getReportTraining')
    );
    
    Route::post('searchtrainings',array(
        'as' => 'searchReportTrainings',
        'uses' => 'ReportController@postSearchTraining')
    );
    
    Route::get('reportupdateappss', array(
        'as' => 'listReportUpdateAppss',
        'uses' => 'ReportController@getReportUpdateApps')
    );
    
    Route::post('searchupdateappss',array(
        'as' => 'searchReportUpdateAppss',
        'uses' => 'ReportController@postSearchUpdateApps')
    );

    Route::get('projects/exportProject', array(
        'as' => 'exportProject',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'ProjectController@getExportProject')
    );

    
    
    
});

/**
 * Unlogged routes
 */
Route::group(array('before' => 'notAuth', 'prefix' => Config::get('config.config.uri')), function()
{
    Route::get('/teskoneksi', function(){
       // utk mengetes koneksi database jalan apa tdk
       if(DB::connection()->getDatabaseName())
       {
          echo "connected sucessfully to database ".DB::connection()->getDatabaseName();
       }
       $siswa = TaskList::all();
       
    });

    Route::post('projects/showdata', array(
        'as' => 'showdataexport',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'ProjectController@showData')
    );

    Route::post('projects/importProject', array(
        'as' => 'importProject',
        //'before' => 'basicAuth|hasPermissions:newProject',
        'uses' => 'ProjectController@getimportProject')
    );

    Route::get('report/autoemailproject', array(
        'as' => 'autoemailReportProjects',
        'uses' => 'ReportController@autoemailProject')
    );

    Route::get('report/autoemailtasklist', array(
        'as' => 'autoemailReportTasklists',
        'uses' => 'ReportController@autoemailTasklist')
    );

    Route::get('login', array(
        'as' => 'getLogin',
        'uses' => 'DashboardController@getLogin')
    );

    Route::post('login', array(
        'as' => 'postLogin',
        'uses' => 'DashboardController@postLogin')
    );
});

Route::group(array('prefix' => Config::get('config.config.uri')), function()
{
    /**
     * Activate a user (with view)
     */
    Route::get('user/activation/{activationCode}', array(
        'as' => 'getActivate',
        'uses' => 'UserController@getActivate')
    );
});
