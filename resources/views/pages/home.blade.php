<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/normalize.css')}}"/>
    <link rel="stylesheet" href="{{url('css/style.css')}}"/>

    <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
</head>
<body>

<div class="cover">
    <div class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><span>Yaba Hitchhikers</span></a></div>
            <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::guest())
                        <li class="active"><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('login')}}">Admin</a></li>
                    @else
                        <li class="active"><a href="{{url('/admin')}}">{{Auth::user()->name}}</a></li>
                         <li><a href="{{url('auth/logout')}}">Logout</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="cover-image"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center"><h1>Yaba  Directory</h1>
                <p>You have come to the right place</p><br><br></div>
            <div class="col-md-offset-3 col-md-6">
                <form role="form" action="{{url('search')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="input-group"><input type="text" class="form-control" required name="search_token"
                                                        placeholder="Search "> <span
                                    class="input-group-btn"> <button class="btn btn-success" type="submit">Go</button> </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--<div class="section">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12"><h1 class="text-center">All Businesses</h1></div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="section">--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="section">--}}
                {{--<div class=" ">--}}
                    {{----}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

</body>
</html>
