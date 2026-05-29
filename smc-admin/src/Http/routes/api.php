<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$middleware = [
    'api'
];
$authPackage = env('AUTH_PACKAGE', 'sanctum');
switch ($authPackage) {
    case "sanctum":
        $middleware[] = 'auth:sanctum';
        break;
    case "passport":
        $middleware[] = 'auth:api';
        break;
    default:
        throw new \Exception('Error: auth package invalid - ' . $authPackage );
}

Route::group(['middleware' => $middleware], function () {

    Route::group(['prefix' => config('smc-admin.api_prefix', 'api/v1')], function () {

        Route::get('/',function (\Illuminate\Http\Request $request) {
            return
                'Admin API';
        });

        //API RESOURCES
        //## User
        Route::get('user',function (Request $request){
            return $request->user();
        });

        //## Users
        Route::get('users', \Admin\Api\Http\Controllers\UserController::class . '@index');
        Route::post('users', \Admin\Api\Http\Controllers\UserController::class . '@store');
        Route::get('users/{user}', \Admin\Api\Http\Controllers\UserController::class . '@show');
        Route::put('users/{user}', \Admin\Api\Http\Controllers\UserController::class . '@update');
        Route::delete('users/{user}', \Admin\Api\Http\Controllers\UserController::class . '@destroy');
        Route::put('users/{userId}/restore', \Admin\Api\Http\Controllers\UserController::class . '@restore')->withTrashed();

    });  // END -- ROUTE GROUP PREFIX FUNC

}); // END -- ROUTE GROUP MIDDLEWARE FUNC