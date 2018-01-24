@extends('layouts.app');

    @section('content')
        <h2>Edit Post<h2>
            {!! Form::open(['action'=>['PostsController@update', $post->id],'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
             <div class = "form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $post->title, ['class'=>'form-control', 'placeholder'=>'Title'])}}
             </div>
             <div class = "form-group">
                {{Form::label('Your Post', 'Post')}}
                {{Form::textarea('Body', $post->body, ['class'=>'form-control', 'placeholder'=>'Enter your post here'])}}
             </div>
             <div class = "form-group" style = "width:30%;">
                    {{Form::file('cover_image')}}
                </div>
             {{Form::hidden('_method','PUT')}}
             {{Form::submit('Submit',['class' => 'btn btn-primary', 'id'=>'submit'])}}
            {!! Form::close() !!}
    @endsection