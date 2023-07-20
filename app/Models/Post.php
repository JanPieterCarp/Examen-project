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
    return collect(File::files(resource_path("posts/")))
        ->map(fn ($file) => YamlFrontMatter::parseFile($file))
        ->map(fn($document) => new Post(
            $document->title,
            $document->date,
            $document->excerpt,
            $document->body(),
            $document->slug

        ));
    }

    public static function find($slug)
    {
        if(! file_exists($path = resource_path("/posts/{$slug}.html"))){
            //return redirect('/')
            throw new ModelNotFoundException;
        }
    return cache()->remember("posts.{$slug}", 1000, fn() => file_get_contents($path));
    {
        //return file_get_contents($path);
    }
    }
}



?>
