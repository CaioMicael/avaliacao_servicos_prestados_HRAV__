<?php

require_once "../../lib/estClassRequestBase.php";
require_once '../../lib/estClassQuery.php';

class ClassModelRetaguardaCadastroDispositivo extends estClassQuery {
    private $idSetor;
    private $nomeDispositivo;


    public function processaFormInclusao() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ((estClassRequestBase::post("idSetor")) && (estClassRequestBase::post("nomeDispositivo"))) {
                $this->setIDSetor($_REQUEST["idSetor"]);
                $this->setNomeDispositivo($_REQUEST["nomeDispositivo"]);
                $this->insereDispositivoCadastrado();
            }
        }
    }


    private function insereDispositivoCadastrado() {
        $this->setSql(
            "INSERT INTO tbdispositivos
             VALUES (DEFAULT, $1, $2, $3);"
        );
        $aDados = array();
        array_push($aDados, $this->idSetor, $this->nomeDispositivo, 1);
        $this->insertAll($aDados);
    }


    private function setIDSetor($setor) {
        $this->idSetor = $setor;
    }


    private function setNomeDispositivo($nome) {
        $this->nomeDispositivo = $nome;
    }
}

$modelCadastroSetor = new ClassModelRetaguardaCadastroDispositivo;
$modelCadastroSetor->processaFormInclusao();
header("Location: ../../View/ViewManutencaoRetaguarda/ClassViewManutencaoHomeRetaguarda.php");
exit;

?>