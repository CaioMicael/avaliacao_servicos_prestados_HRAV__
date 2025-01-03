<?php

require_once "../lib/estClassRequestBase.php";
require_once "../Model/ClassModelLoginAvaliacao.php";

/**
 * Classe Controller usada para
 * fazer a comunicação entre
 * view -> controller -> model
 * além de receber requisições post e get.
 * 
 * @author Caio Micael Krieger
 */
class ClassControllerLoginAvaliacao {
    private $usucodigo;
    private $ususenha;
    private $model;

    public function __construct()   {
        $this->model = new ClassModelLoginAvaliacao();
    }


    /**
     * Este método realiza a trativa dos 
     * dados vindo da requisição POST de login
     * para depois enviar ao model.
     * 
     */
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


    /**
     * Este método recebe o retorno do 
     * model se o login é válido ou não, se
     * for, redireciona para a tela de avaliação,
     * caso contrário emite mensagem.
     * 
     */
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