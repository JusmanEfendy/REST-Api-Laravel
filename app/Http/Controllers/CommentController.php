<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index () 
    {
        $comments = Comments::with('komentator:id,username')->get();
        
        return CommentResource::collection($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment_content' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);

        $request['user_id'] = Auth::id();
        $comment = Comments::create($request->all());

        return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => new CommentResource($comment->loadMissing(['komentator:id,username']))], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comment_content' => 'required'
        ]);

        $comment = Comments::findOrFail($id);
        $comment->update($validated);
        
        return response()->json(['message' => 'Komentar Berhasil diubah', 'data' => $comment], 201);
    }

    public function destroy($id)
    {
        $comment = Comments::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Komentar Berhasil dihapus']);
    }
}
