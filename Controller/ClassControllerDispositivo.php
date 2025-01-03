<?php

require_once "../lib/estClassRequestBase.php";
require_once "../Model/ClassModelDispositivo.php";

/**
 * Classe Controller usada para
 * fazer a comunicação entre
 * view -> controller -> model
 * além de receber requisições post e get.
 * 
 * @author Caio Micael Krieger
 */
class ClassControllerDispositivo {
    private $dispositivo;
    private $model;


    public function __construct() {
        $this->model = new ClassModelDispositivo;
    }


    /**
     * Este método retorna as informações do 
     * dispositivo carregadas pelo modelDispositivo.
     * 
     * @return array
     */
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