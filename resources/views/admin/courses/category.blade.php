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
        <li><a href="#">Categories</a></li>
        <li class="active">List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <button class="btn btn-raised btn-primary" data-toggle="modal" data-target="#add"><span class="fa fa-plus"></span> Add New Course Category</button>
    <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add" role="dialog" 
        aria-labelledby="modalLabelfade" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  action="{{ url('admin/courses/categorysave') }}" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="modalLabelfade">Add New Course Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group {{ $errors->first('institute_name', 'has-error') }}">
                                    <label for="institute_name" class="control-label">Title *</label>
                                    <input id="title" required name="title" type="text"
                                        placeholder="Title" class="form-control required" value="{!! old('title') !!}"/>

                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
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
                                                <input type="file" name="pic" required id="pic" />
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
                <h4 class="panel-title">Course Categories List</h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($categories))
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>
                                        @if(!is_null($category->image))
                                            <img src="{{ url($category->image) }}" width="50">
                                        @endif
                                    </td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        @include('admin.courses.editcoursecategory')
                                        @include('admin.courses.statuscoursecategory')
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
