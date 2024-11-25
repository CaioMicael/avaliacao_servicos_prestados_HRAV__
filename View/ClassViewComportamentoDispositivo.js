var obDispositivos = JSON.parse(document.getElementById('data').getAttribute('data-array'));

var ul = document.getElementById("listaDispositivo");

obDispositivos.forEach((dispositivo) => {
    let li = document.createElement("li");
    let label = document.createElement("label");
    label.innerHTML = '<input type="radio" name="dispositivo" value="dispositivo"> ' +
                        `${typeof dispositivo === 'object' ? JSON.stringify(dispositivo) : dispositivo}`;

    li.appendChild(label);
    ul.appendChild(li);
});
