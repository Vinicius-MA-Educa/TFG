<?php
include './LiberiaPHP/Funciones.php';
$pais= paisAleatorio();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Wordle de Países</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="Estilo/Worled.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <!-- Modal -->
        <div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title w-100" id="instructionModalLabel">🧩 Instrucciones del juego</h5>
                    </div>
                    <div class="modal-body">
                        <p>Adivina el país oculto en 6 intentos.</p>
                        <p>Escribe una palabra, del mismo tamaño que la oculta y se te mostrala las letras desl siguiente color.</p>
                        <ul class="text-start mx-auto" style="max-width: 400px;">
                            <li><span class="badge bg-success">Verde</span>: Letra correcta en la posición correcta</li>
                            <li><span class="badge bg-warning text-dark">Amarillo</span>: Letra correcta en lugar incorrecto</li>
                            <li><span class="badge bg-secondary">Gris</span>: Letra incorrecta</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">Entendido</button>
                    </div>
                </div>
            </div>
        </div>

        <h1>🌍 Wordle de Países</h1>
        <p>Adivina el país en 6 intentos</p>
        
        <form method="POST" id="flagForm" action="Juego1.php">
            <input type="hidden" id="acierto" name="acierto" value="false">
            <div class="mb-3">
                <input type="text" id="guess" name="guess" placeholder="Tu intento..." />
                <button type="button" onclick="submitGuess()">Enviar</button>
            </div>
        </form>
        
        <div id="game"></div>

        <script>
            const Palabra = "<?php echo strtolower($pais["nombre"]); ?>";
            
        </script>
        <script src="JavaScript/WorledJs.js"></script>
    </body>
</html>