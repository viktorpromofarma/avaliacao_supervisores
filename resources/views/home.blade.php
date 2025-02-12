<x-mains.navigation />
<x-mains.app>

    <x-navigation.fieldset legend="Área do Gerente">
        <x-navigation.buttomModal action="openConfirmation()" description="Realizar Avaliação"
            icon="<i class='fa-regular fa-pen-to-square fa-5x'></i>" />

        <x-navigation.options route="{{ route('home') }}" icon="<i class='fa-solid fa-file-circle-check fa-5x'></i>"
            description="Avaliações Realizadas" />
    </x-navigation.fieldset>

    <x-modals.confirmation action="closeConfirmation()" description="Deseja realizar a avaliação?"
        confirmationText="Sim, desejo." denialText="Cancelar" route="{{ route('questions') }}" />

</x-mains.app>

<script src="{{ asset('js/modal.js') }}"></script>
