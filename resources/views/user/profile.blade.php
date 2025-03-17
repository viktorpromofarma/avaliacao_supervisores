<x-mains.navigation />
<x-mains.app>

    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>
    <div class="flex flex-col items-center my-8 " style="margin-top: 4%;">
        <form action="{{ route('user.profile.update') }}" method="POST" class="w-full max-w-2xl "> @csrf <fieldset
                class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Perfil do usuários</legend>
                <div class="mb-8">
                    <x-inputs.label for="username" text="Usuário" class="block mb-2 text-xl font-bold text-gray-700" />
                    <x-inputs.input id="username" name="username" type="text" placeholder="{{ $users->username }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md " requirido="false" />
                    <x-inputs.label for="display_name" text="Nome de exibição"
                        class="block mt-4 mb-2 text-xl font-bold text-gray-700" />
                    <x-inputs.input id="display_name" name="display_name" type="text"
                        placeholder="{{ $users->display_name }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md " requirido="false" />
                    <div class="mt-4">
                        <x-inputs.label for="password" text="Sua Senha" class="block font-bold text-gray-700" />
                        <x-inputs.input id="password" name="password" type="password" placeholder=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-md " />
                    </div>
                    <!-- Senha -->
                    <div class="mt-4">
                        <x-inputs.label for="confirm_password" text="Confirme a senha"
                            class="block font-bold text-gray-700" />
                        <x-inputs.input id="confirm_password" name="confirm_password" type="password" placeholder=""
                            class="w-full px-3 py-2 border border-gray-300 rounded-md " />
                    </div>
                </div>
                <!-- Campos ocultos -->
                <input type="hidden" value="{{ $users->id }}" name="user_id">
                <!-- Botão de envio -->
                <button type="submit"
                    class="px-4 py-2 mt-2 font-bold text-white bg-green-500 rounded hover:bg-green-700"> Atualizar
                    Perfil </button>
            </fieldset>
        </form>
    </div>
</x-mains.app>
