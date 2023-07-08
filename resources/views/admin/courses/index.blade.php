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

    <link href="{{ asset('assets/vendors/modal/css/component.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/advmodals.css') }}" rel="stylesheet"/>
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
        <li><a href="#">Courses</a></li>
        <li class="active">List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    @if(!isset($user))
        <button class="btn btn-raised btn-primary " data-toggle="modal" data-target="#add"><span class="fa fa-plus"></span> Add New Course</button>
        <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add" role="dialog" 
            aria-labelledby="modalLabelfade" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form  action="{{ url('admin/courses/create') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title" id="modalLabelfade">Add New Course</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- CSRF Token -->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group {{ $errors->first('category', 'has-error') }}">
                                        <label for="category" class="control-label">Parent Category *</label>
                                        {!! Form::select('parent_category', \App\FitnessGoals::selectbox(), null,['class' => 'form-control select2', 'id' => 'category']) !!}

                                            {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->first('category', 'has-error') }}">
                                        <label for="category" class="control-label">Category *</label>
                                        {!! Form::select('category', \App\CourseCategory::selectbox(), null,['class' => 'form-control select2', 'id' => 'category']) !!}

                                            {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    @if(Sentinel::inRole('admin'))
                                        <div class="form-group {{ $errors->first('category', 'has-error') }}">
                                            <label for="category" class="control-label">Trainer *</label>
                                            {!! Form::select('trainer_id', \App\User::trainerselectbox(), null,['class' => 'form-control select2', 'id' => 'trainer_id']) !!}

                                                {!! $errors->first('trainer_id', '<span class="help-block">:message</span>') !!}
                                        </div>
                                    @else
                                        <input type="hidden" name="trainer_id" value="{{ Sentinel::getUser()->id }}">
                                    @endif
                                    <div class="form-group {{ $errors->first('institute_name', 'has-error') }}">
                                        <label for="institute_name" class="control-label">Title *</label>
                                        <input id="title" required name="title" type="text"
                                                   placeholder="Title" class="form-control required"
                                                   value="{!! old('title') !!}"/>

                                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="control-label">Descripton <small>(brief intro) *</small></label>
                                        <textarea name="description" placeholder="Enter Description" required id="description" class="form-control resize_vertical" rows="4" placeholder="Enter Description">{!! old('description') !!}</textarea>
                                        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                        <label class="control-label">Video MP4:</label>
                                    </div>
                                    <div class="form-group {{ $errors->first('pic', 'has-error') }}">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                                <img src="http://placehold.it/200x150" alt="..." class="img-responsive"/>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-primary btn-file">
                                                    <span class="fileinput-new">Select Video MP4</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="video" id="video" />
                                                </span>
                                                <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                            </div>
                                        </div>
                                        <span class="help-block">{{ $errors->first('pic', ':message') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->first('address', 'has-error') }}">
                                        <label class="control-label">Avatar:</label>
                                    </div>
                                    <div class="form-group {{ $errors->first('pic', 'has-error') }}">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                                <img src="http://placehold.it/200x150" alt="..." class="img-responsive"/>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-primary btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" name="pic" id="pic" />
                                                </span>
                                                <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                            </div>
                                        </div>
                                        <span class="help-block">{{ $errors->first('pic', ':message') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->first('contact', 'has-error') }}">
                                        <label for="contact" class="control-label">Days of Completion *</label>
                                        <select class="form-control" name="dayscompletion">
                                            @for($x = 1; $x <= 30; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group {{ $errors->first('contact', 'has-error') }}">
                                        <label for="contact" class="control-label">Weeks of Completion *</label>
                                        <input type="number" name="total_weeks" placeholder="Enter number of week" class="form-control" required>
                                    </div>
                                    <div class="form-group {{ $errors->first('contact', 'has-error') }}">
                                        <label for="contact" class="control-label">Days of Week *</label>
                                        <select class="form-control" name="week_a_days">
                                            @for($x = 1; $x <= 7; $x++)
                                                <option value="{{ $x }}">{{ $x }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn  btn-success" value="Save">
                            <button class="btn  btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title">
                    @if(isset($user))
                        <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        {{ $user->first_name .' '.$user->last_name.' Courses List' }}
                    @else
                        Courses List
                    @endif
                    
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Trainer</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Equipments</th>
                            <th>Video</th>
                            <th>Image</th>
                            <th>Days To Completion</th>
                            <th>Total Weeks</th>
                            <th>Days of Week</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($courses))
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>
                                        @if(!empty($course->Trainer))
                                            {{ $course->Trainer->first_name.' '.$course->Trainer->last_name }}
                                        @endif
                                    </td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ substr($course->description,0,50) }}
                                        <a data-toggle="modal" data-href="#responsive" href="#desc_{{ $course->id }}">...More</a>
                                        <div class="modal fade in" id="desc_{{ $course->id }}" tabindex="-1" role="dialog" aria-hidden="false">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Description</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>{{ $course->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $equipment_ids = [];
                                            $equipment_names = [];
                                            foreach($course->Equipments as $equip){
                                                $equipment_ids[] = $equip->id;
                                                $equipment_names[] = $equip->name;
                                            }
                                        @endphp
                                        {{ implode(" , ",$equipment_names) }}
                                        @if(!isset($user))
                                            <a class="pull-right" data-toggle="modal"
                                            data-href="#responsive" href="#responsive_{{ $course->id }}">Add</a>
                                            <div class="modal fade in" id="responsive_{{ $course->id }}" tabindex="-1" role="dialog" aria-hidden="false">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <form  action="{{ url('admin/courses/equipments') }}" method="POST" class="form-horizontal">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Equipments</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- CSRF Token -->
                                                                <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                                <div class="row">
                                                                    @foreach($Equipments as $Equipment)
                                                                        <div class="col-md-3">
                                                                            <input type="checkbox" @if(in_array($Equipment->id, $equipment_ids)) checked @endif value="{{ $Equipment->id }}" name="equipments[]">&nbsp;&nbsp;&nbsp;{{ $Equipment->name }}
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                                                                <button type="submit" class="btn btn-primary">Add Equipments</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!is_null($course->video))
                                            <video width="220" height="180" controls>
                                                <source src="{{ url('/uploads/courses/'.$course->video) }}" type="video/mp4"> 
                                                    Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!is_null($course->image))
                                            <img src="{{ url('/uploads/courses/'.$course->image) }}" width="50">
                                        @endif
                                    </td>
                                    <td>{{ $course->daystocompletion }}</td>
                                    <td>{{ $course->total_weeks }}</td>
                                    <td>{{ $course->week_a_days }}</td>
                                    <td>{{ $course->created_at->diffForHumans() }}</td>
                                    <td>
                                        @if(!isset($user))
                                            @include('admin.courses.editcourse')
                                            @include('admin.courses.statuscourse')
                                        @endif
                                        @include('courses.viewAllActivities')
                                        <br>
                                        <a href="{{ url('/admin/courses/days/addDayActivity/'.$course->id) }}">
                                            <span class="fa fa-plus"></span> Add
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/modal/js/classie.js')}}"></script>
@stop
