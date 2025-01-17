<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de retaguarda</title>
    <link rel="stylesheet" href="../../public/styles/styleClassViewManutencaoHomeRetaguarda.css">
    <script src="ClassViewComportamentoHomeRetaguarda.js" defer></script>
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item" id="cadastro-nav">
                <a href="#" class="nav-link">Cadastro &#9662;</a>
                <ul class="submenu">
                    <li><a href="#" id="cadastrar-perguntas">Cadastrar Perguntas</a></li>
                    <li><a href="#" id="cadastrar-dispositivo">Cadastrar Dispositivos</a></li>
                    <li><a href="#" id="cadastrar-setor">Cadastrar Setores</a></li>
                </ul>
            </li>
            <li class="nav-item" id="consulta-nav">
                <a href="#" class="nav-link">Manutenção &#9662;</a>
                <ul class="submenu">
                    <li><a href="#" id="manutencao-perguntas">Ativar/Desativar perguntas</a></li>
                    <li><a href="#" id="manutencao-dispositivos">Ativar/Desativar dispositivos</a></li>
                </ul>
            </li>
            <li class="nav-item" id="consulta-nav">
                <a href="#" class="nav-link">Consulta &#9662;</a>
                <ul class="submenu">
                    <li><a href="../ViewManutencaoRetaguarda/ClassViewBIAvaliacao.html" id="visualizar-avaliacoes">Visualizar Avaliações</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="main-content" id="main-content">
        <h1>Bem-vindo ao Sistema de Retaguarda</h1>
        <p>Utilize a barra de navegação para acessar as opções de Cadastro, manutenção e consulta.</p>
    </div>
</body>
</html>