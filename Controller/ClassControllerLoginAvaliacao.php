<?php

require_once "../lib/estClassRequestBase.php";
require_once "../Model/ClassModelLoginAvaliacao.php";

class ClassControllerLoginAvaliacao {
    private $usucodigo;
    private $ususenha;
    private $model;

    public function __construct()   {
        $this->model = new ClassModelLoginAvaliacao();
    }

    public function processaLogin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (estClassRequestBase::post("codigo_usuario")) {
                $this->setUsuario($_REQUEST["codigo_usuario"]);
            }
            if (estClassRequestBase::post("senha")) {
                $this->setSenha($_REQUEST["senha"]);
            }
            $this->isLoginValido();
        }
    }

    private function isLoginValido() {
        if ($this->model->verificaLogin($this->getUsuario(),$this->getSenha())) {
            header("Location: ../View/ClassViewManutencaoDispositivo.php");
            exit;
        }
        else {
            echo "Senha ou usuário inválidos";
        }
    }

    private function getUsuario() {
        return $this->usucodigo;
    }

    private function getSenha() {
        return $this->ususenha;
    }

    private function setUsuario($usuario) {
        $this->usucodigo = $usuario;
    }

    private function setSenha($senha) {
        $this->ususenha = $senha;
    }
}

$loginForm = new ClassControllerLoginAvaliacao();
$loginForm->processaLogin();

?>