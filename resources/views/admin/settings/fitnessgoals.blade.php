@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Fitness Goals
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/modal/css/component.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/advmodals.css') }}" rel="stylesheet"/>
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>Fitness Goals</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                Settings
            </a>
        </li>
        <li><a href="#">Fitness Goals</a></li>
        <li class="active">List</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <button class="btn btn-raised btn-primary " data-toggle="modal" data-target="#add_category">
        <span class="fa fa-plus"></span> Add New Fitness Category
    </button>
    <div class="modal fade modal-fade-in-scale-up" tabindex="-1" id="add_category" role="dialog" 
        aria-labelledby="modalLabelfade" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form  action="{{ url('admin/settings/fitnessgoals') }}" method="POST" class="form-horizontal">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title" id="modalLabelfade">Add New Fitness Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- CSRF Token -->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="form-group {{ $errors->first('institute_name', 'has-error') }}">
                                    <label for="institute_name" class="control-label">Category Name *</label>
                                    <div>
                                        <input id="title" required name="title" type="text"
                                               placeholder="Name" class="form-control required" value="{!! old('title') !!}"/>

                                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                    </div>
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
                <h4 class="panel-title">Goals List</h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($categories))
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        @include('admin.settings.editfitnessgoals')
                                        @include('admin.settings.statusfitnessgoals')
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
   <script type="text/javascript" src="{{ asset('assets/vendors/modal/js/classie.js')}}"></script>
@stop
