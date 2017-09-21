<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;


class WallsController extends Controller
{

    public function __construct() {

        $this->middleware('auth');

    }

    public function index() {
        $user = Auth::user();
        $friends = $user->friends();
        $friends_ids_arr[] = $user->id;
        foreach($friends as $friend) {
            $friends_ids_arr[] = $friend->id;
        }

        if(is_admin()) {
            $posts = Post::with('comments.author')
            ->with('likes')
            ->with('comments.likes')
            ->whereIn('user_id', $friends_ids_arr)
            ->orderBy('created_at', 'desc')
            ->withTrashed()
            ->paginate(6);
        } else {
            $posts = Post::with('comments.author')
            ->with('likes')
            ->with('comments.likes')
            ->whereIn('user_id', $friends_ids_arr)
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        }   

        return view('walls.index', compact('posts', 'user'));
    }
}
