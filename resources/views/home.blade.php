@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class = "col-md-3 col-sm-3">   
                <img style = "width:60%" src = "/storage/profile_img/{{auth()->user()->profile_img}}">
                         @if(auth()->user()->profile_img == 'no_image.jpg')
                             <strong> Uplode Your Pofile Picture</strong>
                        @else
                        <div class='container'>
                            <strong> Change Your Pofile Picture</strong>
                        </div>
                         @endif

                    {!! Form::open(['url'=>'/upload_profile_pics','method'=>'POST','enctype'=>'multipart/form-data', ]) !!}
                      <div class = "form-group">
                        {{Form::file('profile_img', ['class'=>'form-control'])}}
                      </div>
                        {{Form::submit('Submit',['class' => 'btn btn-primary', 'id'=>'submit'])}}
                      
                    {!! Form::close() !!}
            </div>
        <div class= "col-md-7 col-sm-7">
            <div class="panel panel-default">
                <div class="panel-heading"><strong style = "font-size: 30px;">Dashboard</strong></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href = "/post/create" class = "btn btn-primary">Create Post</a>
                 @if(count($posts)>0)
                    <h2>Your Posts</h2>
                        <table class= "table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td><a href = "post/{{$post->id}}/edit" class ="btn btn-default">Edit</td>
                                <td>{!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                      {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                  {!!Form::close()!!}
                                </td>
                            <tr>
                       @endforeach
                            </table>
                            <script>
                                $('.pull-right').on("submit", function(){
                                    return confirm("Do you want to delete this Post ?");
                                });
                            </script>
                 @else
                    <h3>You are loged in !</h3>
                    <p>You don't have any post !</p>
                 @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
