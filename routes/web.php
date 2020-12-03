<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/posts/{post}', [WelcomeController::class, 'show'])->name('posts.show');

Route::get('/about', [WelcomeController::class, 'about']);

Route::get('/service', [PagesController::class, 'service']);
Route::get('/frontend', [PagesController::class, 'frontend']);
Route::get('/backend', [PagesController::class, 'backend']);
Route::get('/dev-ops', [PagesController::class, 'devops']);

Route::resource('posts', PostsController::class, ['only' => ['index', 'create', 'store', 'destroy', 'update', 'edit']]);

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::post('/posts/rate/{post}', [LikesController::class, 'update'])->name('update_like');
Route::get('/posts/comment/{post}', [CommentsController::class, 'view'])->name('commnets.view');
Route::post('/posts/comment/{post}', [CommentsController::class, 'store'])->name('comments.store');
