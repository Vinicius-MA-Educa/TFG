<?php

session_start();

if($_POST["acierto"]=="true"){
    $_SESSION["Juego1"]++;
}else{
    $_SESSION["Juego1"]=0;
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=tfg;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE usuarios SET Juego1 = :Juego1 WHERE Nombre = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':Juego1' => $_SESSION['Juego1'],
        ':usuario' => $_SESSION['user']
    ]);

    echo "Actualización completada correctamente.";
} catch (PDOException $e) {
    echo "Error en la base de datos: " . $e->getMessage();
}

header("Location: Menu.php");
?>
