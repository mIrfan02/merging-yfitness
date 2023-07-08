<?php

namespace App\Http\Controllers;

use App\PushNotification;
use App\User;
use App\Courses;
use App\FitnessGoals;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = PushNotification::orderBy('date', 'ASC')->get();
        return view('admin.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Courses::where('status', 1)->get(['id', 'title']);
        $goals = FitnessGoals::where('status', 1)->get(['id', 'name']);
        return view('admin.notification.create', compact('goals', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $push_notification = new PushNotification;
        $push_notification->gender = $request->gender;
        $push_notification->language = $request->language;
        $push_notification->age_range = $request->age_range;
        $push_notification->fitness_goal_id = $request->fitness_goal_id;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $request->date.' '.$request->time.':00');
        $push_notification->date = $date;
        $push_notification->course_id = $request->course_id;
        $push_notification->link = $request->link;
        $push_notification->notification_text = $request->notification_text;
        $push_notification->save();
        if ($push_notification->id) {
            return redirect()->route('admin.pushnotification.create')->with('success', trans('notification/message.success.create'));
        } else {
            return redirect()->route('admin.pushnotification.create')->withInput()->with('error', trans('notification/message.error.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification =PushNotification::find($id);
        if (!is_null($notification)) {
            $notification->delete();
            return redirect()->route('admin.pushnotification.index')->with('success', 'Notification Deleted');
        }
        else {
            return back()->with('error', 'Notification Not Found!');
        }
    }
}
