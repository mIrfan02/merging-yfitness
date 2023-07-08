@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Users List
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
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                    Dashboard
                </a>
            </li>
            <li><a href="#"> Users</a></li>
            <li class="active">Users List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content paddingleft_right15">
        <div class="row">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="user" data-size="16" data-loop="true"
                            data-c="#fff" data-hc="white"></i>
                        Users List
                    </h4>
                </div>
                <br />
                <div class="panel-body">
                    <table class="table table-bordered " id="table">
                        <thead>
                            <tr class="filters">
                                <th>ID</th>
                                <th>Role</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User E-mail</th>
                                {{-- <th>Courses</th> --}}
                                <th>Assign Role</th>
                                <th>Package Subscribed</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->getRoles()[0]->name }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{-- <td>{{ $user->courses }}
                                        @if ($user->getRoles()[0]->name == 'Trainer')
                                            <a target="_blank"
                                                href='{{ url('admin/courses/training_courses', $user->id) }}'>Assigned:
                                                {{ App\Courses::where('trainer_id', $user->id)->count() }}</a>
                                        @elseif($user->getRoles()[0]->name == 'User')
                                            <a target="_blank"
                                                href='{{ url('admin/courses/subscribe_courses', $user->id) }}'>Subscribed:
                                                {{ App\UserCourseSchedule::where('user_id', $user->id)->count() }}</a>
                                        @endif
                                    </td> --}}
                                    <td>
                                        <select name="role" onchange="assignRole(this,{{ $user->id }})"
                                            id="">
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $user->getRoles()[0]->name == $role->name ? 'selected' : '' }}>
                                                    {{ $role->name }}</option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td>
                                        @if (!is_null($user->subscriptionPlan))
                                            {{ $user->subscriptionPlan->title }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>

                                        <a href="{{ route('admin.users.delete', $user->id) }}" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            Delete
                                        </a>

                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div> <!-- row-->
    </section>
@stop

<script>
    function assignRole(e, user_id) {

        let role = e.value;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            type: "Post",
            url: "{{ route('admin.assign.role') }}",
            data: {
                role: role,
                userId: user_id
            },
            dataType: "dataType",
            success: function(response) {
                console.log(response)
            }
        });
    }
</script>
{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>


    <script>
        $(function() {

            var table = $('#table').DataTable({

                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.users.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'courses',
                        name: 'courses'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            table.on('draw', function() {
                $('.livicon').each(function() {
                    $(this).updateLivicon();
                });
            });
        });
    </script>

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>
    <script>
        $(function() {
            $('body').on('hidden.bs.modal', '.modal', function() {
                $(this).removeData('bs.modal');
            });
        });
    </script>
@endsection
