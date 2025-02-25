<x-mains.navigation />
<x-mains.app>


    <?php
    $classificacoes = [
        1 => 'Combate a fraudes e custos',
        2 => 'Explorando metas',
        3 => 'Liderança',
        4 => 'Inovações e processos',
    ];

    $supervisor = 'Anizio';
    $cargo = 'Supervisor Regional';

    $comentarios = [
        ['id' => 1, 'comentario' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'classificacao_id' => 1, 'classificacao' => $classificacoes[1]],
        ['id' => 2, 'comentario' => 'Se houve casos de fraudes na sua loja, o supervisor (a) deu assistência para a resolução do caso?', 'classificacao_id' => 1, 'classificacao' => $classificacoes[1]],
        ['id' => 3, 'comentario' => 'Sempre que um funcionário age contra as Normas e Procedimentos da Empresa, o supervisor orienta e toma as providências necessárias?', 'classificacao_id' => 2, 'classificacao' => $classificacoes[2]],
        ['id' => 4, 'comentario' => 'Se houve fraude, comente como foi a assistência do supervisor (a) na ocorrência:', 'classificacao_id' => 1, 'classificacao' => $classificacoes[1]],
        ['id' => 6, 'comentario' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'classificacao_id' => 2, 'classificacao' => $classificacoes[2]],
        ['id' => 7, 'comentario' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'classificacao_id' => 3, 'classificacao' => $classificacoes[3]],
        ['id' => 8, 'comentario' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'classificacao_id' => 3, 'classificacao' => $classificacoes[3]],
        ['id' => 9, 'comentario' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'classificacao_id' => 4, 'classificacao' => $classificacoes[4]],
        ['id' => 10, 'comentario' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'classificacao_id' => 4, 'classificacao' => $classificacoes[4]],
    ];
    ?>


    <div class="flex flex-col items-center" style="margin-top: 3%; margin-bottom: 5%">
        <form action="{{ route('settings.questions.store') }}" method="POST" class="w-full max-w-2xl">
            @csrf
            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Feedback para Supervisor</legend>
                <div class="mb-8">
                    <h1 class="text-lg font-semibold">Avaliação de Liderança de {{ $supervisor }}</h1>
                    <h1 class="font-semibold text-md">Cargo: {{ $cargo }}</h1>
                    <h1 class="font-semibold text-md">Data de Avaliação: {{ now()->format('d/m/Y') }}</h1>
                </div>
                @foreach ($classificacoes as $key => $classificacao)
                    <div>
                        <div class="mt-4 mb-4">
                            <hr class="border-red-300 border-t-1">
                        </div>
                        <h2 class="mb-3 text-lg font-semibold">{{ $classificacao }}</h2>
                        @foreach ($comentarios as $comentario)
                            @if ($comentario['classificacao_id'] == $key)
                                <div class="px-1 py-1">
                                    <input type="checkbox" name="comentarios[{{ $comentario['id'] }}]"
                                        value="{{ $comentario['id'] }}">
                                    <label class="text-sm font-semibold"
                                        for="{{ $comentario['id'] }}">{{ $comentario['comentario'] }}"</label>
                                </div>
                            @endif
                        @endforeach

                        <!-- Campo de entrada numérico para gerar textareas -->
                        <div class="mt-2">
                            <div class="flex items-center gap-4">
                                <label for="numTextareas_{{ $key }}"
                                    class="flex-shrink-0 block text-sm font-bold text-red-500">
                                    Defina a quantidade de comentários:
                                </label>
                                <input type="number" id="numTextareas_{{ $key }}"
                                    name="numTextareas_{{ $key }}" min="1" max="10"
                                    class="block w-24 p-2 border border-red-300 rounded">
                                <button type="button" onclick="generateTextareas('{{ $key }}')"
                                    class="flex-shrink-0 px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                                    Gerar
                                </button>
                            </div>
                        </div>

                        <!-- Container para os textareas gerados -->
                        <div id="textareaContainer_{{ $key }}" class="mt-4"></div>
                    </div>
                @endforeach
            </fieldset>
        </form>
    </div>

    <script>
        function generateTextareas(classificacaoId) {
            const numTextareas = document.getElementById(`numTextareas_${classificacaoId}`).value;
            const container = document.getElementById(`textareaContainer_${classificacaoId}`);
            container.innerHTML = '';

            for (let i = 0; i < numTextareas; i++) {
                // Cria o label
                const label = document.createElement('label');
                label.htmlFor = `comentario_${classificacaoId}_${i}`;
                label.className = 'block text-sm font-medium text-gray-700 mt-2';
                label.textContent = `Comentário ${i + 1}`;

                // Cria o textarea
                const textarea = document.createElement('textarea');
                textarea.id = `comentario_${classificacaoId}_${i}`;
                textarea.name = `comentarios[${classificacaoId}][${i}]`;
                textarea.cols = 30;
                textarea.rows = 3;
                textarea.className = 'w-full p-2 border border-gray-300 rounded mb-2';

                // Adiciona o label e o textarea ao container
                container.appendChild(label);
                container.appendChild(textarea);
            }
        }
    </script>
</x-mains.app>
