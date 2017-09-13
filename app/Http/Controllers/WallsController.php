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

        $posts = Post::whereIn('user_id', $friends_ids_arr)
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        // var_dump($posts);
        // exit;

        return view('walls.index', compact('posts', 'user'));
    }
}
