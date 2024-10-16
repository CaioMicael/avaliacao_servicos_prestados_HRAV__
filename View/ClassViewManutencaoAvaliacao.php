<?php
    require_once '../Controller/ClassControllerAvaliacao.php';
    $controller = new ClassControllerAvaliacao();   
    $aTexto = $controller -> getTextoPergunta(); 
    echo "<div id='data' data-array='". json_encode($aTexto) ."'></div>";
    //notação: fazer com que ao enviar o formulário, abra na mesma página com a próxima pergunta.
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação Hospital Regional</title>
    <link rel="stylesheet" href="../public/styles/styleClassViewManutencaoAvaliacao.css" defer> 
    <script src="../View/ClassViewComportamentoAvaliacao.js" defer></script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<body>
    <form method="post" action="../Controller/ClassControllerAvaliacao.php" id="myform">
        <div class="pergunta">
            <p name="textoPergunta" id="textoPergunta"></p>
        </div>
        <div class="container">
            <label>
                <input type="radio" name="avaliacao" value="1">
                <div class="box red">
                    <img src="../public/imgs/emoji_5.png" width="100px">
                </div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="2">
                <div class="box red">
                    <img src="../public/imgs/emoji_4.png" width="100px">
                </div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="3">
                <div class="box orange-dark">
                    <img src="../public/imgs/emoji_3.png" width="100px">
                </div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="4">
                <div class="box orange">
                    <img src="../public/imgs/emoji_2.png" width="100px">
                </div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="5">
                <div class="box orange-light">
                    <img src="../public/imgs/emoji_1.png" width="100px">
                </div>
            </label>
<!--
            <label>
                <input type="radio" name="avaliacao" value="5">
                <div class="box yellow-dark">5</div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="6">
                <div class="box yellow">6</div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="7">
                <div class="box yellow-light">7</div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="8">
                <div class="box green-light">8</div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="9">
                <div class="box green">9</div>
            </label>

            <label>
                <input type="radio" name="avaliacao" value="10">
                <div class="box green-dark">10</div>
            </label> !-->
        </div>
        <div>
            <input type="text" name="texto" id="itexto">
        </div>

        <button type="submit" id="botaoSubmit">Enviar</button> 

    </form>

    <div class="footer">
        <img src="../public/imgs/pngAtencaoSimbolo.png" alt="Atenção" id="img_footer" >
        <footer>Sua avaliação espontânea é anônima, nenhuma informação pessoal é solicitada ou armazenada.</footer>
    </div>

</body>
</html>