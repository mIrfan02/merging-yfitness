@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Reports
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/iCheck/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/pages/wizard.css') }}" rel="stylesheet">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <h1>Reports Section</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> Users</a></li>
            <li class="active">Reports</li>
        </ol>
    </section>
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true"
                            data-c="#fff" data-hc="white"></i>
                        Reports List
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                            <tr class="filters">

                                <th>ID</th>
                                <th>User Name</th>
                                <th>Reported User Name</th>
                                <th>Description</th>
                                <th>Screenshot</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <a href="{{ route('admin.users.profile', $report->user->id) }}" class="btn btn-primary btn-sm">
                                {{ $report->user->first_name . ' ' . $report->user->last_name }}
                            </a> --}}

                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->id }}</td>
                                    {{-- <td>{{ $report->user->first_name . ' ' . $report->user->last_name }}</td> --}}
                                    <td> <a href="{{ route('admin.users.profile', $report->user->id) }}">
                                            {{ $report->user->first_name . ' ' . $report->user->last_name }}
                                        </a></td>

                                    <td> <a href="{{ route('admin.users.profile', $report->reportedUser->id) }}"
                                            class="text-danger">
                                            {{ $report->reportedUser->first_name . ' ' . $report->reportedUser->last_name }}
                                        </a></td>

                                    {{-- <td>{{ $report->reportedUser->first_name . ' ' . $report->reportedUser->last_name }} --}}
                                    </td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ $report->image }}</td>
                                    <!-- Other report details -->
                                    <td>
                                        @if ($report->reportedUser->status == 1)
                                            <a href="{{ route('admin.users.unblocked', $report->reportedUser->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Unblock
                                            </a>
                                        @else
                                            <a href="{{ route('admin.users.blocked', $report->reportedUser->id) }}"
                                                class="btn btn-danger btn-sm">
                                                Block
                                            </a>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach





                        </tbody>
                    </table>
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div> <!-- row-->
    </section>


@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapwizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/js/pages/adduser.js') }}"></script>
@stop
