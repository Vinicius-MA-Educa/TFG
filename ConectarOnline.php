<?php
try {
    session_start();
    include './LiberiaPHP/Funciones.php';
    $agrupaciones= sacarRazon();
    if (count($agrupaciones) < 4) {
        die("No se encontraron suficientes agrupaciones de países.");
    }

    // Formatear los datos para JavaScript
    $gameData = [];
    foreach ($agrupaciones as $ag) {
        $grupo = [
            'reason' => $ag['razon'],
            'countries' => [
                [
                    'name' => $ag['nombre_1'],
                    'image' => $ag['bandera_1']
                ],
                [
                    'name' => $ag['nombre_2'],
                    'image' => $ag['bandera_2']
                ],
                [
                    'name' => $ag['nombre_3'],
                    'image' => $ag['bandera_3']
                ],
                [
                    'name' => $ag['nombre_4'],
                    'image' => $ag['bandera_4']
                ]
            ]
        ];
        $gameData[] = $grupo;
    }

    // Convertir a JSON para usar en JavaScript
    $gameDataJSON = json_encode($gameData);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><
        <link href="Estilo/Conectar.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Conecta 4 Países</title>
    </head>
    <body>
        <div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title w-100" id="instructionModalLabel">🧩 Instrucciones del juego</h5>
                    </div>
                    <div class="modal-body">
                        <p>Conecta los 4 paises por su caracteristica oculta.</p>
                        <p>Selecione 4 paises que creas que tengan algo en común, y pulse el boton de comprobar.</p>
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
                            <p class="mb-0"><strong>¡Has adivinado correctamente todas las conexiones!</strong></p>
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
        
        
        <h1>Conecta 4 de Países</h1>

        <div class="game-container">
            <div class="game-info">
                <div class="score"><span id="score"></span></div>
            </div>

            <div class="grid" id="countriesGrid"></div>

            <div class="controls">
                <form method="POST" id="flagForm" action="Juego3Online.php"></form>
                <button class="check-button" id="checkButton" disabled>Comprobar</button>
                <a href="Juego3.php?fallo=1"><button class="btn btn-danger" id="ffButton">Rendirse</button></a> 
            </div>

            <div class="solved-groups" id="solvedGroups"></div>
        </div>

        
        <script>
            // Datos del juego obtenidos de PHP/MySQL
            const gameData = <?php echo $gameDataJSON; ?>;

            
        </script>
        <script src="JavaScript/ConectarJs.js"></script>
    </body>
</html>