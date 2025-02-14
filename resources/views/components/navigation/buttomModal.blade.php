@props([
    'action' => null,
    'description' => null,
    'icon' => null,
])


<div class="mx-4 mt-4 mb-6 text-center">
    <button onclick="{{ $action }}"> {!! $icon !!}
        <h1 class="mt-3 font-bold text-md card-title">{{ $description }}</h1>
    </button>
    </a>
</div>
