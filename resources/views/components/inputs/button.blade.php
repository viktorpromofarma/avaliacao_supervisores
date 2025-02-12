@props([
    'type' => null,
    'textColor' => null, // Substituí hífens por camelCase
    'backgroundColor' => null, // Substituí hífens por camelCase
    'text' => null,
])

<button type="{{ $type }}" style="color: {{ $textColor }}; background-color: {{ $backgroundColor }};"
    class="px-6 py-2 font-bold rounded-md">
    {{ $text }}
</button>
