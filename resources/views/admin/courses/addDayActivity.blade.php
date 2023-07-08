@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Courses List
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/vendors/modal/css/component.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/advmodals.css') }}" rel="stylesheet" />
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Courses</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#">Course</a></li>
            <li class="active">Add Day Activities</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="container-fluid">
            <div class="welcome">
                <h3>Course Day Activities<a href="{{ URL('admin/courses') }}" class="btn btn-info pull-right">Go Back to
                        Courses</a></h3>
            </div>
            <!--Content Section Start -->
            <!-- Best Deal Section Start -->
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
                    {{-- @dd($videos) --}}
                    @for ($x = 1; $x <= $course->total_weeks; $x++)
                        @for ($y = 1; $y <= $course->week_a_days; $y++)
                            {{-- @foreach ($videos as $video) --}}
                            <tr>
                                <td>{{ 'Week-' . $x }}</td>
                                <td>{{ 'Day-' . $y }}</td>
                                <td>
                                    @include('courses.viewActivities')
                                    <a data-toggle="modal" class="btn btn-primary" data-href="#responsive"
                                        href="#responsive_{{ $x . $y }}">
                                        <span class="fa fa-plus"></span> Add
                                    </a>
                                    <a data-toggle="modal" class="btn btn-primary" data-href="#responsive-video"
                                        href="#responsive-video_{{ $x . $y }}">
                                        <span class="fa fa-plus"></span> Add Video
                                    </a>

                                    <a data-toggle="modal" class="btn btn-primary"
                                        data-target="#responsive-videoDisplay_{{ $x . $y }}">
                                        <span class="fa fa-play"></span> Play Video
                                    </a>

                                    <div class="modal fade in" id="responsive_{{ $x . $y }}" tabindex="-1"
                                        role="dialog" aria-hidden="false">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ url('courses/addActivity') }}"
                                                    enctype="multipart/form-data" method="POST" class="form-horizontal">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Add Activity</h4>
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
                                                                <h3> Week-{{ $x }}
                                                                    Day-{{ $y }}
                                                                </h3>
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
                                                                <div class="fileinput fileinput-new"
                                                                    data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;">
                                                                        <img src="http://placehold.it/200x150"
                                                                            alt="..." class="img-responsive" />
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn btn-primary btn-file">
                                                                            <span class="fileinput-new">Select
                                                                                image</span>
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




                                    {{-- video modal --}}
                                    <div class="modal fade in" id="responsive-video_{{ $x . $y }}" tabindex="-1"
                                        role="dialog" aria-hidden="false">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.courses.courseVideos') }}"
                                                    enctype="multipart/form-data" method="POST" class="form-horizontal">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Add Video</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- CSRF Token -->
                                                        <input type="hidden" name="course_id"
                                                            value="{{ $course->id }}" />
                                                        <input type="hidden" name="week"
                                                            value="{{ $x }}" />
                                                        <input type="hidden" name="day"
                                                            value="{{ $y }}" />
                                                        <input type="hidden" name="_token"
                                                            value="{{ csrf_token() }}" />
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h3> Week-{{ $x }}
                                                                    Day-{{ $y }}
                                                                </h3>
                                                            </div>

                                                        </div>


                                                        <div
                                                            class="form-group {{ $errors->first('title', 'has-error') }}">
                                                            <label for="title" class="control-label">Title *</label>
                                                            <input id="title" required name="title" type="text"
                                                                placeholder="Title" class="form-control required"
                                                                value="{!! old('title') !!}" />

                                                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                                        </div>



                                                        <div class="row">
                                                            <label class="col-md-12">Image:</label>
                                                            <div class="col-md-12">
                                                                <div class="fileinput fileinput-new"
                                                                    data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;">
                                                                        <img src="http://placehold.it/200x150"
                                                                            alt="..." class="img-responsive" />
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn btn-primary btn-file">
                                                                            <span class="fileinput-new">Select
                                                                                image</span>
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
                                                        <div class="row">
                                                            <label class="col-md-12">Video:</label>
                                                            <div class="col-md-12">
                                                                <div class="fileinput fileinput-new"
                                                                    data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;">
                                                                        <img src="http://placehold.it/200x150"
                                                                            alt="..." class="img-responsive" />
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                                                        style="max-width: 200px; max-height: 150px;">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn btn-primary btn-file">
                                                                            <span class="fileinput-new">Select
                                                                                video</span>
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

                                    {{-- display video  --}}

                                    <div class="modal fade in" id="responsive-videoDisplay_{{ $x . $y }}"
                                        tabindex="-1" role="dialog" aria-hidden="false">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Video Detail</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h3>Week-{{ $x }} Day-{{ $y }}</h3>
                                                        </div>
                                                    </div>
                                                    @foreach ($videos as $video)
                                                        @if ($video->week == $x && $video->day == $y)
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p>{{ $video->detail }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <video width="100%" controls>
                                                                        <source src="{{ asset($video->video) }}"
                                                                            type="video/mp4">
                                                                        Your browser does not support the video tag.
                                                                    </video>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal"
                                                        class="btn btn-default">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            {{-- @endforeach --}}
                        @endfor
                    @endfor
                </tbody>
            </table>

            <!-- //Mens Section End -->
            <!-- //Content Section End -->
        </div>
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/modal/js/classie.js') }}"></script>
@stop
