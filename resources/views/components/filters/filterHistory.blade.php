@props([
    'route' => null,
    'title' => null,
]);

<div class="flex flex-wrap justify-center ">

    <!-- card 1 -->
    <div class="max-w-sm p-4 mt-4">
        <div class="flex flex-col">
            <form action="{{ $route }}" method="GET" class="w-full max-w-md ">
                @csrf
                <fieldset class="p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md ">
                    <legend class="flex justify-center w-full text-2xl font-bold">{{ $title }}</legend>
                    <div class="grid grid-cols-1 gap-2">
                        <div class="mb-2">
                            {{ $slot }} <!-- Slot padrão para filtros -->
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            Filtrar <i class="fa-solid fa-filter"></i>
                        </button>

                        <button type="button" onclick="limparGet()"
                            class="px-4 py-2 mx-4 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                            Limpar <i class="fa-solid fa-broom"></i>
                        </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div class="max-w-full p-4">
        <div class="flex flex-col">
            {{ $table }}
        </div>
    </div>

</div>
