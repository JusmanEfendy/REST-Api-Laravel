<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;

class Commentator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $komentator = Auth::id();
        $comment = Comments::findOrFail($request->id);
        
        if($komentator != $comment->user_id) {
            return response()->json(['message' => 'Komentar Tidak Ditemukan'], 403);
        };

        return $next($request);
    }
}
