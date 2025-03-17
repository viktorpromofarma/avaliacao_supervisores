<x-mains.navigation />
<x-mains.app>
    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>

    <div class="mb-6">
        <x-navigation.fieldset
            legend="{{ $roules == 'gerente'
                ? 'Área do Gerente'
                : ($roules == 'supervisor_geral'
                    ? 'Área do Supervisor Geral'
                    : ($roules == 'supervisor'
                        ? 'Área do Supervisor'
                        : 'Área do Admin')) }}">
            @if ($roules == 'gerente')
                @if ($validationPeriodoAnswers === true)
                    <div style='color: #4CAF50;'>
                        <x-navigation.options route="{{ route('home') }}"
                            icon="<i class='fa-solid fa-check-double fa-4x'></i>" description="Avaliação já respondida" />
                    </div>
                @elseif ($validationPeriodoAnswers === false)
                    <x-navigation.buttomModal action="openConfirmation()" description="Realizar Avaliação"
                        icon="<i class='fa-regular fa-pen-to-square fa-4x'></i>" />
                @elseif($validationPeriodoAnswers == null)
                    <div style='color: red;'>
                        <x-navigation.options route="{{ route('home') }}" icon="<i class='fa-solid fa-xmark fa-4x'></i>"
                            description="Avaliação não está disponível" />
                    </div>
                @endif
                <x-navigation.options route="{{ route('admin.evaluation_history') }}"
                    icon="<i class='fa-solid fa-file-circle-check fa-4x'></i>" description="Histórico de Avaliações" />
            @elseif ($roules == 'supervisor')
                <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2 md:grid-cols-3">
                    <x-navigation.options route="{{ route('admin.evaluation_history') }}"
                        icon="<i class='fa-solid fa-file-circle-check fa-4x'></i>"
                        description="Histórico de Avaliações" />

                    <x-navigation.options route="{{ route('average.supervisor') }}"
                        icon="<i class='fa-solid fa-chart-line fa-4x'></i>" description="Notas de Avaliação" />

                    <x-navigation.options route="{{ route('admin.feedback_history') }}"
                        icon="<i class='fa-regular fa-comments fa-4x'></i>" description="Feedbacks Aplicados" />
                    @if ($validationPeriodoAnswers === true)
                        <div style='color: #4CAF50;'>
                            <x-navigation.options route="{{ route('home') }}"
                                icon="<i class='fa-solid fa-check-double fa-4x'></i>"
                                description="Avaliação já respondida" />
                        </div>
                    @elseif ($validationPeriodoAnswers === false)
                        <x-navigation.buttomModal action="openConfirmation()" description="Realizar Avaliação"
                            icon="<i class='fa-regular fa-pen-to-square fa-4x'></i>" />
                    @elseif($validationPeriodoAnswers == null)
                        <div style='color: red;'>
                            <x-navigation.options route="{{ route('home') }}"
                                icon="<i class='fa-solid fa-xmark fa-4x'></i>"
                                description="Avaliação não está disponível" />
                        </div>
                    @endif
                </div>
            @elseif ($roules == 'supervisor_geral')
                <x-navigation.options route="{{ route('average.supervisor') }}"
                    icon="<i class='fa-solid fa-chart-line fa-4x'></i>" description="Médias de avaliação" />

                <x-navigation.options route="{{ route('admin.feedback_history') }}"
                    icon="<i class='fa-regular fa-calendar-days fa-4x'></i>" description="Histórico de feedbacks" />
            @elseif($roules == 'admin')
                <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2 md:grid-cols-3">

                    <x-navigation.options route="{{ route('admin.generate_feedback') }}"
                        icon="<i class='fa-solid fa-file-pen fa-4x'></i>" description="Gerar Feedback" />

                    <x-navigation.options route="{{ route('admin.feedback_history') }}"
                        icon="<i class='fa-regular fa-calendar-days fa-4x'></i>" description="Histórico de feedbacks" />

                    <x-navigation.options route="{{ route('average.supervisor') }}"
                        icon="<i class='fa-solid fa-chart-line fa-4x'></i>" description="Médias de avaliação" />

                    <x-navigation.options route="{{ route('admin.evaluation_history') }}"
                        icon="<i class='fa-solid fa-user-clock fa-4x'></i>" description="Histórico de avaliações" />

                    <x-navigation.options route="{{ route('settings.period') }}"
                        icon="<i class='fa-solid fa-clock fa-4x'></i>" description="Períodos da avaliação" />

                    <x-navigation.options route="{{ route('settings.categories') }}"
                        icon="<i class='fa-solid fa-list-ol fa-4x'></i>" description="Cadastrar Categorias" />

                    <x-navigation.options route="{{ route('settings.questions') }}"
                        icon="<i class='fa-solid fa-list-check fa-4x'></i>" description="Cadastrar questões" />

                </div>
            @endif

        </x-navigation.fieldset>

        <x-modals.confirmation action="closeConfirmation()" description="Deseja realizar a avaliação?"
            confirmationText="Sim, desejo." denialText="Não, cancele." route="{{ route('questions') }}" />
    </div>
</x-mains.app>

<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('js/alertSucessError.js') }}"></script>
