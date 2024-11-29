//var obDispositivos = JSON.parse(document.getElementById('data').getAttribute('data-array'));
//
//var ul = document.getElementById("listaDispositivo");
//
//obDispositivos.forEach((dispositivo) => {
//    let li = document.createElement("li");
//    let label = document.createElement("label");
//    label.innerHTML = '<input type="radio" name="dispositivo" value="dispositivo"> ' +
//                        `${typeof dispositivo === 'object' ? JSON.stringify(dispositivo) : dispositivo}`;
//
//    li.appendChild(label);
//    ul.appendChild(li);
//});

doAjaxCarregaDispositivos()
    .then(resposta => {
        criarTabela({
            colunas: [
                        'ID Dispositivo','Setor','Nome do Dispositivo'
                    ],
            tituloTabela: "Dispositivos Cadastrados"
                },resposta);
    })
    .catch(error => {
        console.error("Erro ao carregar dispositivos: ", error);
    });
    criarFormulario({
        action: "../Controller/ClassControllerAvaliacao.php",
        method: "GET",
        inputs: [
            {type: "number" , name: "dispositivo" , placeholder: "Código do Dispositivo" , required: true},
            {type: "hidden" , name: "tipoFormulario" , value: "setarDispositivo"}
        ],
        buttonText: "Confirmar"
    })


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


function doAjaxCarregaDispositivos() {
    return doAjaxCarrega("../lib/estAjax/estClassAjaxDispositivos.php");
};


function doAjaxCarrega(caminho) {
    return new Promise((resolve, reject) => {
        let xmlhttp  = new XMLHttpRequest();
        const method = "GET";
        const url    = caminho;
        
        xmlhttp.onreadystatechange = () => {
            if (xmlhttp.readyState === XMLHttpRequest.DONE) {
                const status = xmlhttp.status;
                if (status === 200) {
                    const resposta = JSON.parse(xmlhttp.response);
                    resolve(resposta);
                } else {
                    reject("Erro ao tentar carregar os dados!");
                }
            }
        };
        
        xmlhttp.open(method, url, true);
        xmlhttp.send();
    });
}