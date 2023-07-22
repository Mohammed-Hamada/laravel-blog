<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NewsletterController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;


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



Route::get('/', [PostController::class, 'index']);

Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [CommentController::class, 'create']);

Route::post('newsletter', NewsletterController::class);

Route::get('categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts,
        'categories' => Category::all()
    ]);
});

Route::get('user/{user}/posts', function (User $user) {
    return view('posts', [
        'posts' => $user->posts,
        "categories" => Category::all(),
    ]);
});

Route::middleware('can:admin')
    ->prefix('admin')
    ->controller(PostController::class)
    ->group(function () {
        Route::resource('posts', PostController::class)->except('edit', 'show');

        // Route::get('posts/create', 'create');
        // Route::post('posts', 'store');
        // Route::patch('posts/{post}', 'update');
        // Route::delete('posts/{post}', 'destroy');
    });

Route::middleware('guest')
    ->prefix('register')
    ->group(function () {
        Route::get('/', [RegisterController::class, 'create']);
        Route::post('/', [RegisterController::class, 'store']);
    });

Route::middleware('guest')
    ->prefix('login')
    ->group(function () {
        Route::get('/', [LoginController::class, 'create']);
        Route::post('/', [LoginController::class, 'store']);
    });

Route::post('logout', LogoutController::class)
    ->middleware('auth');