document.addEventListener("DOMContentLoaded", function () {
    const multipleChoiceRadio = document.getElementById("Múltipla Escolha");
    const dissertativaRadio = document.getElementById("Dissertativa");
    const numChoicesInput = document.getElementById("num_choices");
    const form = document.querySelector("form"); // Certifique-se de que o formulário está correto

    // Container onde os inputs serão adicionados
    const choicesContainer = document.createElement("div");
    choicesContainer.id = "choices-container";
    choicesContainer.className = "grid grid-cols-1 gap-2 ";

    // Insere o container antes do input de Dissertativa
    dissertativaRadio.parentNode.parentNode.insertBefore(
        choicesContainer,
        dissertativaRadio.parentNode
    );

    function toggleNumberInput() {
        if (multipleChoiceRadio.checked) {
            numChoicesInput.classList.remove("hidden");
            numChoicesInput.setAttribute("required", "true");
        } else {
            numChoicesInput.classList.add("hidden");
            numChoicesInput.value = "";
            numChoicesInput.removeAttribute("required");
            choicesContainer.innerHTML = ""; // Remove os inputs ao mudar para Dissertativa
        }
    }

    function updateChoicesInputs() {
        const count = parseInt(numChoicesInput.value, 10) || 0;
        choicesContainer.innerHTML = ""; // Limpa os inputs antes de recriar

        for (let i = 1; i <= count; i++) {
            const div = document.createElement("div");
            div.className = "flex items-center gap-2 ";

            // Input resposta
            const respostaInput = document.createElement("input");
            respostaInput.type = "text";
            respostaInput.name = `respostas[]`;
            respostaInput.placeholder = `Resposta ${i}`;
            respostaInput.className = "w-full px-2 py-2 mt-2 border border-gray-300 rounded-md";
            respostaInput.style.marginTop = "12px"; // Adiciona margem superior

            respostaInput.required = true; // Adiciona required corretamente

            // Input nota
            const notaInput = document.createElement("input");
            notaInput.type = "number";
            notaInput.name = `notas[]`;
            notaInput.min = "0";
            notaInput.max = "10";
            notaInput.placeholder = `Nota ${i}`;
            notaInput.className = "px-2 px-4 py-2 border border-gray-300 rounded-md w-18 ";
            notaInput.style.marginTop = "12px"; // Adiciona margem superior


            notaInput.required = true; // Adiciona required corretamente

            div.appendChild(respostaInput);
            div.appendChild(notaInput);
            choicesContainer.appendChild(div);
        }
    }

    // Captura o envio do formulário para validar dinamicamente os inputs
    form.addEventListener("submit", function (event) {
        if (multipleChoiceRadio.checked) {
            const respostaInputs = choicesContainer.querySelectorAll(
                'input[name="respostas[]"]'
            );
            const notaInputs = choicesContainer.querySelectorAll(
                'input[name="notas[]"]'
            );

            let isValid = true;

            respostaInputs.forEach((input) => {
                if (!input.value.trim()) {
                    input.classList.add("border-red-500");
                    isValid = false;
                } else {
                    input.classList.remove("border-red-500");
                }
            });

            notaInputs.forEach((input) => {
                if (!input.value.trim()) {
                    input.classList.add("border-red-500");
                    isValid = false;
                } else {
                    input.classList.remove("border-red-500");
                }
            });

            if (!isValid) {
                event.preventDefault(); // Impede o envio se houver campos vazios
                alert(
                    "Preencha todos os campos de resposta e nota antes de continuar."
                );
            }
        }
    });

    multipleChoiceRadio.addEventListener("change", toggleNumberInput);
    dissertativaRadio.addEventListener("change", toggleNumberInput);
    numChoicesInput.addEventListener("input", updateChoicesInputs);
});
