<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArticleController, AuthController, InteractionController, ProfileController};

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/article/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::resource('articles', ArticleController::class)->except(['index', 'show']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/comment', [InteractionController::class, 'comment'])->name('comment');
    Route::post('/rate', [InteractionController::class, 'rate'])->name('rate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
