<x-mains.navigation />
<x-mains.app>
    <div class="fixed top-6 right-3 z-[1050]">
        <x-alerts.alertSucessError />
    </div>
    <div class="mb-6">
        <x-navigation.fieldset legend="Home Page">
            @if ($user->accessRole && $user->accessRole->root === '1')
                <x-navigation.options route="{{ route('user.reset') }}" icon="<i class='fa-solid fa-key fa-4x'></i>"
                    description="Reset de Senha" />
            @endif
            @if ($user->accessRole && $user->accessRole->admin === '1')
                <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2 md:grid-cols-3">

                    <x-navigation.options route="{{ route('settings.period') }}"
                        icon="<i class='fa-solid fa-clock fa-4x'></i>" description="Períodos da avaliação" />

                    <x-navigation.options route="{{ route('settings.categories') }}"
                        icon="<i class='fa-solid fa-list-ol fa-4x'></i>" description="Cadastrar Categorias" />

                    <x-navigation.options route="{{ route('settings.questions') }}"
                        icon="<i class='fa-solid fa-list-check fa-4x'></i>" description="Cadastrar questões" />

                    <x-navigation.options route="{{ route('average.supervisor') }}"
                        icon="<i class='fa-solid fa-chart-line fa-4x'></i>" description="Médias de avaliação" />

                    <x-navigation.options route="{{ route('admin.evaluation_history') }}"
                        icon="<i class='fa-solid fa-user-clock fa-4x'></i>" description="Histórico de avaliações" />

                    <x-navigation.options route="{{ route('admin.generate_feedback') }}"
                        icon="<i class='fa-solid fa-file-pen fa-4x'></i>" description="Gerar Feedback" />

                    <x-navigation.options route="{{ route('admin.feedback_history') }}"
                        icon="<i class='fa-regular fa-calendar-days fa-4x'></i>" description="Histórico de feedbacks" />

                    <x-navigation.options route="{{ route('admin.listRegionalManager') }}"
                        icon="<i class='fa-solid fa-people-group fa-4x'></i>"
                        description="Lista de regionais e gerentes" />


                </div>
            @endif
            @if ($user->accessRole && $user->accessRole->supervisor === '1')
                <x-navigation.options route="{{ route('average.supervisor') }}"
                    icon="<i class='fa-solid fa-chart-line fa-4x'></i>" description="Médias de avaliação" />

                <x-navigation.options route="{{ route('admin.feedback_history') }}"
                    icon="<i class='fa-regular fa-calendar-days fa-4x'></i>" description="Histórico de feedbacks" />
            @endif
            @if ($user->accessRole && $user->accessRole->regional === '1')
                <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2 md:grid-cols-3">
                    <x-navigation.options route="{{ route('admin.evaluation_history') }}"
                        icon="<i class='fa-solid fa-file-circle-check fa-4x'></i>"
                        description="Histórico das avaliações" />

                    <x-navigation.options route="{{ route('average.supervisor') }}"
                        icon="<i class='fa-solid fa-chart-line fa-4x'></i>" description="Médias de Avaliação" />

                    <x-navigation.options route="{{ route('admin.feedback_history') }}"
                        icon="<i class='fa-regular fa-comments fa-4x'></i>" description="Feedbacks Aplicados" />



                    <x-modals.confirmation action="closeConfirmation()" description="Deseja realizar a avaliação?"
                        confirmationText="Sim, desejo." denialText="Não, cancele."
                        route="{{ route('questionsRegional') }}" />


                    @if (!$validationPeriodoAnswers)
                        <x-navigation.buttomModal action="openConfirmation()" description="Realizar Avaliação"
                            icon="<i class='fa-regular fa-pen-to-square fa-4x'></i>" />
                    @else
                        <div style='color: red;'>
                            <x-navigation.options route="{{ route('home') }}"
                                icon="<i class='fa-solid fa-xmark fa-4x'></i>"
                                description="Avaliação não está disponível" />
                        </div>
                    @endif
                </div>
            @endif
            @if ($user->accessRole && $user->accessRole->gerentes === '1')
                @if ($validationPeriodoAnswers)
                    <x-navigation.buttomModal action="openConfirmation()" description="Realizar Avaliação"
                        icon="<i class='fa-regular fa-pen-to-square fa-4x'></i>" />
                @else
                    <div style='color: red;'>
                        <x-navigation.options route="{{ route('home') }}"
                            icon="<i class='fa-solid fa-xmark fa-4x'></i>"
                            description="Avaliação não está disponível" />
                    </div>
                @endif
                <x-navigation.options route="{{ route('admin.evaluation_history') }}"
                    icon="<i class='fa-solid fa-file-circle-check fa-4x'></i>" description="Histórico de Avaliações" />
                <x-modals.confirmation action="closeConfirmation()" description="Deseja realizar a avaliação?"
                    confirmationText="Sim, desejo." denialText="Não, cancele." route="{{ route('questions') }}" />
            @endif
        </x-navigation.fieldset>
    </div>
</x-mains.app>
<script src="{{ asset('js/modal.js') }}"></script>
<script src="{{ asset('js/alertSucessError.js') }}"></script>
