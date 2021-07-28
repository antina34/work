@extends('layouts.landing')

@section('content')
<a id="button">
    <svg width="10em" height="10em" viewBox="0 0 50 50" class="bi bi-arrow-up-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
        <path fill-rule="evenodd" d="M4.646 8.354a.5.5 0 0 0 .708 0L8 5.707l2.646 2.647a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 0 0 0 .708z"/>
        <path fill-rule="evenodd" d="M8 11.5a.5.5 0 0 0 .5-.5V6a.5.5 0 0 0-1 0v5a.5.5 0 0 0 .5.5z"/>
    </svg>
</a>

<header class="header">
    <div class="container">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark purple scrolling-navbar">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('/assets/img/landing/logo/main_logo.png') }}" width="150" height="40" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbar-example" aria-controls="navbar-example"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-example">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            HOME <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">LINK</a>
                    </li>
                </ul>
                <a href="{{ route('login') }}" class="btn btn-outline-info my-2 my-sm-0 mr-3">SIGN IN</a>
                <a href="{{ route('register') }}" class="btn btn-danger my-2 my-sm-0 mr-3">SIGN UP</a>
            </div>
        </nav>
</header>

        <section class="promo text-center" id="up">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="promo_header page-header">Knowledge is power</div>
                        <hr class="promo_line"/>
                        <div class="promo_descr">Even the most experienced traders need to take their time to analyze the situation on the market.<br>
                            The high market volatility creates risks to miss the possibility of making the right decisions and obtaining good results.<br>
                           <p class="first_page_text">MyBitcoin offers unique access to the BTC/USD exchange rate course to avoid such situations.
                            We use the combination of artificial intelligence, computer algorithms, and data inputs that give us an opportunity to predict the future prices of Bitcoin one hour in advance.
                            We don’t believe in long-term forecasts, but we are very confident in our hourly predictions and are ready to share this knowledge with you. Our predictions have an accuracy of 98%.</p>
                            Increase your income with data-driven knowledge now!
                        </div>

                        <a href="{{ route('register') }}" class="btn btn-info promo_btn">SIGN UP</a>
                    </div>
                </div>
            </div>
        </section>
    </div>



<section class="choose_us">
    <div class="container">
            <h2 class="promo_subheader">Why should you choose us?</h2>
        <div class="row">
            <div class="col-md-2 promo_item">
                <img src="{{ asset('/assets/img/landing/icons/first_screen/98_accuracy.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text">98% accuracy</h5>
                <h6 class="promo_item_desc">Our algorithms make the most accurate predictions</h6>
            </div>
            <div class="col-md-2 promo_item">
                <img src="{{ asset('/assets/img/landing/icons/first_screen/247access.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text">24/7 access</h5>
                <h6 class="promo_item_desc">Check BTC hourly prediction anywhere at any time</h6>
            </div>
            <div class="col-md-2 promo_item">
                <img src="{{ asset('/assets/img/landing/icons/first_screen/security_guaranteed.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text">Security guaranteed</h5>
                <h6 class="promo_item_desc">We reliably protect your personal data</h6>
            </div>
            <div class="col-md-2 promo_item">
                <img src="{{ asset('/assets/img/landing/icons/first_screen/price_alerts.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text">Price alert</h5>
                <h6 class="promo_item_desc">Create an alert for BTC price drop or growth</h6>
            </div>
            <div class="col-md-2 promo_item">
                <img src="{{ asset('/assets/img/landing/icons/first_screen/world-class_support.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text">World-class support</h5>
                <h6 class="promo_item_desc">Customer support any time you need it</h6>
            </div>
            <div class="col-md-2 promo_item">
                <img src="{{ asset('/assets/img/landing/icons/first_screen/user-friendly.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text">User-friendly</h5>
                <h6 class="promo_item_desc">Customized design that is easy-to-use</h6>
            </div>
        </div>
    </div>
</section>

<section class="how_it" id="How_it_works">
    <div class="container">
        <h2 class="promo_subheader_dark">How does it work?</h2>
        <div class="row">
            <div class="col-md-3 promo_item">
                <img src="{{ asset('/assets/img/landing/icons/second_screen/register.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text_dark">Register</h5>
                <h5 class="promo_item_desc_dark">Create your personal account on our website</h5>
            </div>
            <div class="col-md-3  promo_item">
                <img src="{{ asset('/assets/img/landing/icons/second_screen/choose_plan.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text_dark">Choose</h5>
                <h5 class="promo_item_desc_dark">Select one of our access plans and activate it</h5>
            </div>
            <div class="col-md-3  promo_item">
                <img src="{{ asset('/assets/img/landing/icons/second_screen/learn.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text_dark">Learn</h5>
                <h5 class="promo_item_desc_dark">Login and get access to unique knowledge</h5>
            </div>
            <div class="col-md-3  promo_item">
                <img src="{{ asset('/assets/img/landing/icons/second_screen/enjoy.png') }}"
                     class="rounded mx-auto d-block" width="100" height="100">
                <h5 class="promo_item_text_dark">Enjoy</h5>
                <h5 class="promo_item_desc_dark">Use your new knowledge to increase your income</h5>
            </div>
        </div>
    </div>
