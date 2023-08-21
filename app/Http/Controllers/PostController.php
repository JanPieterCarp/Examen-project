<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class PostController extends Controller
{
    public function index(){

        return view('posts.index',
            ['posts' => Post::latest()->filter(request(['search', 'category', 'author']))->get(),
            'categories' =>category::all()

        ]);
    }

    public function show(post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }

    protected function getPosts(){
       return ;
    }
}
