<?php

require_once '../lib/estClassQuery.php';

/**
 * Classe model usada para validação
 * do login na plataforma.
 * 
 * @author Caio Micael Krieger
 */
class ClassModelLoginAvaliacao extends estClassQuery {
     private $situacaoLogin;


     /**
      * Este método verifica se as credenciais de
      * login e senha estão no banco de dados, se
      * estiverem corretas, retorna valor booleano
      * ao model.
      *
      * @param integer $usucodigo
      * @param string $ususenha
      * @return boolean
      */
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