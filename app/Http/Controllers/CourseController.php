<?php

namespace App\Http\Controllers;

use App\CourseVideo;
use Illuminate\Http\Request;
use Redirect;
use Sentinel;
use View;
use File;
use Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;



class CourseController extends Controller
{


    

    public function addVideo(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'week' => 'required',
            'day' => 'required',
            'pic' => 'required',
            'title'=>'required',
            'video' => 'required',
        ], [
            'pic.required' => 'The image field is required.',
            'video.required' => 'The video field is required.',
        ]);
        
        $courseId = $request->input('course_id');
        $week = $request->input('week');
        $day = $request->input('day');
        $pic = $request->file('pic');
        $video = $request->file('video');
        $title=$request->input('title');
        // Check if pic file is uploaded
        if ($pic) {
            
            $picFileName = $pic->getClientOriginalName();
            $pic->move(public_path('uploads'), $picFileName);
             $picFilePath = 'uploads/' . $picFileName;
        } else {
            
            $picFilePath = null;
        }
    
        // Check if video file is uploaded
        if ($video) {
            $videoFileName = $video->getClientOriginalName();
            $video->move(public_path('uploads'), $videoFileName);
            $videoFilePath = 'uploads/' . $videoFileName;
        } else {
            $videoFilePath = null;
        }
    
        // Create or update the CourseVideo instance
         CourseVideo::updateOrCreate(
            ['course_id' => $courseId, 'week' => $week, 'day' => $day],
            ['img' => $picFilePath, 'video' => $videoFilePath,'title'=>$title]
            
        );
    
        return redirect()->back()->with('success', 'Video added successfully');
    }
    
    
    public function DisplayVideo(){
        $videos = CourseVideo::all();
    
        return view('admin.courses.addDayActitivity', compact('videos'));
    }
    
   



    public function trainerCourses()
    {
        $courses = \App\Courses::where('trainer_id', Sentinel::getUser()->id)->get();
        $Equipments = \App\Equipments::where('status', 1)->get();
        return view('courses.index', compact('courses', 'Equipments'));
    }
    public function addDayActivityForm($courseId)
    {
        $course = \App\Courses::find($courseId);
        return view('courses.addDayActivity', compact('course'));
    }
    public function addAdminDayActivityForm($courseId)
    {
        $course = \App\Courses::find($courseId);
        $videos = CourseVideo::all();
        return view('admin.courses.addDayActivity', compact('course','videos'));
    }
    public function index()
    {
        $courses = \App\Courses::all();
        $Equipments = \App\Equipments::where('status', 1)->get();
        return view('admin.courses.index', compact('courses', 'Equipments'));
    }
    public function subscribeCourses($userId)
    {
        $user = Sentinel::findById($userId);
        $courses = \App\Courses::join('user_course_schedule as cs', 'cs.course_id', '=', 'courses.id')->where('cs.user_id', $userId)->get();
        $Equipments = \App\Equipments::where('status', 1)->get();
        return view('admin.courses.index', compact('courses', 'Equipments', 'user'));
    }
    public function trainingCourses($userId)
    {
        $user = Sentinel::findById($userId);
        $courses = \App\Courses::where('trainer_id', $userId)->get();
        $Equipments = \App\Equipments::where('status', 1)->get();
        return view('admin.courses.index', compact('courses', 'Equipments', 'user'));
    }
    public function saveDayActivity(Request $request)
    {
        $data = [];
        $data['course_id'] = $request->get('course_id');
        $data['week'] = $request->get('week');
        $data['day'] = $request->get('day');
        $data['detail'] = $request->get('detail');
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = rand(000000000, 999999999) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $data['image'] =  $safeName;
        }
        \App\CourseDayActivity::create($data);
        return Redirect::back()->with('success', 'Added');
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video' => 'required',
            // Add other validation rules for your form fields
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $Courses = new \App\Courses();
        $Courses->title                 = $request->get('title');
        if ($request->get('trainer_id') != 0) {
            $Courses->trainer_id            = $request->get('trainer_id');
        }
        $Courses->description           = $request->get('description');
        $Courses->daystocompletion      = $request->get('dayscompletion');
        $Courses->total_weeks           = $request->get('total_weeks');
        $Courses->week_a_days           = $request->get('week_a_days');
        $Courses->stepdescription       = $request->get('stepdescription');
        if ($file = $request->file('video')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'mp4';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str::random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Courses->video = $folderName . $safeName;
        }
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str::random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Courses->image = $folderName . $safeName;
        }
        if ($Courses->save() == true) {
            $Listing = new \App\CourseListing();
            $Listing->course_id = $Courses->id;
            $Listing->parent_cat_id    = $request->get('parent_category');
            $Listing->cat_id    = $request->get('category');
            $Listing->save();
            return Redirect::back()->with('success', 'Added');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateCourse(Request $request, $id)
    {
        $Courses =  \App\Courses::find($id);
        $Courses->title                 = $request->get('title');
        if ($request->get('trainer_id') != 0) {
            $Courses->trainer_id            = $request->get('trainer_id');
        }
        $Courses->description           = $request->get('description');
        $Courses->daystocompletion      = $request->get('dayscompletion');
        $Courses->total_weeks           = $request->get('total_weeks');
        $Courses->week_a_days           = $request->get('week_a_days');
        if ($file = $request->file('video')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'mp4';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Courses->video = $folderName . $safeName;
        }
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Courses->image = $folderName . $safeName;
        }
        if ($Courses->save() == true) {
            $Listing =  \App\CourseListing::where('course_id', $id)->first();
            if (!$Listing) $Listing = new \App\CourseListing();
            $Listing->parent_cat_id    = $request->get('parent_category');
            $Listing->cat_id    = $request->get('category');
            $Listing->save();
            return Redirect::back()->with('success', 'Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateCourseStatus($id, $action)
    {
        $Courses =  \App\Courses::find($id);
        $Courses->status = $action;
        if ($Courses->save() == true) {
            return Redirect::back()->with('success', 'Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function categorySave(Request $request)
    {
        $Courses = new \App\CourseCategory();
        $Courses->title                 = $request->get('title');
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Courses->image = $folderName . $safeName;
        }
        if ($Courses->save() == true) {
            return Redirect::back()->with('success', 'Added');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateCategory(Request $request, $id)
    {
        $Courses = \App\CourseCategory::find($id);
        $Courses->title                 = $request->get('title');
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str::random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Courses->image = $folderName . $safeName;
        }
        if ($Courses->save() == true) {
            return Redirect::back()->with('success', 'Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateCategoryStatus($id, $action)
    {
        $Courses = \App\CourseCategory::find($id);
        $Courses->status = $action;
        if ($Courses->save() == true) {
            return Redirect::back()->with('success', 'Status Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function coursEquipments(Request $request)
    {
        if (count($request->get('equipments'))) {
            \App\CourseEquipments::where('course_id', $request->get('course_id'))->delete();
            foreach ($request->get('equipments') as $equipment) {
                $Courses = new \App\CourseEquipments();
                $Courses->course_id     = $request->get('course_id');
                $Courses->equipment_id  = $equipment;
                $Courses->save();
            }
            return Redirect::back()->with('success', 'Equipments Added');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function category()
    {
        $categories = \App\CourseCategory::all();
        return view('admin.courses.category', compact('categories'));
    }


    # Sdek Code Start
    public function day_activity_update(Request $request, $id)
    {
        $activity =  \App\CourseDayActivity::find($id);
        if (!is_null($activity)) {
            $activity->week = $request->week;
            $activity->day = $request->day;
            $activity->detail = $request->detail;
            // image save
            if ($request->image) {
                if (File::exists('uploads/courses/' . $activity->image)) {
                    File::delete('uploads/courses/' . $activity->image);
                }
                $image = $request->file('image');
                $img = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('uploads/courses/' . $img);
                Image::make($image)->save($location);
                $activity->image = $img;
            }
            $activity->save();
            return back()->with('success', 'Course Day Activity updated.');
            dd($activity);
        } else {
            return back()->with('error', 'Day Activity Not Found.');
        }
    }
    # Sdek Code End
}