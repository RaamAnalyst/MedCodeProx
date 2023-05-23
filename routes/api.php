<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Icd Cm Codes
    Route::apiResource('icd-cm-codes', 'IcdCmCodesApiController');

    // Icd Order
    Route::post('icd-orders/media', 'IcdOrderApiController@storeMedia')->name('icd-orders.storeMedia');
    Route::apiResource('icd-orders', 'IcdOrderApiController');

    // Icd Pcs Codes
    Route::apiResource('icd-pcs-codes', 'IcdPcsCodesApiController');

    // Icd Pcs Order
    Route::apiResource('icd-pcs-orders', 'IcdPcsOrderApiController');
});
