@props([
    'route' => null,
    'icon' => null,
    'description' => null,
])
<div class="flex flex-col items-center justify-center px-6 py-4">
    <a href="{{ $route }}" class="text-center">
        {!! $icon !!}
        <h1 class="mt-3 text-lg font-bold card-title">{{ $description }}</h1>
    </a>
</div>
