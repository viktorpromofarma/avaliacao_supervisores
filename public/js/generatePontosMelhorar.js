function generatePontosMelhorar(inputId) {
    const quantidade = document.getElementById(inputId).value;
    const container = document.getElementById('pontosMelhorarContainer');
    container.innerHTML = ''; // Limpa o conteúdo anterior

    for (let i = 0; i < quantidade; i++) {
        const label = document.createElement('label');
        label.htmlFor = `pontoPositivo_${i}`;
        label.className = 'block mt-2 text-sm font-medium text-gray-700';
        label.textContent = `Ponto a melhorar ${i + 1}:`;

        const textarea = document.createElement('textarea');
        textarea.id = `pontoPositivo_${i}`;
        textarea.name = `pontosMelhorar[${i}]`;
        textarea.cols = 30;
        textarea.rows = 3;
        textarea.maxLength = 200;
        textarea.style.resize = 'none';
        textarea.placeholder = 'Descreva um ponto a melhorar...';
        textarea.className = 'w-full p-2 mb-2 border border-gray-300 rounded';

        container.appendChild(label);
        container.appendChild(textarea);
    }
}
