function generateTextareas(classificacaoId) {
    const comentariosAdicionais = document.getElementById(`qtdCmtAdicClassi_${classificacaoId}`).value;
    const container = document.getElementById(`textareaContainer_${classificacaoId}`);
    container.innerHTML = '';

    for (let i = 0; i < comentariosAdicionais; i++) {

        const label = document.createElement('label');
        label.htmlFor = `comentario_${classificacaoId}_${i}`;
        label.className = 'block mt-2 text-sm font-medium text-gray-700';
        label.textContent = `Comentário ${i + 1}`;


        const textarea = document.createElement('textarea');
        textarea.id = `comentario_${classificacaoId}_${i}`;
        textarea.name = `comentarios[${classificacaoId}][${i}]`;
        textarea.cols = 30;
        textarea.rows = 3;
        textarea.maxLength = 200;
        textarea.style.resize = 'none';
        textarea.placeholder = 'Digite seu comentário em 200 caracteres...';
        textarea.className = 'w-full p-2 mb-2 border border-gray-300 rounded';


        container.appendChild(label);
        container.appendChild(textarea);
    }
}

