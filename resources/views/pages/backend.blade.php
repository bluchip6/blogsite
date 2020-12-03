@extends('layouts.app')

@section('title')
    {{config('app.name', 'Backend Development')}}
@endsection

@section('content')
    <h1>Backend Development Post's</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card card-body bg-light span">
                <div class="row">
                    <div class="col-md-2 col-sm-4">
                        <img class="image" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{$post->created_at}} by {{$post->user['name']}}</small>
                        <br>
                        <small>Category: {{$post->category['category']}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}

    @else
        <div class="card card-body bg-light span">
            <p class="mx-auto">No Post Found</p>
        </div>
    @endif
@endsection
