<!DOCTYPE html>
<html lang="en">
        <head>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                <style type="text/css">
                 .box{
                  width:600px;
                  margin:0 auto;
                  border:1px solid #ccc;
                 }
                </style>
        </head>
    <body>
    <h1>Fund List</h1>
    <h2><a href="/canoeform"</a>Go To Form</a></h2>
    <h1>Client Name: {{$client->name}}</h1> 
            @foreach($funds as $fund)
                @if(($client->permission )==1)
                <div class="well">
                    <h3>{{$fund->name}}</h3>
                    <small>Name: {{$fund->name}} Description: {{$fund->description}} Type: {{$fund->type}} Date: {{$fund->inception_date}} Description: {{$fund->description}}	</small>
                </div>

                @elseif(($client->permission )==2)
                    @if(($fund->type)=='VC' || ($fund->type)=='RE')
                <div class="well">
                    <h3>{{$fund->name}}</h3>
                    <small>Name: {{$fund->name}} Description: {{$fund->description}} Type: {{$fund->type}} Date: {{$fund->inception_date}} Description: {{$fund->description}}	</small>
                </div>
                    @else
                    <div class="well">
                        <h3>name</h3>
                        <small>Name: xx Description: xxxx Type: {{$fund->type}} Date: xx-xx-xxxx Description: xxxx</small>
                    </div>
                    @endif


                @elseif(($client->permission )==3)
                    @if(($fund->type)=='PL' || ($fund->type)=='PC')
                <div class="well">
                    <h3>{{$fund->name}}</h3>
                    <small>Name: {{$fund->name}} Description: {{$fund->description}} Type: {{$fund->type}} Date: {{$fund->inception_date}} Description: {{$fund->description}}	</small>
                </div>
                    @else
                    <div class="well">
                        <h3>name</h3>
                        <small>Name: xx Description: xxxx Type: {{$fund->type}} Date: xx-xx-xxxx Description: xxxx</small>
                    </div>
                    @endif
                @endif

            @endforeach

</body>
</html>