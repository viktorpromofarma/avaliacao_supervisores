document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('saveForm');
    const loadingModal = document.getElementById('loadingModal');
    const submitButton = document.getElementById('submitButton');

    // Validação antes do envio
    form.addEventListener('submit', function (e) {
        // Verifica se todos os radios obrigatórios estão marcados
        const radioGroups = new Set();
        document.querySelectorAll('input[type="radio"][required]').forEach(radio => {
            radioGroups.add(radio.name);
        });

        for (const group of radioGroups) {
            if (!document.querySelector(`input[name="${group}"]:checked`)) {
                alert('Por favor, responda todas as perguntas antes de enviar.');
                e.preventDefault();
                return;
            }
        }

        // Mostra o modal e permite o envio
        loadingModal.classList.remove('hidden');
        submitButton.disabled = true;

        // Não usamos preventDefault() para permitir o envio normal
    });


    window.onload = function () {
        loadingModal.classList.add('hidden');
        submitButton.disabled = false;
    };
});
