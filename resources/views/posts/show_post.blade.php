@extends('layouts.app')

@section('content')
<a href = "/post" class = "btn btn-default">Go Back</a>
    <h2>{{$post->title}}</h2>
    <img style = "width:50% height:30%" src = "/storage/cover_images/{{$post->cover_image}}"><hr>
    <div class="well">
            <p>{!!$post->body!!}</p>
    </div>
    <hr>
    <small>Writen on {{$post->created_at}} , by- {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id==$post->user_id)
        <!--
            <a href = "/post/{{$post->id}}/edit" class = "btn btn-default">Edit</a>
            {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right','id'=>'delete'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
            {!!Form::close()!!}-->
            <a href = "/post/{{$post->id}}/edit" class = "btn btn-default">Edit</a>
            <form class='pull-right' action="{{ action('PostsController@destroy', $id = $post->id) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="submit" value="Delete" class = "bun btn-danger">
            </form>
       
        <script>
            $('.pull-right').on("submit", function(){
                return confirm("Do you want to delete this Post ?");
            });
        </script>
        @endif
   @endif
@endsection
<script>
    $("#delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>