<x-mains.app>
    <div class="flex items-center justify-center min-h-screen" style="background-color: #fff8f9">
        <div class="max-w-md p-6 bg-white border border-gray-300 rounded-lg shadow-xl w-62 ">
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

                <p class="mb-6 font-bold text-gray-600">Insira seus dados abaixo.</p>
            </div>
            <form action="{{ route('create-account') }}" method="POST">
                @csrf
                <input type="number" name="id" value="{{ $id }}" placeholder="{{ $id }}"
                    readonly hidden>
                <!-- Matrícula -->
                <div class="mt-4">
                    <x-inputs.label for="username" text="Seu Usuário" class="block font-bold text-gray-700" />
                    <input type="text" id="username" name="username" value="{{ $username }}" readonly
                        class="w-full px-3 py-2 text-gray-500 bg-gray-200 border border-gray-300 rounded-md" />

                </div>

                <!-- Nome -->
                <div class="mt-4">
                    <x-inputs.label for="name" text="Nome no sistema" class="block font-bold text-gray-700" />
                    <x-inputs.input id="name" name="name" type="text" placeholder=""
                        class="w-full px-3 py-2 border border-gray-300 rounded-md " />
                </div>
                <!-- Senha -->
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
                <!-- Botão de Login -->
                <div class="mt-4 text-center">
                    <x-inputs.button type="submit" text="Crie a sua conta" textColor="white"
                        backgroundColor="#E2304E" />
                </div>
            </form>
        </div>
    </div>
</x-mains.app>
