/**
 * Função utilizada para fechar todos os submenus.
 * 
 */
function closeAllSubmenus() {
    document.querySelectorAll('.nav-item').forEach(item => {
        item.classList.remove('active');
    });
}


/**
 * Função utilizada para fechar as tabelas abertas.
 * 
 */
function closeTables() {
    let tabela = document.getElementsByTagName("table");
    aTabela    = Array.from(tabela);
    aTabela.forEach(item => {
        item.remove();
    })
}


/**
 * Função utilizada para fechar os formulários em aberto.
 */
function closeForms() {
    let form = document.getElementsByTagName("form");
    aForm    = Array.from(form);
    aForm.forEach(item => {
        item.remove();
    })
}


/**
 * Função utilizada para mudar o <h1> e <p> da view.
 * title é o <h1> e description é o <p>.
 * @param {string} title 
 * @param {string} description 
 */
function updateContent(title, description) {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = `
        <h1>${title}</h1>
        <p>${description}</p>
    `;
}


/**
 * Função utilizada para criar uma tabela a view.
 * O parâmetro config deve ter tituloTabela e colunas.
 * 
 * @param {*} config 
 * @param {*} dados 
 */
function criarTabela(config,dados) {
    if (!Array.isArray(dados)) {
        console.error("Erro: o argumento `dados` não é um array válido:", dados);
        return;
    }

    const tabela      = document.createElement("table");
    const thead       = document.createElement("thead");
    const titleRow    = document.createElement("tr");
    const titleCell   = document.createElement("th");
    const headerTitle = config.tituloTabela;
    const headerRow   = document.createElement("tr");

    config.colunas.forEach(coluna => {
        const th = document.createElement("th");
        th.textContent = coluna;
        headerRow.appendChild(th);
    });

    titleCell.textContent = headerTitle;
    titleCell.colSpan = 3;
    titleCell.style.textAlign = "center";

    thead.appendChild(titleRow);
    titleRow.appendChild(titleCell)
    thead.appendChild(headerRow);
    tabela.appendChild(thead);

    const tbody = document.createElement("tbody");

    // Iterar sobre os dados e adicionar linhas na tabela
    dados.forEach(item => {
        const row = document.createElement("tr");
        Object.values(item).forEach(subitem => {
            let tempCell = document.createElement("td");
            if (Object.keys(item) == "status" && subitem == 1) {
                tempCell.textContent = "Ativo";
            }
            else if (Object.keys(item) == "status" && subitem == 0) {
                tempCell.textContent = "Inativo";
            }
            else {
                tempCell.textContent = subitem;
            }
            tempCell.style.border  = "1px solid #ddd";
            tempCell.style.padding = "8px";
            row.appendChild(tempCell);
        })

        tbody.appendChild(row);
    });

    tabela.appendChild(tbody);

    document.body.appendChild(tabela);
}


/**
 * Função utilizada para criação de um formulário na view
 * O parametro config deve conter um atributo "action" com o caminho de onde o formulário
 * deve ser enviado.
 * Deve ter um atributo "method" contendo o método do formulário (GET ou POST).
 * Deve ter um atributo "inputs" onde deve ser repassado os inputs desejados.
 * Deve ter um atributo "buttonText" contendo o texto que deve aparecer no botão.
 * 
 * @param {*} config 
 */
function criarFormulario(config) {
    if (!config || !config.action || !Array.isArray(config.inputs)) {
        console.error("Configuração inválida!");
        return;
    }

    const formulario = document.createElement("form");
    formulario.method = config.method || "POST"; 
    formulario.action = config.action; // A URL para onde o formulário será enviado

    // Cria os inputs com base no objeto de configuração
    config.inputs.forEach(inputConfig => {
        const input = document.createElement("input");
        input.type = inputConfig.type || "text"; // Tipo do input (padrão é "text")
        input.name = inputConfig.name || ""; // Nome do campo
        input.placeholder = inputConfig.placeholder || ""; // Placeholder (opcional)
        input.value = inputConfig.value || ""; // Valor inicial (opcional)
        input.required = inputConfig.required || false; // Definir se o campo é obrigatório

        formulario.appendChild(input);
    });

    const botaoEnvio = document.createElement("button");
    botaoEnvio.type = "submit";
    botaoEnvio.textContent = config.buttonText || "Enviar";
    botaoEnvio.style.marginTop = "10px";

    formulario.appendChild(botaoEnvio);

    document.body.appendChild(formulario);
};