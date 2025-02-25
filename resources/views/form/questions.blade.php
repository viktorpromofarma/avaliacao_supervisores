<x-mains.navigation />
<x-mains.app>
    <x-alerts.alertSucessError />

    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">
        <form action="{{ route('save-answers') }}" method="POST">
            @csrf

            <input type="hidden" name="user_id" value="{{ $user->id }}">

            @foreach ($form_questions as $categoria)
                <fieldset class="w-full max-w-2xl p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                    <legend class="mb-4 text-2xl font-bold ">{{ $categoria['categoria'] }}</legend>
                    @foreach ($categoria['questoes'] as $questao)
                        <div class="mb-6">
                            <p class="mb-2 font-semibold">{{ $questao['questao'] }}</p>
                            @if ($questao['tipo'] == 'Múltipla Escolha')
                                @foreach ($questao['respostas'] as $resposta)
                                    <label class="block">
                                        <input type="radio" name="{{ $questao['id'] }}" value="{{ $resposta['id'] }}"
                                            class="mr-2">
                                        {{ $resposta['resposta'] }}
                                    </label>
                                @endforeach
                            @else
                                <textarea name="{{ $questao['id'] }}" class="w-full p-2 border border-gray-300 rounded" rows="4"
                                    placeholder="Sua resposta..."></textarea>
                            @endif
                        </div>
                    @endforeach
                </fieldset>
            @endforeach

            <div class="flex justify-center">
                <button type="submit"
                    class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">Finalizar
                    avaliação</button>
            </div>
        </form>
    </div>
</x-mains.app>

<script src="{{ asset('js/alertSucessError.js') }}"></script>
