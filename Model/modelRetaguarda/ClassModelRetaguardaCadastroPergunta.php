<?php

require_once "../../lib/estClassRequestBase.php";
require_once '../../lib/estClassQuery.php';

class ClassModelRetaguardaCadastroPergunta extends estClassQuery {
    private $textoPergunta;


    public function processaFormInclusao() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (estClassRequestBase::post("texto_pergunta")) {
                $this->setTextoPergunta($_REQUEST["texto_pergunta"]);
                $this->inserePerguntaCadastrada();
            }
        }
    }


    private function inserePerguntaCadastrada() {
        $this->setSql(
            "INSERT INTO tbperguntas
            VALUES (DEFAULT, $1,$2);"
        );
        $aDados = array ();
        array_push($aDados, $this->textoPergunta, 1);
        $this->insertAll($aDados);
    }


    private function setTextoPergunta($texto) {
        $this->textoPergunta = $texto;
    }
}

$modelCadastroPergunta = new ClassModelRetaguardaCadastroPergunta();
$modelCadastroPergunta->processaFormInclusao();
header("Location: ../../View/ViewManutencaoRetaguarda/ClassViewManutencaoHomeRetaguarda.php");
exit;

?>