@extends('layouts.app')

@section('title')
    About
@endsection

@section('content')
    <h1>Edit</h1>

    {!! Form::open(['route' => ['posts.update', 'post' => ($post->id)],'enctype'=> 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class'=> 'form-control', 'placeholder' =>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id'=> 'editor', 'class'=> 'form-control', 'placeholder' =>'Body Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('summary', 'Summary')}}
            {{Form::text('summary', $post->summary, ['class'=> 'form-control', 'placeholder' =>'Summary Text'])}}
        </div>
        <div class="form-group">
            {{Form::label('category', 'Category')}}
            {{Form::select('category', $categories, $post->category_id, ['placeholder' => $post->category['category'], 'class'=>'custom-select'])}}
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
        {{Form::hidden('_method', 'PUT')}}
    {!! Form::close() !!}
@endsection
