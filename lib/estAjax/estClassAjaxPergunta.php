<?php

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
        $this->pergunta = $result;
    }

}

$oPergunta = new estClassAjaxPergunta();
$oPergunta->getPergunta();

?>