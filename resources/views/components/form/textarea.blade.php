@props(["name", "default" => ""])

<x-form.field>
    <x-form.label :name="$name" />

    <textarea
        class="border border-gray-200 p-2 w-full"
        id="{{ $name }}"
        name="{{ $name }}"
        required
    >{{ old($name, $default) }}</textarea>

    <x-form.error :name="$name" />
</x-form.field>
