<?php
use App\Events\FormSubmitted;
include_once 'web_builder.php';
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JoshController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\OpenReminderNotificationController;
use App\Http\Controllers\UserCourseLogbookController;
use App\Http\Controllers\SettingsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return "Cleared";
});

Route::get('/db', function () {
    Artisan::call('migrate:fresh --seed');
    return "run successfully";
});
Route::pattern('slug', '[a-z0-9- _]+');

Route::group(array('prefix' => 'admin'), function () {

    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return View('admin/404');
    });
    Route::get('500', function () {
        return View::make('admin/500');
    });
    Route::get('/',[CourseController::class,'index']);

    # Lock screen
    Route::get('{id}/lockscreen', [UsersController::class,'lockscreen']);
    Route::post('{id}/lockscreen', [UsersController::class,'postLockscreen']);

    # All basic routes defined here
    Route::get('signin', [AuthController::class,'getSignin'])->name('signin');
    Route::post('signin', [AuthController::class,'postSignin'])->name('signup');
    Route::post('signup', [AuthController::class,'postSignup']);
    Route::post('forgot-password', [AuthController::class,'postForgotPassword']);
    Route::get('login2', function () {
        return View::make('admin/login2');
    });

    # Register2
    Route::get('register2', function () {
        return View::make('admin/register2');
    });
    Route::post('register2',[AuthController::class,'postRegister2']);

    # Forgot Password Confirmation

    Route::get('forgot-password/{userId}/{passwordResetCode}',[AuthController::class,'getForgotPasswordConfirm']);
    Route::post('forgot-password/{userId}/{passwordResetCode}',[AuthController::class,'postForgotPasswordConfirm']);

    # Logout
    Route::get('logout',[AuthController::class,'getLogout']);

    # Account Activation
    Route::get('activate/{userId}/{activationCode}',[AuthController::class,'getActivate']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    # Dashboard / Index
    Route::get('/',[JoshController::class,'showHome'])->name('dashboard');

    # Sadek Start

    # Broadcasting
    Route::get('/counter', function () {
        return view('admin.sadek.counter');
    });
    Route::get('/sender', function () {
        return view('admin.sadek.sender');
    });
    Route::post('/sender', function () {
        $text = request()->text;
        event(new FormSubmitted($text));

    });


    Route::post('/admin/password/reset/', [UsersController::class,'resetPassword'])->name('password.reset');


    // Push Notification Routes
    Route::group(['prefix' => 'marketing/pushnotifications'], function(){
        Route::get('/',[PushNotificationController::class,'index'])->name('pushnotification.index');
        Route::get('/create',[PushNotificationController::class,'create'])->name('pushnotification.create');
        Route::get('/edit/{id}',[PushNotificationController::class,'edit'])->name('pushnotification.edit');
        Route::post('/store',[PushNotificationController::class,'store'])->name('pushnotification.store');
        Route::post('/update/{id}',[PushNotificationController::class,'update'])->name('pushnotification.update');
        Route::post('/destroy/{id}',[PushNotificationController::class,'destroy'])->name('pushnotification.destroy');
    });
    Route::get('/user/push-notification-seen/{id}', 'UserPushNotificationController@update')->name('userpushnotification.update');
    // Bannner Routes
    Route::group(['prefix' => 'marketing/banners'], function(){
        Route::get('/',[BannerController::class,'index'])->name('banner.index');
        Route::get('/create',[BannerController::class,'create'])->name('banner.create');
        Route::get('/edit/{id}',[BannerController::class,'edit'])->name('banner.edit');
        Route::post('/store',[BannerController::class,'store'])->name('banner.store');
        Route::post('/update/{id}',[BannerController::class,'update'])->name('banner.update');
        Route::post('/destroy/{id}',[BannerController::class,'destroy'])->name('banner.destroy');
    });

    // Open Reminder Routes
    Route::group(['prefix' => 'marketing/open-reminder'], function(){
        Route::get('/',[OpenReminderNotificationController::class,'index'])->name('openreminder.index');
        Route::get('/create',[OpenReminderNotificationController::class,'create'])->name('openreminder.create');
        Route::get('/edit/{id}',[OpenReminderNotificationController::class,'edit'])->name('openreminder.edit');
        Route::post('/store',[OpenReminderNotificationController::class,'store'])->name('openreminder.store');
        Route::post('/update/{id}',[OpenReminderNotificationController::class,'update'])->name('openreminder.update');
        Route::post('/destroy/{id}',[OpenReminderNotificationController::class,'destroy'])->name('openreminder.destroy');
    });
    // Open Reminder Routes
    Route::group(['prefix' => 'user-logbook'], function(){
        Route::get('/',[UserCourseLogbookController::class,'index'])->name('courselogbook.index');
        Route::get('/create',[UserCourseLogbookController::class,'create'])->name('courselogbook.create');
        Route::get('/edit/{id}',[UserCourseLogbookController::class,'edit'])->name('courselogbook.edit');
        Route::post('/store',[UserCourseLogbookController::class,'store'])->name('courselogbook.store');
        Route::post('/update/{id}',[UserCourseLogbookController::class,'update'])->name('courselogbook.update');
        Route::post('/destroy/{id}',[UserCourseLogbookController::class,'destroy'])->name('courselogbook.destroy');
    });

    # Sadek End

    # Courses Management
    Route::group(array('prefix' => 'courses'), function () {
        Route::get('/',[CourseController::class,'index']);
        Route::get('subscribe_courses/{id}',[CourseController::class,'subscribeCourses']);
        Route::get('training_courses/{id}',[CourseController::class,'trainingCourses']);
        Route::post('create',[CourseController::class,'create']);
        Route::post('edit/{id}',[CourseController::class,'postUpdateCourse']);
        Route::get('status/{id}/{action}',[CourseController::class,'postUpdateCourseStatus']);
        Route::get('category',[CourseController::class,'category']);
        Route::post('categorysave',[CourseController::class,'categorySave']);
        Route::post('category/edit/{id}',[CourseController::class,'postUpdateCategory']);
        Route::get('category/status/{id}/{action}',[CourseController::class,'postUpdateCategoryStatus']);
        Route::post('equipments',[CourseController::class,'coursEquipments']);
        Route::get('days/addDayActivity/{id}',[CourseController::class,'addAdminDayActivityForm']);
        Route::post('days/update-day-activity/{id}',[CourseController::class,'day_activity_update'])->name('course.dayactivity.update');
        Route::post('course/videos',[CourseController::class,'addVideo'])->name('courses.courseVideos');

    });

    # Settings Management
    Route::group(array('prefix' => 'settings'), function () {
        Route::get('fitnessgoals',[SettingsController::class,'fitnessGoals']);
        Route::post('fitnessgoals',[SettingsController::class,'postFitnessGoals']);
        Route::post('fitnessgoals/edit/{id}',[SettingsController::class,'postUpdateFitnessGoals']);
        Route::get('fitnessgoals/status/{id}/{action}',[SettingsController::class,'postUpdateFitnessGoalsStatus']);

        Route::get('equipments',[SettingsController::class,'equipments']);
        Route::post('equipments',[SettingsController::class,'postEquipments']);
        Route::post('equipments/edit/{id}',[SettingsController::class,'postUpdateEquipments']);
        Route::get('equipments/status/{id}/{action}',[SettingsController::class,'postUpdateEquipmentsStatus']);

        Route::get('tutrial',[SettingsController::class,'tutrial']);
        Route::post('tutrial',[SettingsController::class,'posTutrial']);
        Route::post('tutrial/edit/{id}',[SettingsController::class,'postUpdateTutrial']);
        Route::get('tutrial/status/{id}/{action}',[SettingsController::class,'postUpdateTutrialStatus']);

        Route::get('subscriptions',[SettingsController::class,'subscriptions']);
        Route::post('subscriptions',[SettingsController::class,'postsubScriptions']);
        Route::post('subscriptions/edit/{id}',[SettingsController::class,'postUpdatesubScriptions']);
        Route::get('subscriptions/status/{id}/{action}',[SettingsController::class,'postUpdatesubScriptionsStatus']);


    });



    # User Management
    Route::group(array('prefix' => 'users'), function () {
        Route::get('/',[UsersController::class,'index'])->name('users.index');
        //i made this new route below
        Route::get('delete/{id}', [UsersController::class,'delete'])->name('users.delete');
        Route::get('admin/deleted-users',  [UsersController::class,'getDeletedUsers'])->name('deleted-users');
        Route::get('restore/{id}', [UsersController::class,'restore'])->name('users.restore');

        Route::get('profile', [UsersController::class,'show'])->name('users.profile');



        Route::get('data',[UsersController::class,'data'])->name('users.data');
        Route::get('create',[UsersController::class,'create'])->name('users.create');
        Route::post('create',[UsersController::class,'store']);
        Route::get('{user}/delete',[UsersController::class,'destroy']);
        Route::get('{user}/confirm-delete',[UsersController::class,'getModalDelete']);
        Route::get('{user}/restore',[UsersController::class,'getRestore']);
        Route::get('{user}',[UsersController::class,'show']);
        Route::post('{user}/passwordreset',[UsersController::class,'passwordreset']);

        # Sadek Start
        Route::get('/search/results',[UsersController::class,'user_search'])->name('user.search');
        Route::get('{user}/details',[UsersController::class,'user_details'])->name('user.details');
        Route::post('{user}/add-friend',[UsersController::class,'add_friend'])->name('user.addfriend');
        # Sadek Start End
        Route::post('assign-role',[UsersController::class,'assigRole'])->name('assign.role');
    });

    # Remaining pages will be called from below controller method
    # in real world scenario, you may be required to define all routes manually
    Route::get('{name?}',[JoshController::class,'showView']);

});

