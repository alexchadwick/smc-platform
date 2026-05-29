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

    Route::group(['prefix' => config('smc-training.api_prefix', 'api/v1')], function () {

        Route::get('/',function (\Illuminate\Http\Request $request) {
            return
                'Training API';
        });

        //API RESOURCES

        //## User
        Route::get('user',function (Request $request){
            return $request->user();
        });
        Route::get('user/dashboard-metrics',function (Request $request){
            $user = $request->user();
            return response()->json([
                'data' => [
                    'recently_enrolled_courses' => $request->user()->course_enrollments()->with('course')->orderby('created_at')->limit(5)->get(),
                    'recently_completed_courses' => $request->user()->course_enrollments()->with('course')->where('completed_at', '!=', null)->orderby('created_at')->limit(5)->get(),
                ]
                //'available_courses' => $user->courses()->isNotCompleted()->get(),
                //'completed_courses' => $user->courses()->isCompleted()->get(),
            ]);
        });
        Route::get('user/course_enrollments', \Training\Api\Http\Controllers\UserCourseEnrollmentController::class . '@index');


        //## Courses
        Route::get('courses', \Training\Api\Http\Controllers\CourseController::class . '@index');
        Route::post('courses', \Training\Api\Http\Controllers\CourseController::class . '@store');
        Route::get('courses/{course}', \Training\Api\Http\Controllers\CourseController::class . '@show');
        Route::put('courses/{course}', \Training\Api\Http\Controllers\CourseController::class . '@update');
        Route::delete('courses/{course}', \Training\Api\Http\Controllers\CourseController::class . '@destroy');
        Route::post('courses/{courseId}/restore', \Training\Api\Http\Controllers\CourseController::class . '@restore')->withTrashed();


        //## CourseEnrollments
        Route::get('course-enrollments', \Training\Api\Http\Controllers\CourseEnrollmentController::class . '@index');
        Route::post('course-enrollments', \Training\Api\Http\Controllers\CourseEnrollmentController::class . '@store');
        Route::get('course-enrollments/{courseEnrollment}', \Training\Api\Http\Controllers\CourseEnrollmentController::class . '@show');
        Route::put('course-enrollments/{courseEnrollment}', \Training\Api\Http\Controllers\CourseEnrollmentController::class . '@update');
        Route::delete('course-enrollments/{courseEnrollment}', \Training\Api\Http\Controllers\CourseEnrollmentController::class . '@destroy');
        Route::post('course-enrollments/{courseEnrollmentId}/restore', \Training\Api\Http\Controllers\CourseEnrollmentController::class . '@restore')->withTrashed();




    });  // END -- ROUTE GROUP PREFIX FUNC

}); // END -- ROUTE GROUP MIDDLEWARE FUNC