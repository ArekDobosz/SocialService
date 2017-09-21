<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CheckPostPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $postExists = Post::where([
            'id' => $request->post,
            'user_id' => Auth::id()
        ])->exists();

        if(!Auth::check() ||  !$postExists && !is_admin()) {
            abort(403, 'Brak dostępu');
        }

        return $next($request);
    }
}
