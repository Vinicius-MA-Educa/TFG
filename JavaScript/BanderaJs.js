

const maxAttempts = 3;
let currentAttempts = 0;

// Asegurarse de que la imagen de la bandera tiene la URL correcta
document.addEventListener('DOMContentLoaded', function () {
    // Asignar la URL de la imagen a la imagen de la bandera
    document.getElementById("flagImage").src = flagUrl;

    // Configurar el evento de tecla Enter para el campo de entrada
    document.getElementById("guess").addEventListener("keyup", function (event) {
        if (event.key === "Enter") {
            checkAnswer();
        }
    });


    mostrarInstruccionesPrimeraVez();
});

// Normalizar texto (convertir a minúsculas y eliminar acentos)
function normalizeString(text) {
    // Primero convertimos a minúsculas
    text = text.toLowerCase();
    // Luego eliminamos los acentos
    return text.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

function checkAnswer() {
    const guessInput = document.getElementById("guess");
    const guess = guessInput.value.trim();
    const normalizedGuess = normalizeString(guess);
    const attemptsLeft = document.getElementById("attemptsLeft");
    const flagForm = document.getElementById("flagForm");

    if (guess === "") {
        showMessage("Por favor, escribe el nombre de un país", "warning");
        return;
    }

    currentAttempts++;

    if (normalizedGuess === normalizedCountryName) {
        showMessage("✅ ¡Correcto! Es " + countryName, "success");

        // Enviar formulario para actualizar racha
        flagForm.submit();
    } else {
        const remaining = maxAttempts - currentAttempts;
        attemptsLeft.textContent = remaining;

        if (remaining <= 0) {
            // Marcar que es el último intento
            document.getElementById("finalAttempt").value = "true";
            showMessage(`❌ Incorrecto. La respuesta correcta era ${countryName}.`, "danger");

            // Enviar formulario para resetear racha
            flagForm.submit();
        } else {
            showMessage(`❌ Incorrecto. Te quedan ${remaining} intento${remaining !== 1 ? 's' : ''}.`, "danger");
        }
    }
}

function showMessage(text, type) {
    const message = document.getElementById("message");
    message.textContent = text;
    message.className = `alert alert-${type}`;
    message.style.display = "block";
}

// Función para mostrar instrucciones solo la primera vez
function mostrarInstruccionesPrimeraVez() {
    // Verificar si es la primera visita
    if (!localStorage.getItem('yaVioInstrucciones')) {
        const modal = new bootstrap.Modal(document.getElementById('instructionModal'));
        modal.show();

        // Guardar que ya vio las instrucciones
        localStorage.setItem('yaVioInstrucciones', 'true');
    }
}