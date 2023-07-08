<?php namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use App\UserFriend;
use App\UserPushNotification;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Redirect;
use Sentinel;
use URL;
use View;
use Datatables;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Str;
use Auth;
use App\Models\Report;

class UsersController extends JoshController
{





   public function   reports(){
    // dd("kuch");
    $reports = Report::all();
    return view('admin.users.reports',compact('reports'));
   }

   public function blockUser($id)
   {
       $user = User::findOrFail($id);
       $user->status = 1; // Set the status to 1 (blocked)
       $user->save();
       return redirect()->back()->with('success', 'User has been blocked');

       
   }
   public function unblockUser($id)
   {
       $user = User::findOrFail($id);
       $user->status = 0; // Set the status to 0 (unblocked)
       $user->save();
   
       return redirect()->back()->with('success', 'User has been unblocked');
   }
   


    /**
     * Show a list of all the users.
     *
     * @return View
     */
    public function index()
    {
        // Grab users with roles except "admin"
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'admin');
        })->paginate(10);
        
        $roles = DB::table('roles')->select('id', 'name')->get();
    
        // Show the page
        return view('admin.users.index', compact('users', 'roles'));
    }
    

    /*
     * Pass data through ajax call
     */
    public function data()
    {
        if(Sentinel::inRole('customer_service')){
            $users = User::join('role_users as u','u.user_id','=','users.id')->where('u.role_id',2)->get();
        }else{
            $users = User::get(['id', 'first_name', 'last_name', 'email','created_at']);
        }


        return Datatables::of($users)
            ->edit_column('created_at',function(User $user) {
                return $user->created_at->diffForHumans();
            })
            ->add_column('role',function($user){
                return $user->getRoles()[0]->name;

            })
            ->add_column('courses',function($user){
                $links = '';
                if($user->getRoles()[0]->name == 'Trainer'){
                    $links = '<a target = "_blank" href='. url('admin/courses/training_courses', $user->id) .'>Assigned: '.\App\Courses::where('trainer_id',$user->id)->count().'</a>';
                }elseif($user->getRoles()[0]->name == 'User'){
                    $links = '<a target = "_blank" href='. url('admin/courses/subscribe_courses', $user->id) .'>Subscribed: '.\App\UserCourseSchedule::where('user_id',$user->id)->count().'</a>';
                }
                return $links;

            })
            ->add_column('status',function($user){
                if($activation = Activation::completed($user))
                    return 'Activated';
                else
            		return 'Pending';

            })
            ->add_column('actions',function($user) {
                $actions = '<a href='. route('admin.users.show', $user->id) .'><i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view user"></i></a>
                            <a href='. route('admin.users.edit', $user->id) .'><i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="update user"></i></a>';

                if ((Sentinel::getUser()->id != $user->id) && ($user->id != 1)) {
                    $actions .= '<a href='. route('admin.users.confirm-delete', $user->id) .' data-toggle="modal" data-target="#delete_confirm"><i class="livicon" data-name="user-remove" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete user"></i></a>';
                }
                return $actions;
            })
            ->rawColumns(['actions','courses'])
            ->make(true);
    }

    /**
     * Create new user
     *
     * @return View
     */
    public function create()
    {
        // Get all the available groups
        $groups = Sentinel::getRoleRepository()->all();

        $countries = $this->countries;
        // Show the page
        return view('admin.users.create', compact('groups', 'countries'));
    }



//delete user here from all user

