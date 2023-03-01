@props(["comment"])
<article>
    <x-panel class="flex bg-gray-100 space-x-4">
        <div class="flex-shrink-0">
            <img
                alt=""
                class="rounded-xl"
                src="https://i.pravatar.cc/60?u={{ $comment->author->id }}"
                width="60"
            >
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->name }}</h3>
                <p class="text-xs">Posted <strong>{{ $comment->created_at->diffForHumans() }}</strong></p>
            </header>

            <p>{{ $comment->body }}</p>
        </div>
    </x-panel>
</article>
