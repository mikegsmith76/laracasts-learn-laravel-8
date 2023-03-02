@props(["heading"])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-4 border-b mb-6 pb-4">{{ $heading }}</h1>

    <div class="flex">
        <aside class="w-48">
            <h4 class="font-semibold mb-6">Links</h4>

            <ul>
                <li><a href="/admin/posts">All Posts</a></li>
                <li><a href="/admin/posts/create">New Post</a></li>
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
