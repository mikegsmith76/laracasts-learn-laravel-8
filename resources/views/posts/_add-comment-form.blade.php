<form
    action="/posts/{{ $post->slug }}/comment"
    method="POST"
>
    @csrf

    <header class="flex items-center">
        <img
            alt=""
            class="rounded-full"
            src="https://i.pravatar.cc/40?u={{ auth()->id() }}"
            width="60"
        >
        <h2 class="ml-4">Want to participate?</h2>
    </header>

    <x-form.field>
        <textarea
            class="text-small w-full focus:ring"
            name="body"
            placeholder="Quick, think of something to say"
            required
            rows="5"
        ></textarea>

        <x-form.error name="body" />
    </x-form.field>

    <footer class="flex justify-end mt-6 pt-6 border-t border-gray">
        <x-form.button>Post</x-form.button>
    </footer>
</form>
