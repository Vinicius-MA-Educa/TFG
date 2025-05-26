<?php

session_start();


print_r($_POST);

if (isset($_POST['guess'])) {
    $normalizedGuess = normalizeString($_POST['guess']);
    $normalizedCountry = normalizeString($_POST["pais"]);
    
    if (strcasecmp($normalizedGuess, $normalizedCountry) == 0) {
        $acierto=true; // Incrementar racha si es correcto
    } else {
        $acierto=false;  // Resetear racha si falló todos los intentos
    }
}

// Función para normalizar texto
function normalizeString($string) {
    $string = strtolower($string);
    $unwanted_array = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n'
    ];
    return strtr($string, $unwanted_array);
}

$partida = $_SESSION['partida'];
$usuarioActual = $_SESSION['user'];

// Verificar que es el turno del usuario actual
if ($partida['Turno'] != $usuarioActual) {
    header("Location: MenuOnline.php");
    exit;
}

// Determinar qué jugador es el usuario actual
$esJugador1 = ($partida['Nombre1'] == $usuarioActual);
$siguienteTurno = $esJugador1 ? $partida['Nombre2'] : $partida['Nombre1'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=tfg;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Actualizar puntos según el resultado
    if ($acierto) {
        // Si acierta, suma puntos
        if ($esJugador1) {
            $sqlPuntos = "UPDATE versus SET Puntos1 = Puntos1 + 1 WHERE Nombre1 = :nombre1 AND Nombre2 = :nombre2 AND Juego = :juego";
        } else {
            $sqlPuntos = "UPDATE versus SET Puntos2 = Puntos2 + 1 WHERE Nombre1 = :nombre1 AND Nombre2 = :nombre2 AND Juego = :juego";
        }
        
        $stmtPuntos = $pdo->prepare($sqlPuntos);
        $stmtPuntos->execute([
            ':nombre1' => $partida['Nombre1'],
            ':nombre2' => $partida['Nombre2'],
            ':juego' => $partida['Juego']
        ]);
        
        echo "¡Acierto! Turno para " . $siguienteTurno;
    } else {
        // Si falla, reinicia los puntos del jugador actual a 0
        if ($esJugador1) {
            $sqlPuntos = "UPDATE versus SET Puntos1 = 0 WHERE Nombre1 = :nombre1 AND Nombre2 = :nombre2 AND Juego = :juego";
        } else {
            $sqlPuntos = "UPDATE versus SET Puntos2 = 0 WHERE Nombre1 = :nombre1 AND Nombre2 = :nombre2 AND Juego = :juego";
        }
        
        $stmtPuntos = $pdo->prepare($sqlPuntos);
        $stmtPuntos->execute([
            ':nombre1' => $partida['Nombre1'],
            ':nombre2' => $partida['Nombre2'],
            ':juego' => $partida['Juego']
        ]);
        
        echo "Fallaste. Tus puntos se reiniciaron a 0. Turno para " . $siguienteTurno;
    }
    
    // Siempre cambiar el turno, independientemente del resultado
    $sqlTurno = "UPDATE versus SET Turno = :turno WHERE Nombre1 = :nombre1 AND Nombre2 = :nombre2 AND Juego = :juego";
    
    $stmtTurno = $pdo->prepare($sqlTurno);
    $stmtTurno->execute([
        ':turno' => $siguienteTurno,
        ':nombre1' => $partida['Nombre1'],
        ':nombre2' => $partida['Nombre2'],
        ':juego' => $partida['Juego']
    ]);
    
    // Actualizar la partida en la sesión
    $sqlSelect = "SELECT * FROM versus WHERE Nombre1 = :nombre1 AND Nombre2 = :nombre2 AND Juego = :juego";
    $stmtSelect = $pdo->prepare($sqlSelect);
    $stmtSelect->execute([
        ':nombre1' => $partida['Nombre1'],
        ':nombre2' => $partida['Nombre2'],
        ':juego' => $partida['Juego']
    ]);
    
    $partidaActualizada = $stmtSelect->fetch(PDO::FETCH_ASSOC);
    if ($partidaActualizada) {
        $_SESSION['partida'] = $partidaActualizada;
    }
    
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
    header("Location: MenuOnline.php");
    exit;
}

header("Location: MenuOnline.php");
?>
