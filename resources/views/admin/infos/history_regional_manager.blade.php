<x-mains.navigation />
<x-mains.app>

    <div class="p-8 mt-8 mb-8 ">

        <div class="flex flex-col items-center" style=" margin-bottom: 5%">
            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Histórico de Gerentes e regionais</legend>
                <div class="overflow-y-auto rounded-lg max-h-96">
                    <table class="min-w-full bg-white border shadow-md">
                        <thead class="sticky top-0 z-10 px-4 py-2 font-bold text-black bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-center text-md text-nowrap">Loja</th>
                                <th class="px-4 py-2 text-center text-md text-nowrap">Matricula do Regional</th>
                                <th class="px-4 py-2 text-center text-md text-nowrap">Nome do Regional</th>
                                <th class="px-4 py-2 text-center text-md text-nowrap">Matricula do Gerente</th>
                                <th class="px-4 py-2 text-center text-md text-nowrap">Nome do Gerente</th>
                                <th class="px-4 py-2 text-center text-md text-nowrap">Data de Entrada</th>
                                <th class="px-4 py-2 text-center text-md text-nowrap">Data de Saída</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history_regional_manager as $history)
                                <tr class="font-bold {{ $history->DATA_SAIDA ? 'even:bg-gray-100' : 'bg-red-100' }}">
                                    <td class="px-4 py-2 text-center text-gray-700">
                                        {{ $history->LOJA }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-700">
                                        {{ $history->SUPERVISOR }}
                                    </td>
                                    <td class="px-4 py-2 text-left text-gray-700">
                                        {{ $history->NOME_SUPERVISOR }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-700">
                                        {{ $history->GERENTE_ATUAL }}
                                    </td>
                                    <td class="px-4 py-2 text-left text-gray-700">
                                        {{ $history->NOME }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-700">
                                        {{ \Carbon\Carbon::parse($history->DATA_ENTRADA)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-2 text-center text-gray-700">
                                        @if ($history->DATA_SAIDA)
                                            {{ \Carbon\Carbon::parse($history->DATA_SAIDA)->format('d/m/Y') }}
                                        @else
                                            <span class="font-bold text-red-500">Ativo</span>
                                        @endif
                                    </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </fieldset>

        </div>
    </div>

</x-mains.app>
