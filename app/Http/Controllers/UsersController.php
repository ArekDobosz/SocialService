<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;

class UsersController extends Controller
{

public function __construct() {
    $this->middleware('user_permission', ['only' => ['edit', 'update'] ]);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =  User::findOrFail($id);

        if(is_admin()) {
            $posts = Post::with('comments.author')
            ->with('comments.likes')
            ->with('likes')
            ->where('user_id', $id)
            ->withTrashed()
            ->paginate(10);
        } else {
            $posts = Post::with('comments.author')
            ->with('comments.likes')
            ->with('likes')
            ->where('user_id', $id)
            ->paginate(10);
        }        

        return view('users.show', array(
            'user' => $user,
            'posts' => $posts
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        return view('users.edit', compact('id', 'user'));
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
            'name' => 'required|min:3|max:50',
            'email'=> [
                'required',
                'email',
                Rule::unique('users')->ignore($id)
            ]
        ],[
            'required' => 'To pole jest wymagane',
            'unique' => 'Podany adres email istnieje już w bazie danych',
            'email' => 'Wprowadź poprawny adres email',
            'min' => 'Pole musi mieć podane minimum :min znaków'
        ]);

            if(is_admin()) {

            } else {

            }


        
        
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->sex = $request->sex;

        if($request->file('avatar')) {
            $userAvatarPath = 'public/users/'.$id.'/avatars';

            if($user->avatar) {
                Storage::delete($userAvatarPath.'/'.$user->avatar);
            } 
                      
            $uploadPath = $request->file('avatar')->store($userAvatarPath);
            $avatarFile = str_replace($userAvatarPath.'/', '', $uploadPath);
            $user->avatar = $avatarFile;
        }

        $user->save();

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
        //
    }
}
