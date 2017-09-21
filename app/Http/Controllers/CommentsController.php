<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;


class CommentsController extends Controller
{

    public function __construct() {
        $this->middleware('comment_permission', ['except' => ['store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment_content = 'comment_content_'.$request->post_id;

        $this->validate($request, [
            $comment_content => 'min:2|max:1000|required'
        ], [
            'required' => 'Nie można dodać pustej treści.',
            'min' => 'Treść komentarza powinna być dłuższa niż :min znaków.',
            'max' => 'Treść komentarza powinna być krótsza niż :max znaków.'
        ]);

        $Comment = new Comment();
        $Comment->content = $request->$comment_content;
        $Comment->post_id = $request->post_id;
        $Comment->author_id = Auth::id();

        $Comment->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        return view('comments.edit', compact('comment'));
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
            'comment_content' => 'min:2|max:1000|required'
        ], [
            'required' => 'Nie można dodać pustej treści.',
            'min' => 'Treść komentarza powinna być dłuższa niż :min znaków.',
            'max' => 'Treść komentarza powinna być krótsza niż :max znaków.'
        ]);

        Comment::where('id', $id)->update([
                'content' => $request->comment_content
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
        Comment::where('id', $id)->delete();

        return back();
    }
}
