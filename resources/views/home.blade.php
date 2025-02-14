<x-mains.navigation />
<x-mains.app>

    <div style="margin-top: 12%; ">

        <x-navigation.fieldset
            legend="{{ $roules == 'gerente'
                ? 'Área do Gerente'
                : ($roules == 'supervisor'
                    ? 'Área do Supervisor'
                    : 'Área do Admin') }}">


            @if ($roules == 'gerente')
                <x-navigation.buttomModal action="openConfirmation()" description="Realizar Avaliação"
                    icon="<i class='fa-regular fa-pen-to-square fa-4x'></i>" />
                <x-navigation.options route="#" icon="<i class='fa-solid fa-file-circle-check fa-4x'></i>"
                    description="Avaliações Realizadas" />
            @elseif ($roules == 'supervisor')
                <x-navigation.options route="#" icon="<i class='fa-solid fa-chart-line fa-4x'></i>"
                    description="Notas de Avaliação" />
                <x-navigation.options route="#" icon="<i class='fa-regular fa-comments fa-4x'></i>"
                    description="Feedbacks Aplicados" />
            @elseif($roules == 'admin')
                <div class="grid grid-cols-3 gap-4 md:grid-cols-3">
                    <x-navigation.options route="#" icon="<i class='fa-solid fa-file-pen fa-4x'></i>"
                        description="Gerar Feedback" />
                    <x-navigation.options route="#" icon="<i class='fa-solid fa-user-clock fa-4x'></i>"
                        description="Histórico de avaliações" />
                    <x-navigation.options route="#" icon="<i class='fa-regular fa-calendar-days fa-4x'></i>"
                        description="Histórico de feedbacks" />
                    <x-navigation.options route="#" icon="<i class='fa-solid fa-screwdriver-wrench fa-4x'></i>"
                        description="Períodos da avaliação" />
                    <x-navigation.options route="#" icon="<i class='fa-solid fa-list-ol fa-4x'></i>"
                        description="Cadastrar Categorias" />
                    <x-navigation.options route="#" icon="<i class='fa-solid fa-list-check fa-4x'></i>"
                        description="Cadastrar questões" />
                </div>
            @endif

        </x-navigation.fieldset>

        <x-modals.confirmation action="closeConfirmation()" description="Deseja realizar a avaliação?"
            confirmationText="Sim, desejo." denialText="Não, cancele." route="{{ route('questions') }}" />
    </div>
</x-mains.app>

<script src="{{ asset('js/modal.js') }}"></script>
