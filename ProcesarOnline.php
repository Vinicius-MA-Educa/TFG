<?php
session_start();

// Si no viene del formulario, redirige
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: CrearOnline.php");
    exit;
}

try {
    // Conexión con PDO
    $pdo = new PDO("mysql:host=localhost;dbname=tfg;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recoger datos del formulario
    $jugador1 = $_POST['jugador1'];
    $jugador2 = $_POST['jugador2'];
    $juego = $_POST['juego'];

    // Insertar nueva partida
    $stmt = $pdo->prepare("
        INSERT INTO versus (Nombre1, Nombre2, turno, puntos1, puntos2, juego)
        VALUES (:jugador1, :jugador2, :turno, 0, 0, :juego)
    ");
    $stmt->execute([
        ':jugador1' => $jugador1,
        ':jugador2' => $jugador2,
        ':turno' => $jugador1,
        ':juego' => $juego
    ]);

    // Guardar la partida en la sesión
    $stmt = $pdo->prepare("
        SELECT * FROM versus
        WHERE Nombre1 = :jugador1 AND Nombre2 = :jugador2
    ");
    $stmt->execute([
        ':jugador1' => $jugador1,
        ':jugador2' => $jugador2
    ]);
    $partida = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($partida) {
        $_SESSION['partida'] = $partida;
    }

    // Redirigir al menú online
    header("Location: MenuOnline.php");
    exit;

} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
