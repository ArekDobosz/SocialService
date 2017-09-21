<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Comment;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('post_permission', ['except' => ['show', 'store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_content' => 'required|min:5'
        ], [
            'required' => 'Nie można dodać pustej treści.',
            'min' => 'Treść wiadomości powinna być dłuższa niż :min znaków.'
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->post_content
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_admin()) {
            $post = Post::findOrFail($id)->withTrashed();
        } else {
            $post = Post::findOrFail($id);
        }
        
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_admin()) {
            $post = Post::findOrFail($id)->withTrashed();
        } else {
            $post = Post::findOrFail($id);
        }   

        return view('posts.edit', compact('post'));
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
            'post_content' => 'required|min:5'
        ], [
            'required' => 'Nie można dodać pustej treści.',
            'min' => 'Treść wiadomości powinna być dłuższa niż :min znaków.'
        ]);

        Post::where('id', $id)->update([
            'content' => $request->post_content
        ]);
        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->delete();
        $comments = Comment::where('post_id', $id)->delete();

        return back();
    }
}
