<?php

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'La\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/
Route::group(['as'         => config('laraadmin.adminRoute').'.',
              'namespace'  => 'La',
              'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {

    $adminPath = config('laraadmin.adminRoute');

    /* ================== Dashboard ================== */

    Route::get($adminPath, 'DashboardController@index');
    Route::get($adminPath.'/dashboard', 'DashboardController@index');

    /* ================== Users ================== */
    Route::resource($adminPath.'/users', 'UsersController');
    Route::get($adminPath.'/user_dt_ajax', 'UsersController@dtajax');

    /* ================== Uploads ================== */
    Route::resource($adminPath.'/uploads', 'UploadsController');
    Route::post($adminPath.'/upload_files', 'UploadsController@upload_files');
    Route::get($adminPath.'/uploaded_files', 'UploadsController@uploaded_files');
    Route::post($adminPath.'/uploads_update_caption', 'UploadsController@update_caption');
    Route::post($adminPath.'/uploads_update_filename', 'UploadsController@update_filename');
    Route::post($adminPath.'/uploads_update_public', 'UploadsController@update_public');
    Route::post($adminPath.'/uploads_delete_file', 'UploadsController@delete_file');

    /* ================== Roles ================== */
    Route::resource($adminPath.'/roles', 'RolesController');
    Route::get($adminPath.'/role_dt_ajax', 'RolesController@dtajax');
    Route::post($adminPath.'/save_module_role_permissions/{id}', 'RolesController@save_module_role_permissions');

    /* ================== Permissions ================== */
    Route::resource($adminPath.'/permissions', 'PermissionsController');
    Route::get($adminPath.'/permission_dt_ajax', 'PermissionsController@dtajax');
    Route::post($adminPath.'/save_permissions/{id}', 'PermissionsController@save_permissions');

    /* ================== Departments ================== */
    Route::resource($adminPath.'/departments', 'DepartmentsController');
    Route::get($adminPath.'/department_dt_ajax', 'DepartmentsController@dtajax');

    /* ================== Employees ================== */
    Route::resource($adminPath.'/employees', 'EmployeesController');
    Route::get($adminPath.'/employee_dt_ajax', 'EmployeesController@dtajax');
    Route::post($adminPath.'/change_password/{id}', 'EmployeesController@change_password');

    /* ================== Organizations ================== */
    Route::resource($adminPath.'/organizations', 'OrganizationsController');
    Route::get($adminPath.'/organization_dt_ajax', 'OrganizationsController@dtajax');

    /* ================== Backups ================== */
    Route::resource($adminPath.'/backups', 'BackupsController');
    Route::get($adminPath.'/backup_dt_ajax', 'BackupsController@dtajax');
    Route::post($adminPath.'/create_backup_ajax', 'BackupsController@create_backup_ajax');
    Route::get($adminPath.'/downloadBackup/{id}', 'BackupsController@downloadBackup');
});
