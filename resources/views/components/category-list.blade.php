@props(["categories"])

<div class="space-x-2">
    @foreach ($categories as $category)
        <x-category-button :category="$category" />
    @endforeach
</div>
