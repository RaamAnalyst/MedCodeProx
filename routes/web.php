<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Crm Status
    Route::delete('crm-statuses/destroy', 'CrmStatusController@massDestroy')->name('crm-statuses.massDestroy');
    Route::resource('crm-statuses', 'CrmStatusController');

    // Crm Customer
    Route::delete('crm-customers/destroy', 'CrmCustomerController@massDestroy')->name('crm-customers.massDestroy');
    Route::resource('crm-customers', 'CrmCustomerController');

    // Crm Note
    Route::delete('crm-notes/destroy', 'CrmNoteController@massDestroy')->name('crm-notes.massDestroy');
    Route::resource('crm-notes', 'CrmNoteController');

    // Crm Document
    Route::delete('crm-documents/destroy', 'CrmDocumentController@massDestroy')->name('crm-documents.massDestroy');
    Route::post('crm-documents/media', 'CrmDocumentController@storeMedia')->name('crm-documents.storeMedia');
    Route::post('crm-documents/ckmedia', 'CrmDocumentController@storeCKEditorImages')->name('crm-documents.storeCKEditorImages');
    Route::resource('crm-documents', 'CrmDocumentController');

    // Icd Cm Codes
    Route::delete('icd-cm-codes/destroy', 'IcdCmCodesController@massDestroy')->name('icd-cm-codes.massDestroy');
    Route::post('icd-cm-codes/parse-csv-import', 'IcdCmCodesController@parseCsvImport')->name('icd-cm-codes.parseCsvImport');
    Route::post('icd-cm-codes/process-csv-import', 'IcdCmCodesController@processCsvImport')->name('icd-cm-codes.processCsvImport');
    Route::resource('icd-cm-codes', 'IcdCmCodesController');

    // Icd Order
    Route::delete('icd-orders/destroy', 'IcdOrderController@massDestroy')->name('icd-orders.massDestroy');
    Route::post('icd-orders/media', 'IcdOrderController@storeMedia')->name('icd-orders.storeMedia');
    Route::post('icd-orders/ckmedia', 'IcdOrderController@storeCKEditorImages')->name('icd-orders.storeCKEditorImages');
    Route::post('icd-orders/parse-csv-import', 'IcdOrderController@parseCsvImport')->name('icd-orders.parseCsvImport');
    Route::post('icd-orders/process-csv-import', 'IcdOrderController@processCsvImport')->name('icd-orders.processCsvImport');
    Route::resource('icd-orders', 'IcdOrderController');

    // Icd Pcs Codes
    Route::delete('icd-pcs-codes/destroy', 'IcdPcsCodesController@massDestroy')->name('icd-pcs-codes.massDestroy');
    Route::post('icd-pcs-codes/parse-csv-import', 'IcdPcsCodesController@parseCsvImport')->name('icd-pcs-codes.parseCsvImport');
    Route::post('icd-pcs-codes/process-csv-import', 'IcdPcsCodesController@processCsvImport')->name('icd-pcs-codes.processCsvImport');
    Route::resource('icd-pcs-codes', 'IcdPcsCodesController');

    // Icd Pcs Order
    Route::delete('icd-pcs-orders/destroy', 'IcdPcsOrderController@massDestroy')->name('icd-pcs-orders.massDestroy');
    Route::post('icd-pcs-orders/parse-csv-import', 'IcdPcsOrderController@parseCsvImport')->name('icd-pcs-orders.parseCsvImport');
    Route::post('icd-pcs-orders/process-csv-import', 'IcdPcsOrderController@processCsvImport')->name('icd-pcs-orders.processCsvImport');
    Route::resource('icd-pcs-orders', 'IcdPcsOrderController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
