<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;

class ImageController extends Controller
{
    public function createAvatar($id, $size) {

        
        $User = User::findOrFail($id);

        if(strpos($User->avatar, 'http') !== false) {
            $avatar = Image::make(asset($User->avatar))->fit($size)->response();
        } else if(is_null($User->avatar)) {
            $avatar = Image::make(asset('storage/users/defaults/default_avatar.png'))->fit($size)->response();
        } else {
            $avatar = Image::make(asset('storage/users/'.$id.'/avatars/'.$User->avatar))->fit($size)->response();
        }

        return $avatar;
    }
}
