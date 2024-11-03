<?php
require_once "../Controller/ClassControllerLoginAvaliacao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação HRAV</title>
    <link rel="stylesheet" href="../public/styles/styleClassViewManutencaoLoginAvaliacao.css">
    <script src="ClassViewComportamentoLoginAvaliacao.js" defer></script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script> 
</head>
<body>
    <div class="container">
        <img src="../public/imgs/logo-white.png" alt="Logo do Hospital Regional do Alto Vale" id="logoPaginaLogin">

         <form action="../Controller/ClassControllerLoginAvaliacao.php" class="formLogin" method="POST">

            <div id="label_usuario" class="label_login">
                <label> Código do Usuário <br>
                    <input type="number" name="codigo_usuario" id="codigo_usuario">
                </label>
            </div>

            <div id="label_senha" class="label_login">
                <label>Senha <br>
                    <input type="password" name="senha" id="senha">
                    <button id="mostrarSenha" type="button">Mostrar senha</button>
                </label>
            </div>

            <button type="submit" class="btn" id="botaoSubmit" disabled>Iniciar Sessão</button>
        </form>
    </div>
</body>
</html>