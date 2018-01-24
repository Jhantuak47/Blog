@extends('layouts.app')

@section('content')
    <h1>All Posts</h1><hr>
        @if(count($allPosts)>0)
            @foreach($allPosts as $Post)
                <div class = "well">
                    <div class = "row">
                        <div class = "col-md-4 col-sm-4">
                            <img style = "width:80%" src = "/storage/cover_images/{{$Post->cover_image}}">
                        </div>
                        <div class = "col-md-8 col-sm-8">
                                <h3><a href = "post/{{$Post->id}}">{{$Post->title}}</a></h3>
                                <small>Written on {{$Post->created_at}} ,by- {{$Post->user->name}}</small>
                        </div>
                    </div>
            @endforeach
        @else
        @endif
@endsection