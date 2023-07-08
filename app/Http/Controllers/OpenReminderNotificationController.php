<?php

namespace App\Http\Controllers;

use App\OpenReminderNotification;
use App\User;
use Illuminate\Http\Request;
use App\Events\OpenReminderNotificationEvent;
use Carbon\Carbon;
use Sentinel;

class OpenReminderNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Sentinel::getUser();
        $notifications = OpenReminderNotification::where('user_id', $user->id)->orderBy('date', 'ASC')->get();
        return view('admin.notification.open-reminder.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.open-reminder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('days')) {
            $user = Sentinel::getUser();
            $days = $request->days;
            foreach ($days as $day) {
                
                if (Carbon::toDay()->format('l') == $day) {
                    $date = Carbon::toDay()->toDateString();
                }
                else {
                    $date = $this->date_from_day($day);
                }

                $time = $request->time;
                $duration = $request->duration;
                $term = $request->term;
                $text = $request->notification_text;

                if ($term == 'Month') {
                    $duration = $duration * 4;
                }
                for ($i=0; $i < $duration ; $i++) { 
                    if ($i !=  0) {
                        $date = Carbon::createFromFormat('Y-m-d', $date)->addDays(7)->toDateString();
                    }

                    $open_reminder = new OpenReminderNotification;
                    $open_reminder->user_id = $user->id;
                    $open_reminder->day = $day;
                    $open_reminder->notification_text = $text;
                    $open_reminder->term = $term;
                    $open_reminder->duration = $duration;
                    $open_reminder->date = Carbon::createFromFormat('Y-m-d H:i:s', $date.' '.$time.':00');
                    $open_reminder->save();
                }
            }

            return redirect()->route('admin.openreminder.index')->with('success', 'Notifications Saved.');
        }
        else {
            return back()->with('error', 'Please select at least a day.');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\OpenReminderNotification  $openReminderNotification
     * @return \Illuminate\Http\Response
     */
    public function show(OpenReminderNotification $openReminderNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OpenReminderNotification  $openReminderNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(OpenReminderNotification $openReminderNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OpenReminderNotification  $openReminderNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpenReminderNotification $openReminderNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OpenReminderNotification  $openReminderNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = OpenReminderNotification::find($id);
        if (!is_null($notification)) {
            $notification->delete();
            return redirect()->route('admin.openreminder.index')->with('success', 'Notification deleted.');
        }
        else {
            return back()->with('error', 'Notification Not Found!');
        }
    }
}
