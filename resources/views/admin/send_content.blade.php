<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
          type="text/css">
    <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet"
          type="text/css">
</head>
<body>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="text-center">Send Story</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))

                            <p class="alert alert-{{ $msg }}" style="color: #000">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                <form role="form" action="{{url('/send_content')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label class="control-label" for="inputTitle">Title</label>
                        <input class="form-control" id="inputTitle" name="title" placeholder="Enter Title" type="text">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="headerImage">Header Image</label>
                        <input class="form-control" id="headerImage" name="headerImage" placeholder="Enter Title" type="file">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="story" contenteditable="true">Content</label>
                        <textarea class="form-control" rows=7 id="story" name="story" placeholder="Enter your story"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="pics">Attachments (Images only)</label>
                        <input class="form-control" multiple id="pics"  name="pics[]" type="file">
                    </div>
                    <input class="hidden" name="user_id" value="1" >
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


</body>
</html>
