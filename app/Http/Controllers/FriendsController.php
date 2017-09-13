<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Friend;
use App\User;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $friends = User::findOrFail($id)->friends();

        // var_dump($friends);
        // exit;

        return view('friends.index', compact('friends'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        if(!friendship($id)->exists && !friendship($id)->accepted){

            $Friend = Friend::Create([
                'user_id' => Auth::id(),
                'friend_id' => $id
            ]);
            $Friend->save();
        } else {
            $this->accept($id);
        }
        return back(); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        Friend::where([
            'user_id' => $id,
            'friend_id' => Auth::id(),            
        ])->update([
            'accepted' => 1
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $query = Friend::where([
            'user_id' => $id,
            'friend_id' => Auth::id()
        ]);

        if(!$query->exists()) {
            $query = Friend::where([
                'user_id' => Auth::id(),
                'friend_id' => $id
            ]);
        }

        $query->delete();

        return back();
    }
}
