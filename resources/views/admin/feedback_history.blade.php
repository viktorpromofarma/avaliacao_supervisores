<x-mains.navigation />
<x-mains.app>

    <div style="margin-top: 2%;">
        <x-filters.filterHistory route="{{ route('admin.feedback_history') }}" title="Histórico de Feedbacks">
            <x-slot name="slot">

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

                <x-inputs.label for="supervisor" text="Supervisor" class="block font-bold text-gray-700 text-md" />
                <x-inputs.input id="supervisor" name="supervisor" type="text" placeholder="Nome ou matrícula"
                    class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
            </x-slot>

            <x-slot name="table">
                <div class="p-8  mb-8 overflow-x-auto">
                    <div class="overflow-y-auto rounded-lg max-h-96">
                        <table class="min-w-full bg-white border shadow-md striped">
                            <thead class="text-white bg-red-500">
                                <tr>
                                    <th class="px-4 py-2 text-xl text-center">Supervisor</th>
                                    <th class="px-4 py-2 text-xl text-center">Período</th>
                                    <th class="px-4 py-2 text-xl text-center">Relatório</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedbacks as $feedbacks)
                                    <tr class="font-bold text-center">
                                        <td class="px-4 py-2 text-center">{{ $feedbacks->display_name }}</td>
                                        <td class="px-4 py-2 text-center">{{ $feedbacks->month }}/{{ $feedbacks->year }}
                                        <td class="px-4 py-2 ">
                                            <form action="{{ route('feedback.show') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="feedback_status_id"
                                                    value="{{ $feedbacks->id }}">
                                                <button type="submit"
                                                    class="px-2 py-2 mt-4 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                                    Visualizar
                                                </button>
                                            </form>
                                        </td>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </x-slot>
        </x-filters.filterHistory>
    </div>
</x-mains.app>
<script src="{{ asset('js/limparGet.js') }}"></script>
