<?php

require_once '../lib/estClassQuery.php';

class ClassModelLoginAvaliacao extends estClassQuery {
     private $situacaoLogin;

    public function verificaLogin($usucodigo,$ususenha) {
        $this->setSql("SELECT * 
                         FROM public.tbusuario 
                        WHERE usucodigo = $usucodigo 
                          AND ususenha = '$ususenha'");
        $this->Open();
        $this->setSituacaoLogin($this->getNextRow());
        if ($this->quantidadeLinhas == 1) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getSituacaoLogin() {
        return $this->situacaoLogin;
    }

    public function setSituacaoLogin($login) {
        $this->situacaoLogin = $login;
    }
}

?>