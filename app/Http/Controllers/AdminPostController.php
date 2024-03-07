<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// auth Jan-Pieter Ott
// Deze controller is verantwoordelijk voor de functies van gebruikers die de admin status behouden
//

class AdminPostController extends Controller
{
    public function index(){
        return view('admin.posts.index',[
            'posts' => Post::paginate(50)
        ]);
    }


    public function create(){
        return view('admin.posts.create');
    }

    public function store(){

        $attributes = array_merge($this->validatePost(),[
            'user_id' => request()->user()->id,
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
            ]);

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post){
        return view('admin.posts.edit',[
            'post' => $post]);
    }

    public function update(Post $post){

        $attributes = $this->validatePost(new Post());

        if ($attributes['thumbnail'] ?? false){
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'Post was successfully updated!');

    }

    public function destroy(Post $post){
        $post->delete();

        return back()->with('success', 'post Deleted');
    }

    protected function validatePost(Post $post = null): array{

        $post ?? new Post();
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exist ? ['image'] :['required','image'],
            'excerpt' => 'required',
            'slug' => ['required', Rule::Unique('posts', 'slug')->ignore($post)],
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
    }
}