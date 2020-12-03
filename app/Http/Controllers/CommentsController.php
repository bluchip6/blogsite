<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {

        $this->validate($request, [
            'comment' => 'required',
        ]);

        $comment = new Comments();
        $comment->comment = $request->input('comment');
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $id;

        $comment->save();

        $nums = Comments::where('post_id', $id)->count();

        $returnHtml = view('inc.create_comment', compact('comment'))->render();
        $res = array('success' => true, 'html' => $returnHtml, 'num' => $nums);

        return $res;
    }

}
