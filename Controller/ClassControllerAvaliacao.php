<?php

require_once '../Model/ClassModelAvaliacao.php';
require_once '../View/ClassViewManutencaoAvaliacao.php';

class ClassControllerAvaliacao {
    private $model;
    public $avaliacao;
    public $dispositivo;
    public $pergunta;
    public $feedbackTexto;

    public function __construct() {
        $this -> model = new ClassModelAvaliacao();
        //$avaliacaoForm = new ClassControllerAvaliacao();
        //$this -> getTextoPergunta();
    }

    public function processaAvaliacao() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['avaliacao'])) {
                $this -> setAvaliacao($_POST['avaliacao']);
            }
            if (isset($_POST['id_pergunta'])) {
                $this -> setPergunta($_POST['id_pergunta']);
            }
            if (isset($_POST['texto'])) {
                $this -> setFeedback($_POST['texto']);
            }
            $this -> enviaResultadoAvaliacao();
        }
    }

    public function enviaResultadoAvaliacao() {
        $this -> model -> insereAvaliacao($this -> getPergunta() , $this -> getAvaliacao() , $this -> getFeedback());
    }

    public function getTextoPergunta() {
        return $aDados = $this -> model -> getTextoPerguntaModel();
    }

    public function getAvaliacao() {
        return $this -> avaliacao;
    }

    public function getDispositivo() {
        return $this -> dispositivo;
    }

    public function getPergunta() {
        return $this -> pergunta;
    }

    public function getFeedback() {
        return $this -> feedbackTexto;
    }

    public function setAvaliacao($avaliacao) {
        $this -> avaliacao = $avaliacao;
    }

    public function setDispositivo($dispositivo) {
        $this -> dispositivo = $dispositivo;
    }

    public function setPergunta($pergunta) {
        $this -> pergunta = $pergunta;
    }

    public function setFeedback($feedbackTexto) {
        $this -> feedbackTexto = $feedbackTexto;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $avaliacaoForm = new ClassControllerAvaliacao();   
    $avaliacaoForm -> processaAvaliacao();
}
?>