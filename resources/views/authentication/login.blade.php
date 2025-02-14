<x-mains.app>
    <div class="flex items-center justify-center min-h-screen" style="background-color: #fff8f9">
        <div class="max-w-md p-6 bg-white border border-red-600 rounded-lg shadow-xl w-62 ">
            @if ($message = Session::get('error'))
                <div class="mb-4 text-sm text-red-600"> {{ $message }} </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="text-center">
                <!-- Centralizando e ajustando o tamanho do logo -->
                <div class="flex justify-center ">
                    <img src="{{ URL::asset('/imgs/índice2.png') }}" alt="Logo" id="logo" class="w-12 h-auto">
                </div>
                <h2 class="m-4 mb-2 text-2xl font-bold text-gray-800">
                    {{ env('APP_NAME') }}
                </h2>

                <p class="mb-6 font-bold text-gray-600">Faça o login aqui.</p>
            </div>
            <form action="{{ route('login.auth') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Matrícula -->
                <div class="mt-4">
                    <x-inputs.label for="username" text="Seu Usuário" class="block font-bold text-gray-700" />
                    <x-inputs.input id="username" name="username" type="text" placeholder="" />
                </div>
                <!-- Senha -->
                <div class="mt-4">
                    <x-inputs.label for="password" text="Sua Senha" class="block font-bold text-gray-700" />
                    <x-inputs.input id="password" name="password" type="password" placeholder="" />
                </div>



                <!-- Botão de Login -->

                <div class="mt-4 text-center">
                    <x-inputs.button type="submit" text="Acessar sua conta" textColor="white"
                        backgroundColor="#E2304E" />
                </div>
                <!-- Esqueci a senha -->
                <div class="mt-4 text-center">
                    <div class="relative group">
                        <!-- Link com o texto "Esqueceu a senha?" -->
                        <a href="http://app.promofarma.int/helpdesk/" class="font-bold text-red-500" target="_blank">
                            Esqueceu a senha ?
                        </a>

                        <!-- Tooltip que aparece ao passar o mouse -->
                        <div
                            class="absolute invisible px-3 py-2 mb-2 text-sm text-white transition-opacity duration-300 transform -translate-x-1/2 bg-gray-800 rounded opacity-0 bottom-full left-1/2 group-hover:opacity-100 group-hover:visible">
                            Clique aqui para abrir um chamado e recuperar sua senha.
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-mains.app>
