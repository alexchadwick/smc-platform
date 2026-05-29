<?php

Route::group(['middleware' => ['web',
    //'auth'
]], function () {
   /* Route::get('/model/{modelId}', function ($modelId) {
        return view('smc-erp::viewName')->with([
            'quiz' => \ERP\Api\Models\Model::findOrFail($modelId),
            'pageDetails' => [
                'title' => 'Title Label'
            ]
        ]);
    })->name('routeName');*/

    Route::get('/erp', function () {

        return view('smc-erp::pages.portal')->with([
            'pageDetails' => [
                'title' => 'ERP'
            ]
        ]);
    })->name('erp');

    Route::get('/settings', function () {

        return view('smc-erp::pages.settings')->with([
            'pageDetails' => [
                'title' => 'General Settings'
            ]
        ]);
    })->name('settings');
});
