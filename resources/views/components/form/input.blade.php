@props(["name", "type" => "text", "default" => ""])

<x-form.field>
    <x-form.label :name="$name" />

    <input
        class="border border-gray-200 p-2 w-full"
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $default) }}"
        {{ $attributes }}
    >

    <x-form.error :name="$name" />
</x-form.field>
