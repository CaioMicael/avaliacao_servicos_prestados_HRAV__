const progressBar = document.querySelector('.progress-bar');
const progressValue = document.querySelector('.progress-value');


const totalTime = 5000;

let startTime;

function progress() {
    const now = Date.now();
    const elapsedTime = now - startTime;
    const progressPercentage = Math.floor(Math.min(100, (elapsedTime / totalTime) * 100));

    progressBar.style.width = progressPercentage + '%';
    progressValue.textContent = progressPercentage + '%';

    if (progressPercentage >= 100) {
        clearInterval(interval);
    }
}

// Iniciar a animação da barra de progresso
function startProgress() {
    startTime = Date.now();
    interval = setInterval(progress, 400);
}

startProgress();


setTimeout(function() {
    window.location.href = "../View/ClassViewManutencaoAvaliacao.php";
}, 5000);
