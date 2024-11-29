<?php

require_once '../estClassQuery.php';

class estClassAjaxDispositivos extends estClassQuery {
    private $dispositivo;
    private $model;


    public function getDispositivo() {
        //return $this->model->getInfoDispositivos();
        $this->setSql(
            "SELECT id_dispositivo,
                    nome_setor,
                    nome_dispositivo
               FROM tbdispositivos
               JOIN tbsetor
              USING (id_setor)
              WHERE status = 1;"
        );
        $result = $this->openFetchAll();
        $this->setDispositivo($result);
        return $this->dispositivo;
    }

    public function setDispositivo($dispositivo) {
        $this->dispositivo = $dispositivo;
    }

}

$oDispositivo = new estClassAjaxDispositivos();
$dados        = $oDispositivo->getDispositivo();
header('Content-Type: application/json');
echo json_encode($dados);

?>