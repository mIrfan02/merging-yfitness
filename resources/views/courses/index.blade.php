@extends('layouts/default')

{{-- Page title --}}
@section('title')
Courses
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/shopping.css') }}">
    <link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
    <style>
        tr td {
            text-align: left;
        }
    </style>
@stop

{{-- breadcrumb --}}
@section('top')

@stop


{{-- Page content --}}
@section('content')
    <hr class="content-header-sep">
    <!-- Container Section Start -->
    <div class="container">
        <!--Content Section Start -->
        <!-- Best Deal Section Start -->
        <div class="welcome">
            <h3>My Courses</h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Video</th>
                            <th>Image</th>
                            <th>Detail</th>
                            <th>Created At</th>
                            <th>Activities</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($courses))
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->description }}</td>
                                    <td>{{ $course->video }}</td>
                                    <td>
                                        @if(!is_null($course->image))
                                            <img src="{{ url('/uploads/courses/'.$course->image) }}" width="50">
                                        @endif
                                    </td>
                                    <td>
                                        Completion Days: {{ $course->daystocompletion }}<br>
                                        Total Weeks: {{ $course->total_weeks }}<br>
                                        Week a Days: {{ $course->week_a_days }}<br>
                                    </td>
                                    <td>{{ $course->created_at->diffForHumans() }}</td>
                                    <td>
                                        @include('courses.viewAllActivities')
                                        <br>
                                        <a href="{{ url('/courses/days/addDayActivity/'.$course->id) }}">
                                            <span class="fa fa-plus"></span> Add
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- //Mens Section End -->
        <!-- //Content Section End -->
    </div>
    
@stop

{{-- page level scripts --}}