#FrontEndController
Route::get('login',[FrontEndController::class,'getLogin'])->name('login');
Route::post('login',[FrontEndController::class,'postLogin']);
Route::get('register',[FrontEndController::class,'getRegister'])->name('register');
Route::post('register',[FrontEndController::class,'postRegister']);
Route::post('forgot-password',[FrontEndController::class,'postForgotPassword']);
Route::get('logout',[FrontEndController::class,'getLogout']);


Route::get('activate/{userId}/{activationCode}',[FrontEndController::class,'getActivate']);
Route::get('forgot-password',[FrontEndController::class,'getForgotPassword']);
Route::post('forgot-password',[FrontEndController::class,'postForgotPassword']);
# Forgot Password Confirmation
Route::get('forgot-password/{userId}/{passwordResetCode}',[FrontEndController::class,'getForgotPasswordConfirm']);
Route::post('forgot-password/{userId}/{passwordResetCode}',[FrontEndController::class,'postForgotPasswordConfirm']);
# My account display and update details
Route::group(array('middleware' => 'user'), function () {
    Route::group(array('prefix' => 'courses'), function () {
        Route::get('/',[CourseController::class,'trainerCourses']);
        Route::post('addActivity',[CourseController::class,'saveDayActivity']);
        Route::get('days/addDayActivity/{id}',[CourseController::class,'addDayActivityForm']);
    });

    Route::get('my-account', [FrontEndController::class,'myAccount'])->name('my-account');
    Route::put('my-account', [FrontEndController::class,'update']);
});
Route::get('logout', [FrontEndController::class,'getLogout']);
Route::post('contact', [FrontEndController::class,'postContact']);

#frontend views
Route::get('/', array('as' => 'home', function () {
    return View::make('index');
}));


Route::get('{name?}',[JoshController::class,'showFrontEndView']);
# End of frontend views



// ============== test routes


Route::get('/dd',function(){
    return 'forget page';})->name('forgot-password');