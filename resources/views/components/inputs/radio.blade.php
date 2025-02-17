@props([
    'id' => null,
    'name' => null,
    'type' => null,
    'value' => null,
    'class' => null,
])

<input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
    class="{{ $class }}" />
