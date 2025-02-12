@props([
    'id' => null,
    'name' => null,
    'type' => null,
    'placeholder' => null,
])


<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
    class="w-full px-3 py-2 border border-gray-300 rounded-md">
