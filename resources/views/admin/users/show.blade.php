@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    View User Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet" />
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>User Profile</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Users</a>
            </li>
            <li class="active">User Profile</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="nav  nav-tabs ">
                            <li class="active">
                                <a href="#tab1" data-toggle="tab">
                                    <i class="livicon" data-name="user" data-size="16" data-c="#000" data-hc="#000"
                                        data-loop="true"></i>
                                    User Profile</a>
                            </li>
                            <li>
                                <a href="#tab2" data-toggle="tab">
                                    <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000"
                                        data-hc="#000"></i>
                                    Change Password</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.details', $user->id) }}">
                                    <i class="livicon" data-name="gift" data-size="16" data-loop="true" data-c="#000"
                                        data-hc="#000"></i>
                                    Advanced User Profile</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-4">
                        <form action="{{ route('admin.user.search') }}" method="GET" style="margin-bottom: 20px;">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Name, Email or ID">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">Find Now</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-content mar-top">
                    <div id="tab1" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">

                                            User Profile
                                        </h3>

                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-4">
                                            <div class="img-file">
                                                @if ($user->pic)
                                                    <img src="{!! url('/') . '/uploads/users/' . $user->pic !!}" alt="profile pic" class="img-max">
                                                @else
                                                    <img src="{{ asset('assets/img/authors/avatar3.jpg') }}"
                                                        alt="profile pic">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped" id="users">

                                                        <tr>
                                                            <td>@lang('users/title.first_name')</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $user->first_name }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.last_name')</td>
                                                            <td>
                                                                <p class="user_name_max">{{ $user->last_name }}</p>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.email')</td>
                                                            <td>
                                                                {{ $user->email }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                @lang('users/title.gender')
                                                            </td>
                                                            <td>
                                                                {{ $user->gender }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.dob')</td>

                                                            @if ($user->dob == '0000-00-00')
                                                                <td>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    {{ $user->dob }}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>

                                                            <td>@lang('users/title.country')</td>
                                                            <td>
                                                                @if ($user->country)
                                                                    {{ $user->country }}
                                                                @else
                                                                    N/A
                                                                @endif
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.state')</td>
                                                            <td>
                                                                {{ $user->state }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.city')</td>
                                                            <td>
                                                                {{ $user->city }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.address')</td>
                                                            <td>
                                                                {{ $user->address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.postal')</td>
                                                            <td>
                                                                {{ $user->postal }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.status')</td>
                                                            <td>

                                                                @if ($user->deleted_at)
                                                                    Deleted
                                                                @elseif($activation = Activation::completed($user))
                                                                    Activated
                                                                @else
                                                                    Pending
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('users/title.created_at')</td>
                                                            <td>
                                                                {!! $user->created_at->diffForHumans() !!}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-12 pd-top">
                                <form class="form-horizontal" action="{{ route('admin.password.reset') }}" method="post">
                                    <div class="form-body">
                                        <div class="form-group">
                                            {{ csrf_field() }}
                                            <label for="inputpassword" class="col-md-3 control-label">
                                                Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="livicon" data-name="key" data-size="16" data-loop="true"
                                                            data-c="#000" data-hc="#000"></i>
                                                    </span>
                                                    <input type="password" id="password" placeholder="Password"
                                                        class="form-control" name="password" />
                                                </div>
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputnumber" class="col-md-3 control-label">
                                                Confirm Password
                                                <span class='require'>*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="livicon" data-name="key" data-size="16"
                                                            data-loop="true" data-c="#000" data-hc="#000"></i>
                                                    </span>
                                                    <input type="password" id="password-confirm"
                                                        placeholder="Confirm Password" class="form-control"
                                                        name="password_confirmation" />
                                                </div>
                                                @error('password_confirmation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn btn-primary"
                                                id="change-password">Submit</button>
                                            &nbsp;
                                            <input type="reset" class="btn btn-default hidden-xs" value="Reset">
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @dd('check post') --}}
        <form action="#" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <h2>User Logbook Notification</h2>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Course</label>
                        <select class="form-control" name="course_id">
                            <option>---Course---</option>
                            @foreach (App\Courses::orderBy('id', 'DESC')->get() as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#change-password').click(function(e) {
                e.preventDefault();
                var check = false;
                var sendData = {
                    '_token': $('input[name="_token"]').val(),
                    'password': $('#password').val(),
                    'password_confirmation': $('#password-confirm').val()
                };
                if ($('#password').val() === $('#password-confirm').val()) {
                    check = true;
                }
                if (check) {
                    $.ajax({
                        url: '{{ route('admin.password.reset') }}',
                        type: 'POST',
                        data: sendData,
                        success: function(data) {
                            alert('Password reset successful');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert('Error in password reset');
                        }
                    });
                } else {
                    alert('Password and password confirmation do not match');
                }
            });
        });
    </script> --}}
@stop
