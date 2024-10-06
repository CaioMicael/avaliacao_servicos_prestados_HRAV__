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
        updateContent('Cadastrar Perguntas', 'Aqui você pode cadastrar suas perguntas.');
    });

    document.getElementById('visualizar-avaliacoes').addEventListener('click', function(event) {
        event.preventDefault();
        closeAllSubmenus();
        setActiveLink(this);
        updateContent('Visualizar Avaliações', 'Aqui você pode visualizar as avaliações realizadas.');
    });

    // Função para atualizar o conteúdo principal
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
