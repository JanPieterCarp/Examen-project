<x-layout>
    <article>
        <h1>
            {!!$post->title!!}
        </h1>
        <p>
           Van <a href="#">Jan-Pieter</a>, over <a href="/categories/{{$post->category->slug}}"> {{$post->category->name}} </a>
        <p>
        <div>
            {!!$post->body!!}
        </div>
    </article>

        <a href="/">go back</a>
</x-layout>
