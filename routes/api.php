<?php
use Illuminate\Support\Facades\Route;
use App\Models\Article;
Route::get('/articles', fn() => response()->json(Article::with('user')->latest()->get()));
