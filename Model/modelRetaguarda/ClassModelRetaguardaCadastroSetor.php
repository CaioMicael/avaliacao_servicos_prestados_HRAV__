<?php

require_once "../../lib/estClassRequestBase.php";
require_once '../../lib/estClassQuery.php';

class ClassModelRetaguardaCadastroSetor extends estClassQuery {
    private $nomeSetor;


    public function processaFormInclusao() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (estClassRequestBase::post("nomeSetor")) {
                $this->setNomeSetor($_REQUEST["nomeSetor"]);
                $this->insereSetorCadastrado();
            }
        }
    }


    private function insereSetorCadastrado() {
        $this->setSql(
            "INSERT INTO tbsetor
             VALUES (DEFAULT, $1);"
        );
        $aDados = array();
        array_push($aDados,$this->nomeSetor);
        $this->insertAll($aDados);
    }


    private function setNomeSetor($nome) {
        $this->nomeSetor = $nome;
    }
}

$modelCadastroSetor = new ClassModelRetaguardaCadastroSetor;
$modelCadastroSetor->processaFormInclusao();
header("Location: ../../View/ViewManutencaoRetaguarda/ClassViewManutencaoHomeRetaguarda.php");
exit;

?>