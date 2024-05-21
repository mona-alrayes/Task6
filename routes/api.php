<?php

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});
Route::controller(PostController::class)->group(function() {
    Route::get('posts', 'index');
    Route::get('posts/{id}', 'show');
    Route::get('posts/search/{category}', 'searchByCategory');
});
// Route::controller(CommentController::class)->group(function() {
//     Route::get('comment', 'index');
//     Route::get('comment/{id}', 'show');
// });
// Route::middleware('auth.api')->group( function () {
//     Route::post('comment', CommentController::class);
//     Route::put('comment/{id}', CommentController::class);
// });
// Route::middleware('auth.api' , 'role:publisher')->group( function () {
//     Route::delete('comments/{id}', CommentController::class);
// });
Route::middleware(['auth.api' , 'role:writer'])->group( function () {
    Route::resource('posts', PostController::class)->except('index','show','delete','searchByCategrory');
 });

//  Route::middleware(['auth.api' , 'role:admin'])->group( function ()  {
    Route::resource('categories', CategoryController::class);
// });

