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
        $this->setor = $result;
    }

}

$oSetor = new estClassAjaxSetor();
$oSetor->getSetor();

?>