<x-mains.navigation />
<x-mains.app>
    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>
    <div class="flex flex-col items-center my-8 " style="margin-top: 4%;">
        <form action="{{ route('user.reset.password') }}" method="POST" class="w-full max-w-2xl ">
            @csrf
            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Recuperação de senhas de usuários</legend>
                <div class="mb-8">
                    <x-inputs.label for="userSearch" text="Filtrar Usuário"
                        class="block mt-2 text-xl font-bold text-gray-700 mb-1" />
                    <x-inputs.input id="userSearch" name="manager" type="text"
                        placeholder="Digite o nome do usuários aproximado...."
                        class="w-full px-3 py-2 mb-4 border border-gray-300 rounded-md">
                    </x-inputs.input>
                    <x-inputs.label for="user" text="Usuário a ser resetado"
                        class="block mt-2 text-xl font-bold text-gray-700" />
                    <x-inputs.select id="user" name="user"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"> {{ $user->seller }} - {{ $user->display_name }}
                            </option>
                        @endforeach
                    </x-inputs.select>
                </div>
                <button type="submit"
                    class="px-4 py-2 mt-2 font-bold text-white bg-green-500 rounded hover:bg-green-700"> Resetar Senha
                </button>
    </div>
    </fieldset>
    </form>
    </div>
</x-mains.app>
<script>
    const searchInput = document.getElementById('userSearch');
    const selectElement = document.getElementById('user');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleOptions = [];

        Array.from(selectElement.options).forEach(option => {
            const text = option.text.toLowerCase();
            if (text.includes(searchTerm)) {
                option.style.display = 'block';
                visibleOptions.push(option);
            } else {
                option.style.display = 'none';
            }
        });


        if (visibleOptions.length === 1) {
            selectElement.value = visibleOptions[0].value;
        } else {
            selectElement.value = '';
        }
    });
</script>
