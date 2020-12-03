@extends('layouts.app')

@section('title')
    {{config('app.name', 'MyBlog')}}
@endsection

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card card-body bg-light span">
                <div class="row">
                    <div class="col-md-2 col-sm-4">
                        <a href="/posts/{{$post->id}}">
                            <img class="image" src="{{$post->cover_image}}" alt="">
                        </a>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <a class="text-decoration-none text-dark" href="/posts/{{$post->id}}"><h3>{{$post->title}}</h3></a>
                        <small>Written on {{$post->created_at}} by {{$post->user['name']}}</small>
                        <br>
                        <small>Category: <a href="#">{{$post->category['category']}}</a></small>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}

    @else
        <P>No Post Found</P>
    @endif
@endsection