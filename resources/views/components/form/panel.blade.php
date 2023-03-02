@props(["heading", "url"])

<section class="px-6 py-8">
    <main class="max-w-lg mx-auto mt-10">
        <x-panel>
            <h1 class="text-center font-semibold text-xl">{{ $heading }}</h1>

            <form
                action="{{ $url }}"
                class="mt-10"
                method="POST"
            >
            @csrf
                {{ $slot }}
            </form>
        </x-panel>
    </main>
</section>
