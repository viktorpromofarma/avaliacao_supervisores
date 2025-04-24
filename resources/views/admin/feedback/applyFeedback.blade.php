<x-mains.navigation />
<x-mains.app>
    <div class="flex flex-col items-center my-8 mt-8">
        <form action="{{ route('feedback.save') }}" method="POST" class="w-full max-w-2xl ">
            @csrf
            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Aplicação de Feedback</legend>
                <div class="mb-8">
                    <h1 class="text-lg font-semibold">Avaliação de Liderança de {{ $userData['display_name'] }}</h1>
                    <h1 class="font-semibold text-md">Data de Avaliação: {{ now()->format('d/m/Y') }}</h1>
                </div>
                <input type="hidden" value="{{ $userData['id'] }}" name="user_id">
                <input type="hidden" value="{{ $month }}" name="month">
                <input type="hidden" value="{{ $year }}" name="year">
                <x-aesthetic.divider name="Comentários em Destaque" />
                @foreach ($classificacoes as $classificacaoId => $classificacaoNome)
                    <div class="mt-8 mb-6">
                        <h2 class="mb-4 text-xl font-semibold text-red-500">{{ $classificacaoNome }}</h2>

                        @php
                            $questoesDaClassificacao = $comentarios
                                ->where('classificacao_id', $classificacaoId)
                                ->pluck('question', 'question_id')
                                ->unique();
                        @endphp

                        @foreach ($questoesDaClassificacao as $questionId => $pergunta)
                            <div class="pl-4 mb-4">
                                <p class="font-semibold text-gray-700">{{ $pergunta }}</p>

                                @foreach ($comentarios as $comentario)
                                    @if ($comentario['classificacao_id'] == $classificacaoId && $comentario['question_id'] == $questionId)
                                        <div class="px-1 py-1">
                                            <input type="checkbox" class="mr-2 border border-red-700"
                                                name="comentarios[{{ $comentario['id'] }}]"
                                                value="{{ $comentario['id'] }}">
                                            <label
                                                class="text-sm font-semibold">{{ $comentario['comentario'] }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach

                        {{-- Bloco "Comentários resumidos" reaproveitado da versão antiga --}}
                        <div class="mt-4">
                            <div class="flex items-center gap-4">
                                <label for="qtdCmtAdicClassi_{{ $classificacaoId }}"
                                    class="text-sm font-bold text-black">
                                    Comentários resumidos:
                                </label>
                                <input type="number" id="qtdCmtAdicClassi_{{ $classificacaoId }}"
                                    name="qtdCmtAdicClassi_{{ $classificacaoId }}" min="1" max="10"
                                    class="w-24 p-2 border border-red-300 rounded">
                                <button type="button" onclick="generateTextareas('{{ $classificacaoId }}')"
                                    class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                                    Gerar
                                </button>
                            </div>
                        </div>
                        <div id="textareaContainer_{{ $classificacaoId }}" class="mt-4"></div>
                    </div>
                @endforeach


                <div class="mt-8 mb-8">
                    <x-aesthetic.divider name="Pontos Positivos" />
                    <div class="mt-4">
                        <div class="flex items-center gap-4">
                            <x-inputs.label for="pontosPositivos" text=" Defina a quantidade:"
                                class="text-sm font-bold text-black" />
                            <x-inputs.input id="pontosPositivos" name="pontosPositivos" type="number" placeholder=""
                                class="w-24 p-2 border border-red-300 rounded " />

                            <button type="button" onclick="generatePontosPositivos('pontosPositivos')"
                                class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                                Gerar
                            </button>
                        </div>
                    </div>
                    <div id="pontosPositivosContainer" class="mt-4"></div>
                </div>

                <div class="mt-8 mb-8">
                    <x-aesthetic.divider name="Pontos para Melhorar" />
                    <div class="mt-4">
                        <div class="flex items-center gap-4">
                            <x-inputs.label for="pontosMelhorar" text=" Defina a quantidade:"
                                class="text-sm font-bold text-black" />
                            <x-inputs.input id="pontosMelhorar" name="pontosMelhorar" type="number" placeholder=""
                                class="w-24 p-2 border border-red-300 rounded " />
                            <button type="button" onclick="generatePontosMelhorar('pontosMelhorar')"
                                class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                                Gerar
                            </button>
                        </div>
                    </div>
                    <div id="pontosMelhorarContainer" class="mt-4"></div>
                </div>
                <div class="mt-8 mb-8">
                    <x-aesthetic.divider name="Recomendações" />
                    <div class="mt-4">
                        <div class="flex items-center gap-4">
                            <x-inputs.label for="recomendacoes" text=" Defina a quantidade:"
                                class="text-sm font-bold text-black" />
                            <x-inputs.input id="recomendacoes" name="recomendacoes" type="number" placeholder=""
                                class="w-24 p-2 border border-red-300 rounded " />
                            <button type="button" onclick="generateRecomendacoes('recomendacoes')"
                                class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                                Gerar
                            </button>
                        </div>
                    </div>
                    <div id="recomendacoesContainer" class="mt-4"></div>
                </div>
                <div class="mt-8 mb-4">
                    <x-aesthetic.divider name="Conclusão" />
                    <div class="mt-4">
                        <textarea name="conclusao" class="w-full p-2 border border-gray-300 rounded" maxlength="255" cols="30"
                            rows="4" placeholder="Sua resposta..." style="resize: none;"></textarea>
                    </div>
                </div>
                <button type="submit"
                    class="px-4 py-2 mt-6 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                    Salvar o Feedback
                </button>
            </fieldset>
        </form>
    </div>
    <script src="{{ asset('js/generateTextAreaFeedback.js') }}"></script>
    <script src="{{ asset('js/generatePontosPositivos.js') }}"></script>
    <script src="{{ asset('js/generatePontosMelhorar.js') }}"></script>
    <script src="{{ asset('js/generateRecomendacoes.js') }}"></script>
</x-mains.app>
