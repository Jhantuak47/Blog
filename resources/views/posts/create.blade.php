@extends('layouts.app');

    @section('content')
        <h2>Create Post<h2>
            {!! Form::open(['action'=>'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
             <div class = "form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'Title'])}}
             </div>
             <div class = "form-group">
                {{Form::label('Your Post', 'Post')}}
                {{Form::textarea('Body', '', ['class'=>'form-control', 'placeholder'=>'Enter your post here'])}}
             </div>
             <div class = "well">
                 {{Form::file('cover_image')}}
             </div>
             {{Form::submit('Submit',['class' => 'btn btn-primary', 'id'=>'submit'])}}
            {!! Form::close() !!}
    @endsection