var indice = 0;
var jsTextoPergunta = JSON.parse(document.getElementById('data').getAttribute('data-array'));
var aTextoPergunta  = Object.values(jsTextoPergunta).map(item => item.texto_pergunta);
var idTextoPergunta = Object.values(jsTextoPergunta).map(item => item.id_pergunta);
const divAndamentoPerguntas = document.createElement("div");
const totalPerguntas = Object.keys(jsTextoPergunta).length;
const divAndamentoPerguntasID = document.getElementById("andamentoPerguntas");

setTimeout(atualizaPerguntaForm(),0);

function atualizaPerguntaForm() {
    if (aTextoPergunta[indice] == undefined) {
        window.location.href = "../View/ClassViewManutencaoFinalizacaoAvaliacao.html"
    }
    else {
        document.getElementById("textoPergunta").innerHTML = aTextoPergunta[indice];
        indice += 1;
    }
    var contentAndamentoPerguntas = document.createTextNode("Pergunta "+indice+"/"+totalPerguntas);
    divAndamentoPerguntas.appendChild(contentAndamentoPerguntas);
    document.body.insertBefore(divAndamentoPerguntas,divAndamentoPerguntasID);
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