<?php
session_start();
include './LiberiaPHP/Funciones.php';

if (!tieneMulti($_SESSION['user'])) {
    header("Location: CrearOnline.php");
    exit; // también recomendable usar exit después de redirigir
} else {
    $partida = sacarUsuarioOnline($_SESSION['user']);

    if ($partida) {
        $_SESSION['partida'] = $partida;
    }
}

// Obtener el juego de la partida y verificar el turno
$juegoPartida = isset($partida['Juego']) ? $partida['Juego'] : null;
$esMiTurno = isset($partida['Turno']) && $_SESSION['user'] == $partida['Turno'];
print_r($_SESSION)
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menú</title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
        <style>
            .card {
                transition: transform 0.3s, box-shadow 0.3s;
                cursor: pointer;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            }

            .card-icon {
                font-size: 2.5rem;
                width: 80px;
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                margin: 0 auto 15px;
            }

            .card-badge {
                position: absolute;
                top: 10px;
                left: 10px;
                z-index: 10;
            }

            .card-badge-right {
                position: absolute;
                top: 10px;
                right: 10px;
                z-index: 10;
            }
        </style>
    </head>
    <body class="bg-dark">
        <div class="container py-5">
            <h1 class="text-center mb-5 text-light">Bienvenido al modo Online</h1>

            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">

                <?php if (!$esMiTurno && $juegoPartida): ?>
                    <!-- Tarjeta de espera - No es tu turno -->
                    <div class="col">
                        <div class="card text-bg-warning h-100 text-center p-3">
                            <div class="card-body">
                                <div class="card-icon bg-warning bg-opacity-25 text-warning-emphasis">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <h3 class="card-title text-dark">Esperando turno</h3>
                                <p class="card-text text-dark">No es tu turno, espera a que tu rival termine su jugada.</p>
                                <div class="mt-3">
                                    <div class="spinner-border text-warning-emphasis" role="status">
                                        <span class="visually-hidden">Cargando...</span>
                                    </div>
                                </div>
                                <button class="btn btn-outline-dark mt-3" onclick="location.reload()">
                                    <i class="bi bi-arrow-clockwise"></i> Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php elseif ($esMiTurno && $juegoPartida == 1): ?>
                    <!-- Tarjeta 1 - Wordle -->
                    <div class="col">
                        <div class="card text-bg-secondary h-100 text-center p-3">
                            <span style="font-size: <?php echo $partida["Puntos1"] * 0.15 + 0.8; ?>rem" class="card-badge badge bg-danger rounded-pill"><?php echo $partida["Puntos1"]; ?></span>
                            <span style="font-size: <?php echo $partida["Puntos2"] * 0.15 + 0.8; ?>rem" class="card-badge-right badge bg-primary rounded-pill"><?php echo $partida["Puntos2"]; ?></span>
                            <a href="WorledOnline.php" class="text-decoration-none">
                                <div class="card-body">
                                    <div class="card-icon bg-primary bg-opacity-25 text-primary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </div>
                                    <h3 class="card-title">Wordle</h3>
                                    <p class="card-text text-muted">Adivina el pais</p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($esMiTurno && $juegoPartida == 2): ?>
                    <!-- Tarjeta 2 - Banderas -->
                    <div class="col">
                        <div class="card text-bg-secondary h-100 text-center p-3">
                            <span style="font-size: <?php echo $partida["Puntos1"] * 0.15 + 0.8; ?>rem" class="card-badge badge bg-danger rounded-pill"><?php echo $partida["Puntos1"]; ?></span>
                            <span style="font-size: <?php echo $partida["Puntos2"] * 0.15 + 0.8; ?>rem" class="card-badge-right badge bg-primary rounded-pill"><?php echo $partida["Puntos2"]; ?></span>
                            <a href="BanderaOnline.php" class="text-decoration-none">
                                <div class="card-body">
                                    <div class="card-icon bg-success bg-opacity-25 text-success">
                                        <i class="bi bi-flag-fill"></i>
                                    </div>
                                    <h3 class="card-title">Banderas</h3>
                                    <p class="card-text text-muted">Intenta acertar el pais con la bandera</p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($esMiTurno && $juegoPartida == 3): ?>
                    <!-- Tarjeta 3 - Conecta 4 -->
                    <div class="col">
                        <div class="card text-bg-secondary h-100 text-center p-3">
                            <span style="font-size: <?php echo $partida["Puntos1"] * 0.15 + 0.8; ?>rem" class="card-badge badge bg-danger rounded-pill"><?php echo $partida["Puntos1"]; ?></span>
                            <span style="font-size: <?php echo $partida["Puntos2"] * 0.15 + 0.8; ?>rem" class="card-badge-right badge bg-primary rounded-pill"><?php echo $partida["Puntos2"]; ?></span>
                            <a href="ConectarOnline.php" class="text-decoration-none">
                                <div class="card-body">
                                    <div class="card-icon bg-info bg-opacity-25 text-info">
                                        <i class="bi bi-4-square-fill"></i>
                                    </div>
                                    <h3 class="card-title">Conecta 4</h3>
                                    <p class="card-text text-muted">Cada 4 paises comparten algo</p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>

                
            </div>
            <div class="text-center mt-4">
                    <button class="btn btn-primary" onclick="location.href = 'menu.php'">
                        <i class="bi bi-house"></i> Volver al Menú
                    </button>
                <a href="eliminarVersus.php">
                    <button class="btn btn-danger" onclick="rendirse()">
                        <i class="bi bi-x-circle"></i> Rendirse
                    </button>
                </a>
                    
                </div>
        </div>

        <!-- Bootstrap 5.3.3 JS Bundle -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
        <script>
                document.querySelectorAll('.card').forEach(card => {
                    card.addEventListener('mousedown', function () {
                        this.style.transform = 'translateY(-5px) scale(0.98)';
                    });

                    card.addEventListener('mouseup', function () {
                        this.style.transform = 'translateY(-5px)';
                    });

                    card.addEventListener('mouseleave', function () {
                        if (this.style.transform.includes('scale'))
                            this.style.transform = 'translateY(-5px)';
                    });
                });
        </script>
    </body>
</html>