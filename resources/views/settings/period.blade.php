<x-mains.navigation />
<x-mains.app>

    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">
        <form action="{{ route('settings.period.store') }}" method="POST">
            @csrf

            <fieldset class="w-full max-w-2xl p-4 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Cadastrar Períodos</legend>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <x-inputs.label for="mes" text="Mês" class="block font-bold text-gray-700" />
                        <x-inputs.select id="mes" name="mes"
                            class="w-full p-2 border border-gray-300 rounded" />
                    </div>
                    <div class="mb-6">
                        <x-inputs.label for="ano" text="Ano" class="block font-bold text-gray-700" />
                        <x-inputs.select id="ano" name="ano"
                            class="w-full p-2 border border-gray-300 rounded" />
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                        Confirmar <i class="fa-solid fa-check"></i>
                    </button>
                </div>

            </fieldset>
        </form>

        <fieldset class="w-full max-w-2xl p-6 border border-red-500 rounded-lg shadow-md g-white">
            <legend class="text-2xl font-bold">Períodos Cadastrados</legend>
            <div class="flex justify-center bg-white border border-gray-200 rounded-lg">
                <table class="w-full text-center ">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Mês</th>
                            <th class="px-4 py-2">Ano</th>
                            <th class="px-4 py-2">Primeiro Dia</th>
                            <th class="px-4 py-2">Último Dia</th>
                            <th class="px-4 py-2">Excluir</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periods as $period)
                            <tr>
                                <td class="px-4 py-2">{{ $period['mes'] }}</td>
                                <td class="px-4 py-2">{{ $period['ano'] }}</td>
                                <td class="px-4 py-2">{{ $period['primeiro_dia'] }}</td>
                                <td class="px-4 py-2">{{ $period['ultimo_dia'] }}</td>
                                <td class="px-4 py-2">
                                    <button class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">

                                        <a href="#">Excluir<i class="fa-solid fa-trash-can"></i></a>
                                    </button>

                                </td>

                            </tr>
                        @endforeach

                </table>
            </div>



        </fieldset>



    </div>

</x-mains.app>

<script src="{{ asset('js/period.js') }}"></script>
