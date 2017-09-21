<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CheckCommentPermission
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

        $commentExists = Comment::where([
            'id' => $request->comment,
            'author_id' => Auth::id()
        ])->exists();

        if(!Auth::check() ||  !$commentExists && !is_admin()) {
            abort(403, 'Brak dostępu');
        }

        return $next($request);
    }
}
