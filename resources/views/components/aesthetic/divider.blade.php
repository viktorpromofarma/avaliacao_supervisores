@props([
    'name' => null,
])

<div class="relative flex items-center my-6">
    <div class="flex-grow border-t border-red-300"></div>
    <span class="px-3 text-lg font-medium text-red-500">{{ $name }}</span>
    <div class="flex-grow border-t border-red-300"></div>
</div>