</section>
    <div class="row mb-4">
            <div class="col-lg-10 col-md-10 col-sm-10 offset-1 pt-3">
                @include('partials.charts.prediction-chart')
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4 col-sm offset-md-4">
                <a href="{{ route('register') }}" class="btn btn-info promo_btn_chart btn-md">GET STARTED</a>
            </div>
         </div>

{{--Products start--}}
<section class="pricing py-5" id="Products">
    <div class="container">
        <div class="row pricing_cards text-xs-center">
            <!-- Free Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">7 Days Pass</h5>
                        <h6 class="card-price text-center">$19.99</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>7 days pass</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span> 24/7 access to prediction</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span> Email reminders</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Personal data protection</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Price alert for BTC growth or failure</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Option to add more than one chart currency</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Data export from any period</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Ads free</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-block btn-primary text-uppercase">JOIN</a>
                    </div>
                </div>
            </div>
            <!-- Plus Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">14 Days Pass</h5>
                        <h6 class="card-price text-center">$35.99</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><em class="fas fa-check"></em></span><strong>14 days pass</strong></li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>24/7 access to prediction</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Email reminders</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Personal data protection</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Price alert for BTC growth or failure</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Option to add more than one chart currency</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>FData export from any period</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Ads free</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-block btn-primary text-uppercase">JOIN</a>
                    </div>
                </div>
            </div>
            <!-- Pro Tier -->
            <div class="col-lg-4">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">30 Days Pass</h5>
                        <h6 class="card-price text-center">$65.99</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><em class="fas fa-check"></em></span><strong>30 days pass</strong></li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>24/7 access to prediction</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Email reminders</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Personal data protection</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Price alert for BTC growth or failure</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Option to add more than one chart currency</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>FData export from any period</li>
                            <li><span class="fa-li"><em class="fas fa-check"></em></span>Ads free</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-block btn-primary text-uppercase">JOIN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{--Products end--}}
<section id="Contact_us">
    <div class="container">
        <div class="row justify-content-center align-self-center">
            <div class="col-md-8 col-md-offset-2 contact_us_main center-block">
                <h2 class="text-uppercase mt-3 font-weight-bold">CONTACT US</h2>
                <form>
                    <div class="row contact_us">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="nameSix">Name</label>
                                <input type="text" class="form-control" required="" id="nameSix" placeholder="Your Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="sr-only" for="emailSix">Email</label>
                                <input type="email" class="form-control" required="" id="emailSix" placeholder="Email Address">
                            </div>
                        </div>
                    </div>
                    <!--end of /.row-->
                    <div class="form-group">
                        <label class="sr-only" for="message">Message</label>
                        <textarea class="form-control" required="" rows="7" placeholder="Write Message" id="message"></textarea>
                    </div>
                    <button type="button" class="btn btn-outline-primary">Send message</button>
                </form>
            </div> <!-- /.col-md-8 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<footer class="page-footer font-small mdb-color lighten-3 pt-4 down">
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-2 offset-1">
            <img src="{{ asset('/assets/img/landing/logo/main_logo.png') }}" width="150" height="40" class="d-inline-block align-top" alt="logo">
        </div>
        <div class="col-md-2 offset-1">
            <ul class="footer_menu">
                <li><a href="#up">About</a></li>
                <li><a href="#How_it_works">How it works?</a></li>
                <li><a href="#Products">Products</a></li>
                <li><a href="#Contact_us">Contact us</a></li>
            </ul>
        </div>
        <div class="col-md-2 offset-1">
            <ul class="footer_menu">
                <li><a href="{{ route('login') }}">Log in</a></li>
                <li><a href="{{ route('register') }}">Sign up</a></li>
                <li><a href="{{ route('landing.privacy-policy') }}" class="footer_policy">Privacy Policy</a></li>
                <li><a href="{{ route('landing.privacy-policy') }}">Terms of Service</a></li>
            </ul>
        </div>
    </div>
</div>
    <div class="col-12 text-center">
        <p class="foot_last">© MyBitcoin. All rights reserved.</p>
    </div>
</footer>
@endsection
