<?php

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/
Route::group(['as'         => config('laraadmin.adminRoute').'.',
              'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {

    $adminPath = config('laraadmin.adminRoute');

    /* ================== Dashboard ================== */

    Route::get($adminPath, 'LA\DashboardController@index');
    Route::get($adminPath.'/dashboard', 'LA\DashboardController@index');

    /* ================== Users ================== */
    Route::resource($adminPath.'/users', 'LA\UsersController');
    Route::get($adminPath.'/user_dt_ajax', 'LA\UsersController@dtajax');

    /* ================== Uploads ================== */
    Route::resource($adminPath.'/uploads', 'LA\UploadsController');
    Route::post($adminPath.'/upload_files', 'LA\UploadsController@upload_files');
    Route::get($adminPath.'/uploaded_files', 'LA\UploadsController@uploaded_files');
    Route::post($adminPath.'/uploads_update_caption', 'LA\UploadsController@update_caption');
    Route::post($adminPath.'/uploads_update_filename', 'LA\UploadsController@update_filename');
    Route::post($adminPath.'/uploads_update_public', 'LA\UploadsController@update_public');
    Route::post($adminPath.'/uploads_delete_file', 'LA\UploadsController@delete_file');

    /* ================== Roles ================== */
    Route::resource($adminPath.'/roles', 'LA\RolesController');
    Route::get($adminPath.'/role_dt_ajax', 'LA\RolesController@dtajax');
    Route::post($adminPath.'/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');

    /* ================== Permissions ================== */
    Route::resource($adminPath.'/permissions', 'LA\PermissionsController');
    Route::get($adminPath.'/permission_dt_ajax', 'LA\PermissionsController@dtajax');
    Route::post($adminPath.'/save_permissions/{id}', 'LA\PermissionsController@save_permissions');

    /* ================== Departments ================== */
    Route::resource($adminPath.'/departments', 'LA\DepartmentsController');
    Route::get($adminPath.'/department_dt_ajax', 'LA\DepartmentsController@dtajax');

    /* ================== Employees ================== */
    Route::resource($adminPath.'/employees', 'LA\EmployeesController');
    Route::get($adminPath.'/employee_dt_ajax', 'LA\EmployeesController@dtajax');
    Route::post($adminPath.'/change_password/{id}', 'LA\EmployeesController@change_password');

    /* ================== Organizations ================== */
    Route::resource($adminPath.'/organizations', 'LA\OrganizationsController');
    Route::get($adminPath.'/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

    /* ================== Backups ================== */
    Route::resource($adminPath.'/backups', 'LA\BackupsController');
    Route::get($adminPath.'/backup_dt_ajax', 'LA\BackupsController@dtajax');
    Route::post($adminPath.'/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
    Route::get($adminPath.'/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');
});
