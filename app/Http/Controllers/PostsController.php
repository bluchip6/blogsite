<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $category_list = [];
        foreach ($categories as $category) {
            $category_list[$category->id] = $category->category;
        }
        return view('pages.create')->with('categories', $category_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
            'category' => 'required',
            'summary' => 'required',
        ]);

        //Handle File upload
        if ($request->hasFile('cover_image')) {
            // Get File name with extension
            $path = $request->file('cover_image')->store('images', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');

            //Get Just File Name
            //$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get Just ext
            //$extension = $request->file('cover_image')->getClientOriginalExtension();

            //Filename to store
            $fileUrlToStore = Storage::disk('s3')->url($path);
        } else {
            $fileNameToStore = 'storage/noimage.jpg';
            $fileUrlToStore = Storage::disk('s3')->url($fileNameToStore);
        }

        //Create New Post
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileUrlToStore;
        $post->category_id = $request->input('category');
        $post->summary = $request->input('summary');
        $timeToRead = str_word_count($request->input('body')) / 255;
        if ($timeToRead < 1) {
            $timeToRead = round($timeToRead * 60);
            $timeToRead = strval($timeToRead) . ' sec';
        } else {
            $timeToRead = strval(round($timeToRead)) . ' min';
        }

        $post->time_to_read = $timeToRead;

        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized to view that page');
        }

        $categories = Category::all();
        $category_list = [];
        foreach ($categories as $category) {
            $category_list[$category->id] = $category->category;
        }

        $data = array('post' => $post, 'categories' => $category_list);

        return view('posts.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
        ]);

        if ($request->hasFile('cover_image')) {
            // Get File name with extension
            $path = $request->file('cover_image')->store('images', 's3');
            Storage::disk('s3')->setVisibility($path, 'public');

            //Get Just File Name
            //$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //Get Just ext
            //$extension = $request->file('cover_image')->getClientOriginalExtension();

            //Filename to store
            $fileUrlToStore = Storage::disk('s3')->url($path);
        } else {
            $fileNameToStore = 'storage/noimage.jpg';
            $fileUrlToStore = Storage::disk('s3')->url($fileNameToStore);
        }

        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->input('category');
        $timeToRead = str_word_count($request->input('body')) / 255;
        if ($timeToRead < 1) {
            $timeToRead = round($timeToRead * 60);
            $timeToRead = strval($timeToRead) . ' sec';
        } else {
            $timeToRead = strval(round($timeToRead)) . ' min';
        }

        $post->time_to_read = $timeToRead;

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image != 'noimage.jpg') {
                // Delete previous Image
                Storage::delete('public/cover_images/' . $post->cover_image);
            }
            $post->cover_image = $fileUrlToStore;
        }
        $post->save();

        return (redirect()->route('posts.show', ['post' => $id]))->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (auth()->user()->id != $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized to delete that post');
        }
        if ($post->cover_image != 'noimage.jpg') {
            // Delete previous Image
            Storage::delete('public/cover_images/' . $post->cover_image);
        }
        $post->delete();

        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
