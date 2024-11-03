function mostrarSenha() {
    var senhaInput = document.getElementById("senha");
    senhaInput.type = senhaInput.type === "password" ? "text" : "password";
}

function verificaCamposFormulario() {
    document.getElementById("botaoSubmit").disabled = false;
}

document.getElementById("mostrarSenha").onclick = mostrarSenha; 
document.getElementById("codigo_usuario").addEventListener("input",verificaCamposFormulario());   
document.getElementById("senha").addEventListener("input",verificaCamposFormulario());   