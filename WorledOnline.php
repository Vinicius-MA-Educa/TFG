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
                            <p class="mb-0"><strong>¡Has adivinado correctamente la palabra oculta!</strong></p>
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
        
        
        <!-- Modal de fallo -->
        <div class="modal fade" id="falloModal" tabindex="-1" aria-labelledby="falloModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title w-100 text-center" id="aciertoModalLabel">Ohh has fallado</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-trophy text-warning fs-1 mb-3"></i>
                            <h4 class="text-danger">Que lastima te has quedado cerca</h4>
                            <p class="mb-0"><strong>El pais oculto era: <?php echo strtolower($pais["nombre"]); ?> </strong></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">
                            <i class="fas fa-arrow-left"></i> Volver al menú
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        
        <h1>🌍 Wordle de Países</h1>
        <p>Adivina el país en 6 intentos</p>
        
        <form method="POST" id="flagForm" action="Juego1Online.php">
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