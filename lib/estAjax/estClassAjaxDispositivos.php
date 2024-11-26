<?php

require_once '../estClassQuery.php';
require_once '../../Model/ClassModelDispositivo.php';

class estClassAjaxDispositivos extends estClassQuery {
    private $dispositivo;
    private $model;


    public function __construct() {
        $this->model = new ClassModelDispositivo;
    }

    public function getDispositivo() {
        return $this->model->getInfoDispositivos();
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