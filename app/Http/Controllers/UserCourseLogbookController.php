<?php

namespace App\Http\Controllers;

use App\UserCourseLogbook;
use App\Courses;
use App\UserCourseSchedule;
use App\User;
use Illuminate\Http\Request;
use App\Events\CourseLogbookEvent;
use Carbon\Carbon;
use Sentinel;

class UserCourseLogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("checking");
        $user = Sentinel::getUser();
        $notifications = UserCourseLogbook::where('user_id', $user->id)->orderBy('date', 'ASC')->get();
        // dd($notifications);
        return view('admin.notification.course-logbook.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Sentinel::getUser();
        $course_ids = UserCourseSchedule::where('user_id', $user->id)->pluck('course_id')->toArray();
        $courses = Courses::whereIn('id', $course_ids)->get();
        return view('admin.notification.course-logbook.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Courses::find($request->course_id);
        if (!is_null($course)) {
            if ($request->has('days')) {
                if (count($request->days) == $course->week_a_days) {
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
                        $text = $request->notification_text;

                        for ($i=0; $i < $course->total_weeks ; $i++) { 
                            if ($i !=  0) {
                                $date = Carbon::createFromFormat('Y-m-d', $date)->addDays(7)->toDateString();
                            }

                            $course_logbook = new UserCourseLogbook;
                            $course_logbook->user_id = $user->id;
                            $course_logbook->course_id = $course->id;
                            $course_logbook->day = $day;
                            $course_logbook->notification_text = $text;
                            $course_logbook->date = Carbon::createFromFormat('Y-m-d H:i:s', $date.' '.$time.':00');
                            $course_logbook->save();
                        }
                    }

                    return redirect()->route('admin.courselogbook.index')->with('success', 'Notifications Saved.');
                }
                else {
                    return back()->with('error', 'Please select '. $course->week_a_days . ' days');
                }
            }
            else {
                return back()->with('error', 'Please select '. $course->week_a_days . ' days');
            }
        }
        else {
            return back()->with('error', 'Course Not Found.');
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
     * @param  \App\UserCourseLogbook  $userCourseLogbook
     * @return \Illuminate\Http\Response
     */
    public function show(UserCourseLogbook $userCourseLogbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserCourseLogbook  $userCourseLogbook
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCourseLogbook $userCourseLogbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserCourseLogbook  $userCourseLogbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCourseLogbook $userCourseLogbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserCourseLogbook  $userCourseLogbook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = UserCourseLogbook::find($id);
        if (!is_null($notification)) {
            $notification->delete();
            return redirect()->route('admin.courselogbook.index')->with('success', 'Notification deleted.');
        }
        else {
            return back()->with('error', 'Notification Not Found!');
        }
    }
}