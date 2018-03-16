
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel= "stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
  
    <div id="app"><br>
       <div class="container col-lg-offset-4 col-lg-4">
            <div class="row">
                <form action="{{route('upload')}}" enctype="multipart/form-data" method = "post">
                    {{csrf_field()}}
                        <input type="file" id = "image" name = "image">
                        <img src="/storage/content_top.jpg" alt="">
                        <input type="submit" id = "btn" value= "upload" class="btn btn-success">
                </form>
            </div>
       </div>
    </div>
    <script src = "{{asset('js/app.js')}}"></script>

</body>
</html>