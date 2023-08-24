@props(['comment'])
<article class="flex bg-gray-100 p-6 border border-grey-200 rounded-xl space-x-4">
        <div style="flex-shrink: 0;"><img src="https://i.pravatar.cc/60?u={{ $comment->id }}" class="rounded-xl" width="60" height="60"></div>
        <div>
            <header class="mb-4">
                <h3 class="font-bold">
                    {{ $comment->author->username }}
                </h3>
                <p class="text-xs">Posted<time> {{ $comment->created_at }}</time></p>
            </header>
           <p> {{ $comment->body }}</p>
        </div>
    </article>
