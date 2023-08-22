<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show'])->where('posts','[A-z_\-]+');

Route::get('register', [RegisterController::class, 'create']);
