<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,0" />
     
    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/normalize.css')}}"/>
    <link rel="stylesheet" href="{{url('css/style.css')}}"/>
   
   
 </head>
<body>
@include('widgets.menu_top')

@yield('content')

</body>
 <script type="text/javascript" src="{{url('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
</html>
