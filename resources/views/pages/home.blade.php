                    {{--@if(Auth::guest())--}}
                        {{--<li class="active"><a href="{{url('/')}}">Home</a></li>--}}
                        {{--<li><a href="{{url('login')}}">Admin</a></li>--}}
                    {{--@else--}}
                        {{--<li class="active"><a href="{{url('/admin')}}">{{Auth::user()->name}}</a></li>--}}
                         {{--<li><a href="{{url('auth/logout')}}">Logout</a></li>--}}
                    {{--@endif--}}


<!DOCTYPE html>
<html>
<head>
    <title>Yaba Hitchhikers</title>
    <meta charset="utf-8">
    <meta name="description" content="It's all about yaba and it's businesses " />
    <meta name="author" content="INITS Nigeria" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700" rel="stylesheet" />
    <link href="{{url('ui_sample_1/img/favicon.png')}}" type="image/x-icon" rel="shortcut icon" />
    <link href="{{url('ui_sample_1/css/screen.css')}}" rel="stylesheet" />
</head>
<body class="home" id="page">
<!-- Header -->
<header class="main-header">
    <div class="container">
        <div class="header-content">
            <a href="">
                <img src="{{url('ui_sample_1/img/site-identity.png')}}" alt="site identity" />
            </a>

            {{--<nav class="site-nav">--}}
                {{--<ul class="clean-list site-links">--}}
                    {{--<li>--}}
                        {{--<a href="#">Top Destinations</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#">Add your boat</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}

                {{--<a href="#" class="btn btn-outlined">Sign up</a>--}}
            {{--</nav>--}}
        </div>
    </div>
</header>

<!-- Main Content -->
<div class="content-box">
    <!-- Hero Section -->
    <section class="section section-hero">
        <div class="hero-box">
            <div class="container">
                <div class="hero-text align-center">
                    <h1>Yaba Hitchhikers!</h1>
                    <p>look for any place in yaba</p>
                </div>


                    <form role="form" class="destinations-form" action="{{url('search')}}" method="post">
                        {{ csrf_field() }}
                    <div class="input-line">
                        <input type="text" name="destination" value="" class="form-input check-value" placeholder="WHAT IS YOUR DESTINATION, HIKER?" />
                        <button type="submit" name="destination-submit" class="form-submit btn btn-special">Find it</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Box -->
        <div class="container">
            <div class="statistics-box">
                <div class="statistics-item">
                    <span class="value">2,300</span>
                    <p class="title">Businesses </p>
                </div>

                <div class="statistics-item">
                    <span class="value">1,000</span>
                    <p class="title">Eateries</p>
                </div>

                <div class="statistics-item">
                    <span class="value">400</span>
                    <p class="title">Banks</p>
                </div>

                <div class="statistics-item">
                    <span class="value">300</span>
                    <p class="title">Others</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section class="section section-destination">
        <!-- Title -->
        <div class="section-title">
            <div class="container">
                <h2 class="title">Moving around Yaba just got better. Hiking season is everyday.</h2>
                <p class="sub-title">#yabaHikers #onlyInYaba #yabacon #yabaPlaces  #techCluster #homeOfTech #techSavy #flexInYaba #shopInYaba #YabaIsBae</p>
            </div>
        </div>

    </section>

</div>

<!-- Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="widget widget_links">
                    <h5 class="widget-title">This Project is Open Source </h5>
                    {{--<ul>--}}
                        {{--<li><a href="#">Lorem impsum dolor</a></li>--}}
                        {{--<li><a href="#">Sit amet consectetur</a></li>--}}
                        {{--<li><a href="#">Adipisicing elit</a></li>--}}
                        {{--<li><a href="#">Eiusmod tempor</a></li>--}}
                        {{--<li><a href="#">incididunt ut labore</a></li>--}}
                    {{--</ul>--}}
                </div>
            </div>

            {{--<div class="col-md-5">--}}
                {{--<div class="widget widget_links">--}}
                    {{--<h5 class="widget-title">Featured Boats</h5>--}}
                    {{--<ul>--}}
                        {{--<li><a href="#">Lorem impsum dolor</a></li>--}}
                        {{--<li><a href="#">Sit amet consectetur</a></li>--}}
                        {{--<li><a href="#">Adipisicing elit</a></li>--}}
                        {{--<li><a href="#">Eiusmod tempor</a></li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="col-md-9">
                <div class="widget widget_social">
                    <h5 class="widget-title">Subscribe to our newsletter</h5>
                    <form class="subscribe-form">
                        <div class="input-line">
                            <input type="text" name="subscribe-email" value="" placeholder="Your email address" />
                        </div>
                        <button type="button" name="subscribe-submit" class="btn btn-special no-icon">Subscribe</button>
                    </form>

                    <ul class="clean-list social-block">
                        <li>
                            <a href="#"><i class="icon-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icon-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icon-google-plus"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-5">
                <div class="widget widget_links pull-right">
                    <h5 class="widget-title">Contribute </h5>
                    <ul>
                        <li><a href="#">Register a place</a></li>
                        <li><a href="#">Contribute on Git</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{url('ui_sample_1/js/jquery.js')}}"></script>
<script src="{{url('ui_sample_1/js/functions.js')}}"></script>
</body>
</html>

