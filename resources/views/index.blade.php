@extends('layouts/default')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    
    <!--end of page level css-->
@stop

{{-- slider --}}
@section('top')

@stop

{{-- content --}}
@section('content')
    <!--======================================================
            Preloader
        ======================================================-->
        <div id='preloader' >
            <div class='loader' >
                <img src='img/loader.gif' alt>
            </div>
        </div>
        
        <!--======================================================
            Navbar
        ======================================================-->
        <nav class='navbar navbar-fixed-top' >
            <div class='container' >
                
                <div class='navbar-header' >
                    
                    <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#nav-collapse' aria-expanded='false'>
                        <span class='sr-only' >Toggle navigation</span>
                        <span class='icon-bar' ></span>
                        <span class='icon-bar' ></span>
                        <span class='icon-bar' ></span>
                    </button>
                    
                    <a href='#' class='navbar-brand' >
                        <img class='logo-light' src='img/logo.png' alt>
                        <img class='logo-dark' src='img/logo-dark.png' alt>
                    </a>
                    
                </div>
                
                <div class='collapse navbar-collapse' id='nav-collapse' >
                    
                    <ul class='nav navbar-nav navbar-right' >
                        
                        <li class='active'>
                            <a href='#intro' data-scroll>Home</a>
                        </li>
                        
                        <li>
                            <a href='#features-1' data-scroll>About US</a>
                        </li>
                        
                        <li>
                            <a href='#screenshots' data-scroll>App</a>
                        </li>
                        
                        <li>
                            <a href="{{ url('login') }}">Login</a>
                        </li>

                        <li>
                            <a href="{{ url('register') }}">Register</a>
                        </li>
                        
                        <li>
                            <a href='#download' data-scroll>Download</a>
                        </li>
                        
                        <li>
                            <a href='#contact' data-scroll>Contact</a>
                        </li>
                        
                    </ul>
                    
                </div>
            </div>
        </nav>
        
        
        <!--======================================================
            Intro Section
        ======================================================-->
        <section id='intro' class='main-section parallax' data-parallax='scroll' data-image-src='img/bg.jpg' >
            
            <!-- Particles Background -->
            
            <div class='container' >
                <div class='row' >
                    
                    <div class='col-md-6' >
                        
                        <div class='intro-text' >
                            
                            <h1 class='wow fadeInUp' data-wow-delay='.2s' >
                                Your favourite gym, for fitness

                            </h1>
                            
                            <p class='font-alt wow fadeInUp' data-wow-delay='.4s' >You’ve got things to do! We’ve got options!</p>
                            
                            <div class='btns' >
                                
                                <a href='#8' class='app-btn wow bounceIn' data-wow-delay='.6s' target='_blank' > 
                                    <i class='ion-social-apple' ></i>
                                    App Store
                                </a>
                                
                                <a href='#' class='app-btn wow bounceIn' data-wow-delay='.8s' target='_blank'  >
                                    <i class='ion-android-playstore' ></i>
                                    Google Play
                                </a>
                                
                            </div>
                            
                        </div>
                    </div>
                    
                    
                    <div class='col-md-6' >
                        
                        <div class='mockup' >
                            <img src='img/mockup1-front.png' class='front wow fadeInDown' data-wow-duration='.7s' data-wow-delay='1.6s' alt>
                            <img src='img/mockup1-back.png' class='back wow fadeInDown' data-wow-duration='.7s' data-wow-delay='1.3s' alt>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        
        <!--======================================================
            Mockup Section
        ======================================================-->
        <section id='features-1' class='mockup-section' >
            <div class='container' >
                <div class='row' >
                    
                    <div class='col-md-7' >
                        
                        <div class='screens-mockup' >
                            <img class='phone wow fadeInUp' data-wow-duration='.8s' data-wow-delay='.2s' src='img/mockup2-phone.png' alt>
                            <img class='screen wow fadeIn' data-wow-delay='1s' src='img/mockup2-screen1.png' alt>
                            <img class='screen wow fadeIn' data-wow-delay='1.4s' src='img/mockup2-screen2.png' alt>
                            <img class='screen wow fadeIn' data-wow-delay='1.8s' src='img/mockup2-screen3.png' alt>
                        </div>
                        
                    </div>
                    
                    <div class='col-md-5' >
                        
                        <div class='mockup-text' >
                            
                            <span class='font-alt wow fadeInUp' data-wow-delay='.2s' >Yfitness </span>
                            
                            <h2 class='wow fadeInUp' data-wow-delay='.4s' >Fitness is easy</h2>
                            
                            <p class='wow fadeInUp' data-wow-delay='.6s' >
                                Support your local restaurants and grocery stores by ordering the food you enjoy, delivered straight to your door.
                            </p>
                            
                            <a href='https://www.youtube.com/watch?v=1piFN_ioMVI&ab_channel=BumrungradInternationalHospital' class='btn-custom arrow-btn wow fadeInUp' data-wow-delay='.8s' target='_blank' >
                                Watch Video
                                <span class='arrow' ></span>
                            </a>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
        
        <!--======================================================
            Mockups Section 2
        ======================================================-->
        <section id='features-2' class='mockup-section section-2' >
            <div class='container' >
                <div class='row' >
                    
                    <div class='col-md-7 col-md-push-5' >
                        
                        <div class='mockup-shadow' >
                            <img class='shadow wow fadeIn' data-wow-delay='.4s' data-wow-offset='200' data-wow-duration='1.2s' src='img/mockup3-shadow.png' alt>
                            <img class='phone wow fadeInDown' data-wow-delay='.2s' data-wow-offset='200' data-wow-duration='1.2s' src='img/mockup3-phone.png' alt>
                        </div>
                        
                    </div>
                    <div class='col-md-5 col-md-pull-7' >
                        
                        <div class='mockup-text' >
                            
                            <span class='font-alt wow fadeInUp' data-wow-delay='.2s' >Book </span>
                            
                            <h2 class='wow fadeInUp' data-wow-delay='.4s' >Share & Get Paid</h2>
                            
                            <p class='wow fadeInUp' data-wow-delay='.6s' >
                                Share our app with others and earn cash each time your friends make a purchase. XP Eats, sharing is caring!
                            </p>
                            
                            <a href='https://www.youtube.com/watch?v=1piFN_ioMVI&ab_channel=BumrungradInternationalHospital' class='btn-custom arrow-btn wow fadeInUp' data-wow-delay='.8s' target='_blank' >
                                Learn More:
                                <span class='arrow' ></span>
                            </a>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        
        <!--======================================================
            Features Section
        ======================================================-->
        <section id='features-3' class='features-section' >
            <div class='container' >
                
                <div class='section-header text-center' >
                    <h2 class='wow fadeInUp' data-wow-delay='.2s' >Yfitness App</h2>
                    <p class='wow fadeInUp' data-wow-delay='.4s' >Become a part time trainer</p>
                </div>
                
                <div class='row' >
                    
                    <div class='col-md-4' >
                        <div class='col-features text-right' >
                            
                            <div class='col-feature wow fadeInLeft' data-wow-delay='.2s' >
                                <i class='icon-basic-heart' ></i>
                                <h4>Love your community?</h4>
                                <p>
                                    Drive with XP Eats, where we share our earnings with users to help families get by 
                                </p>
                            </div>
                            
                            <div class='col-feature wow fadeInLeft' data-wow-delay='.4s' >
                                <i class='icon-basic-paperplane' ></i>
                                <h4>Notifications</h4>
                                <p>
                                    Receive order alerts, each order receipt is emailed to you directly
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class='col-md-4' >
                        
                        <div class='mockup wow fadeInUp' data-wow-delay='.2s' >
                            <img src='img/mockup4.png' alt>
                        </div>
                        
                    </div>
                    
                    <div class='col-md-4' >
                        <div class='col-features text-left' >
                            
                            <div class='col-feature wow fadeInRight' data-wow-delay='.2s' >
                                <i class='icon-basic-bolt' ></i>
                                <h4>Your time</h4>
                                <p>
                                    Earn money quickly, your time is your own to manage. 
                                </p>
                            </div>
                            
                            <div class='col-feature wow fadeInRight' data-wow-delay='.4s' >
                                <i class='icon-ecommerce-wallet' ></i>
                                <h4>Weekly Payouts</h4>
                                <p>
                                    Earn money weekly! Auto deposits and track your results on the XP Driver app
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--======================================================
            Screenshots Section
        ======================================================-->
        <section id='screenshots' class='screenshots-section' >
            <div class='container' >
                
                <div class='section-header text-center' >
                    <h2 class='wow fadeInUp' data-wow-delay='.2s' >Become a Driver</h2>
                    <p class='wow fadeInUp' data-wow-delay='.4s' >
                        As an XP Driver you’ll earn reliable income - work anytime, anywhere
                    </p>
                </div>
                
                <ul class='screenshots-slider wow fadeInRight' data-wow-delay='.6s' >
                    
                    <li>
                        <figure>
                            <img src='img/screens/1.jpg' alt>
                            <div class='overlay' >
                                <a href='img/screens/1.jpg' class='view-btn' ></a>
                            </div>
                        </figure>
                    </li>
                    
                    <li>
                        <figure>
                            <img src='img/screens/2.jpg' alt>
                            <div class='overlay' >
                                <a href='img/screens/2.jpg' class='view-btn' ></a>
                            </div>
                        </figure>
                    </li>
                    
                    <li>
                        <figure>
                            <img src='img/screens/3.jpg' alt>
                            <div class='overlay' >
                                <a href='img/screens/3.jpg' class='view-btn' ></a>
                            </div>
                        </figure>
                    </li>
                    
                    <li>
                        <figure>
                            <img src='img/screens/4.jpg' alt>
                            <div class='overlay' >
                                <a href='img/screens/4.jpg' class='view-btn' ></a>
                            </div>
                        </figure>
                    </li>
                    
                    <li>
                        <figure>
                            <img src='img/screens/5.jpg' alt>
                            <div class='overlay' >
                                <a href='img/screens/5.jpg' class='view-btn' ></a>
                            </div>
                        </figure>
                    </li>
                    
                    <li>
                        <figure>
                            <img src='img/screens/6.jpg' alt>
                            <div class='overlay' >
                                <a href='img/screens/6.jpg' class='view-btn' ></a>
                            </div>
                        </figure>
                    </li>
                    
                </ul>
            </div>
            
        </section>
        
        
        <!--======================================================
            Video Section
        ======================================================-->
        <section id='video' class='video-section parallax' data-parallax='scroll' data-image-src='img/bg-mockup.jpg' >
            <div class='container' >
                <div class='row' >
                    <div class='col-md-4 col-sm-6' >
                        
                        <div class='watch-video' >
                            
                            <a href='https://www.youtube.com/watch?v=1piFN_ioMVI&ab_channel=BumrungradInternationalHospital' class='play-btn wow bounceIn' data-wow-delay='.2s' target='_blank' >
                                <img src='img/play-btn.png' alt>
                            </a>
                            
                            <h4 class='font-alt wow fadeInUp' data-wow-delay='.4s' >Watch Video</h4>
                            
                            <p class='wow fadeInUp' data-wow-delay='.6s' >
                                Learn about XP Eats and what it can do for your business
                            </p>
                        
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        
        
        <!--======================================================
            More Features Section
        ======================================================-->
        <section id='features-4' class='features-2-section' >
            <div class='container' >
                
                <div class='section-header text-center' >
                    <h2 class='wow fadeInUp' data-wow-delay='.2s' >How we work</h2>
                    <p class='wow fadeInUp' data-wow-delay='.4s' >We've got a lot of features, here are some more</p>
                </div>
                
                <div class='row' >
                    <div class='col-md-4' >
                        
                        <div class='icon-feature wow fadeInUp' data-wow-delay='.2s' >
                            
                            <div class='icon' >
                                <i class='icon-basic-heart' ></i>
                            </div>
                            
                            <div class='content' >
                                <h4>Order what you Love</h4>
                                <p>
                                    Have a favorite restaurant? Order through XP Eats
                                </p>
                            </div>
                            
                        </div>
                        
                    </div>
                    <div class='col-md-4' >
                        
                        <div class='icon-feature wow fadeInUp' data-wow-delay='.4s' >
                            
                            <div class='icon' >
                                <i class='icon-basic-paperplane' ></i>
                            </div>
                            
                            <div class='content' >
                                <h4>Add items to your cart</h4>
                                <p>
                                    Select items & add them to your cart 
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class='col-md-4' >
                        
                        <div class='icon-feature wow fadeInUp' data-wow-delay='.6s' >
                            
                            <div class='icon' >
                                <i class='icon-basic-cup' ></i>
                            </div>
                            
                            <div class='content' >
                                <h4>Delivery</h4>
                                <p>
                                    We will deliver straight to your door, add instructions if needed
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                
                <div class='row' >
                    
                    <div class='col-md-4' >
                        
                        <div class='icon-feature wow fadeInUp' data-wow-delay='.2s' >
                            <div class='icon' >
                                <i class='icon-ecommerce-wallet' ></i>
                            </div>
                            <div class='content' >
                                <h4>Save Money</h4>
                                <p>
                                    Our vendors provide incentives and discounts just for you
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class='col-md-4' >
                        
                        <div class='icon-feature wow fadeInUp' data-wow-delay='.4s' >
                            <div class='icon' >
                                <i class='icon-basic-gear' ></i>
                            </div>
                            <div class='content' >
                                <h4>Customizable menu</h4>
                                <p>
                                    Vendors udpate your menu at any time
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class='col-md-4' >
                        
                        <div class='icon-feature wow fadeInUp' data-wow-delay='.6s' >
                            <div class='icon' >
                                <i class='icon-ecommerce-graph1' ></i>
                            </div>
                            <div class='content' >
                                <h4>Transaction Reports</h4>
                                <p>
                                    View real time transaction information, auto deposits and alerts
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class='mockup' >
                    <img class='shadow wow zoomIn animated' src='img/perspective-shadow.png' alt>
                    <img class='phone wow fadeInDown animated' src='img/perspective-phone.png' alt>
                </div>
                
            </div>
        </section>
        
        <!--======================================================
            Register Section
        ======================================================-->
        <!-- <section id='register' class='register-section' >
            <div class='container' >
                
                <div class='section-header text-center' >
                    <h2 class='wow fadeInUp' data-wow-delay='.2s' >Register</h2>
                    <p class='wow fadeInUp' data-wow-delay='.4s' >Register, and earn</p>
                </div>
                
                <div class='row' >
                    
                    <div class='col-md-4' >
                        
                        <div class='p-table wow fadeInRight' data-wow-delay='.8s' >
                            <div class='header' >
                                <h4>XP Eats</h4>
                                <div class='price' >
                                    <span class='currency' >$</span>
                                    <span class='amount' >FREE</span>
                                    <span class='period' >/forever</span>
                                </div>
                            </div>
                            <ul class='items' >
                                <li>Order</li>
                                <li>Track</li>
                                <li>Receive</li>
                            </ul>
                            <a href='https://xp.life/refer.php?_user=jaminican&r=u' class='register-btn arrow-btn' target='_blank' >
                                Register for XP Eats
                                <span class='arrow' ></span>
                                <br/>
                            
                            </a>
                        </div>
                        
                    </div>
                    <div class='col-md-4' >
                        
                        <div class='p-table standard wow bounceIn' data-wow-delay='.2s' >
                            <div class='header' >
                                <h4>XP Driver</h4>
                                <div class='price' >
                                    <span class='currency' ></span>
                                    <span class='amount' >Time to</span>
                                    <span class='period' >Get paid</span>
                                </div>
                            </div>
                            <ul class='items' >
                                <li>Work on your time</li>
                                <li>Earn more</li>
                                <li>Drive with confidence</li>
                            </ul>
                            <a href='https://xp.life/refer.php?_user=oneilmclean2&r=d' class='register-btn arrow-btn' target='_blank' >
                                Register for XP Driver
                                <span class='arrow' ></span>
                                <br/>
                    
                            </a>
                        </div>
                        
                    </div>
                    <div class='col-md-4' >
                        
                        <div class='p-table wow fadeInLeft' data-wow-delay='.8s' >
                            <div class='header' >
                                <h4>Business Owner</h4>
                                <div class='price' >
                                    <span class='currency' >$</span>
                                    <span class='amount' >FREE</span>
                                    <span class='period' >/per store</span>
                                </div>
                            </div>
                            <ul class='items' >
                                <li>Free tablet</li>
                                <li>Free menu setup</li>
                                <li></li>
                            </ul>
                            <a href='https://www.digitaladportal.com/home/kai3xp2eats786' class='register-btn arrow-btn' target='_blank' >
                                Register Business
                                <span class='arrow' ></span>
                            </a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </section> -->
        
        <!--======================================================
            Testimonials Section
        ======================================================-->
        <!-- <section id='testimonials' class='testimonials-section' >
            <div class='container' >
                
                <div class='testimonials-slider wow fadeInUp' data-wow-delay='.2s' >
                    
                    <div class='testimonial' >
                        <div class='icon' >
                            <i class='ion-quote' ></i>
                        </div>
                        <div class='content' >
                            <p>
                                XP Eats will enhance your daily shopping Experience
                            </p>
                        </div>
                        <div class='author' >
                            <img class='author-img' src='img/people1.jpg' alt>
                            
                            <img class='signature' src='img/signature.png' alt>
                            
                            <h4>O'Neil McLean</h4>
                            <span>CEO XP Life Inc.</span>
                        </div>
                    </div>
                    
                    <div class='testimonial' >
                        <div class='icon' >
                            <i class='ion-quote' ></i>
                        </div>
                        <div class='content' >
                            <p>
                                Providing safe, quality products for delivery is what we do. XP Eats allows for on time, trackable delivery
                            </p>
                        </div>
                        <div class='author' >

                            <img class='author-img' src='img/people2.jpg' alt>
                            
                            
                            <img class='signature' src='img/signature.png' alt>
                            
                            <h4>Deborah Longmore</h4>
                            <span>Supplier</span>
                        </div>
                    </div>
        </section> -->
        
        <!--======================================================
            Download Section
        ======================================================-->
        <section id='download' class='cta-section parallax' data-parallax='scroll' data-image-src='img/bg.png' >
            <div class='container' >
                
                <div class='download-app' >
                    
                    <h2 class='wow fadeInUp' data-wow-delay='.2s' >Download the App</h2>
                    
                    <div class='download-btns' >
                        
                        <a href='#' class='wow bounceIn' data-wow-delay='.4s'target='_blank' >
                            <img src='img/android.png' alt>
                        </a>
                        
                        <a href='#' class='wow bounceIn' data-wow-delay='.6s'target='_blank' >
                            <img src='img/apple.png' alt>
                        </a>
                        
                    </div>
                    
                </div>
                
                
                <!--======================================================
                    Newsletter Section
                ======================================================-->
                <div class='newsletter' >
                    
                    <h4 class='wow fadeInUp' data-wow-delay='.2s' >Join our network for fitness</h4>
                    
                    <div class='row' >
                        <div class='col-md-8 col-md-offset-2' >
                            
                            
                                
                            </form>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </section>
        
        <!--======================================================
            Contact Section
        ======================================================-->
        <section id='contact' class='contact-section' >
            <div class='container' >
                
                <div class='section-header text-center' >
                    <h2 class='wow fadeInUp' data-wow-delay='.2s' >Say Hello!</h2>
                    <p class='wow fadeInUp' data-wow-delay='.4s' >If you've got any questions, mail us, we will get in touch</p>
                </div>
                
                <div class='row' >
                    <div class='col-md-8 col-md-offset-2' >
                        
                        <form id='contact-form' name='contactForm' class='contact-form' data-toggle='validator' >
                            
                            <div id='contact-form-result' ></div>
                            
                            <div class='row' >
                                <div class='col-md-6' >
                                    
                                    <div class='form-group' >
                                        <input type='text' class='form-control wow fadeInUp' data-wow-delay='.4s' name='name' placeholder='Name' required>
                                        <div class='help-block with-errors' ></div>
                                    </div>
                                
                                </div>
                                <div class='col-md-6' >
                                    
                                    <div class='form-group' >
                                        <input type='email' class='form-control wow fadeInUp' data-wow-delay='.5s' name='email' placeholder='Email' required>
                                        <div class='help-block with-errors' ></div>
                                    </div>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group' >
                                        <input type='text' class='form-control wow fadeInUp' data-wow-delay='.6s' name='subject' placeholder='Subject' required>
                                        <div class='help-block with-errors' ></div>
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group wow fadeInUp" data-wow-delay='.5s'>
                                    <select class="form-control" name="type" required>
                                        <option value="" selected disabled>-Select Type-</option>
                                        <option value="Become a Driver">Become a Driver</option>
                                        <option value="Become a Merchant">Become a Merchant</option>
                                        <option value="XP EATS">XP EATS</option>
                                        <option value="XP Wallet">XP Wallet</option>
                                        <option value="Investor">Investor</option>
                                        <option value="Other">Other</option>
                                    </select>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control wow fadeInUp" data-wow-delay='.5s' type="tel" name="contact" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class='form-group' >
                                        <textarea class='form-control wow fadeInUp' data-wow-delay='.8s' name='message' placeholder='Message' rows='5' required></textarea>
                                        <div class='help-block with-errors' ></div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="g-recaptcha" data-sitekey="6LdZx8IZAAAAAAAlGt8-l3896LuhgvjQwfscvyMS"></div>
                                </div>
                                
                            </div>
                            
                            <div class='form-group text-center' >
                                <button type='submit' class='btn-custom wow fadeInUp' data-wow-delay='1s' >
                                    Send Message
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
@stop

{{-- footer scripts --}}
@section('footer_scripts')
    <!-- page level js starts-->

    <!--page level js ends-->
@stop
