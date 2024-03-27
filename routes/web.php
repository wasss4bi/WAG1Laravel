<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AfishaController;
use App\Http\Controllers\McController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('/posts/update', [PostController::class, 'update']);
Route::get('/posts/delete', [PostController::class, 'delete']);
Route::get('/posts/firstOrCreate', [PostController::class, 'firstOrCreate']);
Route::get('/posts/updateOrCreate', [PostController::class, 'updateOrCreate']);

Route::get('/posts/restore', [PostController::class, 'restore']);

Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/afisha', [AfishaController::class, 'index'])->name('afisha.index');
Route::get('/mc', [McController::class, 'index'])->name('mc.index');
Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms.index');
Route::get('/room', [RoomController::class, 'index'])->name('room.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');


Route::get('/articles', [ArticleController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
