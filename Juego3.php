<?php

session_start();
if(isset($_GET["fallo"]) && !empty($_GET["fallo"])){
   $_SESSION["Juego3"]=0; 
}else{
    $_SESSION["Juego3"]++; // Incrementar racha si es correcto
}

// Conexión y actualización
try {
    $pdo = new PDO("mysql:host=localhost;dbname=tfg;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE usuarios SET Juego3 = :Juego3 WHERE Nombre = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':Juego3' => $_SESSION['Juego3'],
        ':usuario' => $_SESSION['user']
    ]);

    echo "Actualización completada correctamente.";
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}

header("Location: Menu.php");
?>
