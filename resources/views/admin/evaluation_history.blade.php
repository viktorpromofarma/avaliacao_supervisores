<x-mains.navigation />
<x-mains.app>
    <div class="flex flex-row items-start mt-8 ml-4">
        <!-- Formulário -->
        <form action="#" method="GET" class="w-full max-w-sm"> @csrf <fieldset
                class="p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold text-center">Historico de Avaliações</legend>
                <div class="grid grid-cols-1 gap-2">
                    <div class="mb-2">
                        <x-inputs.label for="semester" text="Semestres" class="block font-bold text-gray-700 text-md" />
                        <x-inputs.select name="semester" id="semester"
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md">
                            <option value="3">Todos os Semestres</option>
                            <option value="1">1º Semestre</option>
                            <option value="2">2º Semestre</option>
                        </x-inputs.select>
                        <x-inputs.label for="store" text="Lojas" class="block font-bold text-gray-700 text-md" />
                        <x-inputs.input id="store" name="store" type="number" placeholder=""
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />
                        <x-inputs.label for="manager" text="Gerentes" class="block font-bold text-gray-700 text-md" />
                        <x-inputs.input id="manager" name="manager" type="text" placeholder=""
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" />

                        <x-inputs.label for="quantity" text="Quantidade de Lojas"
                            class="block font-bold text-gray-700 text-md" />
                        <x-inputs.input id="quantity" name="quantity" type="text" placeholder=""
                            class="w-full px-3 py-2 mb-2 border border-gray-300 rounded-md" value="10" />
                    </div>
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700"> Filtrar <i
                            class="fa-solid fa-filter"></i>
                    </button>

                    <button type="submit"
                        class="px-4 py-2 mx-4 font-bold text-white bg-red-500 rounded hover:bg-red-700"> Limpar <i
                            class="fa-solid fa-broom"></i>
                    </button>
                </div>
            </fieldset>
        </form>

        <!-- Section com os cards -->
        <section class="flex-1 mx-4 mt-4 mb-4 ml-4">
            <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 card-container">
                <!-- Ajuste o grid conforme necessário -->
                @for ($index = 1; $index <= 10; $index++)
                    <a href="{{ route('home') }}">
                        <div class="p-4 rounded-lg card" style="background-color: #e2304e; color: white;">
                            <h1 class="text-2xl font-bold">Loja {{ $index }}</h1>
                            <p class="font-bold">Fulano da silva santos.</p>
                            <p class="font-bold">25/12/2025</p>
                        </div>
                    </a>
                @endfor
        </section>
    </div>

</x-mains.app>
