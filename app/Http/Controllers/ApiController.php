<?php

namespace App\Http\Controllers;

use URL;
use File;
use Hash;
use Lang;
use Mail;
use Response;
use Sentinel;
use \App\User;
use Activation;
use App\Courses;
use App\CourseListing;
use App\CourseCategory;
use App\CourseEquipments;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ApiController extends Controller
{
    private $user_activation = true;

    protected $messageBag;

    protected $add;

    public function startTrial(Request $request)
    {
        if (!$request->has('user_id')) {
            return Response::json(array('error' => 'user_id missing'), 201);
        }
        $userId = $request->get('user_id');
        $response = array();
        $response['message'] = 'Trial has been started.';
        # # # Trial Start
        \App\User::where('id', $userId)->update(['trial_to' => date('Y-m-d', strtotime('+7 days'))]);
        $response['Data'] = Sentinel::findById($userId);
        return Response::json($response, 200);
    }
    public function makeCourseSchedule(Request $request)
    {
        $response = array();
        $data = $request->all();
        \App\UserCourseSchedule::create($data);
        $response['message'] = 'Course Schedule has been saved.';
        $response['Data'] = [];
        return Response::json($response, 200);
    }
    public function endTrial(Request $request)
    {
        if (!$request->has('user_id')) {
            return Response::json(array('error' => 'user_id missing'), 201);
        }
        $userId = $request->get('user_id');
        $response = array();
        $endDate = date('Y-m-d', strtotime('-1 day'));
        $response['message'] = 'Trial has been Ended to ' . $endDate . ';';
        # # # Trial Start
        \App\User::where('id', $userId)->update(['trial_to' => $endDate]);
        $response['Data'] = Sentinel::findById($userId);
        return Response::json($response, 200);
    }
    public function getMyActivity(Request $request)
    {
        if (!$request->has('user_id')) {
            return Response::json(array('error' => 'user_id missing'), 201);
        }
        $response = array();
        $response['message'] = 'LogBook Data';
        $response['Data'] = \App\LogBook::getData($request->get('user_id'));
        return Response::json($response, 200);
    }
    public function addMyActivity(Request $request)
    {
        if (!$request->has('user_id')) {
            return Response::json(array('error' => 'user_id missing'), 201);
        }
        if (!$request->has('msg')) {
            return Response::json(array('error' => 'msg missing'), 201);
        }

        $userId = $request->get('user_id');
        $data = [];
        $data['user_id'] = $userId;
        $data['activity'] = $request->get('msg');
        if ($request->has('course_id')) {
            $data['course_id'] = $request->get('course_id');
        }
        if ($request->has('subscription_id')) {
            $data['subscription_id'] = $request->get('subscription_id');
        }
        if ($request->has('notification_id')) {
            $data['notification_id'] = $request->get('notification_id');
        }
        $data['detail'] = serialize($request->all());
        \App\LogBook::create($data);
        $response = array();
        $response['message'] = 'LogBook Data Added';
        $response['Data'] = $response['Data'] = \App\LogBook::getData($userId);
        return Response::json($response, 200);
    }
    public function addMyCourseActivity(Request $request)
    {
        if (!$request->has('user_id')) {
            return Response::json(array('error' => 'user_id missing'), 201);
        }
        if (!$request->has('course_id')) {
            return Response::json(array('error' => 'course_id missing'), 201);
        }
        if (!$request->has('week')) {
            return Response::json(array('error' => 'week missing'), 201);
        }
        if (!$request->has('day')) {
            return Response::json(array('error' => 'day missing'), 201);
        }
        if (!$request->has('detail')) {
            return Response::json(array('error' => 'detail missing'), 201);
        }
        $data = $request->all();
        \App\UserActivity::create($data);
        $response = array();
        $response['message'] = 'Course Activity Save Successfully.';
        $response['Data'] = \App\UserActivity::myPerformedActivities($data['user_id'], $data['course_id']);
        return Response::json($response, 200);
    }
    public function myCourseActivity(Request $request)
    {
        if (!$request->has('user_id')) {
            return Response::json(array('error' => 'user_id missing'), 201);
        }
        if (!$request->has('course_id')) {
            return Response::json(array('error' => 'course_id missing'), 201);
        }
        $data = $request->all();
        $response = array();
        $response['message'] = 'Course Activity Loaded Successfully.';
        $response['Data'] = \App\UserActivity::myPerformedActivities($data['user_id'], $data['course_id']);
        return Response::json($response, 200);
    }
    public function getCourses()
    {
        $response = array();
        $response['message'] = 'Courses Loaded';
        $response['Data'] = \App\Courses::where('status', 1)->get();
        return Response::json($response, 200);
    }
    public function getMyCourses(Request $request)
    {
        // if (!$request->has('user_id')) {
        //     return Response::json(array('error' => 'user_id missing'), 201);
        // }
        // $userId = $request->get('user_id');
        $user = Auth::user();
        $courses = \App\UserCourseSchedule::where('user_id', $user->id)->get();
        $response = array();
        if (count($courses)) {
            $response['message'] = 'Courses Loaded';
        } else {
            $response['message'] = 'Courses Not Found';
        }

        $response['Data'] = $courses;
        return Response::json($response, 200);
    }
    public function getMyOngoingCourses(Request $request)
    {
        // if (!$request->has('user_id')) {
        //     return Response::json(array('error' => 'user_id missing'), 201);
        // }
        // $userId = $request->get('user_id');
        $user = Auth::user();
        $courses = \App\Courses::join('user_course_schedule as cs', 'cs.course_id', '=', 'courses.id')
            ->select('courses.*', 'cs.sun', 'cs.mon', 'cs.tue', 'cs.wed', 'cs.thu', 'cs.fri', 'cs.sat')
            ->where('cs.user_id', $user->id)
            ->where('cs.status', 0)
            ->get();
        $response = array();
        if (count($courses)) {
            $response['message'] = 'Courses Loaded';
        } else {
            $response['message'] = 'Courses Not Found';
        }

        $response['Data'] = $courses;
        return Response::json($response, 200);
    }
    public function getMyCompletedCourses(Request $request)
    {
        // if (!$request->has('user_id')) {
        //     return Response::json(array('error' => 'user_id missing'), 201);
        // }
        // $userId = $request->get('user_id');
        $user = Auth::user();
        $courses = \App\Courses::join('user_course_schedule as cs', 'cs.course_id', '=', 'courses.id')
            ->select('courses.*', 'cs.sun', 'cs.mon', 'cs.tue', 'cs.wed', 'cs.thu', 'cs.fri', 'cs.sat')
            ->where('cs.user_id', $user->id)
            ->where('cs.status', 1)
            ->get();
        $response = array();
        if (count($courses)) {
            $response['message'] = 'Courses Loaded';
        } else {
            $response['message'] = 'Courses Not Found';
        }

        $response['Data'] = $courses;
        return Response::json($response, 200);
    }
    public function doCompletedMyCourse(Request $request)
    {
        // if (!$request->has('user_id')) {
        //     return Response::json(array('error' => 'user_id missing'), 201);
        // }
        $user = Auth::user();
        if (!$request->has('course_id')) {
            return Response::json(array('error' => 'course_id missing'), 201);
        }
        // $userId = $request->get('user_id');
        # # # Doing course complete
        \App\UserCourseSchedule::where([
            'user_id'   => $user->id,
            'course_id' => $request->get('course_id')
        ])->update(['status' => 1]);
        $response = array();
        $response['message'] = 'Course has been completed successfully';

        $response['Data'] = [];
        return Response::json($response, 200);
    }
    public function getCategoryCourses(Request $request)
    {
        if (!$request->has('category_id')) {
            return Response::json(array('error' => 'category_id missing'), 201);
        }
        $response = array();
        $response['message'] = 'Courses Category Loaded';
        $response['Data'] = \App\Courses::join('course_category_listing as cl', 'cl.course_id', '=', 'courses.id')
            ->where('cl.cat_id', $request->get('category_id'))->where('courses.status', 1)->get();
        return Response::json($response, 200);
    }
    public function dictionry(Request $request)
    {
        $response = array();
        // $data = [];
        // $pages = [];
        // $text = [];
        // $text[] = 'Get to know yourself beter';
        // $text[] = 'Full access to workouts and programs';
        // $data['baseUrl'] = url('/');
        // $data['users_img_path'] = url('/uploads/users/');
        // $data['courses_img_path'] = url('/uploads/courses/');
        $data['fitnessGoals'] = \App\FitnessGoals::select('id', 'name')->where('status', 1)->get();
        // $data['tutrialVideos'] = \App\TutrialVideos::where('status', 1)->get();
        // $data['subscriptions_plan'] = \App\Subscriptions::where('status', 1)->get();
        // $data['courses_categories'] = \App\CourseCategory::select('id', 'title', 'image')->where('status', 1)->get();
        // $data['home_text'] = $text;
        // $pages['terms'] = url('/terms');
        // $pages['help'] = url('/help');
        // $pages['contact'] = url('/contact');
        // $pages['about'] = url('/about');
        // $data['pages'] = $pages;
        $response['message'] = 'Fitness Goal Data Loaded';
        $response['Data'] = $data;
        return Response::json($response, 200);
    }
    public function appRegister(Request $request)
    {
        try {
            if (!$request->has('first_name')) {
                return Response::json(array('error' => 'first_name missing'), 201);
            }
            if (!$request->has('last_name')) {
                return Response::json(array('error' => 'last_name missing'), 201);
            }
            if (!$request->has('email')) {
                return Response::json(array('error' => 'email missing'), 201);
            }
            // if(!$request->has('gender')){
            //     return Response::json(array('error' => 'gender missing'), 201);
            // }

            $register_via = 'custom';



            $activate = $this->user_activation; //make it false if you don't want to activate user automatically it is declared above as global variable
            # # # Get Role
            $role = Sentinel::findRoleByName('User');
            $request->merge(['api_token' =>  Str::random(60)]);
            $user = Sentinel::register($request->only(['first_name', 'last_name', 'email', 'password', 'gender', 'api_token', 'register_via']), $activate);
            $role->users()->attach($user);
            $user = User::find($user->id);

            $reminderCode = rand(0000, 9999);
            //if you set $activate=false above then user will receive an activation mail
            if (!$activate) {
                // Data to be used on the email view
                $data = array(
                    'reminderCode' => $reminderCode,
                    'user' => $user,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->from('support@yfitness.com');
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });

                //Redirect to login page
            }
            \App\LogBook::add($user->id, 'Register', serialize($user));
            $data = array(
                'user' => $user,
                'token' => $user->createToken('token')->plainTextToken,
                'success' => Lang::get('auth/message.signup.success')
            );
            return Response::json($data, 200);
        } catch (\Exception $e) {
            return Response::json(array('error' => 'Email already exist.'), 201);
        }
    }
    public function postForgotPassword(Request $request)
    {
        $response = array();

        if (!$request->has('email')) {
            return Response::json(array('error' => 'email missing'), 201);
        }
        $user = Sentinel::findByCredentials(['email' => $request->get('email')]);

        if (!$user) {
            return Response::json(array('error' => Lang::get('auth/message.account_email_not_found')), 201);
        }
        $remoinderCode = rand(00000, 99999);
        $data = array(
            'reminderCode' => $remoinderCode,
        );

        // Send the activation code through email
        Mail::send('emails.forgot-password', ['user' => $user, 'reminderCode' => $remoinderCode], function ($m) use ($user) {
            $m->from('support@yfitness.com');
            $m->to($user->email, $user->first_name . ' ' . $user->last_name);
            $m->subject('Account Password Recovery');
        });


        $response['message'] = Lang::get('auth/message.forgot-password.success');
        $response['verificationCode'] = $remoinderCode;
        $response['user_id'] = $user->id;
        return Response::json($response, 200);
    }
    // public function updateFitnessProfile(Request $request)
    // {
    //     $response = array();
    //     $user = Auth::user();
    //     $UserFitnessIngrediants = \App\UserFitnessIngrediants::where('user_id', $user->id)->first();
    //     if (!$UserFitnessIngrediants) $UserFitnessIngrediants = new \App\UserFitnessIngrediants();
    //     $UserFitnessIngrediants->user_id = $user->id;
    //     if ($request->has('fitness_goal_id')) {
    //         $UserFitnessIngrediants->fitness_goal_id = $request->get('fitness_goal_id');
    //     }
    //     if ($request->has('height')) {
    //         $UserFitnessIngrediants->height = $request->get('height');
    //     }
    //     if ($request->has('heightin')) {
    //         $UserFitnessIngrediants->heightin = $request->get('heightin');
    //     }
    //     if ($request->has('weight')) {
    //         $UserFitnessIngrediants->weight = $request->get('weight');
    //     }
    //     if ($request->has('weightin')) {
    //         $UserFitnessIngrediants->weightin = $request->get('weightin');
    //     }
    //     $UserFitnessIngrediants->save();
    //     \App\LogBook::add($user->id, 'Update Fitness Profile', serialize($UserFitnessIngrediants));
    //     $response['message'] = 'Your profile has been updated.';
    //     $response['Data'] = [
    //         'height' => $UserFitnessIngrediants->height,
    //         'weight' => $UserFitnessIngrediants->weight
    //     ];
    //     return Response::json($response, 200);
    // }
    public function updateProfile(Request $request)
    {
        // Validate the request parameters
        $validator = Validator::make($request->all(), [
            'gender' => 'required',
            'dob' => 'required|date',
            'fitness_goal_id' => 'required',
            'height' => 'required|numeric',
            'heightin' => 'required',
            'weight' => 'required|numeric',
            'weightin' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Proceed with updating the profile
        $response = array();
        $user = Auth::user();

        // Update profile information
        $user->gender = $request->input('gender');
        $user->dob = date('Y-m-d', strtotime($request->input('dob')));
        $age = date('Y') - date('Y', strtotime($request->input('dob')));
        $user->age = $age;

        // Update fitness profile information
        $UserFitnessIngrediants = \App\UserFitnessIngrediants::where('user_id', $user->id)->first();
        if (!$UserFitnessIngrediants) {
            $UserFitnessIngrediants = new \App\UserFitnessIngrediants();
            $UserFitnessIngrediants->user_id = $user->id;
        }
        $UserFitnessIngrediants->fitness_goal_id = $request->input('fitness_goal_id');
        $UserFitnessIngrediants->height = $request->input('height');
        $UserFitnessIngrediants->heightin = $request->input('heightin');
        $UserFitnessIngrediants->weight = $request->input('weight');
        $UserFitnessIngrediants->weightin = $request->input('weightin');

        // Save the updated data
        $user->save();
        $UserFitnessIngrediants->save();

        // Prepare the response
        $response['gender'] = $user->gender;
        $response['fitness_goal_id'] = $UserFitnessIngrediants->fitness_goal_id;
        $response['birthday'] = $user->dob;
        $response['body_weight'] = $UserFitnessIngrediants->weight;
        $response['body_weightin'] = $UserFitnessIngrediants->weightin;
        $response['body_height'] = $UserFitnessIngrediants->height;
        $response['body_heightin'] = $UserFitnessIngrediants->heightin;

        return response()->json($response, 200);
    }



    // public function updateProfile(Request $request)
    // {
    //     $response = array();
    //     // $user = Sentinel::findById($userId);
    //     $user = Auth::user();
    //     if ($request->has('gender')) {
    //         $user->gender = $request->get('gender');
    //     }
    //     if ($request->has('dob')) {
    //         $user->dob = date('Y-m-d', strtotime($request->get('dob')));
    //         $age = date('Y') - date('Y', strtotime($request->get('dob')));
    //         $user->age = $age;
    //     }
    //     # # # profile photo
    //     if ($file = $request->file('pic')) {
    //         $fileName = $file->getClientOriginalName();
    //         $extension = $file->getClientOriginalExtension() ?: 'png';
    //         $folderName = '/uploads/users/';
    //         $destinationPath = public_path() . $folderName;
    //         $safeName = $user->id . rand(0000000000, 9999999999) . '.' . $extension;
    //         $file->move($destinationPath, $safeName);

    //         //delete old pic if exists
    //         if (File::exists(public_path() . $user->pic)) {
    //             File::delete(public_path() . $user->pic);
    //         }

    //         //save new file path into db
    //         $user->pic = $folderName . $safeName;
    //     }
    //     $user->save();
    //     \App\LogBook::add($user->id, 'Update Profile', serialize($user));
    //     $response['message'] = 'Your profile has been updated.';
    //     $response['Data'] = [
    //         'gender' => $user->gender,
    //         'dob' => $user->dob
    //     ];
    //     return Response::json($response, 200);
    // }
    public function myNotificationSettings(Request $request)
    {
        $response = array();
        $user = Auth::user();
        $UserNotification = \App\UserNotification::where('user_id', $user->id)->first();
        if (!$UserNotification) $UserNotification = new \App\UserNotification();
        $UserNotification->user_id = $user->id;
        if ($request->has('receive_notifications')) {
            $UserNotification->receive_notifications = $request->get('receive_notifications');
        }
        if ($request->has('receive_newsletter')) {
            $UserNotification->receive_newsletter = $request->get('receive_newsletter');
        }
        if ($request->has('receive_special_offer')) {
            $UserNotification->receive_special_offer = $request->get('receive_special_offer');
        }
        $UserNotification->save();
        $response['message'] = 'Your notification setting has been updated.';
        $response['Data'] = Sentinel::findById($user->id);
        return Response::json($response, 200);
    }
    public function myStatisticsSettings(Request $request)
    {
        $response = array();
        $user = Auth::user();
        $UserStatistics = \App\UserStatistics::where('user_id', $user->id)->whereDate('record_date', date('Y-m-d', strtotime($request->get('record_date'))))->first();
        if (!$UserStatistics) $UserStatistics = new \App\UserStatistics();
        $UserStatistics->user_id = $user->id;
        $UserStatistics->distance_covered += $request->get('distance_covered');
        $UserStatistics->calaries_gain += $request->get('calaries_gain');
        $UserStatistics->time_spand = date('H:i:s', strtotime($request->get('time_spand')));
        $UserStatistics->record_date = date('Y-m-d', strtotime($request->get('record_date')));
        $UserStatistics->save();
        $response['message'] = 'Your statistics has been updated.';
        $response['Data'] = Sentinel::findById($user->id);
        return Response::json($response, 200);
    }
    public function mySubscription(Request $request)
    {
        $response = array();
        // $user = Sentinel::findById($userId);
        $user = Auth::user();
        if ($request->has('subscription_plan_id')) {
            $user->subscription_plan_id = $request->get('subscription_plan_id');
            $user->save();
            \App\LogBook::add($user->id, 'Subscription Plan', serialize($user));
            # # # Subscription Save
            $Subscription = \App\Subscriptions::where('id', $request->get('subscription_plan_id'))->first();
            $UserSubscriptions = new \App\UserSubscriptions();
            $UserSubscriptions->user_id = $user->id;
            $UserSubscriptions->per_month_fee = $Subscription->per_month_fee;
            $UserSubscriptions->total_fee = $Subscription->total_fee;
            $UserSubscriptions->fee_charge = 1;
            $UserSubscriptions->payment_date = date('Y-m-d');
            if ($request->has('payment_id')) {
                $UserSubscriptions->payment_id = $request->get('payment_id');
            }
            $UserSubscriptions->save();
        }
        $response['message'] = 'Your subscription has been updated.';
        $response['Data'] = Sentinel::findById($user->id);
        return Response::json($response, 200);
    }
    public function postForgotPasswordConfirm(Request $request, $userId)
    {
        $response = array();
        // Declare the rules for the form validation
        if (!$request->has('password')) {
            return Response::json(array('error' => 'password missing'), 201);
        }
        if (!$request->has('password_confirm')) {
            return Response::json(array('error' => 'password_confirm missing'), 201);
        }
        if ($request->get('password') != $request->get('password_confirm')) {
            return Response::json(array('error' => 'password & password_confirm mismatch'), 201);
        }

        // Find the user using the password reset code
        $user = Sentinel::findById($userId);
        $user->password = Hash::make($request->get('password'));
        $user->save();
        \App\LogBook::add($userId, 'Confirm Password', serialize($user));
        $response['message'] = Lang::get('auth/message.forgot-password-confirm.success');
        return Response::json($response, 200);
    }
    public function postLogout(Request $request)
    {
        $user = Auth::user()->id;
        $user = User::find($user);
        if ($user) {
            $user->tokens()->delete();
        }

        return response()
            ->json([
                'message' => 'You have successfully logged out and the token was successfully deleted'
            ]);
    }
    public function postLogin(Request $request)
    {
        $response = array();
        // Grab all the users
        try {
            if (!$request->has('email')) {
                return Response::json(array('error' => 'email missing'), 201);
            }
            if (!$request->has('password')) {
                return Response::json(array('error' => 'password missing'), 201);
            }
            if (!$request->has('fcm_token')) {
                return Response::json(array('error' => 'fcm_token missing'), 201);
            }
            // Try to log the user in

            $user = User::where('email', $request->input('email'))->firstOrFail();
            $user->fcm_token = $request->fcm_token;
            $user->save();
            $token = $user->createToken('token')->plainTextToken;
            // $user = Sentinel::authenticate($request->only('email', 'password'), $request->get('remember-me', 0));
            if ($user) {
                $response['message'] = Lang::get('auth/message.login.success');
                $response['Data'] = $user;
                \App\LogBook::add($user->id, 'Login', serialize($user));
                $response['token'] = $user->createToken('token')->plainTextToken;
                return Response::json($response, 200);
            } else {
                $response['message'] = 'Email or password is incorrect.';
                $response['Data'] = $user;
                return Response::json($response, 201);
                //return Redirect::back()->withInput()->withErrors($validator);
            }
        } catch (UserNotFoundException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_found'));
        } catch (NotActivatedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_not_activated'));
        } catch (UserSuspendedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended'));
        } catch (UserBannedException $e) {
            $this->messageBag->add('email', Lang::get('auth/message.account_banned'));
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            $this->messageBag->add('email', Lang::get('auth/message.account_suspended', compact('delay')));
        }
        // Ooops.. something went wrong
        $response['message'] = 'Email or password is incorrect.';
        $response['Data'] = $user;
        return Response::json($response, 201);
    }


    // api for facebook
    public function facebookRegister(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'facebook_id' => 'required|unique:users',
            ]);

            $email = $request->input('email', null);

            // Check if the user already exists
            $user = User::where('facebook_id', $request->input('facebook_id'))->first();

            if ($user) {
                return Response::json(['error' => 'User already exists'], 409);
            }

            // Create a new user
            $user = new User();
            // $user->first_name = $request->input('first_name');
            // $user->last_name = $request->input('last_name');
            $user->password = Hash::make('passowrd123');
            $user->register_via = 'facebook';
            $user->email = $email;
            $user->facebook_id = $request->input('facebook_id');
            $user->api_token = Str::random(60);
            $user->save();
            $token = $user->createToken('token')->plainTextToken;


            // Return the user data
            return Response::json([
                'register_via' => $user->register_via,
                'facebook_id' => $user->facebook_id,
                'token' => $token,
                'message' => 'User registered successfully'
            ], 201);
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }


    // api for google signup
    public function googleRegister(Request $request)
    {
        try {
            // Validate input
            $request->validate([

                'google_id' => 'required|unique:users',
            ]);

            $email = $request->input('email', null);

            // Check if the user already exists
            $user = User::where('google_id', $request->input('google_id'))->first();

            if ($user) {
                return Response::json(['error' => 'User already exists'], 409);
            }

            // Create a new user
            $user = new User();
            // $user->first_name = $request->input('first_name');
            // $user->last_name = $request->input('last_name');
            $user->password = Hash::make('passowrd123');
            $user->register_via = 'google';
            $user->email = $email;
            $user->google_id = $request->input('google_id');
            $user->api_token = Str::random(60);
            $user->save();
            $token = $user->createToken('token')->plainTextToken;


            // Return the user data
            return Response::json([
                'register_via' => $user->register_via,
                'google_id' => $user->google_id,
                'token' => $token,
                'message' => 'User registered successfully'
            ], 201);
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }

    // api for apple signup
    public function appleRegister(Request $request)
    {
        try {
            // Validate input
            $request->validate([

                'apple_id' => 'required|unique:users',
            ]);

            $email = $request->input('email', null);

            // Check if the user already exists
            $user = User::where('apple_id', $request->input('apple_id'))->first();

            if ($user) {
                return Response::json(['error' => 'User already exists'], 409);
            }

            // Create a new user
            $user = new User();
            // $user->first_name = $request->input('first_name');
            // $user->last_name = $request->input('last_name');
            $user->password = Hash::make('passowrd123');
            $user->register_via = 'apple';
            $user->email = $email;
            $user->apple_id = $request->input('apple_id');
            $user->api_token = Str::random(60);
            $user->save();
            $token = $user->createToken('token')->plainTextToken;


            // Return the user data
            return Response::json([
                'register_via' => $user->register_via,
                'google_id' => $user->apple_id,
                'token' => $token,
                'message' => 'User registered successfully'
            ], 201);
        } catch (Exception $e) {
            return Response::json(['error' => $e->getMessage()], 500);
        }
    }



    // get tutorial video
    public function tutorial_video()
    {
        $response = array();
        $data['tutrialVideos'] = \App\TutrialVideos::where('status', 1)->get();
        // $response['message'] = 'Fitness Goal Data Loaded';
        $response['Data'] = $data;
        return Response::json($response, 200);
    }



    // show courses according to category 
    public function showCoursesAccordingCat()
    {

        $courses = CourseCategory::where('status', 1)
            ->with('courses')
            ->get();

        return response()->json([
            'category_courses' => $courses
        ], 200);
    }

    // show course by id
    public function showCourseById(Request $request)
    {
        try {
            $this->validate($request, [
                'course_id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->errors(),
            ], 422);
        }

        $course_id = $request->input('course_id');
        $course = Courses::findOrFail($course_id);
        // $trainerName = $course->trainer->name;
        $courseEquipments = CourseEquipments::with('equipment')->where('course_id', $course_id)->get()->pluck('equipment')->pluck('name');

        // Check if there are no course equipments
        if ($courseEquipments->isEmpty()) {
            $courseEquipments = null;
        }

        return response()->json([
            'course' => [
                'image' => $course->image,
                'trainer_name' => $course->trainer->name,
                'total_week' => $course->total_weeks,
                'week_a_day' => $course->week_a_days,
                'title' => $course->title,
                'description' => $course->description,
                'equipment' => $courseEquipments
            ]
        ]);
    }
}
