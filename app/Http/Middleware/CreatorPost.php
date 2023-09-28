<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class CreatorPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();
        $post = Posts::findOrFail($request->id);

        if($currentUser->id != $post->author) {
            return response()->json(['Postingan ini tidak tersedia'], 403);
        }
        
        return $next($request);
    }
}
