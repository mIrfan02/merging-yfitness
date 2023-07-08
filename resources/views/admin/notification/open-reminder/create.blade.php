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
    <h1>Open Reminder Notification</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">@lang('notification/title.notification')</a>
        </li>
        <li class="active">Open Reminder Notification</li>
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
            <form action="{{ route('admin.openreminder.store') }}" method="POST">
            	<input type="hidden" name="_token" value="{{ csrf_token() }}" />
            	<div class="row">
            		
            		<div class="col-sm-3">
                        <div class="form-group">
                            <label>Day*</label>
                            <select class="select2 form-control" name="days[]" multiple required>
                                <!-- <option value="">Please Select Day</option> -->
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>@lang('notification/form.time')*</label>
                            <input type="time" name="time" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Duration*</label>
                            <input type="number" name="duration" class="form-control" min="0" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Term*</label>
                            <select class=" form-control" name="term" required>
                                <option value="Week">Week</option>
                                <option value="Month">Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
            			<div class="form-group">
            				<label>@lang('notification/form.text')*</label>
            				<textarea class=" form-control" name="notification_text"></textarea>
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
