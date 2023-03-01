@if (session()->has("success"))
    <div
        class="fixed bottom-3 right-3 bg-blue-500 text-white py-2 px-4 rounded-xl text-sm"
        x-data="{ show: true }"
        x-init="setTimeout(() => show=false, 4000)"
        x-show="show"
    >
        <p>{{ session("success") }}</p>
    </div>
@endif
