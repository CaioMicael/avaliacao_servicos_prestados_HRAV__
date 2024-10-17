<?php

class ClassModelAvaliacao {
    public $dataAvaliacao;
    public $idPergunta;
    public $textoPergunta;
    public $statusPergunta;
    public $info_con = "host= localhost port = 5432 dbname= avaliacao user= postgres password= postgres";

    public function insereAvaliacao($idPergunta , $valorAvaliacao , $texto) {
        try {
            $conexao = pg_connect($this -> info_con);
            $aDados  = array(1,$idPergunta,1,$valorAvaliacao,$texto);
            pg_query_params($conexao , "INSERT INTO tbavaliacao (id_setor , id_pergunta , id_dispositivo , resposta , feedback_textual) 
                                            VALUES ($1, $2, $3, $4, $5)",$aDados);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function geraException($exception) {
        echo "<div class=exceptionTratada>
                <p>Ocorreu uma execeção interna no sistema.</p>
                    <div class=exceptionBD>
                        <p id=exceptionBDdescricao>". $exception ."</p>
                    </div>
              </div>";
    }

    public function getTextoPerguntaModel() {
        $conexao = pg_connect($this -> info_con);
        $result = pg_query($conexao, "SELECT id_pergunta,texto_pergunta FROM tbperguntas WHERE status = 1");
        return pg_fetch_all($result);   
    }

    public function getDataAvaliacao() {
        return $this -> dataAvaliacao;
    }

    public function setDataAvaliacao($data) {
        $this -> dataAvaliacao = $data;
    }

}

?>