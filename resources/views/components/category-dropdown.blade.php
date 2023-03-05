@props(["currentCategory"])

<x-dropdown>
    <x-slot name="trigger">
        <button
            class="flex-1 appearance-none bg-transparent py-2 pl-3 text-sm font-semibold w-32 text-left inline-flex"
        >
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : "Categories" }}

            <x-icon name="down-arrow" class="absolute pointer-events-none"></x-icon>
        </button>
    </x-slot>

    <x-dropdown-item
        :active="!isset($currentCategory)"
        href="/"
    >All</x-dropdown-item>

    @foreach ($categories as $category)
        @php
        $queryStringParams = request()->except("category");
        $remainingQueryString = http_build_query($queryStringParams);
        @endphp

        <x-dropdown-item
            :active="isset($currentCategory) && $currentCategory->is($category)"
            href="/?category={{ $category->id }}&{{ $remainingQueryString }}"
        >{{ ucwords($category->name) }}</x-dropdown-item>
    @endforeach
</x-dropdown>
