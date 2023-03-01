<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Log In!</h1>

            <form
                action="/login"
                class="mt-10"
                method="POST"
            >
                @csrf

                <div class="mb-6">
                    <label
                        class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="username"
                    >
                        Email Address
                    </label>

                    <input
                        class="border border-gray-400 p-2 w-full"
                        id="email"
                        name="email"
                        required
                        type="email"
                        value="{{ old("email") }}"
                    >

                    @error("email")
                    <p class="text-red-500 text-xs mt-1">{{ $message  }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        class="block mb-2 uppercase font-bold text-xs text-gray-700"
                        for="name"
                    >
                        Password
                    </label>

                    <input
                        class="border border-gray-400 p-2 w-full"
                        id="password"
                        name="password"
                        required
                        type="password"
                    >

                    @error("password")
                    <p class="text-red-500 text-xs mt-1">{{ $message  }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button
                        class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                        type="submit"
                    >
                        Login
                    </button>
                </div>
            </form>
        </main>
    </section>
</x-layout>
