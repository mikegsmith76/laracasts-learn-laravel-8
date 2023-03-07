<section>
    <h1>A new post has been created.</h1>

    <p>Post Title: {{ $post->title }}</p>
    <p>Author: {{ $post->author->name }}</p>
    <p>Categories:</p>
    <ul>
        @foreach($post->categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>
    <p><a href="{{ route("post.show", ["post" => $post]) }}">View Post</a></p>
</section>
