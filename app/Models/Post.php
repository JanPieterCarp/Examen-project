<?php

namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $date, $excerpt, $body, $slug){
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
    return cache()->rememberForever('post.all', function(){
        return collect(File::files(resource_path("posts/")))
        ->map(fn ($file) => YamlFrontMatter::parseFile($file))
        ->map(fn($document) => new Post(
            $document->title,
            $document->date,
            $document->excerpt,
            $document->body(),
            $document->slug

        ))
        ->sortByDesc('date');
    });

    }

    public static function find($slug)
    {
        return static::all()->firstwhere('slug', $slug);
    }
    public static function findorfail($slug)
    {
        $post =  static::find($slug);

        if (! $post){
            throw new ModelNotFoundException();
        }

        return $post;
    }
}




?>
