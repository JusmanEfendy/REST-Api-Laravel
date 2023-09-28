<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// route authentication
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::post('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/getdata', [AuthenticationController::class, 'getData']);

    // Menu Posts
    Route::post('posts/create', [PostsController::class, 'store'])->middleware(['creatorPost']);
    Route::patch('posts/{id}/update', [PostsController::class, 'update'])->middleware(['creatorPost']);
    Route::delete('posts/{id}/delete', [PostsController::class, 'destroy'])->middleware(['creatorPost']);

    // Menu Comment
    Route::post('comment/create', [CommentController::class, 'store']);
    Route::patch('comment/{id}/update', [CommentController::class, 'update'])->middleware(['Commentator']);
    Route::delete('comment/{id}/delete', [CommentController::class, 'destroy'])->middleware(['Commentator']);
});

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/register', [AuthenticationController::class, 'register']);

// route posts
Route::get('/posts', [PostsController::class, 'index']);
Route::get('/post/{id}', [PostsController::class, 'show']);





// route comment
Route::get('/comment', [CommentController::class, 'index']);