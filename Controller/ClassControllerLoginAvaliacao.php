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
                estClassRequestBase::set("codigo_usuario",$this->getUsuario());
            }
            if (estClassRequestBase::post("senha")) {
                estClassRequestBase::set("senha",$this->getSenha());
            }
            $this->isLoginValido();
        }
    }

    private function isLoginValido() {
        if ($this->model->verificaLogin($this->getUsuario(),$this->getSenha())) {
            //redireciona a pagina
            echo "login feito com sucesso!";
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