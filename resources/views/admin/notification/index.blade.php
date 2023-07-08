@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('banner/title.management')
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>@lang('banner/title.notifications')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li><a href="#">@lang('banner/title.notifications')</a></li>
        <li class="active">@lang('banner/title.notifications')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    @lang('banner/title.management')
                </h4>
                <div class="pull-right">
                    <a href="{{ route('admin.pushnotification.create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr class="filters">
                            <th>@lang('notification/table.id')</th>
                            <th>@lang('notification/table.gender')</th>
                            <th>@lang('notification/table.language')</th>
                            <th>@lang('notification/table.age_range')</th>
                            <th>@lang('notification/table.fitness_goal')</th>
                            <th>@lang('notification/table.date')</th>
                            <th>@lang('notification/table.course')</th>
                            <th>@lang('notification/table.link')</th>
                            <th>@lang('notification/table.cotification_text')</th>
                            <th>@lang('notification/table.status')</th>
                            <th>@lang('notification/table.created_at')</th>
                            <th>@lang('notification/table.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!empty($notifications))
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->id }}</td>
                                <td>{{ $notification->gender }}</td>
                                <td>{{ $notification->language }}</td>
                                <td>{{ $notification->age_range }}</td>
                                <td>{{ $notification->fitness_goal_id != NULL ? $notification->course_category->title : '' }}</td>
                                <td>{{ $notification->date }}</td>
                                <td>{{ $notification->course_id != NULL ? $notification->course->title : '' }}</td>
                                <td>{{ $notification->link }}</td>
                                <td>{!! $notification->notification_text !!}</td>
                                <td>{{ $notification->is_sent == 0 ? 'Awaiting' : 'Sent' }}</td>
                                <td>{{ $notification->created_at }}</td>
                                <td>
                                    <a href="#delete_confirm{{ $notification->id }}" data-toggle="modal"><i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="@lang('banner/table.delete-banner')"></i></a>
                                    <!-- Modal -->
<div class="modal fade" id="delete_confirm{{ $notification->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Are you sure, you want to delete?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.pushnotification.destroy', $notification->id) }}" method="POST">
            {{ csrf_field() }}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Permanent Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>


@stop
