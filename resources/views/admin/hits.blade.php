@extends('admin_master')

@section('content')


    <div class="col-md-9">
        <div class="section">
        <h3>Hits  </h3>
            <br/>

            <div class=" ">
                <div class=" ">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                
                                <th>Business Name</th>
                                <th>Hit Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($hits->count() > 0)
                            @foreach($hits as $h)
                            <tr>
                                
                                <td>{{$h->listing->name}}</td>
                                <td>{{$h->hits}}</td>

                            </tr>
                            @endforeach

                                @else
                                <tr>
                                    <td><h2> No Business With Count History </h2></td>

                                </tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop
