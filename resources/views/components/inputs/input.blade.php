@props([
    'id' => null,
    'name' => null,
    'type' => null,
    'placeholder' => null,
    'class' => null,
    'requirido' => null,
    'value' => null,
])

<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
    class="{{ $class }}" {{ $requirido ? 'required' : '' }} value="{{ $value }}">
