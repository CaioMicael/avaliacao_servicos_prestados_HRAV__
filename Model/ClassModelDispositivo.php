<?php

require_once '../lib/estClassQuery.php';

class ClassModelDispositivo extends estClassQuery {

    private $dispositivo;
    private $setor;
    private $nomeDispositivo;
    private $status;
    private $infoDispositivos;


    public function getInfoDispositivos() {
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
        $this->setInfoDispositivos($result);
        return $this->infoDispositivos;
    }


    private function getDispositivo() {
        return $this->dispositivo;
    }


    private function getSetor() {
        return $this->setor;
    }


    private function getNomeDispositivo() {
        return $this->nomeDispositivo;
    }


    private function getStatus() {
        return $this->status;
    }


    private function setDispositivo($dispositivo) {
        $this->dispositivo = $dispositivo;
    }


    private function setSetor($setor) {
        $this->setor = $setor;
    }


    private function setNomeDispositivo($nomeDispositivo) {
        $this->nomeDispositivo = $nomeDispositivo;
    }  
    
    
    private function setStatus($status) {
        $this->status = $status;
    }   

    private function setInfoDispositivos($infos) {
        $this->infoDispositivos = $infos;
    }

}

?>