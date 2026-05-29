<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api','auth:api']], function () {

    Route::group(['prefix' => config('smc-erp.api_prefix', 'api/v1')], function () {

        Route::get('/',function (\Illuminate\Http\Request $request) {
            return
                'ERP API';
        });

        //API RESOURCES


        //## Auth User
        Route::get('user',function (Request $request){
            return $request->user();
        });
        Route::get('user/dashboard',function (Request $request){
            $user = $request->user();
            return [
                'available_courses' => $user->courses()->isNotCompleted()->get(),
                'completed_courses' => $user->courses()->isCompleted()->get(),
            ];
        });



        //## Organizations
        Route::get('organizations', \ERP\Api\Api\Http\Controllers\OrganizationController::class . '@index');
        Route::post('organizations', \ERP\Api\Api\Http\Controllers\OrganizationController::class . '@create');
        Route::get('organizations/{organization}', \ERP\Api\Api\Http\Controllers\OrganizationController::class . '@show');
        Route::put('organizations/{organization}', \ERP\Api\Api\Http\Controllers\OrganizationController::class . '@show');
        Route::delete('organizations/{organization}', \ERP\Api\Api\Http\Controllers\OrganizationController::class . '@destroy');
        Route::put('organizations/{organization}/restore', \ERP\Api\Api\Http\Controllers\OrganizationController::class . '@restore');

        //## Organizations Contacts
        Route::get('organizations/{organization}/contacts', \ERP\Api\Api\Http\Controllers\OrganizationContactController::class . '@index');
        Route::post('organizations/{organization}/contacts', \ERP\Api\Api\Http\Controllers\OrganizationContactController::class . '@create');
        Route::get('organizations/{organization}/contacts/{contact}', \ERP\Api\Api\Http\Controllers\OrganizationContactController::class . '@show');
        Route::put('organizations/{organization}/contacts/{contact}', \ERP\Api\Api\Http\Controllers\OrganizationContactController::class . '@show');
        Route::delete('organizations/{organization}/contacts/{contact}', \ERP\Api\Api\Http\Controllers\OrganizationContactController::class . '@destroy');
        Route::put('organizations/{organization}/restore/contacts/{contact}', \ERP\Api\Api\Http\Controllers\OrganizationContactController::class . '@restore');



    });  // END -- ROUTE GROUP PREFIX FUNC

}); // END -- ROUTE GROUP MIDDLEWARE FUNC