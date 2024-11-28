<?php

require_once "../../lib/estClassRequestBase.php";
require_once '../../lib/estClassQuery.php';

class ClassModelRetaguardaCadastroDispositivo extends estClassQuery {
    private $idDispositivo;
    private $idSetor;
    private $nomeDispositivo;
    private $status;


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


    public function alteraStatusDispositivo() {
        if ($this->consultaStatusDispositivo($this->idDispositivo) == 1) {
            $this->setSql(
                "UPDATE tbdispositivos
                    SET status = 0
                  WHERE id_dispositivo = $1;"
            );
            $aDados = array();
            array_push($aDados,$this->idDispositivo);
            $this->insertAll($aDados);
        }else {
            $this->setSql(
                "UPDATE tbdispositivos
                    SET status = 1
                  WHERE id_dispositivo = $1;"
            );
            $aDados = array();
            array_push($aDados,$this->idDispositivo);
            $this->insertAll($aDados);
        }
    }


    private function consultaStatusDispositivo($id) {
        $this->setSql(
            "SELECT status
               FROM tbdispositivos
              WHERE id_dispositivo = $id;"
        );
        $this->Open();
        $result = $this->getNextRow();
        foreach($result as $r) {
            $this->setStatus($r);
            echo $r;
        }
        return $this->status;
    }


    public function setIDSetor($setor) {
        $this->idSetor = $setor;
    }


    public function setIDDispositivo($dispositivo) {
        $this->idDispositivo = $dispositivo;
    }


    private function setNomeDispositivo($nome) {
        $this->nomeDispositivo = $nome;
    }


    public function setStatus($status) {
        $this->status = $status;
    }
}

$modelCadastroSetor = new ClassModelRetaguardaCadastroDispositivo;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['tipoFormulario'] == 'manutencaoDispositivo') {
    $modelCadastroSetor->setIDDispositivo($_POST["idDispositivo"]);
    $modelCadastroSetor->alteraStatusDispositivo();
} else {
    $modelCadastroSetor->processaFormInclusao();
}
header("Location: ../../View/ViewManutencaoRetaguarda/ClassViewManutencaoHomeRetaguarda.php");
exit;

?>