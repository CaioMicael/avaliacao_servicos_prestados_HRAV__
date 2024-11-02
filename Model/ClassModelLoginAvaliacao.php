<?php

require_once '../lib/estClassQuery.php';

class ClassModelLoginAvaliacao extends estClassQuery {

    public function verificaLogin($usucodigo,$ususenha) {
        $this->setSql("SELECT EXISTS(
                            SELECT * 
                              FROM public.tbusuario 
                             WHERE usucodigo = $usucodigo AND ususenha = '$ususenha')");
        $this->Open();
        return $this->lastQuery;
    }
}

?>