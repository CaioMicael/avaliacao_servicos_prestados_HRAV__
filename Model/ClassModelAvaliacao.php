<?php

require_once '../lib/estClassQuery.php';

/**
 * Classe model utilizada para fazer
 * a busca dos dados ao BD.
 * 
 * @author Caio Micael Krieger
 */
class ClassModelAvaliacao extends estClassQuery {


    /**
     * Este método realiza a inserção das avaliações do front end no banco
     * 
     * @param integer $idPergunta
     * @param integer $dispostivo
     * @param integer $valorAvaliacao
     * @param string $texto
     */
    public function insereAvaliacao($idPergunta , $dispositivo , $valorAvaliacao , $texto) {
        $this->setSql(
            "INSERT INTO tbavaliacao (id_setor , id_pergunta , id_dispositivo , resposta , feedback_textual) 
                  VALUES ($1, $2, $3, $4, $5);"
        );
        $aDados = array();
        array_push($aDados,1 , $idPergunta , $dispositivo , $valorAvaliacao , $texto);
        $this->insertAll($aDados);
    }


    /**
     * Este método realiza a busca da media por setor no banco de dados
     * 
     * @return array
     */
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


    /**
     * Este método realiza a busca das perguntas no banco de dados que devem aparecer no front end.
     * 
     * @return array
     */
    public function getTextoPerguntaModel() {
        $this->setSql(
            "SELECT id_pergunta,texto_pergunta FROM tbperguntas WHERE status = 1;"
        );
        $result = $this->openFetchAll();
        return $result;   
    }

}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_REQUEST['mediaSetor'])) {  
    $mediaPorSetor = new ClassModelAvaliacao();
    $dados         = $mediaPorSetor->getMediaPorSetor();
    header('Content-Type: application/json');
    echo json_encode($dados);
}

?>  