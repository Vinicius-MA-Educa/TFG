/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */


const Intentos = 6;
const Cant = Palabra.length;
let Intento = 0;

const game = document.getElementById("game");

// Crear 6 filas vacías desde el inicio
for (let i = 0; i < Intentos; i++) {
    const row = document.createElement("div");
    row.className = "row";
    row.id = `row-${i}`;
    for (let j = 0; j < Cant; j++) {
        const box = document.createElement("div");
        box.className = "letter";
        if (Palabra[j] == " ") {
            box.classList.add("space");
        }
        row.appendChild(box);
    }
    game.appendChild(row);
}


function submitGuess() {
    const input = document.getElementById("guess");
    const flagForm = document.getElementById("flagForm");
    let Respuesta = input.value.toLowerCase().trim();

    if (Respuesta.length !== Cant) {
        alert(`El país tiene ${Cant} letras y la tuya tiene ${Respuesta.length}`);
        return;
    }

    const feedback = Array(Cant).fill("");
    const PalabraArr = Palabra.split("");
    const RespuestaArr = Respuesta.split("");

    // 1ª pasada: letras correctas
    for (let i = 0; i < RespuestaArr.length; i++) {
        if (RespuestaArr[i] === PalabraArr[i]) {
            feedback[i] = "green";
            PalabraArr[i] = null;
            RespuestaArr[i] = null;
        }
    }

    // 2ª pasada: letras en lugar incorrecto
    for (let i = 0; i < RespuestaArr.length; i++) {
        if (RespuestaArr[i] && PalabraArr.includes(RespuestaArr[i])) {
            feedback[i] = "yellow";
            PalabraArr[PalabraArr.indexOf(RespuestaArr[i])] = null;
        }
    }

    const currentRow = document.getElementById(`row-${Intento}`);
    for (let i = 0; i < Cant; i++) {
        const box = currentRow.children[i];
        box.textContent = Respuesta[i].toUpperCase();
        if (feedback[i]) {
            box.classList.add(feedback[i]);
        } else {
            box.classList.add("gray");
        }
    }

    Intento++;
    input.value = "";

    // Solo envía el formulario cuando acierte o se quede sin intentos
    if (Respuesta === Palabra) {
        // Si acierta, cambia el valor de acierto a true
        document.getElementById("acierto").value = "true";
        const modalA = new bootstrap.Modal(document.getElementById('aciertoModal'));
        modalA.show();
        const modalButton = document.querySelector('#aciertoModal .btn');
        if (modalButton) {
            modalButton.addEventListener('click', function () {
                // Enviar el formulario cuando se cierre el modal
                document.getElementById("flagForm").submit();
            });
        }
    } else if (Intento >= Intentos) {
        // Si se queda sin intentos, mantiene acierto en false
        const modalF = new bootstrap.Modal(document.getElementById('falloModal'));
        modalF.show();
        const modalButton = document.querySelector('#falloModal .btn');
        if (modalButton) {
            modalButton.addEventListener('click', function () {
                // Enviar el formulario cuando se cierre el modal
                document.getElementById("flagForm").submit();
            });
        }
    }
}

window.onload = function () {
    const modal = new bootstrap.Modal(document.getElementById('instructionModal'));
    modal.show();
};