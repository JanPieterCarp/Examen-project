<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\Rules\Exists;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(){

        return view('posts.index',
            ['posts' => Post::latest()->filter(request(['search', 'category', 'author']))
            ->simplePaginate(6)->withQueryString(),

        ]);
    }

    public function show(post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create(){
        return view('user.posts.create');
    }

    public function store(){

        $attributes = array_merge($this->validatePost(),[
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
            ]);

        Post::create($attributes);

        return redirect('/');
    }

}
