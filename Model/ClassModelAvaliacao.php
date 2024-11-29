<?php

require_once '../lib/estClassQuery.php';

class ClassModelAvaliacao extends estClassQuery {
    private $dataAvaliacao;
    private $idPergunta;
    private $textoPergunta;
    private $statusPergunta;
    private $info_con = "host= localhost port = 5432 dbname= avaliacao user= postgres password= postgres";

    public function insereAvaliacao($idPergunta , $dispositivo , $valorAvaliacao , $texto) {
        try {
            $conexao = pg_connect($this -> info_con);
            $aDados  = array(1,$idPergunta,$dispositivo,$valorAvaliacao,$texto);
            pg_query_params($conexao , "INSERT INTO tbavaliacao (id_setor , id_pergunta , id_dispositivo , resposta , feedback_textual) 
                                            VALUES ($1, $2, $3, $4, $5)",$aDados);
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function getMediaPorSetor() {
        $this->setSql(
            "SELECT nome_setor,ROUND(AVG(resposta),2) AS media
              FROM tbavaliacao
              JOIN tbsetor
             USING (id_setor)
          GROUP BY 1
          ORDER BY 2 DESC"
        );
        $result = $this->openFetchAll();
        return $result;
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

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['mediaSetor'])) {  
    $mediaPorSetor = new ClassModelAvaliacao();
    $dados         = $mediaPorSetor->getMediaPorSetor();
    header('Content-Type: application/json');
    echo json_encode($dados);
}

?>  