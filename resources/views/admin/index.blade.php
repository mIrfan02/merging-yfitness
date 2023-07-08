@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Dashboard
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
          <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/pages/flot.css') }}" />

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Welcome to Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Dashboard
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <!-- Trans label pie charts strats here-->
                <div class="lightbluebg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>Courses</span>

                                    <div class="number" id="myTargetElement1"></div>
                                </div>
                                <i class="livicon  pull-right" data-name="archive-add" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement1.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement1.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
                <!-- Trans label pie charts strats here-->
                <div class="redbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Trainer's</span>

                                    <div class="number" id="myTargetElement2"></div>
                                </div>
                                <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement2.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement2.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
                <!-- Trans label pie charts strats here-->
                <div class="goldbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Subscribers</span>

                                    <div class="number" id="myTargetElement3"></div>
                                </div>
                                <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement3.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement3.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                <!-- Trans label pie charts strats here-->
                <div class="palebluecolorbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Registered Users</span>

                                    <div class="number" id="myTargetElement4"></div>
                                </div>
                                <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement4.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement4.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        
        <div class="col-lg-6">
            <!-- toggling series charts strats here-->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Bar Chart
                    </h3>
                    <span class="pull-right">
                        <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                        <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div id="bar-chart" class="flotChart"></div>
                </div>
            </div>
        </div>
    
        <div class="col-lg-6">
            <!-- Tracking charts strats here-->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Line Chart
                    </h3>
                    <span class="pull-right">
                        <i class="glyphicon glyphicon-chevron-up showhide clickable"></i>
                        <i class="glyphicon glyphicon-remove removepanel clickable"></i>
                    </span>
                </div>
                <div class="panel-body">
                    <div id="basicFlotLegend1" class="flotLegend"></div>
                    <div id="spline-chart" class="flotChart1"></div>
                </div>
            </div>
        </div>
    </div>
    </section>

@stop
<script>

    /*******Courses ******/

    var totalCourses = {!! \App\Courses::count() !!}

    var lastWeekCourses = {!! \App\Courses::totalCourseswithDueDate(date("Y-m-d", strtotime('monday last week')),date("Y-m-d", strtotime('sunday last week'))) !!}

    var lastMonthCourses = {!! \App\Courses::totalCourseswithDueDate(date("Y-m-d", strtotime('first day of last month')),date("Y-m-d", strtotime('last day of last month'))) !!}

    /*******Trainers ******/

    var totalTrainers = {!! \App\User::totalUsers([3]) !!}

    var lastWeekTrainers = {!! \App\User::totalUserswithDueDate([3],date("Y-m-d", strtotime('monday last week')),date("Y-m-d", strtotime('sunday last week'))) !!}

    var lastMonthTrainers = {!! \App\User::totalUserswithDueDate([3],date("Y-m-d", strtotime('first day of last month')),date("Y-m-d", strtotime('last day of last month'))) !!}


    /*******Subscribers ******/

    var totalSubscribers = {!! \App\User::totalUsers([2]) !!}

    var lastWeekSubscribers = {!! \App\User::totalUserswithDueDate([2],date("Y-m-d", strtotime('monday last week')),date("Y-m-d", strtotime('sunday last week'))) !!}

    var lastMonthSubscribers = {!! \App\User::totalUserswithDueDate([2],date("Y-m-d", strtotime('first day of last month')),date("Y-m-d", strtotime('last day of last month'))) !!}


    /*******Users ******/

    var totalUsers = {!! \App\User::totalUsers([2,3]) !!}

    var lastWeekUsers =  {!! \App\User::totalUserswithDueDate([2,3],date("Y-m-d", strtotime('monday last week')),date("Y-m-d", strtotime('sunday last week'))) !!}

    var lastMonthUsers = {!! \App\User::totalUserswithDueDate([2,3],date("Y-m-d", strtotime('first day of last month')),date("Y-m-d", strtotime('last day of last month'))) !!}


</script>
{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- EASY PIE CHART JS -->
    <script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bower-jquery-easyPieChart/js/jquery.easingpie.js') }}"></script>
    <!--for calendar-->
    <script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
    <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <!--Sparkline Chart-->
    <script src="{{ asset('assets/vendors/sparklinecharts/jquery.sparkline.js') }}"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="{{ asset('assets/vendors/countUp_js/js/countUp.js') }}"></script>
    <!--   maps -->
    <script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!--  todolist-->
    <script src="{{ asset('assets/js/pages/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>

    <!-- Charts -->
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.time.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.selection.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.symbol.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.resize.js') }}" ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flotchart/js/jquery.flot.categories.js') }}"  ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/splinecharts/jquery.flot.spline.js') }}"  ></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/flot_tooltip/js/jquery.flot.tooltip.js') }}"  ></script>
    
    <script>
        //start bar chart
var d1 = [["1", 100],["2", 80],["3", 66],["4", 48],["5", 68],["6", 48],["7",66],["8", 80],["9", 64],["10", 48],["11",64],["12",100]];
$.plot("#bar-chart", [{
    data: d1,
    label: "Project",
    color: "#F89A14"
}], {
    series: {
        bars: {
            align: "center",
            lineWidth: 0,
            show: !0,
            barWidth: .6,
            fill: .9
        }
    },
    grid: {
        borderColor: "#ddd",
        borderWidth: 1,
        hoverable: !0
    },
    tooltip: true,
    tooltipOpts: {
        content: '%s: %y'
    },

    xaxis: {
        tickColor: "#ddd",
        mode: "categories"
    },
    yaxis: {
        tickColor: "#ddd"
    },
    shadowSize: 0
});
//end bar chart



//start line chart

var s1 = [["Jan", 70],["Feb", 100],["Mar", 80],["Apr", 100],["May", 80],["Jun", 90],["Jul", 80]];

$.plot("#spline-chart", [{
    data: s1,
    label: " Product 1",
    color: "#01bc8c"
}], {
    series: {
        lines: {
            show: !1
        },
        splines: {
            show: !0,
            tension: .4,
            lineWidth: 2,
            fill: 0
        },
        points: {
            show: !0,
            radius: 4
        }
    },
    grid: {
        borderColor: "#fafafa",
        borderWidth: 1,
        hoverable: !0
    },
    tooltip: !0,
    tooltipOpts: {
        content: "%x : %y",
        defaultTheme: false
    },
    xaxis: {
        tickColor: "#fafafa",
        mode: "categories"
    },
    yaxis: {
        tickColor: "#fafafa"
    },
    shadowSize: 0
});

//end spline chart



    </script>

@stop