<?php

namespace App\Http\Controllers;

use App\Banner;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Sentinel;
use Image;
use File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'nullable',
            'image' => 'required',
            'link' => 'required',
        ]);
        $banner = new Banner;
        $banner->link = $request->link;
        // image save
        if ($request->image){
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('assets/images/banner/'. $img);
            Image::make($image)->save($location);
            $banner->image = $img;
        }
        $banner->save();
        if ($banner->id) {
            return redirect()->route('admin.banner.create')->with('success', trans('banner/message.success.create'));
        } else {
            return redirect()->route('admin.banner.create')->withInput()->with('error', trans('banner/message.error.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        if (!is_null($banner)) {
            return view('admin.banner.edit', compact('banner'));
        }
        else {
            return redirect()->route('admin.banner.index')->withInput()->with('error', trans('banner/message.banner_not_found'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        if (!is_null($banner)) {
            $this->validate($request, [
                'title' => 'nullable',
                'image' => 'nullable',
                'link' => 'required',
            ]);
            $banner->link = $request->link;
            // image save
            if ($request->image){
                if (File::exists('assets/images/banner/'.$banner->image)){
                    File::delete('assets/images/banner/'.$banner->image);
                }
                $image = $request->file('image');
                $img = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('assets/images/banner/'. $img);
                Image::make($image)->save($location);
                $banner->image = $img;
            }
            $banner->save();
            return redirect()->route('admin.banner.index')->with('success', trans('banner/message.success.update'));
        }
        else {
            return redirect()->route('admin.banner.index')->withInput()->with('error', trans('banner/message.banner_not_found'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (!is_null($banner)) {
            if (File::exists('assets/images/banner/'.$banner->image)){
                File::delete('assets/images/banner/'.$banner->image);
            }
            $banner->delete();
            return redirect()->route('admin.banner.index')->with('success', trans('banner/message.success.delete'));
        }
        else {
            return redirect()->route('admin.banner.index')->withInput()->with('error', trans('banner/message.banner_not_found'));
        }
    }
}
