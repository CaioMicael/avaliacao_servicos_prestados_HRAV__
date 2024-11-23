<?php

require_once "../lib/estClassRequestBase.php";
require_once "../Model/ClassModelDispositivo.php";
require_once "../lib/estClassRequestBase.php";

class ClassControllerDispositivo {
    private $dispositivo;
    private $model;


    public function __construct() {
        $this->model = new ClassModelDispositivo;
    }


    public function getDispositivoFromModel() {
        return $this->model->getInfoDispositivos();
    }


    public function getDispositivo() {
        return $this->dispositivo;
    }


    public function setDispositivo($dispositivo) {
        $this->dispositivo = $dispositivo;
    }

    public function setDispositivoFromModel() {
        $this->dispositivo = $this->model->getInfoDispositivos();
    }
}

?>