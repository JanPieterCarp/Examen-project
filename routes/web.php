<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {

    $posts = Post::all();

        return view('posts',
        ['posts' => Post::all()
        ]);
    });

Route::get('posts/{post}', function ($slug) {
    // vind een post met een slug en geef hem door aan de view genaamd 'post'

    return view('post', [
        'post' => Post::findorfail($slug)

    ]);
})->where('post','[A-z_\-]+');
