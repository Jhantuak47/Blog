
@extends('layouts.app');

    @section('content')
        <h2>Edit Post<h2>
            <form action="{{ action('PostsController@update', $post->id) }}", method="POST", enctype="multipart/form-data">
                 {{ csrf_field() }}
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="post_title" value="{{$post->title}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Your Post</label>
                    <textarea class="form-control" rows="4">{{$post->body}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Upload Image</label>
                    <input type="file" name="cover_image" class="form-control" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">image type should be jpg/png and not more than 1MB.</small>
                </div>
                <input name="_method" type="hidden" value="PUT">
                <input type="submit" name="" id = "submit" class="btn btn-primary" value="submit">
            </form>
    @endsection