<?php

require_once "estClassConexaoBD.php";

Class estClassQuery {
    private $conexaoBD;
    protected $sql;
    protected $lastQuery;
    protected $quantidadeLinhas;

    public function __construct() {
        $this->conexaoBD = new estClassConexaoBD();
    }

    public function Open() {
        if ($this->conexaoBD->conectaDB()) {
            $this->lastQuery = pg_query($this->conexaoBD->getInternalConnection(), $this->sql);
            if($this->lastQuery) {
                $this->setQuantidadeLinhas(pg_num_rows($this->lastQuery));
            }
        }
    }

    protected function openFetchAll() {
        $this->conexaoBD->conectaDB();
        $result = pg_query($this->conexaoBD->getInternalConnection(), $this->sql);
        if ($result) {
            $rows = pg_fetch_all($result);
            return $rows;
        }
        else {
            return 'Dados não encontrados!';
        }
    }


    protected function insertAll($aDados) {
        try {
            $this->conexaoBD->conectaDB();
            pg_query_params($this->conexaoBD->getInternalConnection() , $this->sql,$aDados);
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function getNextRow() {
        return pg_fetch_assoc($this->lastQuery);
    }

    public function getSql() {
        return $this->sql;
    }

    public function getQuantidadeLinhas() {
        return $this->quantidadeLinhas;
    }

    public function setSql($sql) {
        $this->sql = $sql;
    }

    public function setQuantidadeLinhas($qtde) {
        $this->quantidadeLinhas = $qtde;
    }

    private function setLastQuery($last) {
        $this->lastQuery = $last;
    }
}

?>