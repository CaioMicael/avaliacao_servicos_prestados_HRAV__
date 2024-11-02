<?php

class estClassConexaoBD {
    private $host;
    private $porta;
    private $user;
    private $password;
    private $database;
    private $internalConnection;

    public function __construct()   {
        $this->setPorta(5432);
        $this->setHost('localhost');
        $this->setUser('postgres');
        $this->setPassword('postgres');
        $this->setDatabase("avaliacao");
    }

    private function getConnectionString() {
        return "host= "      . $this->getHost() . 
               " port= "     . $this->getPorta() . 
               " user= "     . $this->getUser() . 
               " password= " . $this->getPassword() .
               " dbname= "   . $this->getDatabase();
    }

    public function conectaDB() {
        try {
            $this -> internalConnection = pg_connect($this->getConnectionString());
            if ($this->internalConnection) {
                return true;
            }
        } catch (\Throwable $e) {
            return false;
        }

    }

    public function getHost() {
        return $this->host;
    }

    public function getPorta() {
        return $this->porta;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function getInternalConnection() {
        return $this->internalConnection;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setPorta($porta) {
        $this->porta = $porta;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($pass) {
        $this->password = $pass;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

}

?>