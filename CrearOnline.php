<?php
session_start();
$nombreUsuario = $_SESSION['user'] ?? 'Invitado';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Partida Versus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .game-option {
            border: 2px solid transparent;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            padding: 15px;
        }
        .game-option.selected {
            border-color: #0d6efd;
            background-color: #e7f1ff;
        }
        .game-option:hover {
            background-color: #f0f8ff;
        }
    </style>
</head>
<body class="bg-dark">
<div class="container py-5">
    <h2 class="text-center text-light mb-4">Invitar a un Jugador</h2>
    <div class="card shadow text-bg-secondary  mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <form method="POST" action="ProcesarOnline.php">
                <input type="hidden" name="jugador1" value="<?= $nombreUsuario ?>">
                <div class="mb-3">
                    <label class="form-label">Tu Nombre</label>
                    <input type="text" class="form-control" value="<?php echo $nombreUsuario ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="jugador2" class="form-label">Nombre del Jugador Invitado</label>
                    <input type="text" class="form-control" id="jugador2" name="jugador2" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Selecciona el Juego</label>
                    <input type="hidden" name="juego" id="juegoSeleccionado" required>

                    <div class="d-flex justify-content-around flex-wrap gap-3 mt-2">
                        <div class="game-option text-center" data-juego="1">
                            <i class="bi bi-globe2" style="font-size: 2rem;"></i>
                            <div>Adivina el país</div>
                        </div>
                        <div class="game-option text-center" data-juego="2">
                            <i class="bi bi-flag-fill" style="font-size: 2rem;"></i>
                            <div>Banderas locas</div>
                        </div>
                        <div class="game-option text-center" data-juego="3">
                            <i class="bi bi-grid-3x3-gap" style="font-size: 2rem;"></i>
                            <div>Conecta 4</div>
                        </div>
                        
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Crear Partida</button>
            </form>
        </div>
    </div>
</div>

<script>
    const opciones = document.querySelectorAll('.game-option');
    const inputJuego = document.getElementById('juegoSeleccionado');

    opciones.forEach(op => {
        op.addEventListener('click', () => {
            opciones.forEach(o => o.classList.remove('selected'));
            op.classList.add('selected');
            inputJuego.value = op.dataset.juego;
        });
    });
</script>
</body>
</html>
