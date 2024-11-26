<?php

class estClassAjaxSetor extends estClassQuery {
    private $setor;


    public function getSetor() {
        $this->setSql(
            "
            SELECT *
              FROM tbsetor
            "
        );
        $result = $this->openFetchAll();
        $this->setSetor($result);
        return $this->setor;
    }


    private function setSetor($setor) {
        $this->setor = $setor;
    }

}

$oSetor = new estClassAjaxSetor();
$dados  = $oSetor->getSetor();
header('Content-Type: application/json');
echo json_encode($dados);

?>