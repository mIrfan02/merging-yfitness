<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use View;
use File;
use Illuminate\Support\Str;




class SettingsController extends Controller
{
    public function fitnessGoals()
    {
        $categories = \App\FitnessGoals::get();
        return view('admin/settings/fitnessgoals', compact('categories'));
    }
    public function postFitnessGoals(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $Record = new \App\FitnessGoals();
        $Record->name = $request->get('title');
        $Record->status = 1;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $Record->img = 'uploads/' . $imageName;
        }
    
        if ($Record->save()) {
            return redirect()->back()->with('success', 'Added');
        }
    
        return redirect()->back()->withInput()->with('error', 'Something went wrong');
    }
    
   

    public function postUpdateFitnessGoals(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'new_image' => 'nullable|image',
        ]);
        
        $Record = \App\FitnessGoals::find($id);
        $Record->name = $request->get('title');
        $Record->status = 1;
    
        if ($request->hasFile('new_image')) {
         
            $image = $request->file('new_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $Record->img = 'uploads/' . $imageName;
        }
        if ($Record->save()) {
            return redirect()->back()->with('success', 'Updated');
        }
    
        return redirect()->back()->withInput()->with('error', 'Something went wrong');
    }
    
    public function postUpdateFitnessGoalsStatus($id, $action)
    {
        $Record =  \App\FitnessGoals::find($id);
        $Record->status  = $action;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Status Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function equipments()
    {
        $categories = \App\Equipments::get();
        return view('admin/settings/equipments', compact('categories'));
    }
    public function postEquipments(Request $request)
    {
        $Record = new \App\Equipments();
        $Record->name            = $request->get('title');
        $Record->status           = 1;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Added');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateEquipments(Request $request, $id)
    {
        $Record = \App\Equipments::find($id);
        $Record->name            = $request->get('title');
        $Record->status           = 1;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateEquipmentsStatus($id, $action)
    {
        $Record = \App\Equipments::find($id);
        $Record->status           = $action;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'status updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function tutrial()
    {
        $TutrialVideos = \App\TutrialVideos::get();
        return view('admin/settings/tutrials', compact('TutrialVideos'));
    }
    public function posTutrial(Request $request)
    {
        $Record = new \App\TutrialVideos();
        // is new image uploaded?
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/tutrial/';
            $destinationPath = public_path() . $folderName;
            $safeName = str::random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //delete old pic if exists
            if (File::exists(public_path() . $folderName . $Record->pic)) {
                File::delete(public_path() . $folderName . $Record->pic);
            }

            //save new file path into db
            $Record->thumbnail = $folderName . $safeName;
        }
        $Record->caption    = $request->get('caption');
        if ($file = $request->file('video')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'mp4';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str::random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Record->video_url = $folderName . $safeName;
        }
        $Record->status     = 1;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Added');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateTutrial(Request $request, $id)
    {
        $Record =  \App\TutrialVideos::find($id);
        // is new image uploaded?
        if ($file = $request->file('pic')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/tutrial/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);

            //delete old pic if exists
            if (File::exists(public_path() . $folderName . $Record->pic)) {
                File::delete(public_path() . $folderName . $Record->pic);
            }

            //save new file path into db
            $Record->thumbnail = $folderName . $safeName;
        }
        $Record->caption    = $request->get('caption');
        if ($file = $request->file('video')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'mp4';
            $folderName = '/uploads/courses/';
            $destinationPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $Record->video_url = $safeName;
        }
        $Record->status     = 1;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdateTutrialStatus($id, $action)
    {
        $Record =  \App\TutrialVideos::find($id);
        $Record->status           = $action;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Status Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function subscriptions()
    {
        $Subscriptions = \App\Subscriptions::get();
        return view('admin/settings/subscriptions', compact('Subscriptions'));
    }
    public function postsubScriptions(Request $request)
    {
        $Record = new \App\Subscriptions();
        $Record->title    = $request->get('title');
        $Record->per_month_fee  = $request->get('per_month_fee');
        $Record->total_fee  = $request->get('total_fee');
        $Record->status     = 1;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Added');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdatesubScriptions(Request $request, $id)
    {
        $Record = \App\Subscriptions::find($id);
        $Record->title    = $request->get('title');
        $Record->per_month_fee  = $request->get('per_month_fee');
        $Record->total_fee  = $request->get('total_fee');
        $Record->status     = 1;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'Updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
    public function postUpdatesubScriptionsStatus($id, $action)
    {
        $Record = \App\Subscriptions::find($id);
        $Record->status           = $action;
        if ($Record->save() == true) {
            return Redirect::back()->with('success', 'status updated');
        }
        return Redirect::back()->withInput()->with('error', 'Something Wrong');
    }
}