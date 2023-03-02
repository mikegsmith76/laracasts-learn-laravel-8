<x-layout>
    <x-form.panel heading="Register" url="/register">
        <x-form.input name="name" />
        <x-form.input name="username" />
        <x-form.input name="email" autocomplete="username" />
        <x-form.input name="password" type="password" autocomplete="new-password" />

        <x-form.button>Register</x-form.button>
    </x-form.panel>
</x-layout>
