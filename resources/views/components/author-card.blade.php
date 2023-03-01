@props(["author"])
<div {{ $attributes(["class" => "flex items-center text-sm"]) }}>
    <img src="/images/lary-avatar.svg" alt="Lary avatar">
    <div class="ml-3 text-left">
        <h5 class="font-bold">
            <a href="/?author={{ $author->username }}">{{ $author->name }}</a>
        </h5>
    </div>
</div>
