<x-mains.navigation />
<x-mains.app>
    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>
    <div class="flex flex-col items-center mb-4" style="margin-top: 4%;">
        <fieldset class="w-full max-w-2xl p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
            <legend class="text-2xl font-bold ">Avaliação do supervisor Geral</legend>
            <h1 class="text-lg font-semibold">Nome: {{ $supervisorInfo['NOME_SUPERVISOR'] }} </h1>
            <h1 class="text-lg font-semibold">Loja de referência: {{ $supervisorInfo['LOJA'] }} </h1>
            <div class="mt-4 mb-4">
                <hr class="border-red-300 border-t-1">
            </div>
            @if (!$form_questions->isEmpty())
                <form action="{{ route('save-answers-regional') }}" method="POST" id="saveForm">
                    @csrf <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="store" value="{{ $supervisorInfo['LOJA'] }}">
                    <input type="hidden" name="supervisor_id" value="{{ $supervisorInfo['id'] }}">
                    @foreach ($form_questions as $categoria)
                        <h1 class="mb-4 text-2xl font-bold ">{{ $categoria['categoria'] }}</h1>
                        @foreach ($categoria['questoes'] as $questao)
                            <div class="mb-6">
                                <p class="mb-2 font-semibold">{{ $questao['questao'] }}</p>
                                @if ($questao['tipo'] == 'Múltipla Escolha')
                                    @foreach ($questao['respostas'] as $resposta)
                                        <label class="block">
                                            <input type="radio" name="{{ $questao['id'] }}"
                                                value="{{ $resposta['id'] }}" class="mr-2 border border-red-700">
                                            {{ $resposta['resposta'] }} </label>
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
                            avaliação </button>
                    </div>
                </form>
            @else
                <em> Nenhuma questão foi parametrizada pela Educação corporativa, por favor entre em contato com o
                    setor responsável! </em>
            @endif

        </fieldset>
    </div>
    {{-- Modal de carregamento --}}
    <div id="loadingModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-800 bg-opacity-75">
        <div class="p-6 text-center bg-white rounded-lg shadow-lg">
            <div class="flex items-center justify-center mb-4 space-x-3">
                <svg class="w-6 h-6 text-green-700 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                    </path>
                </svg>
                <span class="text-lg font-semibold text-gray-800">Salvando dados...</span>
            </div>
            <p class="text-gray-700">Por favor aguarde, estamos salvando a avaliação . Não feche esta janela.</p>
        </div>
    </div>
</x-mains.app>

<script src="{{ asset('js/hiddenModal.js') }}"></script>
<script src="{{ asset('js/alertSucessError.js') }}"></script>