public function delete($id)
{
    $user = User::find($id);
    if ($user) {
        $user->delete();
    }

    return redirect()->back();
}
//users whose are deleted will be shown by this
public function deletedUsers()
{
    $deletedUsers = User::onlyTrashed()->get();

    return view('admin.deleted-users', compact('deletedUsers'));
}



    /**
     * User create form processing.
     *
     * @return Redirect
     */
    public function store(UserRequest $request)
    {
        //upload image
        if ($file = $request->file('pic_file')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/users/';
            $destinationPath = public_path() . $folderName;
            $safeName = str::random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            $request['pic'] = $safeName;
        }
        //check whether use should be activated by default or not
        $activate = $request->get('activate') ? true : false;

        try {
            // Register the user
            $user = Sentinel::register($request->except('_token', 'password_confirm', 'group', 'activate', 'pic_file'), $activate);

            //add user to 'User' group
            $role = Sentinel::findRoleById($request->get('group'));
            if ($role) {
                $role->users()->attach($user);
            }
            //check for activation and send activation mail if not activated by default
            if (!$request->get('activate')) {
                // Data to be used on the email view
                $data = array(
                    'user' => $user,
                    'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                );

                // Send the activation code through email
                Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                    $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                    $m->subject('Welcome ' . $user->first_name);
                });
            }

            // Redirect to the home page with success menu
            return redirect()->route('admin.users.index')->with('success', Lang::get('users/message.success.create'));

        } catch (LoginRequiredException $e) {
            $error = Lang::get('admin/users/message.user_login_required');
        } catch (PasswordRequiredException $e) {
            $error = Lang::get('admin/users/message.user_password_required');
        } catch (UserExistsException $e) {
            $error = Lang::get('admin/users/message.user_exists');
        }

        // Redirect to the user creation page
        return Redirect::back()->withInput()->with('error', $error);
    }

    /**
     * User update.
     *
     * @param  int $id
     * @return View
     */
    public function edit(User $user = null)
    {
        // Get this user groups
        $userRoles = $user->getRoles()->pluck('name', 'id')->all();

        // Get a list of all the available groups
        $roles = Sentinel::getRoleRepository()->all();

        $status = Activation::completed($user);

        $countries = $this->countries;

        // Show the page
        return view('admin.users.edit', compact('user', 'roles', 'userRoles', 'countries', 'status'));
    }

    /**
     * User update form processing page.
     *
     * @param  User $user
     * @param UserRequest $request
     * @return Redirect
     */
    public function update(User $user, UserRequest $request)
    {
        if($request->has('pic_file')) {
            $rules = array(
                'pic_file' => 'image|mimes:jpg,jpeg,bmp,png',
            );

            $validator = Validator::make($request->only('pic_file'), $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withInput()->withErrors($validator);
            }
        }
        try {
            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $user->email = $request->get('email');
            $user->dob = $request->get('dob');
            $user->bio = $request->get('bio');
            $user->gender = $request->get('gender');
            $user->country = $request->get('country');
            $user->state = $request->get('state');
            $user->city = $request->get('city');
            $user->address = $request->get('address');
            $user->postal = $request->get('postal');

            if ($password = $request->has('password')) {
                $user->password = Hash::make($request->password);
            }


            // is new image uploaded?
            if ($file = $request->file('pic_file')) {
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/uploads/users/';
                $destinationPath = public_path() . $folderName;
                $safeName = str_random(10) . '.' . $extension;
                $file->move($destinationPath, $safeName);
                //delete old pic if exists
                if (File::exists(public_path() . $folderName . $user->pic)) {
                    File::delete(public_path() . $folderName . $user->pic);
                }

                //save new file path into db
                $user->pic = $safeName;

            }

            //save record
            $user->save();

            // Get the current user groups
            $userRoles = $user->roles()->pluck('id')->all();

            // Get the selected groups
            $selectedRoles = $request->get('groups', array());

            // Groups comparison between the groups the user currently
            // have and the groups the user wish to have.
            $rolesToAdd = array_diff($selectedRoles, $userRoles);
            $rolesToRemove = array_diff($userRoles, $selectedRoles);

            // Assign the user to groups
            foreach ($rolesToAdd as $roleId) {
                $role = Sentinel::findRoleById($roleId);

                $role->users()->attach($user);
            }

            // Remove the user from groups
            foreach ($rolesToRemove as $roleId) {
                $role = Sentinel::findRoleById($roleId);

                $role->users()->detach($user);
            }

            // Activate / De-activate user
            $status = $activation = Activation::completed($user);
            if ($request->get('activate') != $status) {
                if ($request->get('activate')) {
                    $activation = Activation::exists($user);
                    if ($activation) {
                        Activation::complete($user, $activation->code);
                    }
                } else {
                    //remove existing activation record
                    Activation::remove($user);
                    //add new record
                    Activation::create($user);

                    //send activation mail
                    $data = array(
                        'user' => $user,
                        'activationUrl' => URL::route('activate', $user->id, Activation::exists($user)->code),
                    );

                    // Send the activation code through email
                    Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                        $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                        $m->subject('Welcome ' . $user->first_name);
                    });

                }
            }

            // Was the user updated?
            if ($user->save()) {
                // Prepare the success message
                $success = Lang::get('users/message.success.update');

                // Redirect to the user page
                return Redirect::route('admin.users.edit', $user)->with('success', $success);
            }

            // Prepare the error message
            $error = Lang::get('users/message.error.update');
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('user'));
            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }

        // Redirect to the user page
        return Redirect::route('admin.users.edit', $user)->withInput()->with('error', $error);
    }

    /**
     * Show a list of all the deleted users.
     *
     * @return View
     */
    public function getDeletedUsers()
    {
        // Grab deleted users
        $users = User::onlyTrashed()->get();

        // Show the page
        return view('admin.deleted_users', compact('users'));
    }
