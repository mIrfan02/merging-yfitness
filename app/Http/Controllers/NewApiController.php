<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\User;
use App\Courses;
use App\UserCourseLogbook;
use App\UserFriend;
use App\PushNotification;
use App\OpenReminderNotification;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Message;

class NewApiController extends Controller
{
    public function banners()
    {
        $banners = Banner::all();
        return response()->json([
            'data' => $banners
        ]);
    }

    public function banner_show($id)
    {
        $banner = Banner::find($id);
        if (!is_null($banner)) {
            return response()->json([
                'data' => [
                    'id' => (string) $banner->id,
                    'image' => $banner->image,
                    'link' => $banner->link,
                    'created_at' => (string) $banner->created_at,
                    'updated_at' => (string) $banner->updated_at,
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }
    }

    public function banner_create(Request $request)
    {
        $banner = new Banner;
        $banner->image = $request->image;
        $banner->link = $request->link;
        $banner->title = $request->title;
        $banner->save();
        return $banner;
    }

    public function banner_update(Request $request, $id)
    {
        $banner = Banner::find($id);
        if (!is_null($banner)) {
            $banner->link = $request->link;
            $banner->save();
            return response()->json([
                'data' => [
                    'id' => (string) $banner->id,
                    'image' => $banner->image,
                    'link' => $banner->link,
                    'created_at' => (string) $banner->created_at,
                    'updated_at' => (string) $banner->updated_at,
                ]
            ]);
        } else {
            return 404;
        }
    }

    public function banner_delete(Request $request, $id)
    {
        $banner = Banner::find($id);
        if (!is_null($banner)) {
            $banner->delete();
            return response()->json([
                'message' => 'Banner delete successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }
    }

    public function pushnotifications()
    {
        $notifications = PushNotification::all();
        return response()->json([
            'data' => $notifications
        ]);
    }

    public function pushnotification_show($id)
    {
        $pushnotification = PushNotification::find($id);
        if (!is_null($pushnotification)) {
            return response()->json([
                'data' => [
                    'id' => (string) $pushnotification->id,
                    'gender' => $pushnotification->gender,
                    'language' => $pushnotification->language,
                    'age_range' => $pushnotification->age_range,
                    'fitness_goal_id' => $pushnotification->fitness_goal_id,
                    'date' => $pushnotification->date,
                    'course_id' => $pushnotification->course_id,
                    'link' => $pushnotification->link,
                    'notification_text' => $pushnotification->notification_text,
                    'is_sent' => $pushnotification->is_sent,
                    'created_at' => (string) $pushnotification->created_at,
                    'updated_at' => (string) $pushnotification->updated_at,
                ]
            ]);
        } else {
            return 404;
        }
    }

    public function pushnotification_create(Request $request)
    {
        $pushnotification = new PushNotification;
        $pushnotification->gender = $request->gender;
        $pushnotification->language = $request->language;
        $pushnotification->age_range = $request->age_range;
        $pushnotification->fitness_goal_id = $request->fitness_goal_id;
        $pushnotification->date = $request->date;
        $pushnotification->course_id = $request->course_id;
        $pushnotification->link = $request->link;
        $pushnotification->notification_text = $request->notification_text;
        $pushnotification->save();
        return $pushnotification;
    }

    public function pushnotification_update(Request $request, $id)
    {
        $pushnotification = PushNotification::find($id);
        if (!is_null($pushnotification)) {
            if ($request->has('gender')) {
                $pushnotification->gender = $request->gender;
            }
            if ($request->has('language')) {
                $pushnotification->language = $request->language;
            }
            if ($request->has('age_range')) {
                $pushnotification->age_range = $request->age_range;
            }
            if ($request->has('fitness_goal_id')) {
                $pushnotification->fitness_goal_id = $request->fitness_goal_id;
            }
            if ($request->has('date')) {
                $pushnotification->date = $request->date;
            }
            if ($request->has('course_id')) {
                $pushnotification->course_id = $request->course_id;
            }
            if ($request->has('link')) {
                $pushnotification->link = $request->link;
            }
            if ($request->has('notification_text')) {
                $pushnotification->notification_text = $request->notification_text;
            }
            $pushnotification->save();
            return response()->json([
                'data' => [
                    'id' => (string) $pushnotification->id,
                    'gender' => $pushnotification->gender,
                    'language' => $pushnotification->language,
                    'age_range' => $pushnotification->age_range,
                    'fitness_goal_id' => $pushnotification->fitness_goal_id,
                    'date' => $pushnotification->date,
                    'course_id' => $pushnotification->course_id,
                    'link' => $pushnotification->link,
                    'notification_text' => $pushnotification->notification_text,
                    'is_sent' => $pushnotification->is_sent,
                    'created_at' => (string) $pushnotification->created_at,
                    'updated_at' => (string) $pushnotification->updated_at,
                ]
            ]);
        } else {
            return 404;
        }
    }

    public function pushnotification_delete(Request $request, $id)
    {
        $pushnotification = PushNotification::find($id);
        if (!is_null($pushnotification)) {
            $pushnotification->delete();
            return response()->json([
                'message' => 'delete successfully'
            ], 204);
        } else {
            return response()->json(['message' => 'not found'], 404);
        }
    }

    public function openreminders()
    {
        $notifications = OpenReminderNotification::all();
        return response()->json([
            'data' => $notifications
        ]);
    }

    public function openreminders_by_user($id)
    {
        $notifications = OpenReminderNotification::where('user_id', $id)->get();
        return response()->json([
            'data' => $notifications
        ]);
    }

    public function openreminder_show($id)
    {
        $notification = OpenReminderNotification::find($id);
        if (!is_null($notification)) {
            return response()->json([
                'data' => [
                    'id' => (string) $notification->id,
                    'user_id' => (string) $notification->user_id,
                    'day' => $notification->day,
                    'notification_text' => $notification->notification_text,
                    'date' => $notification->date,
                    'duration' => $notification->duration,
                    'term' => $notification->term,
                    'is_sent' => $notification->is_sent,
                    'created_at' => (string) $notification->created_at,
                    'updated_at' => (string) $notification->updated_at,
                ]
            ]);
        } else {
            return 404;
        }
    }

    public function openreminder_create(Request $request)
    {
        if ($request->has('days')) {
            $user_id = $request->user_id;
            $days = $request->days;
            foreach ($days as $day) {

                if (Carbon::toDay()->format('l') == $day) {
                    $date = Carbon::toDay()->toDateString();
                } else {
                    $date = $this->date_from_day($day);
                }

                $time = $request->time;
                $duration = $request->duration;
                $term = $request->term;
                $text = $request->notification_text;

                if ($term == 'Month') {
                    $duration = $duration * 4;
                }
                for ($i = 0; $i < $duration; $i++) {
                    if ($i !=  0) {
                        $date = Carbon::createFromFormat('Y-m-d', $date)->addDays(7)->toDateString();
                    }

                    $open_reminder = new OpenReminderNotification;
                    $open_reminder->user_id = $user_id;
                    $open_reminder->day = $day;
                    $open_reminder->notification_text = $text;
                    $open_reminder->term = $term;
                    $open_reminder->duration = $duration;
                    $open_reminder->date = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time . ':00');
                    $open_reminder->save();
                }
            }

            return $this->openreminders_by_user($request->user_id);
        } else {
            return 'Days can not be empty';
        }
    }

    public function date_from_day($day)
    {
        $date = '';
        if ($day == 'Saturday') {
            $date = Carbon::now()->next(Carbon::SATURDAY)->toDateString();
        }
        if ($day == 'Sunday') {
            $date = Carbon::now()->next(Carbon::SUNDAY)->toDateString();
        }
        if ($day == 'Monday') {
            $date = Carbon::now()->next(Carbon::MONDAY)->toDateString();
        }
        if ($day == 'Tuesday') {
            $date = Carbon::now()->next(Carbon::TUESDAY)->toDateString();
        }
        if ($day == 'Wednesday') {
            $date = Carbon::now()->next(Carbon::WEDNESDAY)->toDateString();
        }
        if ($day == 'Thursday') {
            $date = Carbon::now()->next(Carbon::THURSDAY)->toDateString();
        }
        if ($day == 'Friday') {
            $date = Carbon::now()->next(Carbon::FRIDAY)->toDateString();
        }
        return $date;
    }

    public function openreminder_update(Request $request, $id)
    {
        $notification = OpenReminderNotification::find($id);
        if (!is_null($notification)) {

            if ($request->has('date')) {
                $notification->date = $request->date;
            }
            if ($request->has('notification_text')) {
                $notification->notification_text = $request->notification_text;
            }
            $notification->save();
            return response()->json([
                'data' => [
                    'id' => (string) $notification->id,
                    'user_id' => (string) $notification->user_id,
                    'day' => $notification->day,
                    'notification_text' => $notification->notification_text,
                    'date' => $notification->date,
                    'duration' => $notification->duration,
                    'term' => $notification->term,
                    'is_sent' => $notification->is_sent,
                    'created_at' => (string) $notification->created_at,
                    'updated_at' => (string) $notification->updated_at,
                ]
            ]);
        } else {
            return 404;
        }
    }

    public function openreminder_delete(Request $request, $id)
    {
        $notification = OpenReminderNotification::find($id);
        if (!is_null($notification)) {
            $notification->delete();
            return 204;
        } else {
            return 404;
        }
    }

    public function courselogbooks()
    {
        $notifications = UserCourseLogbook::all();
        return response()->json([
            'data' => $notifications
        ]);
    }

    public function courselogbooks_by_user($id)
    {
        $notifications = UserCourseLogbook::where('user_id', $id)->get();
        return response()->json([
            'data' => $notifications
        ]);
    }

    public function courselogbook_show($id)
    {
        $notification = UserCourseLogbook::find($id);
        if (!is_null($notification)) {
            return response()->json([
                'data' => [
                    'id' => (string) $notification->id,
                    'user_id' => (string) $notification->user_id,
                    'course_id' => $notification->course_id,
                    'notification_text' => $notification->notification_text,
                    'date' => $notification->date,
                    'day' => $notification->day,
                    'link' => $notification->link,
                    'is_sent' => $notification->is_sent,
                    'created_at' => (string) $notification->created_at,
                    'updated_at' => (string) $notification->updated_at,
                ]
            ]);
        } else {
            return 404;
        }
    }

    public function courselogbook_create(Request $request)
    {
        $course = Courses::find($request->course_id);
        if (!is_null($course)) {
            if ($request->has('days')) {
                if (count($request->days) == $course->week_a_days) {
                    $user_id = $request->user_id;
                    $days = $request->days;
                    foreach ($days as $day) {

                        if (Carbon::toDay()->format('l') == $day) {
                            $date = Carbon::toDay()->toDateString();
                        } else {
                            $date = $this->date_from_day($day);
                        }

                        $time = $request->time;
                        $text = $request->notification_text;

                        for ($i = 0; $i < $course->total_weeks; $i++) {
                            if ($i !=  0) {
                                $date = Carbon::createFromFormat('Y-m-d', $date)->addDays(7)->toDateString();
                            }

                            $course_logbook = new UserCourseLogbook;
                            $course_logbook->user_id = $user_id;
                            $course_logbook->course_id = $course->id;
                            $course_logbook->day = $day;
                            $course_logbook->notification_text = $text;
                            $course_logbook->date = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $time . ':00');
                            $course_logbook->save();
                        }
                    }

                    return $this->courselogbooks_by_user($user_id);
                } else {
                    return 'Please select ' . $course->week_a_days . ' days';
                }
            } else {
                return back()->with('error', 'Please select ' . $course->week_a_days . ' days');
            }
        } else {
            return 404;
        }
    }

    public function courselogbook_update(Request $request, $id)
    {
        $notification = UserCourseLogbook::find($id);
        if (!is_null($notification)) {

            if ($request->has('date')) {
                $notification->date = $request->date;
            }
            if ($request->has('notification_text')) {
                $notification->notification_text = $request->notification_text;
            }
            if ($request->has('link')) {
                $notification->link = $request->link;
            }
            $notification->save();
            return response()->json([
                'data' => [
                    'id' => (string) $notification->id,
                    'user_id' => (string) $notification->user_id,
                    'course_id' => $notification->course_id,
                    'notification_text' => $notification->notification_text,
                    'date' => $notification->date,
                    'day' => $notification->day,
                    'link' => $notification->link,
                    'is_sent' => $notification->is_sent,
                    'created_at' => (string) $notification->created_at,
                    'updated_at' => (string) $notification->updated_at,
                ]
            ]);
        } else {
            return 404;
        }
    }

    public function courselogbook_delete(Request $request, $id)
    {
        $notification = UserCourseLogbook::find($id);
        if (!is_null($notification)) {
            $notification->delete();
            return response()->json([
                'message' => 'successfully delete'
            ], 204);
        } else {
            return response()->json([
                'message' => 'not found'
            ], 404);
        }
    }

    public function friendrequests_by_user($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $new_friends = UserFriend::where('user_id', $user->id)->where('is_accepted', NULL)->where('is_rejected', NULL)->get();
            return response()->json([
                'data' => $new_friends
            ]);
        } else {
            return 404;
        }
    }

    public function friendrequest_accept($id)
    {
        $friend_request = UserFriend::find($id);
        if (!is_null($friend_request)) {
            $friend_request->is_accepted = 1;
            $friend_request->save();
            $make_friend = new UserFriend;
            $make_friend->user_id = $friend_request->friend_id;
            $make_friend->friend_id = $friend_request->user_id;
            $make_friend->is_accepted = 1;
            $make_friend->save();
            return response()->json([
                'data' => $friend_request
            ]);
        } else {
            return 404;
        }
    }

    public function friendrequest_reject($id)
    {
        $friend_request = UserFriend::find($id);
        if (!is_null($friend_request)) {
            $friend_request->is_rejected = 1;
            $friend_request->save();
            return response()->json([
                'data' => $friend_request
            ]);
        } else {
            return 404;
        }
    }

    public function user_search(Request $request)
    {
        $query = $request->search;
        $users = User::where('first_name', 'LIKE', '%' . $query . '%')->orWhere('last_name', 'LIKE', '%' . $query . '%')->orWhere('email', 'LIKE', '%' . $query . '%')->orWhere('id', $query)->get();
        return response()->json([
            'data' => [
                'user' => $users
            ]
        ]);
    }
}
