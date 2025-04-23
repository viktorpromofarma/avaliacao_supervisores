<x-mains.navigation />
<x-mains.app>
    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>

    <div class="flex flex-col items-center mb-4" style="margin-top: 4%;">
        <fieldset class="w-full max-w-2xl p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
            <legend class="text-2xl font-bold ">Supervisor Avaliado</legend>
            <h1 class="text-lg font-semibold">Nome: {{ $supervisorInfo['NOME_SUPERVISOR'] }}
            </h1>
            <h1 class="text-lg font-semibold">Loja de referência: {{ $supervisorInfo['LOJA'] }} </h1>
            <div class="mt-4 mb-4">
                <hr class="border-red-300 border-t-1">
            </div>
            <form action="{{ route('save-answers') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                @foreach ($form_questions as $categoria)
                    <h1 class="mb-4 text-2xl font-bold ">{{ $categoria['categoria'] }}</h1>
                    @foreach ($categoria['questoes'] as $questao)
                        <div class="mb-6">
                            <p class="mb-2 font-semibold">{{ $questao['questao'] }}</p>
                            @if ($questao['tipo'] == 'Múltipla Escolha')
                                @foreach ($questao['respostas'] as $resposta)
                                    <label class="block">
                                        <input type="radio" name="{{ $questao['id'] }}" value="{{ $resposta['id'] }}"
                                            class="mr-2 border border-red-700">
                                        {{ $resposta['resposta'] }}
                                    </label>
                                @endforeach
                            @else
                                <textarea name="{{ $questao['id'] }}" class="w-full p-2 border border-gray-300 rounded" maxlength="254" rows="4"
                                    placeholder="Sua resposta..."></textarea>
                            @endif
                        </div>
                    @endforeach
                @endforeach
                <div class="mt-4 mb-8">
                    <hr class="border-red-300 border-t-1">
                </div>
                <div class="flex justify-center">
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Finalizar
                        avaliação</button>
                </div>
        </fieldset>

        </form>
    </div>
</x-mains.app>

<script src="{{ asset('js/alertSucessError.js') }}"></script>
