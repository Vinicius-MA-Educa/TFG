<?php
// Iniciar sesión al principio del script
session_start();
include './LiberiaPHP/Funciones.php';
$pais= paisAleatorio();

// Verificar si hay respuesta correcta o incorrecta (vía POST)
if (isset($_POST['guess'])) {
    $normalizedGuess = normalizeString($_POST['guess']);
    $normalizedCountry = normalizeString($_POST['pais']);

    if ($normalizedGuess === $normalizedCountry) {
        $_SESSION["Juego2"]++; // Incrementar racha si es correcto
    } elseif (isset($_POST['final_attempt']) && $_POST['final_attempt'] === 'true') {
        $_SESSION["Juego2"] = 0; // Resetear racha si falló todos los intentos
    }
}

// Normalizar el nombre del país para comparación
$nombreNormalizado = normalizeString($pais["nombre"]);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>¿De qué país es esta bandera?</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="Estilo/Bandera.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!-- Modal de instrucciones -->
        <div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title w-100 text-center" id="instructionModalLabel">🎌 Instrucciones del juego</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>¡Bienvenido al juego de adivinar banderas!</strong></p>
                        <ul class="text-start">
                            <li>Se mostrará una bandera de un país y tendrás que adivinar a qué país pertenece.</li>
                            <li>Tienes un máximo de <span class="text-danger">3 intentos</span> para acertar.</li>
                            <li>No es necesario incluir acentos en tu respuesta.</li>
                            <li>Después de cada intento verás un modal con el resultado.</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">¡Empezar a jugar!</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal de acierto -->
        <div class="modal fade" id="aciertoModal" tabindex="-1" aria-labelledby="aciertoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title w-100 text-center" id="aciertoModalLabel">🎉 ¡Has Acertado!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-trophy text-warning fs-1 mb-3"></i>
                            <h4 class="text-success">¡Excelente trabajo!</h4>
                            <p class="mb-0"><strong>¡Has adivinado correctamente la bandera!</strong></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success w-100" data-bs-dismiss="modal">
                            <i class="fas fa-arrow-left"></i> Volver al menú
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="game-container">
                <h1 class="mb-4">🎌 ¿De qué país es esta bandera?</h1>

                <div class="flag-container">
                    <img id="flagImage" src="" alt="Bandera del país" class="img-fluid">
                </div>

                <div class="attempts-container">
                    <i class="fas fa-heart text-danger"></i> Intentos restantes: <span class="attempts-left" id="attemptsLeft">3</span>
                </div>

                <div class="streak-container mb-2">
                    <span class="badge bg-warning text-dark fs-6">
                        <i class="fas fa-fire"></i> Racha actual: <span id="currentStreak"><?php echo isset($_SESSION["Juego2"]) ? $_SESSION["Juego2"] : 0; ?></span>
                    </span>
                </div>

                <form method="POST" id="flagForm" action="Juego2Online.php">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="guess" name="guess" placeholder="Escribe el nombre del país..." aria-label="País" autocomplete="off">
                        <input type="hidden" id="finalAttempt" name="final_attempt" value="false">
                        <input type="hidden" id="pais" name="pais" value="<?php echo $pais["nombre"]; ?>">
                        <button class="btn btn-success" type="button" id="checkButton" onclick="checkAnswer()">
                            <i class="fas fa-check"></i> Comprobar
                        </button>
                    </div>
                </form>
            </div>

            <div id="message" class="alert" role="alert" style="display: none;"></div>

        </div>

        <!-- Variables que necesita el script JS -->
        <script>
            const flagUrl = "<?php echo $pais["url_imagen"]; ?>";
            const countryName = "<?php echo $pais["nombre"]; ?>";
            const normalizedCountryName = "<?php echo $nombreNormalizado; ?>";
        </script>
        
        <!-- Referencia al archivo JS externo -->
        <script src="JavaScript/BanderaJs.js"></script>
    </body>
</html>