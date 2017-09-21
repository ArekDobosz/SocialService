<?php

use App\Friend;

function test() {
    return 'test';
}   
 
function friendship($id) {
        
    $friend_query = Friend::where([
		'user_id' => Auth::id(),
		'friend_id' => $id,
    ])->first();

    $friendship = new stdClass();

    if(!is_null($friend_query)) {
        $friendship->exists = true;
        $friendship->accepted = $friend_query->accepted;
    } else {

        $friend_query = Friend::where([
            'user_id' => $id,
            'friend_id' => Auth::id(),
        ])->first();

        if(!is_null($friend_query)) {
            $friendship->exists = true;
            $friendship->accepted = $friend_query->accepted;
        } else {
            $friendship->exists = false;
            $friendship->accepted = false;
        }       
    }

    return $friendship;
}

function has_already_friends($id) {
    return Friend::where([
        'user_id' => $id,
        'friend_id' => Auth::id(),
        'accepted' => 1
    ])->exists();
}

function has_friend_invitation($id) {

    return Friend::where([
        'user_id' => $id,
        'friend_id' => Auth::id(),
        'accepted' => 0
    ])->exists();

}

function has_permission_to_edit($user_id) {
    return Auth::check() && $user_id === Auth::id();
}

function is_admin() {
    return Auth::user()->role == 1;
}

function timesAgo($date) {
    
}

