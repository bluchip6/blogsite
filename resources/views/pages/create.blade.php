@extends('layouts.app')

@section('title')
    Create Post
@endsection

@section('content')
    <h1>Create</h1>

    {!! Form::open(['route' => 'posts.store', 'enctype'=> 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', '', ['class'=> 'form-control', 'placeholder' =>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', '', ['id'=> 'editor', 'class'=> 'form-control', 'placeholder' =>'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('summary', 'Summary')}}
            {{Form::text('summary', '', ['class'=> 'form-control', 'placeholder' =>'Summary Text'])}}
        </div>
        <div class="form-group dropdown">
            {{Form::label('category', 'Category')}}
            {{Form::select('category', ($categories), null, ['placeholder' => 'Pick a category...', 'class'=>'custom-select'])}}
        </div>
        <div class="form-group">
            <div>{{Form::label('cover_image', 'Cover Image')}}</div>
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
