<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'action' => 'required',
            'user_id' => 'required',
        ]);

        $action = $request->input('action');
        $user_id = $request->input('user_id');
        switch ($action) {
            case 'like':
                $rating = Rating::where('post_id', $id)->where('user_id', $user_id)->first();
                if (isset($rating)) {
                    $rating->rating = 2;
                    $rating->save();
                } else {
                    $rating = new Rating();
                    $rating->post_id = $id;
                    $rating->user_id = $user_id;
                    $rating->rating = 2;
                    $rating->save();
                };
                break;
            case 'dislike':
                $rating = Rating::where('post_id', $id)->where('user_id', $user_id)->first();
                if (isset($rating)) {
                    $rating->rating = 1;
                    $rating->save();
                } else {
                    $rating = new Rating();
                    $rating->post_id = $id;
                    $rating->user_id = $user_id;
                    $rating->rating = 1;
                    $rating->save();
                };
                break;

            case 'unlike':
                $rating = Rating::where('post_id', $id)->where('user_id', $user_id)->first();
                $rating->delete();
                break;
            case 'undislike':
                $rating = Rating::where('post_id', $id)->where('user_id', $user_id)->first();
                $rating->delete();
                break;

            default:
                break;
        }

        $likes = Rating::where('post_id', $id)->where('rating', 2)->count();
        $dislikes = Rating::where('post_id', $id)->where('rating', 1)->count();

        $data = ['likes' => $likes, 'dislikes' => $dislikes];

        return $data;
    }
}
