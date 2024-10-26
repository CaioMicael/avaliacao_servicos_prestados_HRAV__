var indice                  = 0;
var jsTextoPergunta         = JSON.parse(document.getElementById('data').getAttribute('data-array'));
var aTextoPergunta          = Object.values(jsTextoPergunta).map(item => item.texto_pergunta);
var idTextoPergunta         = Object.values(jsTextoPergunta).map(item => item.id_pergunta);
var divAndamentoPergunta    = document.createElement("div");
var BarraProgressoContainer = document.createElement("div");
var divBarraProgresso       = document.createElement("div");
var divContainerForm        = document.getElementById("main-container");

const totalPerguntas     = Object.keys(jsTextoPergunta).length;

//Adicionando IDs as divs criadas pelo JS
divAndamentoPergunta.id    = "divAndamentoPergunta";
BarraProgressoContainer.id = "barraProgressoContainer";
divBarraProgresso.id       = "divBarraProgresso";

setTimeout(atualizaComponentesTela(),0);

function atualizaComponentesTela() {
    atualizaPerguntaForm();
    //atualizaCampoTextoDigitado();
    geraBarraProgresso();
    atualizaBarraProgresso(calculaProgresso());
}

function atualizaPerguntaForm() {
    if (aTextoPergunta[indice] == undefined) {
        window.location.href = "../View/ClassViewManutencaoFinalizacaoAvaliacao.html"
    }
    else {
        document.getElementById("textoPergunta").innerHTML = aTextoPergunta[indice];
        indice += 1;
    }
    atualizaAndamentoPergunta();
    atualizaBarraProgresso(calculaProgresso());
    atualizaCampoTextoDigitado();//
}

function atualizaAndamentoPergunta() {
    var contentAndamentoPergunta = "Pergunta "+indice+"/"+totalPerguntas;
    if (document.getElementById("divAndamentoPergunta") == null) {
        divAndamentoPergunta.innerHTML = contentAndamentoPergunta;
        divContainerForm.appendChild(divAndamentoPergunta);
    }
    else {
        divAndamentoPergunta.innerHTML = contentAndamentoPergunta;  
    }
}

function geraBarraProgresso() {
    if (document.getElementById("divBarraProgresso") == null) {
        divContainerForm.appendChild(BarraProgressoContainer);
        BarraProgressoContainer.appendChild(divBarraProgresso);
    }
}

function atualizaBarraProgresso(progresso) {
        divBarraProgresso.style.width = progresso + '%';
}

function calculaProgresso() {
    return (indice/totalPerguntas)*100;
}

function atualizaRadioSelecionado() {
    var botoesAvaliacao = document.getElementsByName("avaliacao");

    for (var i=0 ; i < botoesAvaliacao.length ; i++) {
        botoesAvaliacao[i].checked = false;
    }
}

function atualizaCampoTextoDigitado() {
    var campoTexto = document.getElementById("itexto");
    campoTexto.value = '';
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