<?php
//$nombre = $_SESSION['user'];

session_start();
include './LiberiaPHP/Funciones.php';

$usuario = sacarUsuario($_SESSION['user']);

$_SESSION["Juego1"] = $usuario["Juego1"];
$_SESSION["Juego2"] = $usuario["Juego2"];
$_SESSION["Juego3"] = $usuario["Juego3"];

$multi= tieneMulti($_SESSION['user'])
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
        </style>
    </head>
    <body class="bg-dark">
        <div class="container py-5">
            <h1 class="text-center mb-5 text-light">Bienvenido</h1>

            <div class="row row-cols-1 row-cols-md-3 g-4">
                <!-- Tarjeta 1 -->
                <div class="col">
                    <div class="card text-bg-secondary h-100 text-center p-3"">
                        <span style="font-size: <?php echo $usuario["Juego1"] * 0.15 + 0.8; ?>rem" class="card-badge badge bg-danger rounded-pill"><?php echo $usuario["Juego1"]; ?></span>
                        <a href="Worled.php" class="text-decoration-none">
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

                <!-- Tarjeta 2 -->
                <div class="col">
                    <div class="card text-bg-secondary h-100 text-center p-3">
                        <span style="font-size: <?php echo $usuario["Juego2"] * 0.15 + 0.8; ?>rem" class="card-badge badge bg-danger rounded-pill"><?php echo $usuario["Juego2"]; ?></span>
                        <a href="Bandera.php" class="text-decoration-none">
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

                <!-- Tarjeta 3 -->
                <div class="col">
                    <div class="card text-bg-secondary h-100 text-center p-3">
                        <span style="font-size: <?php echo $usuario["Juego3"] * 0.15 + 0.8; ?>rem" class="card-badge badge bg-danger rounded-pill"><?php echo $usuario["Juego3"]; ?></span>
                        <a href="Conectar.php" class="text-decoration-none">
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

                <!-- Tarjeta Crear. -->
                <div class="col">
                    <div class="card text-bg-secondary h-100 text-center p-3">
                        <a href="MenuOnline.php" class="text-decoration-none">
                            <div class="card-body">
                                <div class="card-icon bg-info bg-opacity-25 text-info">
                                    <i class="bi bi-person-add"></i>
                                </div>
                                <h3 class="card-title">Partida versus</h3>
                                <?php if($multi):?>
                                <p class="card-text text-muted">Continua la partida con tu amigo</p>
                                <?php else:?>
                                <p class="card-text text-muted">Crear una partida con tu amigo</p>
                                <?php endif;?>
                                
                            </div>
                        </a>
                    </div>
                </div>
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