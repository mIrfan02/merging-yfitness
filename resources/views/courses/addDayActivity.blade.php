@extends('/layouts/default')


{{-- Page title --}}
@section('title')
    Course Add Activity
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <link href="{{ asset('assets/css/frontend/shopping.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/advmodals.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
    <style>
        tr td {
            text-align: left;
        }
    </style>
@stop

{{-- breadcrumb --}}
@section('top')

@stop

{{-- Page content --}}
@section('content')
    <hr class="content-header-sep">
    <!-- Container Section Start -->
    <div class="container">
        <div class="welcome">
            <h3>Course Day Activities<a href="{{ URL('courses') }}" class="btn btn-info pull-right">Go Back to Courses</a>
            </h3>
        </div>
        <!--Content Section Start -->
        <!-- Best Deal Section Start -->
        @include('notifications')
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <td colspan="2">{{ $course->title }}</td>
                </tr>
                <tr>
                    <th>Detail</th>
                    <td colspan="2">{{ $course->description }}</td>
                </tr>
                <tr class="filters">
                    <th>Week</th>
                    <th>Day</th>
                    <th>Activity</th>
                </tr>
            </thead>
            <tbody>
                @for ($x = 1; $x <= $course->total_weeks; $x++)
                    @for ($y = 1; $y <= $course->week_a_days; $y++)
                        <tr>
                            <td>{{ 'Week-' . $x }}</td>
                            <td>{{ 'Day-' . $y }}</td>
                            <td>
                                @include('courses.viewActivities')
                                <a data-toggle="modal" class="btn btn-primary" data-href="#responsive"
                                    href="#responsive_{{ $x . $y }}">
                                    <span class="fa fa-plus"></span> Add
                                </a>
                                {{-- <a data-toggle="modal" class="btn btn-primary" data-href="#responsive-video"
                                    href="#responsive-video_{{ $x . $y }}">
                                    <span class="fa fa-plus"></span> Add Video
                                </a> --}}







                                <div class="modal fade in" id="responsive_{{ $x . $y }}" tabindex="-1"
                                    role="dialog" aria-hidden="false">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ url('courses/addActivity') }}" enctype="multipart/form-data"
                                                method="POST" class="form-horizontal">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Add Activity</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- CSRF Token -->
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                                    <input type="hidden" name="week" value="{{ $x }}" />
                                                    <input type="hidden" name="day" value="{{ $y }}" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3> Week-{{ $x }} Day-{{ $y }}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="detail" required rows="5"
                                                                placeholder="Add Week-{{ $x }} Day-{{ $y }} activity detail"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-md-12">Activity Image:</label>
                                                        <div class="col-md-12">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail"
                                                                    style="max-width: 200px; max-height: 150px;">
                                                                    <img src="http://placehold.it/200x150" alt="..."
                                                                        class="img-responsive" />
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                                    style="max-width: 200px; max-height: 150px;"></div>
                                                                <div>
                                                                    <span class="btn btn-primary btn-file">
                                                                        <span class="fileinput-new">Select image</span>
                                                                        <span class="fileinput-exists">Change</span>
                                                                        <input type="file" name="pic"
                                                                            id="pic" />
                                                                    </span>
                                                                    <span class="btn btn-primary fileinput-exists"
                                                                        data-dismiss="fileinput">Remove</span>
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="help-block">{{ $errors->first('pic', ':message') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal"
                                                        class="btn btn-default">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                                <div class="modal fade in" id="responsive-video_{{ $x . $y }}" tabindex="-1"
                                    role="dialog" aria-hidden="false">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ url('courses/addVideo') }}" enctype="multipart/form-data"
                                                method="POST" class="form-horizontal">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Add Video</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- CSRF Token -->
                                                    <input type="hidden" name="course_id"
                                                        value="{{ $course->id }}" />
                                                    <input type="hidden" name="week" value="{{ $x }}" />
                                                    <input type="hidden" name="day" value="{{ $y }}" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3> Week-{{ $x }} Day-{{ $y }}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <textarea class="form-control" name="detail" required rows="5"
                                                                placeholder="Add Week-{{ $x }} Day-{{ $y }} video detail"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label class="col-md-12">Video:</label>
                                                        <div class="col-md-12">
                                                            <div class="fileinput fileinput-new"
                                                                data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail"
                                                                    style="max-width: 200px; max-height: 150px;">
                                                                    <img src="http://placehold.it/200x150" alt="..."
                                                                        class="img-responsive" />
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                                    style="max-width: 200px; max-height: 150px;"></div>
                                                                <div>
                                                                    <span class="btn btn-primary btn-file">
                                                                        <span class="fileinput-new">Select video</span>
                                                                        <span class="fileinput-exists">Change</span>
                                                                        <input type="file" name="video"
                                                                            id="video" />
                                                                    </span>
                                                                    <span class="btn btn-primary fileinput-exists"
                                                                        data-dismiss="fileinput">Remove</span>
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="help-block">{{ $errors->first('video', ':message') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal"
                                                        class="btn btn-default">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>








                            </td>
                        </tr>
                    @endfor
                @endfor
            </tbody>
        </table>

        <!-- //Mens Section End -->
        <!-- //Content Section End -->
    </div>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/modal/js/classie.js') }}"></script>
@stop
