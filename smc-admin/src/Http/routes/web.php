<?php
// WEB
Route::group(['middleware' => ['web',
    'auth'
]], function () {

    Route::get('/users', function () {
        return view('smc-admin::pages.users')->with([
            'pageDetails' => [
                'title' => 'Users'
            ]
        ]);
    })->name('users');

});