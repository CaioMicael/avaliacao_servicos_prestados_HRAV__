<?php

require_once "estClassConexaoBD.php";

Class estClassQuery {
    private $conexaoBD;
    private $sql;
    private $lastQuery;
    private $quantidadeLinhas;

    public function __construct($bd) {
        $this->conexaoBD = $bd;
    }

    public function Open() {
        $this->lastQuery = pg_query($this->conexaoBD->getInternalConnection(), $this->sql);
        if($this->lastQuery) {
            $this->setQuantidadeLinhas(pg_num_rows($this->lastQuery));
            return true;
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
}

?>