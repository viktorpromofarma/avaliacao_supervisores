<x-mains.navigation />
<x-mains.app>

    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">
        <div class="w-full max-w-2xl">
            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Médias de avaliação do Supervisor</legend>
                <div class="mb-8">
                    <h1 class="font-bold text-md">Supervisor: <span
                            class="text-red-500">{{ $userData['display_name'] }}</span></h1>
                    <h1 class="font-bold text-md">Período de avaliação: <span
                            class="text-red-500">{{ $month }}/{{ $year }}</span></h1>

                </div>
                <div class="mt-4 mb-4">
                    <hr class="border-red-300 border-t-1">
                </div>
                <div class="flex justify-center">
                    <table class="w-full text-center ">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-xl ">Categoria de avaliação</th>
                                <th class="px-4 py-2 text-xl">Nota Média</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supervisorAverages as $supervisorAverage)
                                <tr>
                                    <td class="px-4 py-2 font-bold ">
                                        {{ $supervisorAverage['CATEGORY_DESCRIPTION'] }}
                                    </td>
                                    <td class="px-4 py-2 font-bold ">
                                        {{ $supervisorAverage['AVERAGE_NOTE'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>

</x-mains.app>
<script src="{{ asset('js/limparGet.js') }}"></script>
