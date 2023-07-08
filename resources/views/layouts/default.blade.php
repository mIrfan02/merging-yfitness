<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>
    
    <title>
        @section('title')
         | {{ config('app.name') }}
        @show
    </title>
    
    <!--======================================================
        CSS Stylesheets
    ======================================================-->
    
    
    @if(!Request::is('/'))
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib.css') }}">
    @else
        <link rel='stylesheet' type='text/css' href="{{ asset('bootstrap/css/bootstrap.min.css') }}" >
        <link rel='stylesheet' type='text/css' href="{{ asset('css/animate.min.css') }}" >
        <link rel='stylesheet' type='text/css' href="{{ asset('css/ionicons.min.css') }}" >
        <link rel='stylesheet' type='text/css' href="{{ asset('css/linea.css') }}" >
        <link rel='stylesheet' type='text/css' href="{{ asset('css/waves.min.css') }}" >
        <link rel='stylesheet' type='text/css' href="{{ asset('css/owl.carousel.css') }}" >
        <link rel='stylesheet' type='text/css' href="{{ asset('css/magnific-popup.css') }}" >
        <link rel='stylesheet' type='text/css' href="{{ asset('css/style.css') }}" >
    @endif
    <link rel="shortcut icon" href="{{ asset('/img/favicon.png') }}">
    <!-- ========== CDN Stylesheet ========== -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <!--page level css-->
    @yield('header_styles')
</head>

        

<body>
    <!-- Header Start -->
    @if(!Request::is('/'))
        <header>
            <!-- Icon Section Start -->
            <div class="icon-section">
                <div class="container">
                    <ul class="list-inline">
                        <li>
                            <a href="#"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="google-plus" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="linkedin" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> <i class="livicon" data-name="rss" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <ul class="list-inline icon-position">
                                <li>
                                    <a href="mailto:"><i class="livicon" data-name="mail" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                    <label class="hidden-xs"><a href="mailto:" class="text-white">info@yfitness.com</a></label>
                                </li>
                                <li>
                                    <a href="tel:"><i class="livicon" data-name="phone" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                    <label class="hidden-xs"><a href="tel:" class="text-white">(334) 516-8664</a></label>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- //Icon Section End -->
            <!-- Nav bar Start -->
            <nav class="navbar navbar-default container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                        <span><a href="#">_<i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true" data-c="#757b87" data-hc="#ccc"></i>
                        </a></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logo.png') }}" width="150" alt="logo" class="logo_position">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li {!! (Request::is('/') ? 'class="active"' : '') !!}><a href="{{ route('home') }}"> Home</a></li>
                        <li {!! (Request::is('courses') || Request::is('courses/*') ? 'class="active"' : '') !!}>
                            <a href="{{ url('courses') }}"> Courses</a>
                        </li>
                        {{--based on anyone login or not display menu items--}}
                        @if(Sentinel::guest())
                            <li><a href="{{ URL::to('login') }}">Login</a></li>
                            <li><a href="{{ URL::to('register') }}">Register</a></li>
                        @else
                            <li {{ (Request::is('my-account') ? 'class=active' : '') }}><a href="{{ URL::to('my-account') }}">My Account</a></li>
                            <li><a href="{{ URL::to('logout') }}">Logout</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            <!-- Nav bar End -->
        </header>
    @endif
    <!-- //Header End -->
    
    <!-- slider / breadcrumbs section -->
    @yield('top')

    <!-- Content -->
    @yield('content')

    <!--======================================================
        Footer
    ======================================================-->
    <footer>
        <div class='container' >
            <div class='row' >
                
                <div class='col-sm-6' >
                    <p class='wow fadeInLeft' data-wow-delay='.2s' >
                        &copy; 2021 {{ config('app.name') }} All Rights Reserved
                    </p>
                </div>
                
                <div class='col-sm-6' >
                    
                    <!-- Footer Social Icons -->
                    <ul class='footer-social wow fadeInRight' data-wow-delay='.2s' >
                        <li>
                            <a href='https://www.facebook.com/xpeats' >
                                <i class='ion-social-facebook' ></i>
                            </a>
                        </li>
                        <li>
                            <a href='https://twitter.com/xplifeinc' >
                                <i class='ion-social-twitter' ></i>
                            </a>
                        </li>
                            </a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </footer>
    
    <!--======================================================
        JavaScript Files
    ======================================================-->
    <script src="{{ asset('js/jquery.min.js') }}" ></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"'' ></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}" ></script>
    <script src="{{ asset('js/parallax.min.js') }}" ></script>
    <script src="{{ asset('js/particles.min.js') }}" ></script>
    <script src="{{ asset('js/waves.min.js') }}" ></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" ></script>
    <script src="{{ asset('js/wow.min.js') }}" ></script>
    <script src="{{ asset('js/validator.min.js') }}" ></script>
    <script src="{{ asset('js/smooth-scroll.min.js') }}" ></script>
    <script src="{{ asset('js/script.js') }}" ></script>

    <!-- script for google reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- //Footer Section End -->
    <!--global js end-->

    <!-- pusher js -->
    @include('admin.layouts.pusher')
    <!-- pusher js end -->

    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
</body>

</html>
