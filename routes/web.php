<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
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
    \Illuminate\Support\Facades\DB::listen(function($query){
        logger($query->sql, $query->bindings);
    });

        return view('posts',
        ['posts' => Post::with('category')->get()
        ]);
    });

Route::get('posts/{post:slug}', function (Post $post) {
    // vind de eerste post met dezelfde slug die wordt opgegeven of faal

    return view('post', [
        'post' => $post

    ]);
})->where('posts','[A-z_\-]+');


Route::get('categories/{category:slug}', function (Category $category) {

    return view('posts', [
        'posts' => $category->posts

    ]);
});
