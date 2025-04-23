<x-mains.navigation />
<x-mains.app>
    <div class="fixed top-12 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>

    <div class="flex flex-col items-center" style="margin-top: 5%; margin-bottom: 5%">
        <div>
            <fieldset class="w-full p-6 mb-8 bg-white border border-red-500 rounded-lg shadow-md">
                <legend class="text-2xl font-bold">Aplicação de Feedback</legend>

                <div class="flex justify-center overflow-x-auto">
                    <table class="w-full text-center border-collapse">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-xl">Nome</th>
                                <th class="px-4 py-2 text-xl">Período</th>
                                <th class="px-4 py-2 text-xl">Ação</th>
                                <th class="px-4 py-2 text-xl">Feedback Aplicado?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supervisors as $supervisor)
                                <tr class="border-b">
                                    <td class="px-4 py-2 font-semibold">{{ $supervisor['supervisor_name'] }}</td>
                                    <td class="px-4 py-2 font-semibold">
                                        {{ $supervisor['month'] }}/{{ $supervisor['year'] }}</td>
                                    <td class="px-4 py-2">
                                        @if (is_null($supervisor['feedback_id']))
                                            <form action="{{ route('feedback.apply') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="supervisor"
                                                    value="{{ $supervisor['supervisor'] }}">
                                                <input type="hidden" name="month" value="{{ $supervisor['month'] }}">
                                                <input type="hidden" name="year" value="{{ $supervisor['year'] }}">
                                                <button type="submit"
                                                    class="px-4 py-2 mt-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                                    Gerar Feedback
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('feedback.destroy', $supervisor['feedback_id']) }}"
                                                method="POST" class="mt-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                                    Excluir Feedback
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 font-semibold">
                                        @if (is_null($supervisor['feedback_id']))
                                            <i class="text-red-600 fa-solid fa-xmark fa-2xl"></i>
                                        @else
                                            <i class="text-green-600 fa-solid fa-check-double fa-2xl"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</x-mains.app>
