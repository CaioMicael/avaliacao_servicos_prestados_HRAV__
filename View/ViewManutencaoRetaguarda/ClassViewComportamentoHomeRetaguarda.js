document.addEventListener('DOMContentLoaded', function() {

    // Função para fechar todos os submenus
    function closeAllSubmenus() {
        document.querySelectorAll('.nav-item').forEach(item => {
            item.classList.remove('active');
        });
    }

    // Adicionar evento de clique nas opções de navegação
    document.querySelectorAll('.navbar .nav-item > .nav-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evita o comportamento padrão do link

            const parent = this.parentElement;
            const isActive = parent.classList.contains('active');

            // Fechar todos os submenus
            closeAllSubmenus();

            // Se o item não estava ativo, ativá-lo
            if (!isActive) {
                parent.classList.add('active');
            }
        });
    });

    // Adicionar evento de clique nas opções do submenu
    document.getElementById('cadastrar-perguntas').addEventListener('click', function(event) {
        event.preventDefault();
        closeAllSubmenus();
        setActiveLink(this);
        updateContent('Cadastrar Perguntas', 'Aqui você pode cadastrar as perguntas desejadas para que apareçam nos dispositivos!');
        doAjaxCarregaPergunta()
            .then(resposta => {
                criarTabela({
                    colunas: [
                        'Código Pergunta' , 'Descrição' , 'Status'
                    ],
                    tituloTabela: "Perguntas cadastradas"
                },resposta);
            })
            .catch(error => {
                console.error("Erro ao carregar perguntas:", error);
            });
        criarFormulario({
            action: "../../Model/modelRetaguarda/ClassModelRetaguardaCadastroPergunta.php",
            method: "POST",
            inputs: [
                {type: "text" , name: "texto_pergunta" , placeholder: "Digite a pergunta" , required: true}
            ],
            buttonText: "Confirmar"
        });
    });

    
    document.getElementById('cadastrar-dispositivo').addEventListener('click', function(event) {
        event.preventDefault();
        closeAllSubmenus();
        setActiveLink(this);
        updateContent('Cadastrar Dispositivos', 'Aqui você pode cadastrar novos dispositivos!');
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
            action: "../../Model/modelRetaguarda/ClassModelRetaguardaCadastroDispositivo.php",
            method: "POST",
            inputs: [
                {type:"number" , name: "idSetor" , placeholder: "ID do setor" , required: true},
                {type:"text" , name: "nomeDispositivo" , placeholder: "De um nome ao dispositivo" , required: true}
            ],
            buttonText: "Confirmar"
        })
    });


    document.getElementById('cadastrar-setor').addEventListener('click', function(event) {
        event.preventDefault();
        closeAllSubmenus();
        setActiveLink(this);
        updateContent('Cadastrar Setores', 'Aqui você pode cadastrar novos setores!');
        doAjaxCarregaSetores()
            .then(resposta => {
                criarTabela({
                    colunas: [
                                'Nome do Setor'
                            ],
                    tituloTabela: "Setores Cadastrados"
                        },resposta);
            })
            .catch(error => {
                console.error("Erro ao carregar setores: ", error);
            });
        criarFormulario({
            action: "../../Model/modelRetaguarda/ClassModelRetaguardaCadastroSetor.php",
            method: "POST",
            inputs: [
                {type:"text" , name: "nomeSetor" , placeholder: "Nome do setor" , required: true}
            ],
            buttonText: "Confirmar"
        })
    });
    
    
    document.getElementById('visualizar-avaliacoes').addEventListener('click', function(event) {
        event.preventDefault();
        closeAllSubmenus();
        setActiveLink(this);
        updateContent('Visualizar Avaliações', 'Aqui você pode visualizar as avaliações realizadas.');
    });


    function updateContent(title, description) {
        const mainContent = document.getElementById('main-content');
        mainContent.innerHTML = `
            <h1>${title}</h1>
            <p>${description}</p>
        `;
    }


    // Função para destacar a opção selecionada no submenu
    function setActiveLink(link) {
        // Remove a classe 'active' de todos os links da navegação
        document.querySelectorAll('.navbar a').forEach(a => {
            a.classList.remove('active');
        });

        // Adiciona a classe 'active' ao link clicado
        link.classList.add('active');
    }

    // Fechar submenus ao clicar fora da barra de navegação
    window.addEventListener('click', function(e) {
        if (!e.target.closest('.navbar')) { // Verifica se o clique não foi dentro da barra de navegação
            closeAllSubmenus();
        }
    });
});


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
            let tempCell           = document.createElement("td");
            tempCell.textContent   = subitem;
            tempCell.style.border  = "1px solid #ddd";
            tempCell.style.padding = "8px";
            row.appendChild(tempCell);
        })

        // Adicionar a linha no corpo da tabela
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
        input.style.marginBottom = "10px"; // Estilo básico

        formulario.appendChild(input);
    });

    const botaoEnvio = document.createElement("button");
    botaoEnvio.type = "submit";
    botaoEnvio.textContent = config.buttonText || "Enviar";
    botaoEnvio.style.marginTop = "10px";

    formulario.appendChild(botaoEnvio);

    document.body.appendChild(formulario);
};


function doAjaxCarregaPergunta() {
    return doAjaxCarrega("../../lib/estAjax/estClassAjaxPergunta.php");
};


function doAjaxCarregaDispositivos() {
    return doAjaxCarrega("../../lib/estAjax/estClassAjaxDispositivos.php");
};


function doAjaxCarregaSetores() {
    return doAjaxCarrega("../../lib/estAjax/estClassAjaxSetor.php");
}


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