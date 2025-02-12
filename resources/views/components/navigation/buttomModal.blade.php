@props([
    'action' => null,
    'description' => null,
    'icon' => null,
])

<div class="flex flex-col items-center justify-center px-6 py-4">
    <button onclick="{{ $action }}"> {!! $icon !!}
        <h1 class="mt-3 text-lg font-bold card-title">{{ $description }}</h1>
    </button>
    </a>
</div>
