<?php

/**
 * Connect routes with ADMIN_PANEL permission(for security) and 'Dwij\Laraadmin\Controllers' namespace
 * and '/admin' url.
 */
Route::group([
    'namespace' => 'Dwij\Laraadmin\Controllers',
    'as' => config('laraadmin.adminRoute') . '.',
    'middleware' => ['web', 'auth', 'permission:ADMIN_PANEL', 'role:SUPER_ADMIN']
], function () {

    $adminPath = config('laraadmin.adminRoute');

    /* ================== Modules ================== */
    Route::resource($adminPath.'/modules', 'ModuleController');
    Route::resource($adminPath.'/module_fields', 'FieldController');
    Route::get($adminPath.'/module_generate_crud/{model_id}', 'ModuleController@generate_crud');
    Route::get($adminPath.'/module_generate_migr/{model_id}', 'ModuleController@generate_migr');
    Route::get($adminPath.'/module_generate_update/{model_id}', 'ModuleController@generate_update');
    Route::get($adminPath.'/module_generate_migr_crud/{model_id}', 'ModuleController@generate_migr_crud');
    Route::get($adminPath.'/modules/{model_id}/set_view_col/{column_name}', 'ModuleController@set_view_col');
    Route::post($adminPath.'/save_role_module_permissions/{id}', 'ModuleController@save_role_module_permissions');
    Route::get($adminPath.'/save_module_field_sort/{model_id}', 'ModuleController@save_module_field_sort');
    Route::post($adminPath.'/check_unique_val/{field_id}', 'FieldController@check_unique_val');
    Route::get($adminPath.'/module_fields/{id}/delete', 'FieldController@destroy');
    Route::post($adminPath.'/get_module_files/{module_id}', 'ModuleController@get_module_files');
    Route::post($adminPath.'/module_update', 'ModuleController@update');
    Route::post($adminPath.'/module_field_listing_show', 'FieldController@module_field_listing_show_ajax');
    
    /* ================== Code Editor ================== */
    Route::get($adminPath.'/lacodeeditor', function () use ($adminPath) {
        if(file_exists(resource_path("views/la/editor/index.blade.php"))) {
            return redirect($adminPath.'/laeditor');
        } else {
            // show install code editor page
            return View('la.editor.install');
        }
    });
    
    /* ================== Menu Editor ================== */
    Route::resource($adminPath.'/la_menus', 'MenuController');
    Route::post($adminPath.'/la_menus/update_hierarchy', 'MenuController@update_hierarchy');
    
    /* ================== Configuration ================== */
    Route::resource($adminPath.'/la_configs', '\App\Http\Controllers\La\LAConfigController');
    
    Route::group([
        'middleware' => 'role'
    ], function () use ($adminPath) {
        /*
        Route::get($adminPath.'/menu', [
            'as'   => 'menu',
            'uses' => 'LAController@index'
        ]);
        */
    });
});
