@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    User Profile Details
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/bootstrap-magnify/bootstrap-magnify.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet" type="text/css" />

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>
            User Profile Details
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li>Users</li>
            <li class="active">View Profile</li>
        </ol>
    </section>
    <section class="content">
        <div class="row ">
            <div class="col-md-12">
                <div class="row ">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="text-center">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <img src="{{ asset('uploads/users/' . $user->pic) }}"
                                            data-src="holder.js/366x218/#fff:#000" class="img-responsive" width="366px"
                                            height="218px" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileinput-new">
                                                Select image
                                            </span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="..."></span>
                                        <a href="#" class="btn btn-default fileinput-exists"
                                            data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table  table-striped" id="users">

                                <tr>
                                    <td>User Name</td>
                                    <td>
                                        <a href="#" data-pk="1" class="editable"
                                            data-title="Edit User Name">{{ $user->first_name . ' ' . $user->last_name }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>
                                        <a href="#" data-pk="1" class="editable" data-title="Edit E-mail">
                                            {{ $user->email }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Phone Number
                                    </td>
                                    <td>
                                        <a href="#" data-pk="1" class="editable" data-title="Edit Phone Number">
                                            {{ $user->phone }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>
                                        <a href="#" data-pk="1" class="editable" data-title="Edit Address">
                                            {{ $user->address }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <!-- <a href="#" id="status" data-type="select" data-pk="1" data-value="1" data-title="Status"></a> -->
                                        {{ Activation::completed($user) ? 'Activated' : 'Pending' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created At</td>
                                    <td>
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>
                                        <a href="#" data-pk="1" class="editable"
                                            data-title="Edit City">{{ $user->city }}</a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="row ">
                            <div class="panel colr-hed">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Friends</h3>
                                </div>
                                <div class="panel-body">
                                    {{-- @dd($friends) --}}
                                    @foreach ($friends as $friend)
                                        <div class="col-md-3 col-xs-6">
                                            <div class="mag img-responsive">
                                                <br /><a href="{{ route('admin.user.details', $friend->friend_id) }}"
                                                    title="{{ $friend->friend->first_name . ' ' . $friend->friend->last_name }}">
                                                    <img data-toggle="magnify" class="thumbnail img-responsive"
                                                        src="{{ asset('uploads/users/' . $friend->friend->pic) }}"
                                                        alt=""></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-tabs ul-edit responsive">
                            <li class="active">
                                <a href="#tab-activity" data-toggle="tab">
                                    <i class="livicon" data-name="envelope" data-size="16" data-c="#01BC8C"
                                        data-hc="#01BC8C" data-loop="true"></i> <!-- Activity --> Training
                                </a>
                            </li>

                            <li>
                                <a href="#tab-friends" data-toggle="tab">
                                    <i class="livicon" data-name="user" data-size="16" data-c="#01BC8C"
                                        data-hc="#01BC8C" data-loop="true"></i> <!-- Messages --> Freinds
                                </a>
                            </li>
                            @if (Sentinel::getUser()->id == $user->id)
                                <li style="float: right">
                                    <a href="#tab-friend-request" data-toggle="tab">
                                        <i class="livicon" data-name="user" data-size="16" data-c="#01BC8C"
                                            data-hc="#01BC8C" data-loop="true"></i> <!-- Messages --> New Freind Request
                                        @if (count($new_friends) > 0)
                                            <sup><span class="badge rounded"
                                                    style="background-color: purple;">{{ count($new_friends) }}</span></sup>
                                        @endif
                                    </a>
                                </li>
                                <li style="float: right">
                                    <a href="#tab-message" data-toggle="tab">
                                        <i class="livicon" data-name="comments" data-size="16" data-c="#01BC8C"
                                            data-hc="#01BC8C" data-loop="true"></i> Messages @if (count(
                                                    $notifications->filter(function ($item) {
                                                        return $item->is_seen == 0;
                                                    })) > 0)
                                            <sup><span class="badge rounded"
                                                    style="background-color: green;">{{ count(
                                                        $notifications->filter(function ($item) {
                                                            return $item->is_seen == 0;
                                                        }),
                                                    ) }}</span></sup>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div id="tab-activity" class="tab-pane fade in active">
                                <div class="activity">
                                    <table class="table table-striped table-advance table-hover web-mail"
                                        id="inbox-check">
                                        <tbody>
                                            @foreach ($courses as $course)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td><img src="{{ asset('uploads/courses/' . $course->image) }}"
                                                            width="80"></td>
                                                    <td><a href="">{{ $course->title }}</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="tab-friends" class="tab-pane fade in">
                                <table class="table table-striped table-advance table-hover web-mail" id="inbox-check">

                                    <tbody>
                                        @foreach ($friends as $friend)
                                            <tr data-messageid="{{ $loop->index + 1 }}" class="unread">
                                                <td>
                                                    {{ $loop->index + 1 }}
                                                </td>
                                                <td class="view-message">
                                                    <a href="{{ route('admin.user.details', $friend->friend_id) }}">
                                                        <img data-toggle="magnify" class="thumbnail img-responsive"
                                                            src="{{ asset('uploads/users/' . $friend->friend->pic) }}"
                                                            alt="" width="80">
                                                    </a>
                                                </td>
                                                <td class="view-message ">
                                                    <a href="{{ route('admin.user.details', $friend->friend_id) }}">
                                                        {{ $friend->friend->first_name . ' ' . $friend->friend->last_name }}
                                                    </a>
                                                </td>

                                                <td class="view-message text-right">
                                                    {{ $friend->updated_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if (Sentinel::getUser()->id == $user->id)
                                <div id="tab-friend-request" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12 pd-top">
                                            <table class="table table-striped table-advance table-hover web-mail"
                                                id="inbox-check">

                                                <tbody>
                                                    @foreach ($new_friends as $new_friend)
                                                        <tr data-messageid="{{ $loop->index + 1 }}" class="unread">
                                                            <td>
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td class="view-message">
                                                                <a
                                                                    href="{{ route('admin.user.details', $new_friend->friend_id) }}">
                                                                    <img data-toggle="magnify"
                                                                        class="thumbnail img-responsive"
                                                                        src="{{ asset('uploads/users/' . $new_friend->friend->pic) }}"
                                                                        alt="" width="80">
                                                                </a>
                                                            </td>
                                                            <td class="view-message ">
                                                                <a
                                                                    href="{{ route('admin.user.details', $new_friend->friend_id) }}">
                                                                    {{ $new_friend->friend->first_name . ' ' . $new_friend->friend->last_name }}
                                                                </a>
                                                            </td>

                                                            <td class="view-message text-right">
                                                                {{ $new_friend->updated_at->diffForHumans() }}
                                                            </td>
                                                            <td class="view-message text-right">
                                                                <form
                                                                    action="{{ route('admin.user.friendrequest', $new_friend->id) }}"
                                                                    method="POST">
                                                                    {{ csrf_field() }}
                                                                    <input type="submit" name="accept" value="Accept"
                                                                        class="btn btn-primary">
                                                                    <input type="submit" name="reject" value="Reject"
                                                                        class="btn btn-danger">


                                                                </form>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div id="tab-message" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-12 pd-top">
                                            <table class="table table-striped table-advance table-hover web-mail"
                                                id="inbox-check">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="3">
                                                            <h3>Notifications from Admin</h3>
                                                        </td>
                                                    </tr>
                                                    @foreach ($notifications as $notification)
                                                        <tr data-messageid="{{ $loop->index + 1 }}" class="unread">
                                                            <td>
                                                                {{ $loop->index + 1 }}
                                                            </td>
                                                            <td class="view-message">
                                                                <a href="{{ $notification->push_notification->link }}"
                                                                    target="_blank"
                                                                    style="color: {{ $notification->is_seen == 0 ? 'green' : '' }};"
                                                                    @if ($notification->is_seen == 0) onclick="seen({{ $notification->id }})" @endif>
                                                                    <b>{!! $notification->push_notification->notification_text !!}</b>
                                                                </a>
                                                            </td>

                                                            <td class="view-message text-right">
                                                                {{ $notification->created_at->diffForHumans() }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/jquery-mockjax/js/jquery.mockjax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/x-editable/js/bootstrap-editable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrap-magnify/bootstrap-magnify.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/holder.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/pages/user_profile.js') }}" type="text/javascript"></script>

    <script>
        function seen(notification_id) {
            var notification_id = notification_id;
            var url = "{{ url('/') }}";
            // window.alert(notification_id);
            $.get(url + "/admin/user/push-notification-seen/" + notification_id, function(data) {

            });

        }
    </script>

@stop
