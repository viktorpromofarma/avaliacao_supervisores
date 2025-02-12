@props([
    'for' => null,
    'class' => null,
    'text' => null,
])

<label for="{{ $for }}" class="{{ $class }}">{{ $text }}</label>