//restore user
    public function restore($id)
{
    $restoredUser = User::onlyTrashed()->findOrFail($id);
    $restoredUser->restore();

    return redirect()->route('admin.deleted-users')->with('success', 'User has been restored.');
}


// code to delete user permanent from deleted user view
public function permanentDelete($id)
{
    $deletedUser = User::onlyTrashed()->findOrFail($id);
    $deletedUser->forceDelete();

    return redirect()->route('admin.deleted-users')->with('success', 'User has been permanently deleted.');
}



    /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
        $model = 'users';
        $confirm_route = $error = null;
        try {
            // Get user information
            $user = Sentinel::findById($id);

            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = Lang::get('users/message.error.delete');

                return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
            }
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));
            return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        $confirm_route = route('admin.users.delete', ['id' => $user->id]);
        return view('admin.layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id = null)
    {
        try {
            // Get user information
            $user = Sentinel::findById($id);

            // Check if we are not trying to delete ourselves
            if ($user->id === Sentinel::getUser()->id) {
                // Prepare the error message
                $error = Lang::get('admin/users/message.error.delete');

                // Redirect to the user management page
                return Redirect::route('admin.users.index')->with('error', $error);
            }

            // Delete the user
            //to allow soft deleted, we are performing query on users model instead of Sentinel model
            //$user->delete();
            User::destroy($id);

            // Prepare the success message
            $success = Lang::get('users/message.success.delete');

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('admin/users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.users.index')->with('error', $error);
        }
    }






    /**
     * Restore a deleted user.
     *
     * @param  int $id
     * @return Redirect
     */
    public function getRestore($id = null)
    {
        try {
            // Get user information
            $user = User::withTrashed()->find($id);

            // Restore the user
            $user->restore();

            // create activation record for user and send mail with activation link
            $data = array(
                'user' => $user,
                'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
            );

            // Send the activation code through email
            Mail::send('emails.register-activate', $data, function ($m) use ($user) {
                $m->to($user->email, $user->first_name . ' ' . $user->last_name);
                $m->subject('Dear ' . $user->first_name . '! Active your account');
            });


            // Prepare the success message
            $success = Lang::get('users/message.success.restored');

            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('users/message.user_not_found', compact('id'));

            // Redirect to the user management page
            return Redirect::route('admin.deleted_users')->with('error', $error);
        }
    }

    /**
     * Display specified user profile.
     *
     * @param  int $id
     * @return Response
     */
    // public function show()
    // {
    //     try {
    //         // $id=Auth::id();
         
    //         // Get the user information
    //         $user = Sentinel::getUser();
            
    //         $role = $user->roles()->first()->slug;
    //         dd($role);
    //         //get country name
    //         // dd($user);
    //         if ($user->country) {
    //             $user->country = $this->countries[$user->country];
    //         }

    //     } catch (UserNotFoundException $e) {
    //         // Prepare the error message
    //         $error = Lang::get('users/message.user_not_found', compact('id'));

    //         // Redirect to the user management page
    //         return Redirect::route('admin.users.index')->with('error', $error);
    //     }

    //     // Show the page
    //     return view('admin.users.show', compact('user'));

    // }


    public function show($id = null)
    {
        try {
            $user = null;
            $role = 'admin';
    
            if ($id) {
                $user = User::findOrFail($id);
                // Fetch the user's roles
                $roles = $user->roles()->pluck('slug')->toArray();
                $role = in_array('admin', $roles) ? 'admin' : 'user';
            } else {
                $user = Sentinel::getUser();
            }
    
            return view('admin.users.show', compact('user', 'role'));
        } catch (UserNotFoundException $e) {
            $error = Lang::get('users/message.user_not_found', compact('id'));
            return Redirect::route('admin.users.index')->with('error', $error);
        }
    }
    




//updated code 

public function resetPassword(Request $request)
{
    $userid = Sentinel::getUser();
    $id = $userid->id;
    
    $user = Sentinel::findUserById($id);
    
    if (!$user) {
        return back()->with('error', 'User not found');
    }

    $validator = Validator::make($request->all(), [
        'password' => 'required|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $password = $request->input('password');
    // dd($password);
    // Update the user's password
    $user->password = Hash::make($password);
    $user->save();

    return back()->with('success', 'Password reset successful');
}

    //Already code not working
    // public function passwordreset($id, Request $request)
    // {
    //     $data = $request->all();

    //     $user = Sentinel::findUserById($id);
    //     $password = $request->get('password');
    //     $user->password = Hash::make($password);
    //     $user->save();
    // }

    public function lockscreen($id){
        $user = Sentinel::findUserById($id);
        return view('admin.lockscreen',compact('user'));
    }

    public function postLockscreen(Request $request){
        $password = Sentinel::getUser()->password;
        if(Hash::check($request->password,$password)){
            return 'success';
        }
        else{
            return 'error';
        }
    }

    # Sadek Start
    public function user_search(Request $request)
    {
        $query = $request->search;
        $user = Sentinel::getUser();
        $friends = UserFriend::where('user_id', $user->id)->pluck('friend_id')->toArray();
        // dd($friends);
        $users = User::where('first_name', 'LIKE', '%'. $query. '%')->orWhere('last_name', 'LIKE', '%'. $query. '%')->orWhere('email', 'LIKE', '%'. $query. '%')->orWhere('id', $query)->get();
        return view('admin.users.search-result', compact('users', 'friends'));
    }

    public function user_details($id)
    {
        $user = User::find($id);
        if (!is_null($user)) {
            $roles = $user->roles()->pluck('slug')->toArray();
                $role = in_array('admin', $roles) ? 'admin' : 'user';
                // dd($role);
            $course_ids = \App\UserCourseSchedule::where('user_id', $user->id)->pluck('course_id')->toArray();
            $courses = \App\Courses::whereIn('id', $course_ids)->get();

            $friends = UserFriend::where('user_id', $user->id)->where('is_accepted', 1)->get();
            $new_friends = UserFriend::where('user_id', $user->id)->where('is_accepted', NULL)->where('is_rejected', NULL)->get();
            $notifications = UserPushNotification::where('user_id', $user->id)->orderBy('id', 'DESC')->get();
            return view('admin.users.user-details', compact('user', 'friends', 'new_friends', 'courses', 'notifications','role'));
        }
        else {
            return back();
        }
    }

    public function add_friend($id)
    {
        $friend = User::find($id);
        $user = Sentinel::getUser();
        if (!is_null($friend)) {
            $user_friend = new UserFriend;
            $user_friend->user_id = $friend->id;
            $user_friend->friend_id = $user->id;
            $user_friend->save();
            return back()->with('success', 'Friend request sent');
        }
        else {
            return back();
        }
    }

    public function friend_request_action(Request $request, $id)
    {
        $friend_request = UserFriend::find($id);
        if (!is_null($friend_request)) {
            if ($request->has('accept')) {
                $friend_request->is_accepted = 1;
                $friend_request->save();
                $make_friend = new UserFriend;
                $make_friend->user_id = $friend_request->friend_id;
                $make_friend->friend_id = $friend_request->user_id;
                $make_friend->is_accepted = 1;
                $make_friend->save();
                return back()->with('success', 'Friend Request Accepted.');
            }

            if ($request->has('reject')) {
                $friend_request->is_rejected = 1;
                $friend_request->save();
                return back()->with('success', 'Friend Request Rejected.');
            }
            return back();
        }
        else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function logbook_notification(Request $request)
    {
        dd($request->all());
    }

    # Sadek Start End

    public function assigRole(Request $request)
    {
        $data  = $request->all();

        $user = User::find($request->userId);
        $role  = DB::table('roles')
        ->where('id',$request->role)->first();
        $user->roles()->attach($role->id);
        $user->roles()->sync([$role->id]);
        // dd($user->roles());
        $user->save();
    }


}