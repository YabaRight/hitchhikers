@extends('master_layout')

@section('content')
    <div class="section">
        <div class=" ">
            <div class="row">
                <div class="col-md-12"><h1 class="text-center">Admin Login</h1></div>
            </div>
            <div class=" ">
                <div class="col-md-12">
                    <div class="col-md-4 col-md-offset-4 m-t-sm">
                        <form role="form" action="{{url('auth/login')}}" method="post">
                            {{ csrf_field() }}
                            @include('errors.showerrors')
                            <div class="form-group"><label class="control-label" for="exampleInputEmail1">Email
                                    address</label><input class="form-control" name="email"
                                                          placeholder="Enter email" type="email"></div>
                            <div class="form-group"><label class="control-label"
                                                           for="exampleInputPassword1">Password</label><input
                                        class="form-control" name="password" placeholder="Password"
                                        type="password"></div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
