<x-mains.navigation />
<x-mains.app>

    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">

        <!-- Formulário -->
        <form action="{{ route('settings.categories.store') }}" method="POST" class="w-full max-w-2xl">
            @csrf

            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Cadastrar Categorias</legend>

                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-2">
                        <x-inputs.label for="description" text="Descrição"
                            class="block text-xl font-bold text-gray-700" />
                        <x-inputs.input id="description" name="description" type="text" placeholder=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-md " />
                    </div>


                    <div class="flex justify-start">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                            Salvar <i class="fa-solid fa-check"></i>
                        </button>
                    </div>

            </fieldset>
        </form>

        <!-- Tabela -->
        <fieldset class="w-full max-w-2xl p-4 bg-white border border-red-500 rounded-lg shadow-md">
            <legend class="text-2xl font-bold ">Categorias Cadastradas</legend>
            <div class="flex justify-center mt-4 bg-white border border-gray-200 rounded-lg">
                <table class="w-full text-center">
                    <thead class="bg-gray-100"> <!-- Adicionado background -->
                        <tr>
                            <th class="px-4 py-2">Descrição</th>
                            <th class="px-4 py-2" colspan="2">Ações</th>
                            <!-- Ocupa duas colunas -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 font-bold">COMBATE A FRAUDES E CUSTOS </td>
                            <td class="px-4 py-2">
                                <button class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                    <a href="#" class="flex items-center gap-2 whitespace-nowrap">
                                        Editar <i class="fa-solid fa-pen"></i>
                                    </a>
                                </button>
                            </td>
                            <td class="px-4 py-1">
                                <button class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                    <a href="#" class="flex items-center gap-2 whitespace-nowrap">
                                        Excluir <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>

    </div>

</x-mains.app>
