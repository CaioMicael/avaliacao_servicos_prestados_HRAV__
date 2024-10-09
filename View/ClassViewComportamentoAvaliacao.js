window.onload = carregaPergunta();

function carregaPergunta() {
    var indice = 0;
    var jsTextoPergunta = JSON.parse(document.getElementById('data').getAttribute('data-array'));

    var aTextoPergunta = Object.values(jsTextoPergunta).map(item => item.texto_pergunta);

    document.getElementById("textoPergunta").innerHTML = aTextoPergunta[indice];

    indice += 1;
}