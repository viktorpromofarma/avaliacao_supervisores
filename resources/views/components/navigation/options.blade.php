@props([
    'route' => null,
    'icon' => null,
    'description' => null,
])

<div class="mx-4 mt-4 mb-6 text-center ">
    <a href="{{ $route }}" class="text-center">
        {!! $icon !!}
        <h1 class="mt-3 font-bold text-md card-title ">{{ $description }}</h1>

    </a>
</div>
