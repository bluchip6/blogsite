@extends('layouts.app')

@section('title')
    @isset($post)
       {{ $post->title}}
    @else
        Page Not Found
    @endisset
    
@endsection

@section('content')
    <section class="container">
        @isset($post)
            <div class="row">
                <div class="col-sm-2 col-md-2">
                    <div id="divToShowHide" class="is-dockedBeforeScroll">
                        <div class="t">
                            <button class="icon-btn btn" id="comment_btn">
                                <i class="fas fa-comment"></i>
                                <h5 class="float-right pl-4 pt-1">{{$num_comment}}</h5>
                            </button>
                        </div>
                        <div class="m">
                            <button class="icon-btn btn" id="like" data-id="{{ $post->id}}">
                                <i
                                    @empty($user_rating)
                                        class="far fa-thumbs-up"
                                    @else
                                        @if ($user_rating == 2)
                                            class="fas fa-thumbs-up"    
                                        @else
                                            class="far fa-thumbs-up"
                                        @endif
                                    @endempty
                                
                                ></i>
                                <h5 class="float-right pl-4 pt-1">{{$likes}}</h5>
                            </button>
                            
                        </div>
                        <div class="d">
                            <button class="icon-btn btn" id="dislike" data-id="{{ $post->id }}">
                                <i 
                                    @empty($user_rating)
                                        class="far fa-thumbs-down"
                                    @else
                                        @if ($user_rating == 1)
                                            class="fas fa-thumbs-down"    
                                        @else
                                            class="far fa-thumbs-down"
                                    @endif
                                @endempty
                                ></i>
                                <h5 class="float-right pl-4 pt-0">{{$dislikes}}</h5>
                            </button>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="col-sm-8 col-md-8 col-custom-2">
                    <h1 class="display-5">{{$post->title}}</h1>
                    <div class="row col-custom-2">
                        <div class="col">
                            <div>
                                <a class="text-bold text-dark text-decoration-none" href="#">{{$post->user['name']}}</a>
                            </div>
                            <div>
                            <small class="fs-sm">{{$post->created_at->format('jS M, Y')}}. {{ $timeToRead }} read</small>
                            @if ($post->feature)
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-star-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>                            
                            @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="float float-right">
                                <a href="#" class="btn btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="2em" height="2em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M20.47 2H3.53a1.45 1.45 0 0 0-1.47 1.43v17.14A1.45 1.45 0 0 0 3.53 22h16.94a1.45 1.45 0 0 0 1.47-1.43V3.43A1.45 1.45 0 0 0 20.47 2zM8.09 18.74h-3v-9h3zM6.59 8.48a1.56 1.56 0 1 1 0-3.12a1.57 1.57 0 1 1 0 3.12zm12.32 10.26h-3v-4.83c0-1.21-.43-2-1.52-2A1.65 1.65 0 0 0 12.85 13a2 2 0 0 0-.1.73v5h-3v-9h3V11a3 3 0 0 1 2.71-1.5c2 0 3.45 1.29 3.45 4.06z" fill="#626262"/></svg>
                                </a>
                            </div>
                            <div class="float float-right">
                                <a href="#" class="btn btn-sm">
                                    <svg width="29" height="29"><path d="M22.05 7.54a4.47 4.47 0 0 0-3.3-1.46 4.53 4.53 0 0 0-4.53 4.53c0 .35.04.7.08 1.05A12.9 12.9 0 0 1 5 6.89a5.1 5.1 0 0 0-.65 2.26c.03 1.6.83 2.99 2.02 3.79a4.3 4.3 0 0 1-2.02-.57v.08a4.55 4.55 0 0 0 3.63 4.44c-.4.08-.8.13-1.21.16l-.81-.08a4.54 4.54 0 0 0 4.2 3.15 9.56 9.56 0 0 1-5.66 1.94l-1.05-.08c2 1.27 4.38 2.02 6.94 2.02 8.3 0 12.86-6.9 12.84-12.85.02-.24 0-.43 0-.65a8.68 8.68 0 0 0 2.26-2.34c-.82.38-1.7.62-2.6.72a4.37 4.37 0 0 0 1.95-2.51c-.84.53-1.81.9-2.83 1.13z" fill="#626262"></path></svg>
                                </a>
                            </div>
                            <div class="float float-right">
                                <a href="#" class="btn btn-sm">
                                    <svg width="29" height="29"><path d="M23.2 5H5.8a.8.8 0 0 0-.8.8V23.2c0 .44.35.8.8.8h9.3v-7.13h-2.38V13.9h2.38v-2.38c0-2.45 1.55-3.66 3.74-3.66 1.05 0 1.95.08 2.2.11v2.57h-1.5c-1.2 0-1.48.57-1.48 1.4v1.96h2.97l-.6 2.97h-2.37l.05 7.12h5.1a.8.8 0 0 0 .79-.8V5.8a.8.8 0 0 0-.8-.79" fill="#626262"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($post->cover_image != 'noimage.jpg')
                        <div class="col-custom-2">
                            <img style="width:100%" src="{{$post->cover_image}}" alt="">
                        </div>
                    @endif
                    <br><br><br>
                    <strong class="bold fs mt-5">
                        {{$post->summary}}
                    </strong>
                    <div class="fs lh mt-4">
                        {!!$post->body!!}
                    </div>
                    <div class="bd">
                        <small class="fs-sm">Written on {{$post->created_at->format('jS M, Y')}} by {{$post->user['name']}}</small>
                        <div class="float-right">
                            <!-- FACEBOOK -->
                            <a href="#" class="float-right sc-btn sc--facebook sc--tiny sc--shiny">
                                <span class="sc-icon">
                                    <svg class="svg" viewBox="0 0 33 33" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M 17.996,32L 12,32 L 12,16 l-4,0 l0-5.514 l 4-0.002l-0.006-3.248C 11.993,2.737, 13.213,0, 18.512,0l 4.412,0 l0,5.515 l-2.757,0 c-2.063,0-2.163,0.77-2.163,2.209l-0.008,2.76l 4.959,0 l-0.585,5.514L 18,16L 17.996,32z"></path></g></svg>
                                </span>
                                <span class="sc-text">
                                    Share on Facebook
                                </span>
                            </a>
                            <!-- TWITTER -->
                            <a href="#" class=" float-right sc-btn sc--twitter sc--tiny sc--shiny">
                                <span class="sc-icon">
                                    <svg class="svg" viewBox="0 0 33 33" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M 32,6.076c-1.177,0.522-2.443,0.875-3.771,1.034c 1.355-0.813, 2.396-2.099, 2.887-3.632 c-1.269,0.752-2.674,1.299-4.169,1.593c-1.198-1.276-2.904-2.073-4.792-2.073c-3.626,0-6.565,2.939-6.565,6.565 c0,0.515, 0.058,1.016, 0.17,1.496c-5.456-0.274-10.294-2.888-13.532-6.86c-0.565,0.97-0.889,2.097-0.889,3.301 c0,2.278, 1.159,4.287, 2.921,5.465c-1.076-0.034-2.088-0.329-2.974-0.821c-0.001,0.027-0.001,0.055-0.001,0.083 c0,3.181, 2.263,5.834, 5.266,6.438c-0.551,0.15-1.131,0.23-1.73,0.23c-0.423,0-0.834-0.041-1.235-0.118 c 0.836,2.608, 3.26,4.506, 6.133,4.559c-2.247,1.761-5.078,2.81-8.154,2.81c-0.53,0-1.052-0.031-1.566-0.092 c 2.905,1.863, 6.356,2.95, 10.064,2.95c 12.076,0, 18.679-10.004, 18.679-18.68c0-0.285-0.006-0.568-0.019-0.849 C 30.007,8.548, 31.12,7.392, 32,6.076z"></path></g></svg>
                                </span>
                                <span class="sc-text">
                                    Share on Twitter
                                </span>
                            </a>
                        </div>
                    </div>
                    
                    @if (!Auth::guest())
                        @if (Auth::user()->id == $post->user_id)
                            <div class="bd-2">
                                <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                    Edit
                                </a>
                                
                                {!! Form::open(['route' => ['posts.destroy', 'post' => $post->id], 'class'=> 'float-right']) !!}
                                    {!! Form::button('<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg> Delete', ['type' => 'submit', 'class'=> 'btn btn-danger'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                {!! Form::close()!!}
                            </div>
                            
                        @endif
                    @endif

                    <div class="row-custom-2">
                        <div class="form-group">
                            <label for="comment" class="strong">Comment</label>
                            <textarea id="editor" class="form-control" placeholder="Comment Text" name="comment" cols="50" rows="10"></textarea>
                        </div>
                    
                        <input class="btn btn-primary float-right" id='comment' type="button" value="Submit" data-id="{{ $post->id}}">
                    </div>
                    <div class="row-custom pt-5 mt-5" id="comments_list">
                        @forelse ($comments as $comment)
                            <div class="card bg-light mb-3">
                                <div class="card-header">{{$comment->user['name']}} -
                                    @if ($comment->created_at->format('Y') == date('Y'))
                                        <small class="text-muted">{{$comment->created_at->format('M j')}}</small>
                                    @else
                                        <small class="text-muted">{{$comment->created_at->format('M j, Y')}}</small>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{$comment->comment}}</p>
                                </div>
                            </div>
                        @empty
                            <div class="card card-body bg-light">
                                <p class="mx-auto">Be The First To Respond</p>
                            </div>
                        @endforelse
                    </div>
                    
                    
                </div>
                <div class="col-sm-2 col-md-2"></div>
            </div>   
        @else
            @include('inc.404')
        @endisset
              
    </section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type = "text/javascript">
    $(document).ready(function(){
      //Take your div into one js variable
      var div = $("#divToShowHide");
      //Take the current position (vertical position from top) of your div in the variable
      var pos = div.position();
      //Now when scroll event trigger do following
      $(window).scroll(function () {
       var windowpos = $(window).scrollTop();

       if (windowpos >= (pos.top + 6)) {
         div.addClass("is-dockedAfterScroll");
       }
       else {
         div.removeClass("is-dockedAfterScroll");
       }
       //Note: If you want the content should be shown always once you scroll and do not want to hide it again when go to top agian, no need to write the else part
     });
    });
</script>