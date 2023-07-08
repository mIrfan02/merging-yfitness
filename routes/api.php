<?php

use Illuminate\Http\Request;

include_once 'api_builder.php';

use App\Http\Controllers\ApiController;
use App\Http\Controllers\NewApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('signup', [ApiController::class, 'appRegister']);
Route::post('signupFacbook', [ApiController::class, 'facebookRegister']);
Route::post('signupGoogle', [ApiController::class, 'googleRegister']);
Route::post('signupApple', [ApiController::class, 'appleRegister']);
Route::post('login', [ApiController::class, 'postLogin']);
Route::post('forgot-password', [ApiController::class, 'postForgotPassword']);
Route::post('forgot-password/{userId}', [ApiController::class, 'postForgotPasswordConfirm']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('fitnessgoal', [ApiController::class, 'dictionry']);  //get all fitness goal
    Route::post('logout', [ApiController::class, 'postLogout']);
    Route::post('updateProfile', [ApiController::class, 'updateProfile']);
    // Route::post('updateFitnessProfile', [ApiController::class, 'updateFitnessProfile']);
    Route::get('tutorialVideo', [ApiController::class, 'tutorial_video']);
    Route::post('courses', [ApiController::class, 'getCourses']);
    Route::get('coursesAccordingCategory', [ApiController::class, 'showCoursesAccordingCat']);
    Route::post('showCourseAndEquipmentById', [ApiController::class, 'showCourseById']);

    Route::post('myongoingcourses', [ApiController::class, 'getMyOngoingCourses']);
    Route::post('mysubscription', [ApiController::class, 'mySubscription']);
    Route::post('myNotificationSettings', [ApiController::class, 'myNotificationSettings']);
    Route::post('myStatisticsSettings', [ApiController::class, 'myStatisticsSettings']);
    Route::post('mySettings/{userId}', [ApiController::class, 'mySettings']); // there is no method for my setting
    Route::post('mycourses', [ApiController::class, 'getMyCourses']);
    Route::post('mycompletedcourses', [ApiController::class, 'getMyCompletedCourses']);
    Route::post('docompletemycourse', [ApiController::class, 'doCompletedMyCourse']);
    Route::post('categoryCourses', [ApiController::class, 'getCategoryCourses']);
    Route::post('addMyCourseActivity', [ApiController::class, 'addMyCourseActivity']);
    Route::post('myCourseActivity', [ApiController::class, 'myCourseActivity']);
    Route::post('myActivity', [ApiController::class, 'getMyActivity']);
    Route::post('addMyActivity', [ApiController::class, 'addMyActivity']);
    Route::post('startTrial', [ApiController::class, 'startTrial']);
    Route::post('endTrial', [ApiController::class, 'endTrial']);
    Route::post('makeCourseSchedule', [ApiController::class, 'makeCourseSchedule']);

    # Sadek Start
    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'banners'], function () {
            Route::get('/', [NewApiController::class, 'banners']);
            Route::get('/{id}', [NewApiController::class, 'banner_show']);
            Route::post('/create', [NewApiController::class, 'banner_create']); // the image query in this not found
            Route::post('/update/{id}', [NewApiController::class, 'banner_update']);
            Route::post('/delete/{id}', [NewApiController::class, 'banner_delete']);
        });

        Route::group(['prefix' => 'pushnotifications'], function () {
            Route::get('/', [NewApiController::class, 'pushnotifications']);
            Route::get('/{id}', [NewApiController::class, 'pushnotification_show']);
            Route::post('/create', [NewApiController::class, 'pushnotification_create']);
            Route::post('/update/{id}', [NewApiController::class, 'pushnotification_update']);
            Route::post('/delete/{id}', [NewApiController::class, 'pushnotification_delete']);
        });

        Route::group(['prefix' => 'openreminders'], function () {
            Route::get('/', [NewApiController::class, 'openreminders']);
            Route::get('/user/{id}', [NewApiController::class, 'openreminders_by_user']);
            Route::get('/{id}', [NewApiController::class, 'openreminder_show']);
            Route::post('/create', [NewApiController::class, 'openreminder_create']);
            Route::post('/update/{id}', [NewApiController::class, 'openreminder_update']);
            Route::post('/delete/{id}', [NewApiController::class, 'openreminder_delete']);
        });

        Route::group(['prefix' => 'courselogbooks'], function () {
            Route::get('/', [NewApiController::class, 'courselogbooks']);
            Route::get('/user/{id}', [NewApiController::class, 'courselogbooks_by_user']);
            Route::get('/{id}', [NewApiController::class, 'courselogbook_show']);
            Route::post('/create', [NewApiController::class, 'courselogbook_create']);
            Route::post('/update/{id}', [NewApiController::class, 'courselogbook_update']);
            Route::post('/delete/{id}', [NewApiController::class, 'courselogbook_delete']);
        });

        Route::get('/user-search', [NewApiController::class, 'user_search']);

        Route::group(['prefix' => 'friendrequests'], function () {
            Route::get('/', [NewApiController::class, 'friendrequests']);
            Route::get('/user/{id}', [NewApiController::class, 'friendrequests_by_user']);
            Route::post('/accept/{id}', [NewApiController::class, 'friendrequest_accept']);
            Route::post('/reject/{id}', [NewApiController::class, 'friendrequest_reject']);
        });
    });
    # Sadek Start End
});
