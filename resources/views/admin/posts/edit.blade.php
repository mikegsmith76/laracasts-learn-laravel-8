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

                <select name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old("category_id", $post->category->id) == $category->id ? "selected" : "" }}>{{ $category->name }}</option>
                    @endforeach
                </select>

                <x-form.error name="category_id" />
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
