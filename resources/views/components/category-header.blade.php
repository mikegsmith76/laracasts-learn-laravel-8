@props(["currentCategory"])

@if (!auth()->user()->isSubscribedTo($currentCategory))
<form action="{{ route("category.subscribe", ["category" => $currentCategory->id]) }}" method="POST">
    @csrf

    <button
        class="border border-gray-200 px-4 py-2 rounded-xl text-xs bg-gray-100 mt-4"
        type="submit"
    >
        <i class="fas fa-plus"></i> Subscribe to {{ $currentCategory->name }}
    </button>
</form>
@else
<form action="{{ route("category.subscribe", ["category" => $currentCategory->id]) }}" method="POST">
    @csrf
    @method("DELETE")

    <button
        class="border border-gray-200 px-4 py-2 rounded-xl text-xs bg-gray-100 mt-4"
        type="submit"
    >
        <i class="fas fa-minus"></i> Unsubscribe from {{ $currentCategory->name }}
    </button>
</form>
@endif
