<?php

namespace App\Http\Controllers;

use App\UserPushNotification;
use Illuminate\Http\Request;

class UserPushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserPushNotification  $userPushNotification
     * @return \Illuminate\Http\Response
     */
    public function show(UserPushNotification $userPushNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserPushNotification  $userPushNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPushNotification $userPushNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserPushNotification  $userPushNotification
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $notification = UserPushNotification::find($id);
        $notification->is_seen = 1;
        $notification->save();
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPushNotification  $userPushNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPushNotification $userPushNotification)
    {
        //
    }
}
