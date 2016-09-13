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
                    <li><a href="{{url('login')}}">Admin</a></li>
                @else
                    <li class="active"><a href="{{url('/admin')}}">{{Auth::user()->name}}</a></li>
                     <li><a href="{{url('auth/logout')}}">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
