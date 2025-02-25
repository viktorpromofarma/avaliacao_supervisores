<x-mains.navigation />
<x-mains.app>

    <div style="margin-top: 2%;">
        <x-filters.filterHistory route="{{ route('admin.feedback_history') }}" title="Histórico de Feedbacks">
            <x-slot name="slot">
                <div class="flex flex-row space-x-4">
                    <div class="flex-1">
                        <x-inputs.label for="storeStart" text="Loja Inicial"
                            class="block font-bold text-gray-700 text-md" />
                        <x-inputs.input id="storeStart" name="storeStart" type="number" placeholder=""
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="flex-1">
                        <x-inputs.label for="storeEnd" text="Loja Final"
                            class="block font-bold text-gray-700 text-md" />
                        <x-inputs.input id="storeEnd" name="storeEnd" type="number" placeholder=""
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
                    </div>
                </div>
                <div class="flex flex-row space-x-4">
                    <div class="flex-1">
                        <x-inputs.label for="month" text="Mês" class="block font-bold text-gray-700 text-md" />
                        <x-inputs.input id="month" name="month" type="number" placeholder=""
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="flex-1">
                        <x-inputs.label for="year" text="Ano" class="block font-bold text-gray-700 text-md" />
                        <x-inputs.input id="year" name="year" type="number" placeholder=""
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
                    </div>
                </div>
                <x-inputs.label for="manager" text="Gerente" class="block font-bold text-gray-700 text-md" />
                <x-inputs.input id="manager" name="manager" type="text" placeholder="Nome ou matrícula"
                    class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
                <x-inputs.label for="supervisor" text="Supervisor" class="block font-bold text-gray-700 text-md" />
                <x-inputs.input id="supervisor" name="supervisor" type="text" placeholder="Nome ou matrícula"
                    class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
            </x-slot>

            <x-slot name="table">
                <div class="p-8 mt-6 mb-8 overflow-x-auto">
                    <div class="overflow-y-auto rounded-lg max-h-96">
                        <table class="min-w-full bg-white border shadow-md striped">
                            <thead class="text-white bg-red-500">
                                <tr>
                                    <th class="px-4 py-2 text-xl text-center">Loja</th>
                                    <th class="px-4 py-2 text-xl text-center">Data</th>
                                    <th class="px-4 py-2 text-xl text-center">Supervisor</th>
                                    <th class="px-4 py-2 text-xl text-center">Relatório</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </x-slot>
        </x-filters.filterHistory>
    </div>
</x-mains.app>
<script src="{{ asset('js/limparGet.js') }}"></script>
