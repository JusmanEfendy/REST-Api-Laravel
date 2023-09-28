<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Http\Resources\PostsResource;
use App\Http\Resources\PostDetailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostsController extends Controller
{
    public function index() 
    {
        $posts = Posts::with(['penulis:id,username', 'comments'])->orderBy('id', 'DESC')->get();

        // return PostsResource::collection($posts);
        return Inertia::render('Home', [
            'title' => 'PostJust',
            'desc' => 'Welcome to Posts',
            'posts' => PostsResource::collection($posts),

        ]);
    }

    public function show($id) 
    {
        $post = Posts::with(['penulis', 'comments'])->findOrFail($id);

        return new PostDetailResource($post);
    }

    public function store(Request $request) 
    {
        $newName = null;
        if($request->file_image) {
            $fileName = $this->generateRandomString();
            $ekstensi = $request->file_image->extension();
            $newName = date('dmY').'_'.$fileName.'.'.$ekstensi;

            Storage::putFileAs('images', $request->file_image, $newName);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        
        $request['image'] = $newName;
        $request['author'] = Auth::id();
        $post = Posts::create($request->all());

        return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => new PostDetailResource($post)], 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $post = Posts::findOrFail($id);
        $post->update($validated);

        return response()->json(["message" => "Data berhasil di perbarui"], 201);
    }

    public function destroy($id)
    {
        $post = Posts::findOrFail($id);

        if ($post->image) {
            Storage::delete($post->image);
        }
        $post->delete();

        return response()->json([$post]);
    }

    // fungsi pembuat string random
    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
