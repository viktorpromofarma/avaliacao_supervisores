<x-mains.navigation />
<x-mains.app>
    <x-alerts.alertSucessError />

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
                            class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            Salvar <i class="fa-solid fa-check"></i>
                        </button>
                    </div>

            </fieldset>
        </form>

        <!-- Tabela -->
        <fieldset class="w-full max-w-2xl p-4 bg-white border border-red-500 rounded-lg shadow-md">
            <legend class="text-2xl font-bold">Categorias Cadastradas</legend>
            <div class="flex justify-center mt-4 bg-white border border-gray-200 rounded-lg">
                <table class="w-full text-center">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Descrição</th>
                            <th class="px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="px-4 py-2 font-bold">{{ $category->description }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-center mt-4 space-x-4">
                                        <form action="{{ route('settings.categories.destroy', $category['id']) }}"
                                            method="GET">
                                            @csrf @method('EDIT')
                                            <button type="submit"
                                                class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                                Editar <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('settings.categories.destroy', $category['id']) }}"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                                Excluir <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </fieldset>

    </div>

</x-mains.app>

<script src="{{ asset('js/alertSucessError.js') }}"></script>
