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
                criarTabelaPergunta(resposta);
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
        updateContent('Cadastrar Dispositivos', 'Aqui você pode cadastrar novos dispositivos.');
        criarTabela({
            colunas: [
                        'coluna1','coluna2','coluna3'
                    ]
                },[10,2])
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


    function criarTabela(config,dados) {
        if (!Array.isArray(dados)) {
            console.error("Erro: o argumento `dados` não é um array válido:", dados);
            return;
        }

        const tabela = document.createElement("table");
        tabela.style.borderCollapse = "collapse";
        tabela.style.width = "100%";
        tabela.style.border = "1px solid #ddd";
    
        const thead = document.createElement("thead");
        const headerRow = document.createElement("tr");

        config.colunas.forEach(coluna => {
            const th = document.createElement("th");
            th.textContent = coluna;
            th.style.border = "1px solid #ddd";
            th.style.padding = "8px";
            th.style.textAlign = "left";
            th.style.backgroundColor = "#f2f2f2";
            headerRow.appendChild(th);
        });

        thead.appendChild(headerRow);
        tabela.appendChild(thead);

        const tbody = document.createElement("tbody");

        // Iterar sobre os dados e adicionar linhas na tabela
        dados.forEach(item => {
            const row = document.createElement("tr");
    
            // Adicionar células para ID, Pergunta e Status
            const cellId = document.createElement("td");
            cellId.textContent = item.id_pergunta;
            cellId.style.border = "1px solid #ddd";
            cellId.style.padding = "8px";
    
            const cellPergunta = document.createElement("td");
            cellPergunta.textContent = item.texto_pergunta;
            cellPergunta.style.border = "1px solid #ddd";
            cellPergunta.style.padding = "8px";
    
            const cellStatus = document.createElement("td");
            cellStatus.textContent = item.status === "1" ? "Ativo" : "Inativo";  // Exemplo de mapeamento de status
            cellStatus.style.border = "1px solid #ddd";
            cellStatus.style.padding = "8px";
    
            // Adicionar as células na linha
            row.appendChild(cellId);
            row.appendChild(cellPergunta);
            row.appendChild(cellStatus);
    
            // Adicionar a linha no corpo da tabela
            tbody.appendChild(row);
        });
    
        tabela.appendChild(tbody);
    
        // Adicionar a tabela ao corpo do documento
        document.body.appendChild(tabela);
    }


    function criarTabelaPergunta(dados) {
        // Verifica se `dados` é um array
        if (!Array.isArray(dados)) {
            console.error("Erro: o argumento `dados` não é um array válido:", dados);
            return;
        }
    
        // Criar a tabela e o cabeçalho
        const tabela = document.createElement("table");
        tabela.style.borderCollapse = "collapse";
        tabela.style.width = "100%";
        tabela.style.border = "1px solid #ddd";
    
        const thead = document.createElement("thead");
        const headerRow = document.createElement("tr");
    
        // Criar cabeçalhos
        const colunas = ["ID", "Pergunta", "Status"];
        colunas.forEach(coluna => {
            const th = document.createElement("th");
            th.textContent = coluna;
            th.style.border = "1px solid #ddd";
            th.style.padding = "8px";
            th.style.textAlign = "left";
            th.style.backgroundColor = "#f2f2f2";
            headerRow.appendChild(th);
        });
    
        thead.appendChild(headerRow);
        tabela.appendChild(thead);
    
        // Criar o corpo da tabela
        const tbody = document.createElement("tbody");
    
        // Iterar sobre os dados e adicionar linhas na tabela
        dados.forEach(item => {
            const row = document.createElement("tr");
    
            // Adicionar células para ID, Pergunta e Status
            const cellId = document.createElement("td");
            cellId.textContent = item.id_pergunta;
            cellId.style.border = "1px solid #ddd";
            cellId.style.padding = "8px";
    
            const cellPergunta = document.createElement("td");
            cellPergunta.textContent = item.texto_pergunta;
            cellPergunta.style.border = "1px solid #ddd";
            cellPergunta.style.padding = "8px";
    
            const cellStatus = document.createElement("td");
            cellStatus.textContent = item.status === "1" ? "Ativo" : "Inativo";  // Exemplo de mapeamento de status
            cellStatus.style.border = "1px solid #ddd";
            cellStatus.style.padding = "8px";
    
            // Adicionar as células na linha
            row.appendChild(cellId);
            row.appendChild(cellPergunta);
            row.appendChild(cellStatus);
    
            // Adicionar a linha no corpo da tabela
            tbody.appendChild(row);
        });
    
        tabela.appendChild(tbody);
    
        // Adicionar a tabela ao corpo do documento
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


function doAjaxCarregaPergunta() {
    return new Promise((resolve, reject) => {
        let xmlhttp = new XMLHttpRequest();
        const method = "GET";
        const url = "../../lib/estAjax/estClassAjaxPergunta.php";
        
        xmlhttp.onreadystatechange = () => {
            if (xmlhttp.readyState === XMLHttpRequest.DONE) {
                const status = xmlhttp.status;
                if (status === 200) {
                    const resposta = JSON.parse(xmlhttp.response);
                    resolve(resposta);
                } else {
                    reject("Erro ao tentar carregar perguntas!");
                }
            }
        };
        
        xmlhttp.open(method, url, true);
        xmlhttp.send();
    });
};


function doAjaxCarregaDispositivos() {
    return new Promise((resolve, reject) => {
        let xmlhttp  = new XMLHttpRequest();
        const method = "GET";
        const url    = "../../lib/estAjax/estClassAjaxSetor.php";
        
        xmlhttp.onreadystatechange = () => {
            if (xmlhttp.readyState === XMLHttpRequest.DONE) {
                const status = xmlhttp.status;
                if (status === 200) {
                    const resposta = JSON.parse(xmlhttp.response);
                    resolve(resposta);
                } else {
                    reject("Erro ao tentar carregar perguntas!");
                }
            }
        };
        
        xmlhttp.open(method, url, true);
        xmlhttp.send();
    });
};