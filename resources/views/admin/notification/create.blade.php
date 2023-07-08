@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('notification/title.add-notification') :: @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/summernote/summernote.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/blog.css') }}" rel="stylesheet" type="text/css">

    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>@lang('notification/title.add-notification')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">@lang('notification/title.notification')</a>
        </li>
        <li class="active">@lang('notification/title.add-notification')</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
            <!-- errors -->
            <div class="has-error">
                
            </div>
            <form action="{{ route('admin.pushnotification.store') }}" method="POST">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
            	<div class="row">
            		
            		<div class="col-sm-4">
            			<div class="form-group">
            				<label>@lang('notification/form.gender')</label>
            				<select class="select2 form-control" name="gender">
            					<option value="male">Male</option>
            					<option value="female">Female</option>
            					<option value="both">Both</option>
            				</select>
            			</div>
            		</div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>@lang('notification/form.language')</label>
                            <select class="select2 form-control" name="language">
                                <option value="">Please Select Language</option>
                                <option value="Arabic">Arabic</option>
                                <option value="English">English</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                    </div>
            		<div class="col-sm-4">
            			<div class="form-group">
            				<label>@lang('notification/form.age-range')</label>
            				<select class="select2 form-control" name="age_range">
            					<option value="0-18">Below 18</option>
                                <option value="18-30">18 to 30</option>
            					<option value="30-50">30 to 50</option>
            					<option value="Above 50">50 and above</option>
                                <option value="all ages">All ages</option>
            				</select>
            			</div>
            		</div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>@lang('notification/form.training-goal')</label>
                            <select class="select2 form-control" name="fitness_goal_id">
                                <option value="">Select Type</option>
                                @foreach($goals as $goal)
                                <option value="{{ $goal->id }}">{{ $goal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>@lang('notification/form.date')</label>
                            <input type="date" name="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>@lang('notification/form.time')</label>
                            <input type="time" name="time" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>@lang('notification/form.link')</label>
                            <input type="text" name="link" class="form-control">
                            <span class="help-block">{{ $errors->first('link', ':message') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>@lang('notification/form.course')</label>
                            <select class="select2 form-control" name="course_id">
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            		<div class="col-sm-12">
            			<div class="form-group">
            				<label>@lang('notification/form.text')</label>
            				<textarea class="textarea form-control" name="notification_text"></textarea>
            			</div>
            		</div>
            		<div class="col-sm-12">
            			<div class="form-group">
            				<button type="submit" class="btn btn-success">@lang('notification/form.publish')</button>
            			</div>
            		</div>
            		
            	</div>
            </form>
        </div>
    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->
<!--edit blog-->
<script src="{{ asset('assets/vendors/summernote/summernote.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}" type="text/javascript" ></script>
<script src="{{ asset('assets/js/pages/add_newblog.js') }}" type="text/javascript"></script>
@stop
