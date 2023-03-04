<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form action="/admin/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PATCH")

            <x-form.input name="title" :default="$post->title" />
            <x-form.input name="slug" :default="$post->slug" />
            <x-form.input name="thumbnail" type="file" default="{{ $post->thumbnail }}"/>
            <x-form.textarea name="excerpt" :default="$post->excerpt" />
            <x-form.textarea name="body" :default="$post->body" />

            <x-form.field>
                <x-form.label name="category_id" />

                <select
                    class="w-full"
                    id="category_id"
                    name="category_id[]"
                    multiple
                >
                    @foreach (\App\Models\Category::all() as $category)
                        <option
                            {{ in_array($category->id, old("category_id", $post->categoryIds())) ? "selected" : "" }}
                            value="{{ $category->id }}"
                        >{{ $category->name }}</option>
                    @endforeach
                </select>

                <x-form.error name="category_id" />
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
