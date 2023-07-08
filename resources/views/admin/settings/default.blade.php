@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Default
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
<link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Courses</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Settings
            </a>
        </li>
        <li><a href="#">Settings</a></li>
        <li class="active">Default</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="col-md-12">
            <form  action="{{ url('admin/settings') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <h2>Add tutrial videos</h2>
                <div class="form-group {{ $errors->first('caption', 'has-error') }}">
                    <label for="caption" class="col-sm-2 control-label">Caption *</label>
                    <div class="col-sm-4">
                        <textarea required name="caption" class="form-control" placeholder="Enter Caption Here"></textarea>
                    </div>
                </div>
                <div class="form-group {{ $errors->first('video_url', 'has-error') }}">
                    <label for="video_url" class="col-sm-2 control-label">Video Url *</label>
                    <div class="col-sm-4">
                        <textarea required name="video_url" class="form-control" placeholder="Enter Video Url"></textarea>
                    </div>
                </div>
                <div class="form-group {{ $errors->first('pic', 'has-error') }}">
                    <label class="col-md-2 control-label">Thumbnail:</label>
                    <div class="col-md-10">
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
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="submit" value="Add" class="btn btn-primary pull-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
   
@stop
