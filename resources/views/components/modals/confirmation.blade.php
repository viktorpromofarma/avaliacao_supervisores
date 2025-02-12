@props([
    'action' => null,
    'description' => null,
    'confirmationText' => null,
    'denialText' => null,
    'route' => null,
])


<div id="modal" class="hidden" onclick="{{ $action }}">
    <div class="text-center">
        <div class="fixed inset-0 flex items-center justify-center py-4 bg-gray-500 bg-opacity-50">
            <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-lg" onclick="event.stopPropagation()">
                <h3 class="mb-4 text-xl font-semibold">{{ $description }}</h3>
                <button onclick="window.location.href='{{ route('questions') }}'"
                    class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-700">
                    {{ $confirmationText }}
                </button>

                <button onclick="{{ $action }}" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">
                    {{ $denialText }}
                </button>

            </div>
        </div>
    </div>
</div>
