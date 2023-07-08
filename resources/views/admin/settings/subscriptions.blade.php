@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Subscriptions
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
                Subscriptions
            </a>
        </li>
        <li><a href="#">Subscriptions</a></li>
        <li class="active">Plan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <button class="btn btn-raised btn-primary " data-toggle="modal" data-target="#add">
        <span class="fa fa-plus"></span> Add New Subscription
    </button>
    <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add" role="dialog" 
        aria-labelledby="modalLabelfade" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  action="{{ url('admin/settings/subscriptions') }}" method="POST" class="form-horizontal">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="modalLabelfade">Add New Subscription</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group {{ $errors->first('caption', 'has-error') }}">
                                    <label for="caption" class="control-label">Title *</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group {{ $errors->first('video_url', 'has-error') }}">
                                    <label for="video_url" class="control-label">Per Month Fee</label>
                                    <input type="text" name="per_month_fee" class="form-control" placeholder="10">
                                </div>
                                <div class="form-group {{ $errors->first('video_url', 'has-error') }}">
                                    <label for="video_url" class="control-label">Total Fee</label>
                                    <input type="text" name="total_fee" class="form-control" placeholder="70">
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
                    Subscriptions List
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Per Month Fee</th>
                            <th>Total Fee</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($Subscriptions))
                            @foreach($Subscriptions as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->per_month_fee }}</td>
                                    <td>{{ $record->total_fee }}</td>
                                    <td>{{ $record->created_at->diffForHumans() }}</td>
                                    <td>
                                        @include('admin.settings.editsubscription')
                                        @include('admin.settings.statusubscription')
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
