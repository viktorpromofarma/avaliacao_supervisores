<x-mains.navigation />
<x-mains.app>

    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>


    <div class="flex flex-col items-center" style="margin-top: 4%; margin-bottom: 5%">

        <!-- Formulário -->
        <form action="{{ route('settings.questions.store') }}" method="POST" class="w-full max-w-2xl">
            @csrf

            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Cadastrar Questões</legend>

                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-2">
                        <x-inputs.label for="category" text="Categoria" class="block text-xl font-bold text-gray-700" />
                        <x-inputs.select id="category" name="category"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            @foreach ($categories as $category)
                                <option value={{ $category->id }}>{{ $category->description }}</option>
                            @endforeach

                        </x-inputs.select>
                    </div>

                    <div class="mb-2">
                        <x-inputs.label for="description" text="Descrição"
                            class="block text-xl font-bold text-gray-700" />
                        <x-inputs.input id="description" name="description" type="text" placeholder=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-md " requirido="true" />
                    </div>
                    <div class="mb-2">
                        <x-inputs.label for="generalSupervisor" text="Avalia o supervisor Geral"
                            class="block text-xl font-bold text-gray-700" />
                        <x-inputs.select id="generalSupervisor" name="generalSupervisor"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="1">Sim, Disponibilizar questão para avaliar o supervisor geral.</option>
                            <option value="0">Não, Disponibilizar questão apenas para os supervisores regionais.
                            </option>
                        </x-inputs.select>
                    </div>
                    <div class="mb-2">
                        <x-inputs.label for="type" text="Tipo da questão"
                            class="block text-xl font-bold text-gray-700" />
                        <div class="flex flex-col gap-2 mt-2">
                            @foreach ($typeQuestions as $typeQuestion)
                                <label class="flex items-center gap-2">
                                    <x-inputs.radio type="radio" id="{{ $typeQuestion->description }}"
                                        name="type_question" value="{{ $typeQuestion->id }}"
                                        class="text-red-500 form-radio" />
                                    <span class="font-bold text-gray-700">{{ $typeQuestion->description }}</span>
                                    <x-inputs.input id="num_choices" name="num_choices" type="number" min="1"
                                        class="hidden w-20 px-1 py-1 border border-gray-300 rounded-md" required />
                                </label>
                            @endforeach
                        </div>

                    </div>

                    <div class="flex justify-start">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                            Cadastrar questão <i class="fa-solid fa-check"></i>
                        </button>
                    </div>

            </fieldset>
        </form>

        <!-- Tabela -->
        <fieldset class="w-full max-w-6xl p-4 bg-white border border-red-500 rounded-lg shadow-md">
            <legend class="text-2xl font-bold ">Questões Cadastradas</legend>
            <div class="flex justify-center mt-4 bg-white border border-gray-200 rounded-lg">
                <table class="w-full ">
                    <thead class="text-center bg-gray-100"> <!-- Adicionado background -->
                        <tr>
                            <th class="px-4 py-2 ">Categoria</th>
                            <th class="px-4 py-2 ">Descrição</th>
                            <th class="px-4 py-2"> Avalia o Supervisor Geral ? </th>
                            <th class="px-4 py-2 ">Tipo</th>
                            <th class="px-4 py-2 ">Ações</th>
                            <!-- Ocupa duas colunas -->
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($questions as $question)
                            <tr>
                                <td class="px-4 py-2 font-bold text-center">{{ $question['category_description'] }}
                                </td>
                                <td class="px-4 py-2 font-bold text-justify">{{ $question['description'] }} </td>
                                <td class="px-4 py-2 font-bold text-center">
                                    {{ $question['supervisor_geral_question'] == 1 ? 'Sim' : 'Não' }}
                                </td>

                                <td class="px-4 py-2 font-bold text-center">{{ $question['type_description'] }} </td>

                                <td class="px-4 py-2">
                                    <div class="flex justify-center mt-4 space-x-4">
                                        <form action="{{ route('settings.questions.destroy', $question['id']) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-6 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                                Excluir <i class="ml-2 fa-solid fa-trash"></i>

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
<script src="{{ asset('js/questionsChoice.js') }}"></script>
