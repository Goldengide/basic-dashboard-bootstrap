<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\CategoryController;
use App\Http\Controllers\Blog\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('blog/check-slug-for-categories', [CategoryController::class, 'checkSlug'])->name('check-slug.categories');
Route::post('blog/check-slug-for-posts', [PostController::class, 'checkSlug'])->name('check-slug.post');
Route::post('blog/check-slug-for-settings', [PostController::class, 'checkSlug'])->name('check-slug.settings');
