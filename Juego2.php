<?php

session_start();


print_r($_POST);

if (isset($_POST['guess'])) {
    $normalizedGuess = normalizeString($_POST['guess']);
    $normalizedCountry = normalizeString($_POST["pais"]);
    
    if (strcasecmp($normalizedGuess, $normalizedCountry) == 0) {
        $_SESSION["Juego2"]++; // Incrementar racha si es correcto
    } else {
        $_SESSION["Juego2"] = 0; // Resetear racha si falló todos los intentos
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

// Conexión y actualización
try {
    $pdo = new PDO("mysql:host=localhost;dbname=tfg;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE usuarios SET Juego2 = :juego2 WHERE Nombre = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':juego2' => $_SESSION['Juego2'],
        ':usuario' => $_SESSION['user']
    ]);

    echo "Actualización completada correctamente.";
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}

header("Location: Menu.php");
?>
