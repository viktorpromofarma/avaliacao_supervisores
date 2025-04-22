@props([
    'legend' => null,
])

<div class="flex items-center justify-center" style="margin-top: 2%;">
    <fieldset class="relative w-full max-w-4xl p-12 border-2 border-red-200 rounded-lg shadow-xl">
        <legend class="px-2 text-4xl font-bold">{{ $legend }}</legend>
        <div class="flex flex-wrap justify-center gap-6">


            {{ $slot }}


        </div>
    </fieldset>
</div>
