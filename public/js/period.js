  document.addEventListener("DOMContentLoaded", function() {
            const meses = [
                "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
                "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ];

            const mesSelect = document.getElementById("mes");
            const anoSelect = document.getElementById("ano");

            // Preencher o select de meses
            meses.forEach((mes, index) => {
                const option = document.createElement("option");
                option.value = index + 1; // Os valores vão de 1 a 12
                option.textContent = mes;
                mesSelect.appendChild(option);
            });

            // Preencher o select de anos (próximos 5 anos)
            const anoAtual = new Date().getFullYear();
            for (let i = 0; i < 5; i++) {
                const option = document.createElement("option");
                option.value = anoAtual + i;
                option.textContent = anoAtual + i;
                anoSelect.appendChild(option);
            }
        });
