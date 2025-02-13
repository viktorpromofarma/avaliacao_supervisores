<?php
$classificacoes = [
    1 => 'Combate a fraudes e custos',
    2 => 'Explorando metas',
    3 => 'Liderança',
    4 => 'Inovações e processos',
];

$tipos_questoes = [
    1 => 'multipla-escolha',
    2 => 'dissertativa',
];

$tipos_respostas = [
    ['resposta' => 'Sim'],
    ['resposta' => 'Não'],
    ['resposta' => 'De vez em quando'],
    ['resposta' => ''], // Dissertativa
];

$questoes = [
    ['id' => 1, 'questao' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'categoria_id' => 1, 'respostas' => [$tipos_respostas[0], $tipos_respostas[1], $tipos_respostas[2]]],
    ['id' => 2, 'questao' => 'Se houve casos de fraudes na sua loja, o supervisor (a) deu assistência para a resolução do caso?', 'categoria_id' => 1, 'respostas' => [$tipos_respostas[0], $tipos_respostas[1], $tipos_respostas[2]]],
    ['id' => 3, 'questao' => 'Sempre que um funcionário age contra as Normas e Procedimentos da Empresa, o supervisor orienta e toma as providências necessárias?', 'categoria_id' => 1, 'respostas' => [$tipos_respostas[0], $tipos_respostas[1], $tipos_respostas[2]]],
    ['id' => 4, 'questao' => 'Se houve fraude, comente como foi a assistência do supervisor (a) na ocorrência:', 'categoria_id' => 1, 'respostas' => [$tipos_respostas[3]]],
    ['id' => 5, 'questao' => 'O supervisor (a) te orientou a verificar relatórios de cupons cancelados no procfit?', 'categoria_id' => 2, 'respostas' => [$tipos_respostas[0], $tipos_respostas[1], $tipos_respostas[2]]],
    ['id' => 6, 'questao' => 'Se houve casos de fraudes na sua loja, o supervisor (a) deu assistência para a resolução do caso?', 'categoria_id' => 2, 'respostas' => [$tipos_respostas[0], $tipos_respostas[1], $tipos_respostas[2]]],
    ['id' => 7, 'questao' => 'Sempre que um funcionário age contra as Normas e Procedimentos da Empresa, o supervisor orienta e toma as providências necessárias?', 'categoria_id' => 2, 'respostas' => [$tipos_respostas[0], $tipos_respostas[1], $tipos_respostas[2]]],
    ['id' => 8, 'questao' => 'Se houve fraude, comente como foi a assistência do supervisor (a) na ocorrência:', 'categoria_id' => 2, 'respostas' => [$tipos_respostas[3]]],
];

$categorias_com_questoes = [];

foreach ($questoes as $questao) {
    $categoria_id = $questao['categoria_id'];
    $categorias_com_questoes[$categoria_id]['categoria'] = $classificacoes[$categoria_id];
    $tipo_questao = empty($questao['respostas'][0]['resposta']) ? 2 : 1;
    $categorias_com_questoes[$categoria_id]['questoes'][] = [
        'id' => $questao['id'],
        'questao' => $questao['questao'],
        'tipo' => $tipos_questoes[$tipo_questao],
        'respostas' => $questao['respostas'],
    ];
}
?>

<x-mains.navigation />
<x-mains.app>
    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">
        <form action="{{ route('save-form') }}" method="POST">
            @csrf
            <input type="hidden" name="username" value="{{ $user->username }}">
            <input type="hidden" name="seller" value="{{ $user->seller }}">

            @foreach ($categorias_com_questoes as $categoria)
                <fieldset class="w-full max-w-2xl p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                    <legend class="mb-4 text-2xl font-bold">{{ $categoria['categoria'] }}</legend>
                    @foreach ($categoria['questoes'] as $questao)
                        <div class="mb-6">
                            <p class="mb-2 font-semibold">{{ $questao['questao'] }}</p>
                            @if ($questao['tipo'] == 'multipla-escolha')
                                @foreach ($questao['respostas'] as $resposta)
                                    <label class="block">
                                        <input type="radio" name="{{ $questao['id'] }}"
                                            value="{{ $resposta['resposta'] }}" class="mr-2">
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

            <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Enviar
                respostas</button>
        </form>
    </div>
</x-mains.app>
