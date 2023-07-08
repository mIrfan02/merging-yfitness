@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Search Results
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/x-editable/css/bootstrap-editable.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/pages/user_profile.css') }}" rel="stylesheet"/>
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>User Search Results</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">Users</a>
            </li>
            <li class="active">Search Resutls</li>
        </ol>
    </section>
    <!--section ends-->
    <section class="content">
        <form action="{{ route('admin.user.search') }}" method="GET" style="margin-bottom: 20px;">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                       <input type="text" name="search" class="form-control" placeholder="Name, Email or ID">
                       <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Find Now</button>
                       </span>
                    </div>
                </div>
            </div>
        </form>
        @if(count($users) > 0)
        @foreach($users as $user)
        @if(Sentinel::getUser()->id != $user->id)
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-3">
                <img src="{{ asset('uploads/users/'.$user->pic) }}" width="100%">
            </div>
            <div class="col-md-9">
                <h4><a href="{{ route('admin.user.details', $user->id) }}">{{ $user->first_name . ' ' . $user->last_name }}</a></h4>
                @if(!in_array($user->id, $friends))
                <form action="{{ route('admin.user.addfriend', $user->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id">
                    <button class="btn btn-primary" type="submit" style="margin-top: 15px;">Add Friend</button>
                </form>
                @endif
            </div>
        </div>
        @endif
        @endforeach
        @else
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-md-12">
                <h3 class=" text-danger">No users found.</h3>
            </div>
        </div>
        @endif
    </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- Bootstrap WYSIHTML5 -->
    <script  src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        
    </script>
@stop
