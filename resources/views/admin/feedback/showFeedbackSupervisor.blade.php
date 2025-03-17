<x-mains.navigation />
<x-mains.app>

    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">
        <div class="w-full max-w-2xl">
            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Feedback aplicado</legend>
                <div class="mb-8">
                    <h1 class="font-bold text-md">Supervisor: <span class="text-red-500">{{ $user->display_name }}</span>
                    </h1>
                    <h1 class="font-bold text-md">Período de avaliação: <span
                            class="text-red-500">{{ $feedback->month }}/{{ $feedback->year }}</span></h1>
                    <h1 class="font-bold text-md">
                        Data de avaliação:
                        <span
                            class="text-red-500">{{ \Carbon\Carbon::parse($feedback->created_at)->format('d-m-Y') }}</span>
                    </h1>

                </div>
                <x-aesthetic.divider name="Quantitativo de Avaliação" />
                <div class="mb-8 text-center">
                    <!-- Comentários em Destaque -->

                    <table class="flex justify-center w-full ">

                        <tbody class="text-center">
                            @foreach ($metrics as $supervisorAverage)
                                <tr>
                                    <td class="px-4 py-2 font-bold text-left">
                                        {{ $supervisorAverage['CATEGORY_DESCRIPTION'] }}
                                    </td>
                                    <td class="px-4 py-2 font-bold text-center ">
                                        {{ $supervisorAverage['AVERAGE_NOTE'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <x-aesthetic.divider name="Resultados Obtidos" />
                <div class="mb-8">
                    @foreach ($totalAnswersManager as $categoryId => $categoryData)
                        <!-- Título da Categoria -->
                        <h2 class="mt-4 mb-4 text-lg font-bold text-red-500">{{ $categoryData['category_description'] }}
                        </h2>

                        <!-- Exibe as questões e respostas -->
                        @foreach ($categoryData['questions'] as $questionDescription => $answers)
                            <h3 class="mt-2 mb-2 font-semibold text-md">{{ $questionDescription }}</h3>
                            <!-- Título da Questão -->

                            <ul class="list-disc list-inside">
                                @foreach ($answers as $answer)
                                    <li class="text-gray-700">
                                        Em {{ $answer['porcentagem'] }}% foi dito que
                                        {{ $answer['answer_description'] }}
                                    </li> <!-- Resposta e Porcentagem -->
                                @endforeach
                            </ul>
                        @endforeach
                        <!-- Exibe os comentários selecionados -->
                        @if (!empty($categoryData['commentSelect']))
                            <h3 class="mt-4 mb-2 font-semibold text-md">Comentários em Destaque</h3>
                            <div class="space-y-2"> <!-- Espaçamento entre os comentários -->
                                @foreach ($categoryData['commentSelect'] as $commentSelect)
                                    <div class="text-red-500">
                                        • {{ $commentSelect }} <!-- Adiciona o ponto manualmente -->
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Exibe os comentários -->
                        @if (!empty($categoryData['comments']))
                            <h3 class="mt-4 mb-2 font-semibold text-md">Comentários Resumidos</h3>
                            <div class="space-y-2"> <!-- Espaçamento entre os comentários -->
                                @foreach ($categoryData['comments'] as $comment)
                                    <div class="text-gray-700">
                                        • {{ $comment }} <!-- Adiciona o ponto manualmente -->
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
                <x-aesthetic.divider name="Pontos Positivos" />
                <div class="space-y-2">
                    @foreach ($positivePoints as $point)
                        <div class="text-gray-700">
                            • {{ $point->positivePoints }}
                        </div>
                    @endforeach
                </div>
                <x-aesthetic.divider name="Pontos para Melhorar" />
                <div class="space-y-2">
                    @foreach ($pointsToImprove as $point)
                        <div class="text-gray-700">
                            • {{ $point->pointsToImprove }}
                        </div>
                    @endforeach
                </div>

                <x-aesthetic.divider name="Recomendações" />
                <div class="space-y-2">
                    @foreach ($recomendations as $point)
                        <div class="text-gray-700">
                            • {{ $point->recomendation }}
                        </div>
                    @endforeach
                </div>


                <x-aesthetic.divider name="Conclusão" />
                <div class="space-y-2">
                    <div class="text-gray-700">
                        {{ $conclusion }}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>

</x-mains.app>
