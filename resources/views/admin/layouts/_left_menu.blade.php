<ul id="menu" class="page-sidebar-menu">
    <li {!! Request::is('admin') ? 'class="active"' : '' !!}>
        <a href="{{ route('admin.dashboard') }}">
            <i class="livicon" data-name="home" data-size="18" data-c="#F89F1F" data-hc="#F89F1F" data-loop="true"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>
    @if (Sentinel::inRole('admin'))
        <li {!! Request::is('admin/settings') ||
        Request::is('admin/settings/fitnessgoals') ||
        Request::is('admin/settings/equipments') ||
        Request::is('admin/settings/tutrial') ||
        Request::is('admin/settings/subscriptions')
            ? 'class="active"'
            : '' !!}>
            <a href="#">
                <i class="livicon" data-name="settings" data-size="18" data-c="#F89F1F" data-hc="#F89F1F"
                    data-loop="true"></i>
                <span class="title">Settings</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! Request::is('admin/settings/fitnessgoals') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/settings/fitnessgoals') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Fitness Goals
                    </a>
                </li>
                <li {!! Request::is('admin/settings/equipments') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/settings/equipments') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Equipments
                    </a>
                </li>
                <li {!! Request::is('admin/settings/tutrial') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/settings/tutrial') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Tutrial Videos
                    </a>
                </li>
                <li {!! Request::is('admin/settings/subscriptions') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/settings/subscriptions') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Subscriptions
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if (Sentinel::inRole('admin') || Sentinel::inRole('supervisor'))
        <li {!! Request::is('admin/courses') || Request::is('admin/courses/*') || Request::is('admin/courses/category')
            ? 'class="active"'
            : '' !!}>
            <a href="#">
                <i class="livicon" data-name="home" data-size="18" data-c="#F89F1F" data-hc="#F89F1F"
                    data-loop="true"></i>
                <span class="title">Courses</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! (Request::is('admin/courses') || Request::is('admin/courses/*')) && !Request::is('admin/courses/category')
                    ? 'class="active" id="active"'
                    : '' !!}>
                    <a href="{{ URL::to('admin/courses') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Courses
                    </a>
                </li>
                @if (Sentinel::inRole('admin'))
                    <li {!! Request::is('admin/courses/category') ? 'class="active" id="active"' : '' !!}>
                        <a href="{{ URL::to('admin/courses/category') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Category
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (Sentinel::inRole('admin') || Sentinel::inRole('customer_service'))
        <li {!! Request::is('admin/users') ||
        Request::is('admin/users/create') ||
        Request::is('admin/user_profile') ||
        Request::is('admin/users/*') ||
        Request::is('admin/deleted_users') ||
        Request::is('admin/user-logbook')
            ? 'class="active"'
            : '' !!}>
            <a href="#">
                <i class="livicon" data-name="user" data-size="18" data-c="#F89F1F" data-hc="#F89F1F"
                    data-loop="true"></i>
                <span class="title">Users</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! Request::is('admin/users') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/users') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Users
                    </a>
                </li>
                <li {!! Request::is('admin/users/create') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/users/create') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Add New User
                    </a>
                </li>


                <li>
                    <a href="{{ route('users.reports') }}">
                        <i class="fa fa-angle-double-right"></i>
                        View Reports
                    </a>
                </li>


                <li {!! Request::is('admin/marketing/open-reminder/create') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ route('admin.openreminder.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Open Reminder Notifications
                    </a>
                </li>
                <li {!! Request::is('admin/user-logbook') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ route('admin.courselogbook.index') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Course Logbook
                    </a>
                </li>
                <li {!! Request::is('admin/deleted_users') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/deleted_users') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Deleted Users
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if (Sentinel::inRole('admin') || Sentinel::inRole('marketer'))
        <li {!! Request::is('admin/marketing/banners') ||
        Request::is('admin/marketing/pushnotifications') ||
        Request::is('admin/marketing/pushnotifications/create')
            ? 'class="active"'
            : '' !!}>
            <a href="#">
                <i class="livicon" data-name="home" data-size="18" data-c="#F89F1F" data-hc="#F89F1F"
                    data-loop="true"></i>
                <span class="title">Marketing</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li {!! Request::is('admin/marketing/banners') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/marketing/banners') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Banners
                    </a>
                </li>
                <li {!! Request::is('admin/marketing/pushnotifications') ? 'class="active" id="active"' : '' !!}>
                    <a href="{{ URL::to('admin/marketing/pushnotifications') }}">
                        <i class="fa fa-angle-double-right"></i>
                        Push Notifications
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @include('admin/layouts/menu')
</ul>
