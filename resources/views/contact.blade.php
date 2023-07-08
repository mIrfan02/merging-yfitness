@extends('layouts/default')

{{-- Page title --}}
@section('title')
    ContactUs
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    

    <link rel="stylesheet" href="{{ asset('assets/css/website/contactUs.css') }}" />
    <!-- CSS Part Here -->

@stop

{{-- Page content --}}
@section('content')
    <section role="main" class="content-wrapper">

        <section role="main" class="content-wrapper">
            <div id="content-area" class="inner-page-wrapper">    
                <div class="contact-us-main">
                    <div class="contact-us-half">
                        <h1 class="page-title">Contact</h1>
                        @include('admin.notifications')
                        <p>Please fill in the form below and a dedicated member of our team will be in touch within 24 hrs</p>
                        <form action="{{ url('contactUs') }}" class="contact-us" method="POST">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                            <div class="form-column">
                                <div class="input-field">
                                    <input id="contact-name" class="form-control" type="text" required autocomplete="off" name="contactusname" required="" aria-required="true" value="" maxlength="2147483647" minlength="2">
                                    <label class="form-control-label" data-label="Name">
                                        Name
                                    </label>
                                </div>
                                <div class="input-field">
                                    <input id="contact-email" class="form-control" type="text" required autocomplete="off" name="email" required="" aria-required="true" value="" maxlength="2147483647">
                                    <label class="form-control-label" data-label="Email">
                                        Email
                                    </label>
                                </div>
                            </div>

                            
                            <div class="input-field">
                                <div class="custom-select">
                                    <span>
                                                General enquiries
                                            </span>
                                    <ul class="generated-list">
                                        <li data-value="GE">
                                            General enquiries
                                        </li>
                                        <li data-value="TI">
                                            Tecnical issues
                                        </li>
                                        <li data-value="PI">
                                            Payment issues
                                        </li>
                                    </ul>
                                    <select class="form-control" id="topic" autocomplete="cc-exp-month" name="topic">
                                        
                                            <option id="GE" value="GE">
                                                General enquiries
                                            </option>
                                        
                                            <option id="TI" value="TI">
                                                Tecnical issues
                                            </option>
                                        
                                            <option id="PI" value="PI">
                                                Payment issues
                                            </option>
                                        
                                    </select>
                                </div>
                                <label class="active form-control-label" data-label="Topic">
                                    Topic
                                </label>
                            </div>

                            
                            <div class="input-field" style="height: 160px">
                                <textarea id="contact-message" required="" class="materialize-textarea form-control" required row="5" cols="5" type="text" autocomplete="off" name="contactusmessage" aria-required="true" value="" maxlength="2147483647" minlength="2"></textarea>
                                <label class="form-control-label" data-label="Message">
                                    Message
                                </label>
                            </div>

                            
                            <div class="profile-update-section">
                                <button class="global-btn subscribe-contact-us" type="submit" name="submit" value="submit">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="contact-us-half withBg">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232565.37346060257!2d54.418536206009684!3d24.38707886044897!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e6596f8aa2c21%3A0x634ef65bd7bd41c8!2sEmirates%20Palace!5e0!3m2!1sen!2s!4v1633892646792!5m2!1sen!2s" height="231" width="100%"></iframe>
                        </div>
                        <div class="contact-us-details drop-shadow">
                            <h2 class="contact-title">{{ config('app.name') }} Headquarters</h2>
                            <a class="contact-address" href="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14440.240202914514!2d55.2501101!3d25.2011973!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x55fdacabbd98f512!2sIdealz%20Enterprises%20LLC!5e0!3m2!1sen!2sae!4v1585659422127!5m2!1sen!2sae" target="_blank">P.O. Box 81406 <br>Abu Dhabi, United Arab Emirates</a>
                            <ul class="contact-links clearfix">
                                <!-- <li><a class="icon-call-number" href="tel:800433259"> <span>Call us now</span> 800-{{ config('app.name') }} (433259)</a></li> -->
                                <li><a class="icon-email-address" href="mailto:support@ebigwin.com"> <span>Write us an email</span>support@ebigwin.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="contactus-whatsapp">
                    <a href="https://wa.me/97143551888" target="_blank">
                        
                        <span><img alt="" src="/on/demandware.static/Sites-Idealz-ae-Site/-/default/dw48ef82a8/images/footer/contact-whatsapp3x.png" height="75" width="75"></span>
                    </a>
                </div>
            </div>
        </section>

    </section>
@stop


{{-- page level scripts --}}
@section('footer_scripts')
    

@stop