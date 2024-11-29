<?php

require_once "../../lib/estClassRequestBase.php";
require_once '../../lib/estClassQuery.php';

class ClassModelRetaguardaCadastroPergunta extends estClassQuery {
    private $idPergunta;
    private $textoPergunta;
    private $status;


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
        $aDados = array();
        array_push($aDados, $this->textoPergunta, 1);
        $this->insertAll($aDados);
    }


    public function alteraStatusPergunta() {
        if ($this->consultaStatusPergunta($this->idPergunta) == 1) {
            $this->setSql(
                "UPDATE tbperguntas
                    SET status = 0
                  WHERE id_pergunta = $1;"
            );
            $aDados = array();
            array_push($aDados,$this->idPergunta);
            $this->insertAll($aDados);
        }else {
            $this->setSql(
                "UPDATE tbperguntas
                    SET status = 1
                  WHERE id_pergunta = $1;"
            );
            $aDados = array();
            array_push($aDados,$this->idPergunta);
            $this->insertAll($aDados);
        }
    }


    private function consultaStatusPergunta($id) {
        $this->setSql(
            "SELECT status
               FROM tbperguntas
              WHERE id_pergunta = $id;"
        );
        $this->Open();
        $result = $this->getNextRow();
        foreach($result as $r) {
            $this->setStatus($r);
            echo $r;
        }
        return $this->status;
    }


    private function setTextoPergunta($texto) {
        $this->textoPergunta = $texto;
    }


    public function setIDPergunta($id) {
        $this->idPergunta = $id;
    }


    private function setStatus($status) {
        $this->status = $status;
    }
}

$modelCadastroPergunta = new ClassModelRetaguardaCadastroPergunta();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tipoFormulario'])) {
    $modelCadastroPergunta->setIDPergunta($_POST["idPergunta"]);
    $modelCadastroPergunta->alteraStatusPergunta();
    echo "erraddoo";
} else {
    $modelCadastroPergunta->processaFormInclusao();
}
header("Location: ../../View/ViewManutencaoRetaguarda/ClassViewManutencaoHomeRetaguarda.php");
exit;

?>