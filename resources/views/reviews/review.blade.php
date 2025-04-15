<x-mains.navigation />
<x-mains.app>
    <div class="flex flex-col items-center" style="margin-top: 3%; margin-bottom: 5%">
        <div class="w-full max-w-2xl">
            @csrf
            <fieldset class="w-full p-6 mb-4 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Relatório do Supervisor</legend>
                <div class="mb-8">
                    <h1 class="text-lg font-semibold">Avaliação de Liderança de {{ $userDatas['supervisor_name'] }} </h1>
                    <h1 class="font-semibold text-md">Data de Avaliação: {{ $userDatas['data_registro'] }} </h1>
                    <h1 class="font-semibold text-md">Loja da avaliação: {{ $userDatas['store'] }} </h1>
                </div>
                <div class="mt-4 mb-4">
                    <hr class="border-red-300 border-t-1">
                </div>
                @foreach ($reviews as $category)
                    <div class="mb-4">
                        <h2 class="mb-2 text-2xl font-semibold ">{{ $category['category_description'] }}</h2>

                        @foreach ($category['questions'] as $question)
                            <div class="question">
                                <h2 class="font-semibold text-md">{{ $question['question_description'] }}</h2>
                                @foreach ($question['answers'] as $answer)
                                    <div class="items-start mb-2 font-semibold text-red-500 answer">
                                        <p style="text-align: justify;">{{ $answer['answer'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </fieldset>
        </div>
    </div>
</x-mains.app>
