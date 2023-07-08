@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Tutrials Videos
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
    <h1>Tutrials</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Settings
            </a>
        </li>
        <li><a href="#">Tutrial</a></li>
        <li class="active">Videos</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <button class="btn btn-raised btn-primary " data-toggle="modal" data-target="#add">
        <span class="fa fa-plus"></span> Add tutrial videos
    </button>
    <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add" role="dialog" 
        aria-labelledby="modalLabelfade" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  action="{{ url('admin/settings/tutrial') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="modalLabelfade">Add tutrial videos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group {{ $errors->first('caption', 'has-error') }}">
                                    <label for="caption" class="control-label">Caption *</label>
                                    <textarea required name="caption" class="form-control" placeholder="Enter Caption Here"></textarea>
                                </div>
                                <div class="form-group {{ $errors->first('video', 'has-error') }}">
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
                                <div class="form-group">
                                    <label class="control-label">Thumbnail:</label>
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
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Tutrials List
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Caption</th>
                            <th>Video</th>
                            <th>Thumbnail</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($TutrialVideos))
                            @php
                                $x = 1;
                            @endphp
                            @foreach($TutrialVideos as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->caption }}</td>
                                    <td>
                                        @if(!is_null($record->video_url))
                                            <video width="220" height="180" controls>
                                                <source src="{{ url('/uploads/courses/'.$record->video_url) }}" type="video/mp4"> 
                                                    Your browser does not support the video tag.
                                            </video>
                                        @endif
                                    </td>
                                    <td>
                                        <img class="img-thumbnail" width="100" src="{{ url($record->thumbnail) }}">
                                    </td>
                                    <td>{{ $record->created_at->diffForHumans() }}</td>
                                    <td>
                                        @include('admin.settings.edittutrial')
                                        @if($x != 1)
                                            @include('admin.settings.statustutrial')
                                        @endif
                                        @php
                                            $x++;
                                        @endphp
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
   
@stop
