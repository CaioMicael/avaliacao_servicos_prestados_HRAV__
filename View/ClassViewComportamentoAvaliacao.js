var indice = 0;
var jsTextoPergunta = JSON.parse(document.getElementById('data').getAttribute('data-array'));
var aTextoPergunta  = Object.values(jsTextoPergunta).map(item => item.texto_pergunta);
var idTextoPergunta = Object.values(jsTextoPergunta).map(item => item.id_pergunta);
var divAndamentoPergunta = document.createElement("div");
const totalPerguntas = Object.keys(jsTextoPergunta).length;
divAndamentoPergunta.id = "divAndamentoPergunta";

setTimeout(atualizaPerguntaForm(),0);

function atualizaPerguntaForm() {
    if (aTextoPergunta[indice] == undefined) {
        window.location.href = "../View/ClassViewManutencaoFinalizacaoAvaliacao.html"
    }
    else {
        document.getElementById("textoPergunta").innerHTML = aTextoPergunta[indice];
        indice += 1;
    }

    atualizaAndamentoPergunta();
}

function atualizaAndamentoPergunta() {
    var contentAndamentoPergunta = "Pergunta "+indice+"/"+totalPerguntas;
    if (document.getElementById("divAndamentoPergunta") == null) {
        divAndamentoPerguntas.appendChild(createNodeAndamentoPergunta);
        document.body.insertBefore(divAndamentoPerguntas,divAndamentoPerguntasID);
    }
    else {
        var nodeAndamentoPergunta = document.getElementById("andamentoPerguntas");
        nodeAndamentoPergunta.parentNode.removeChild(nodeAndamentoPergunta);
        divAndamentoPerguntas.appendChild(createNodeAndamentoPergunta);
        document.body.insertBefore(divAndamentoPerguntas,divAndamentoPerguntasID);  
    }
}

function atualizaRadioSelecionado() {
    var botoesAvaliacao = document.getElementsByName("avaliacao");

    for (var i=0 ; i < botoesAvaliacao.length ; i++) {
        botoesAvaliacao[i].checked = false;
    }
}

//Ajax para enviar a resposta da avaliacação para o backend.
function realizaEnvioFormulario() {
    $("#myform").submit(function(e) {
        var url = "../Controller/ClassControllerAvaliacao.php";
        var id_pergunta = idTextoPergunta[indice-1]; 
        var avaliacao   = $("#myform").serialize();
        var sdata = avaliacao + "&id_pergunta=" + encodeURIComponent(id_pergunta);
        $.ajax({
                type: "POST",
                url: url,
                data: sdata,
                success: function(data)
                {
                    atualizaPerguntaForm();
                    atualizaRadioSelecionado();
                }
                });
        e.preventDefault();
    });
}

document.getElementById("botaoSubmit").addEventListener("click",realizaEnvioFormulario());   