<x-mains.navigation />
<x-mains.app>

    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">

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
                            <option value="1">Teste 1</option>
                            <option value="2">Teste 2 </option>
                            <option value="3">Teste 3 </option>
                            <option value="4">Teste 4</option>
                            <option value="5">Teste 5</option>
                        </x-inputs.select>
                    </div>

                    <div class="mb-2">
                        <x-inputs.label for="description" text="Descrição"
                            class="block text-xl font-bold text-gray-700" />
                        <x-inputs.input id="description" name="description" type="text" placeholder=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-md " requirido="true" />
                    </div>

                    <div class="mb-2">
                        <x-inputs.label for="type" text="Tipo da questão"
                            class="block text-xl font-bold text-gray-700" />

                        <div class="flex flex-col gap-2 mt-2">
                            <!-- Opção 1 -->
                            <label class="flex items-center gap-2">
                                <x-inputs.radio type="radio" id="multiple_choice" name="type"
                                    value="multiple_choice" class="text-red-500 form-radio" />
                                <span class="font-bold text-gray-700">Múltipla escolha</span>
                            </label>

                            <x-inputs.input id="num_choices" name="num_choices" type="number" min="1"
                                class="hidden w-20 px-2 py-1 border border-gray-300 rounded-md" />

                            <!-- Opção 2 -->
                            <label class="flex items-center gap-2">
                                <x-inputs.radio type="radio" id="dissertativa" name="type" value="dissertativa"
                                    class="text-red-500 form-radio" />
                                <span class="font-bold text-gray-700">Dissertativa</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-start">
                        <button type="submit"
                            class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
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
                            <th class="px-4 py-2 ">Tipo</th>
                            <th class="px-4 py-2 ">Ações</th>
                            <!-- Ocupa duas colunas -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td class="px-4 py-2 font-bold text-center">COMBATE A FRAUDES </td>
                            <td class="px-4 py-2 font-bold text-justify">O supervisor (a) te orientou a verificar
                                relatórios de
                                cupons cancelados no procfit? </td>
                            <td class="px-4 py-2 font-bold text-center">Múltipla Escolha </td>

                            <td class="px-4 py-1 text-center">
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


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const multipleChoiceRadio = document.getElementById("multiple_choice");
        const dissertativaRadio = document.getElementById("dissertativa");
        const numChoicesInput = document.getElementById("num_choices");

        // Seleciona o local onde os inputs devem ser adicionados
        const choicesContainer = document.createElement("div");
        choicesContainer.id = "choices-container";
        choicesContainer.className = "grid grid-cols-1 gap-1";

        // Insere o container antes do input de Dissertativa
        dissertativaRadio.parentNode.parentNode.insertBefore(choicesContainer, dissertativaRadio.parentNode);

        function toggleNumberInput() {
            if (multipleChoiceRadio.checked) {
                numChoicesInput.classList.remove("hidden");
            } else {
                numChoicesInput.classList.add("hidden");
                numChoicesInput.value = "";
                choicesContainer.innerHTML = ""; // Remove inputs se mudar para Dissertativa
            }
        }

        function updateChoicesInputs() {
            const count = parseInt(numChoicesInput.value, 10) || 0;
            choicesContainer.innerHTML = ""; // Limpa os inputs antes de recriar

            for (let i = 1; i <= count; i++) {
                const div = document.createElement("div");
                div.className = "flex items-center gap-2";

                // Input resposta
                const respostaInput = document.createElement("input");
                respostaInput.type = "text";
                respostaInput.name = `respostas[]`;
                respostaInput.placeholder = `Resposta ${i}`;
                respostaInput.className = "w-full px-3 py-2 border border-gray-300 rounded-md ";

                // Input nota
                const notaInput = document.createElement("input");
                notaInput.type = "number";
                notaInput.name = `notas[]`;
                notaInput.min = "0";
                notaInput.max = "10";
                notaInput.placeholder = `Nota ${i}`;
                notaInput.className = "w-20 px-3 py-2 border border-gray-300 rounded-md";

                div.appendChild(respostaInput);
                div.appendChild(notaInput);
                choicesContainer.appendChild(div);
            }
        }

        multipleChoiceRadio.addEventListener("change", toggleNumberInput);
        dissertativaRadio.addEventListener("change", toggleNumberInput);
        numChoicesInput.addEventListener("input", updateChoicesInputs);
    });
</script>
