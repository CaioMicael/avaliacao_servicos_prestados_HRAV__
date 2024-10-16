var indice = 0;
var jsTextoPergunta = JSON.parse(document.getElementById('data').getAttribute('data-array'));
var aTextoPergunta  = Object.values(jsTextoPergunta).map(item => item.texto_pergunta);
var idTextoPergunta = Object.values(jsTextoPergunta).map(item => item.id_pergunta);
window.onload = atualizaPerguntaForm();

function atualizaPerguntaForm() {
    if (aTextoPergunta[indice] == undefined) {
        window.location.href = "../View/ClassViewManutencaoFinalizacaoAvaliacao.html"
    }
    else {
        document.getElementById("textoPergunta").innerHTML = aTextoPergunta[indice];
        indice += 1;
    }
}

function atualizaRadioSelecionado() {
    var botoesAvaliacao = document.getElementsByName("avaliacao");

    for (var i=0 ; i < botoesAvaliacao.length ; i++) {
        botoesAvaliacao[i].checked = false;
    }
}

//Ajax para enviar a resposta da avaliacação para o backend.
//document.getElementById("botaoSubmit").addEventListener("click", function() { ---> AVALIAR NECESSIDADE, a principio a forma de pegar as perguntas do model que está fazendo ele inserir antes de enviar o formulário
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
    
        e.preventDefault();// esse comando serve para previnir que o form realmente realize o submit e atualize a tela.
    });
//})
