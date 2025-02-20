<x-mains.navigation />
<x-mains.app>
    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>
    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">
        <form action="{{ route('settings.categories.update') }}" method="POST" class="w-full max-w-2xl">
            @csrf

            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Editar Categoria</legend>

                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-2">
                        <x-inputs.label for="description" text="Descrição"
                            class="block text-xl font-bold text-gray-700" />
                        <x-inputs.input id="description" name="description" type="text"
                            placeholder="{{ $category->description }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md " />
                        <x-inputs.input id="id" name="id" type="number" placeholder=""
                            value="{{ $category->id }}"
                            class="hidden w-full px-3 py-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="flex justify-start space-x-4">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            Editar <i class="fa-solid fa-check"></i>
                        </button>
                        <button type="button" onclick="window.history.back()"
                            class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                            Cancelar <i class="fa-solid fa-times"></i>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</x-mains.app>
<script src="{{ asset('js/alertSucessError.js') }}"></script>
