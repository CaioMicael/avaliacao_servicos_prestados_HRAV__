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
</head>
<body>
    <div class="container">
        <form action="../Controller/ClassControllerLoginAvaliacao.php" method="post">
            <div id="label_usuario" class="label_login">
                <label> Código do Usuário <br>
                    <input type="number" name="codigo_usuario" id="codigo_usuario">
                </label>
            </div>

            <div id="label_senha" class="label_login">
                <label>Senha <br>
                    <input type="password" name="senha" id="senha">
                </label>
            </div>

            <button type="submit">Inicial Sessão</button>
        </form>
    </div>
</body>
</html>