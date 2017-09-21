<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;

class LikesController extends Controller
{
    public function add(Request $request) {

        $like = new Like();
        $like->user_id = Auth::id();
        $like->post_id = $request->post_id;
        $like->comment_id = $request->comment_id;

        $like->save();

        return back();
    }

    public function destroy(Request $request) {
        Like::where([
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment_id' => $request->comment_id
        ])->delete();

        return back();
    }
}
