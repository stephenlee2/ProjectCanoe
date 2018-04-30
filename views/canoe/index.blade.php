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
        <h1>Clinet List</h1>
            @foreach($clients as $client)
                <div class="well">
                    <h3><a href="/canoe/{{$client->id}}">{{$client->name}}</a></h3>
                    <small>Description: {{$client->description}}</small>
                </div>
            @endforeach

</body>
</html>