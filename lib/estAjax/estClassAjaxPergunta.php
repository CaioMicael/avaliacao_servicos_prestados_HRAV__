<?php

require_once '../estClassQuery.php';

class estClassAjaxPergunta extends estClassQuery {
    private $pergunta;

    public function getPergunta() {
        $this->setSql(
            "
            SELECT *
              FROM tbperguntas
            "
        );
        $result = $this->openFetchAll();
        $this->setPerguntas($result);
        return $this->pergunta;
    }

    public function setPerguntas($perguntas) {
        $this->pergunta = $perguntas;
    }

}

$oPergunta = new estClassAjaxPergunta();
$dados     = $oPergunta->getPergunta();
header('Content-Type: application/json');
echo json_encode($dados);

?>