<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\ContactController;

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

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::post('/result',[PostController::class,'result'])->name('post.result');
//Route::get('/result',[PostController::class,'result'])->name('post.result');
Route::post('/result_back',[PostController::class,'result_back'])->name('post.result_back');

Route::middleware(['can:admin'])->group(function(){
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
});

Route::resource('post', PostController::class);

// Route::get('/result/back', [PostController::class, 'result'])->name('result_get');
// Route::post('/result/back', [PostController::class, 'result'])->name('result_post');
Route::match(['get', 'post'], '/result/back', [PostController::class, 'result']);
Route::match(['get', 'post'], '/result_back/back', [PostController::class, 'result_back']);

Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('contact/index', [ContactController::class, 'index'])->name('contact.index');


