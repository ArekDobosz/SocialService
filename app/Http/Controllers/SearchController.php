<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class SearchController extends Controller
{
    public function searchUsers() {
        
        $search = Input::get('q');
    
        $users = User::where('name', 'like', '%'.$search.'%')->paginate(6);

        return view('search.users', compact('users', 'search'));
    }
}
