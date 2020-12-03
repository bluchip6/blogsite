<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Post;
use App\Models\Rating;

class WelcomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popular_posts = Post::orderBy('visit', 'desc')->limit(5)->get();
        $featured = Post::where('feature', true)->orderBy('visit', 'desc')->limit(5)->get();
        $allpost = Post::orderBy('created_at', 'desc')->paginate(3);
        $data = ['pop_posts' => $popular_posts, 'featured' => $featured, 'all_posts' => $allpost];
        return view('pages.index')->with($data);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function show($id)
    {
        $post = Post::find($id);

        $likes = Rating::where('post_id', $id)->where('rating', 2)->count();
        $dislikes = Rating::where('post_id', $id)->where('rating', 1)->count();
        $num_comment = Comments::where('post_id', $id)->count();
        $comments = Comments::where('post_id', $id)->orderBy('created_at', 'desc')->paginate(25);

        if (empty($likes)) {
            $likes = 0;
        };
        if (empty($dislikes)) {
            $dislikes = 0;
        };
        if (empty($comments)) {
            $num_comment = 0;
        };

        $user = auth()->user();
        if (isset($user)) {
            $user_id = $user->id;
        } else {
            $user_id = 0;
        }

        $rating = Rating::where('post_id', $id)->where('user_id', $user_id)->firstOr(function () {});
        if (isset($rating)) {
            $user_rating = $rating->rating;
        } else {
            $user_rating = null;
        }
        if ($post) {
            $post->visit = $post->visit + 1;
            $post->save();
            $timeToRead = str_word_count($post->body) / 255;
            if ($timeToRead < 1) {
                $timeToRead = round($timeToRead * 60);
                $timeToRead = strval($timeToRead) . ' sec';
            } else {
                $timeToRead = strval(round($timeToRead)) . ' min';
            }
            $data = ['timeToRead' => $timeToRead,
                'post' => $post,
                'likes' => $likes,
                'dislikes' => $dislikes,
                'user_rating' => $user_rating,
                'comments' => $comments,
                'num_comment' => $num_comment,
            ];
            return view('posts.show')->with($data);
        }

        return view('posts.show')->with($post);
    }
}
