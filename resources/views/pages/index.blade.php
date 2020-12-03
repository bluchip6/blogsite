@extends('layouts.app')

@section('title')
    {{config('app.name', 'MyBlog')}}
@endsection

@section('content')

    @guest
        <section class="row row-custom row-cus">
            <div class="col">
                <div class="lg-fnt lg-lh">Where Open Source ideas thrives </div>
                <div class="mt-5">Read and share new ideas centered around the Dev World. Everyone is Welcome</div>
                <div class="mt-4">
                    <a class="btn btn-outline-success btn-lg text-decoration-none" href="/register">
                        Get Started
                    </a>
                </div>
            </div>
            <div class="col-7 imgd">
                <img class="img_res" src="https://blogsource.s3.eu-west-2.amazonaws.com/storage/landing_image.png" alt="">
            </div>
            
        </section>
    @endguest
    <div class="container span">
        <div class="row flex-xl-nowrap">
            <div class="col-sm">
                <div class="row">
                    <div class="col-sm">
                        <img class="image" src="{{$featured[0]->cover_image}}" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm col-custom ">
                        <h4><strong>{{$featured[0]->title}}</strong></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <h6 class="text-muted">{{$featured[0]->summary}}</h6>
                        <div class="small"><strong>{{$featured[0]->user['name']}}</strong><a href="#" class="text-muted"> in {{$featured[0]->category['category']}}</a></div>
                        @if ($featured[0]->created_at->format('Y') == date('Y'))
                            <small class="text-muted">{{$featured[0]->created_at->format('M j')}} . {{$featured[0]->time_to_read}}</small>
                        @else
                            <small class="text-muted">{{$featured[0]->created_at->format('M j, Y')}} . {{$featured[0]->time_to_read}}</small>
                        @endif
                        
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <section class="row row-custom-2">
                    <div class="col-4">
                        <a href="#">
                            <img class="image" src="{{$featured[1]->cover_image}}" alt="">
                        </a>
                    </div>
                    <div class="col-8">
                        <a class="text-decoration-none text-dark" href="#"><h4><strong>{{$featured[1]->title}}</strong></h4></a>
                        <div class="small"><strong>{{$featured[1]->user['name']}}</strong><a href="#" class="text-muted"> in {{$featured[1]->category['category']}}</a></div>
                        @if ($featured[1]->created_at->format('Y') == date('Y'))
                            <small class="text-muted">{{$featured[1]->created_at->format('M j')}} . {{$featured[1]->time_to_read}}</small>
                        @else
                            <small class="text-muted">{{$featured[1]->created_at->format('M j, Y')}} . {{$featured[1]->time_to_read}}</small>
                        @endif
                    </div>
                </section>
                <section class="row row-custom">
                    <div class="col-4">
                        <a href="#">
                            <img class="image" src="{{$featured[2]->cover_image}}" alt="">
                        </a>
                    </div>
                    <div class="col-8">
                        <a class="text-decoration-none text-dark" href="#"><h4><strong>{{$featured[2]->title}}</strong></h4></a>
                        <div class="small"><strong>{{$featured[2]->user['name']}}</strong><a href="#" class="text-muted"> in {{$featured[2]->category['category']}}</a></div>
                        @if ($featured[2]->created_at->format('Y') == date('Y'))
                            <small class="text-muted">{{$featured[2]->created_at->format('M j')}} . {{$featured[2]->time_to_read}}</small>
                        @else
                            <small class="text-muted">{{$featured[2]->created_at->format('M j, Y')}} . {{$featured[2]->time_to_read}}</small>
                        @endif
                    </div>
                </section>
                <section class="row row-custom">
                    <div class="col-4">
                        <a href="#">
                            <img class="image" src="{{$featured[3]->cover_image}}" alt="">
                        </a>
                    </div>
                    <div class="col-8">
                        <a class="text-decoration-none text-dark" href="#"><h4><strong>{{$featured[3]->title}}</strong></h4></a>
                        <div class="small"><strong>{{$featured[3]->user['name']}}</strong><a href="#" class="text-muted"> in {{$featured[3]->category['category']}}</a></div>
                        @if ($featured[3]->created_at->format('Y') == date('Y'))
                            <small class="text-muted">{{$featured[3]->created_at->format('M j')}} . {{$featured[3]->time_to_read}}</small>
                        @else
                            <small class="text-muted">{{$featured[3]->created_at->format('M j, Y')}} . {{$featured[3]->time_to_read}}</small>
                        @endif
                    </div>
                </section>
            </div>
            <section class="col-sm d-none d-xl-block">
                <div class="row">
                    <div class="col-sm">
                        <img class="image" src="{{$featured[4]->cover_image}}" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm col-custom ">
                        <h4><strong>{{$featured[4]->title}}</strong></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <h6 class="text-muted">{{$featured[4]->summary}}</h6>
                        <div class="small"><strong>{{$featured[4]->user['name']}}</strong><a href="#" class="text-muted"> in {{$featured[4]->category['category']}}</a></div>
                        @if ($featured[4]->created_at->format('Y') == date('Y'))
                            <small class="text-muted">{{$featured[4]->created_at->format('M j')}} . {{$featured[4]->time_to_read}}</small>
                        @else
                            <small class="text-muted">{{$featured[4]->created_at->format('M j, Y')}} . {{$featured[4]->time_to_read}}</small>
                        @endif
                        
                    </div>
                </div>
            </section>
        </div>
    </div>
    <br>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9" id="grid">
                @foreach ($all_posts as $post)
                    <section class="row row-custom d-flex" id="grid-item">
                        <div class="col-4">
                            <a href="#">
                                <img class="image" src="{{$post->cover_image}}" alt="">
                            </a>
                        </div>
                        <div class="col-8 justify-content-center align-self-center">
                            <a class="text-decoration-none text-dark" href="#"><h4><strong>{{$post->title}}</strong></h4></a>
                            <h6 class="text-muted">{{$post->summary}}</h6>
                            <div class="small"><strong>{{$post->user['name']}}</strong><a href="#" class="text-muted"> in {{$post->category['category']}}</a></div>
                            @if ($post->created_at->format('Y') == date('Y'))
                                <small class="text-muted">{{$post->created_at->format('M j')}} . {{$post->time_to_read}}</small>
                            @else
                                <small class="text-muted">{{$post->created_at->format('M j, Y')}} . {{$post->time_to_read}}</small>
                            @endif
                        </div>
                    </section> 
                @endforeach
                {{ $all_posts->links() }}
            </div>
            <div class="col-sm col-custom-2">
                <div class="is-dockedTop">
                    <h3><strong>Popular On MyBlog</strong></h3>
                    <hr>
                    @php
                        $n = 1
                    @endphp
                    @foreach ($pop_posts as $post)
                        <div class="row row-custom">
                            <div class="col-md-2 col-sm-2">
                                <h3 class="text-muted">{{$n}}</h3>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <a class="text-decoration-none text-dark" href="#"><h4><strong>{{$post->title}}</strong></h4></a>
                                <small>{{$post->created_at->format('jS M, Y')}}</small>
                                <br>
                                <small class="text-muted">Category: <a href="#" class="text-muted">{{$post->category['category']}}</a></small>
                            </div>
                        </div>
                        @php
                            $n +=1
                        @endphp
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
    
@endsection