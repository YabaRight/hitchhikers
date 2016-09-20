
        <!DOCTYPE html>
<html>
<head>
    <title>Yaba Hitchhikers</title>
    <meta charset="utf-8">
    <meta name="description" content="It's all about yaba and it's businesses "/>
    <meta name="author" content="INITS Nigeria"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700" rel="stylesheet"/>
    <link href="{{url('ui_sample_1/css/screen.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/normalize.css')}}"/>
    <link rel="stylesheet" href="{{url('css/style.css')}}"/>
    <link href="{{url('ui_sample_1/img/favicon.png')}}" type="image/x-icon" rel="shortcut icon"/>

</head>
<body class="home" id="page">
<!-- Header -->
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                        class="icon-bar"></span><span class="icon-bar"></span></button>
            <a class="navbar-brand" href="{{url('/')}}"><span>Yaba Hitchhikers</span></a></div>
        <div class="collapse navbar-collapse" id="navbar-ex-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::guest())
                    <li class="active"><a href="{{url('/')}}">Home</a></li>

                @else
                    <li class="active"><a href="{{url('/admin')}}">{{Auth::user()->name}}</a></li>
                    <li><a href="{{url('auth/logout')}}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="content-box">

    <!-- Destinations Section -->
    <section class="section section-destination">
        <!-- Title -->
        <div class="section-title">
            <div class="container">
                <h2 class="title">Moving around Yaba just got better. Hiking season is everyday.</h2>
                {{--<p class="sub-title">#yabaHikers #onlyInYaba #yabacon #yabaPlaces #techCluster #homeOfTech #techSavy--}}
                    {{--#flexInYaba #shopInYaba #YabaIsBae</p>--}}

                @yield('content')
            </div>
        </div>
    </section>

</div>

<!-- Footer -->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="widget widget_links">
                    <h5 class="widget-title">This Project is Open Source </h5>

                </div>
            </div>



            <div class="col-md-6">
                <div class="widget widget_social">


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

            <div class="col-md-3">
                <div class="widget widget_links pull-right">
                    <h5 class="widget-title">Contribute </h5>
                    <ul>
                        <li><a href="{{ url('external/create_business') }}">Register a place</a></li>
                        <li><a href="https://github.com/YabaRight/hitchhikers">Contribute on Git</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="{{url('ui_sample_1/js/jquery.js')}}"></script>
<script src="{{url('ui_sample_1/js/functions.js')}}"></script>
@yield("script")
</body>
</html>

