<?php

require_once "../lib/estClassRequestBase.php";
require_once '../Model/ClassModelAvaliacao.php';
require_once '../View/ClassViewManutencaoAvaliacao.php';

/**
 * Classe Controller usada para fazer
 * a comunicação entre view -> controller -> model
 * além de receber requisições post e get.
 * 
 * @author Caio Micael Krieger
 */
class ClassControllerAvaliacao {
    private $model;
    public $avaliacao;
    public $dispositivo;
    public $pergunta;
    public $feedbackTexto;

    public function __construct() {
        $this -> model = new ClassModelAvaliacao();
    }


    /**
     * Este método realiza a trativa dos 
     * dados vindo da requisição POST para
     * depois enviar ao model.
     * 
     */
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


    public function setDispositivoSelecionado() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (estClassRequestBase::get("dispositivo")) {
                $this->setDispositivo($_REQUEST['dispositivo']);
            }
        }
    }


    /**
     * Este método realiza o envio dos 
     * dados da avaliação para o model
     * inserir ao banco de dados.
     * 
     */
    public function enviaResultadoAvaliacao() {
        $this -> model -> insereAvaliacao($this->getPergunta(), $this->getDispositivo(),  $this->getAvaliacao() , $this->getFeedback());
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
    $avaliacaoForm->processaAvaliacao();
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $avaliacaoForm = new ClassControllerAvaliacao(); 
    $avaliacaoForm->setDispositivoSelecionado();
}
?>