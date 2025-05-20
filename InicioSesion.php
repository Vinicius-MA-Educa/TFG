<?php
session_start();
/*
 * Script de verificación de usuario y registro
 */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["user"]) && isset($_POST["contra"]) && !empty($_POST["user"]) && !empty($_POST["contra"])) {
        $username = trim($_POST["user"]);
        $contra = $_POST["contra"];
        
        try {
            // Conexión a la base de datos (recomendable extraer a un archivo aparte)
            $pdo = new PDO("mysql:host=localhost;dbname=tfg", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Verificar si el usuario existe
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE Nombre = :nombre");
            $stmt->execute([':nombre' => $username]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($usuario) {
                // El usuario existe, verificar contraseña
                if (password_verify($contra, $usuario["Contra"])) {
                    // Contraseña correcta, iniciar sesión
                    $_SESSION["user"] = $usuario["Nombre"]; 
                    $_SESSION["contra"] = $contra;
                    
                    header("Location: Menu.php");
                    exit();
                } else {
                    // Contraseña incorrecta
                    $_SESSION["error_message"] = "Nombre de usuario no disponible o contraseña errorenea";
                    header("Location: Main.php"); // Redirigir de vuelta al login
                    exit();
                }
            } else {
                // El usuario no existe, crear uno nuevo
                $codificada = password_hash($contra, PASSWORD_DEFAULT);
                
                $stm = $pdo->prepare("INSERT INTO usuarios (Nombre, Contra) VALUES (:user, :pass)");
                $stm->bindParam(":user", $username);
                $stm->bindParam(":pass", $codificada);
                
                if ($stm->execute()) {
                    
                    
                    // Iniciar sesión con el nuevo usuario
                    $_SESSION["user"] = $username;
                    $_SESSION["contra"] = $contra;
                    
                    header("Location: Menu.php");
                    exit();
                } else {
                    $_SESSION["error_message"] = "Error al crear el usuario";
                    header("Location: Main.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            $_SESSION["error_message"] = "Error de conexión: " . $e->getMessage();
            header("Location: Main.php");
            exit();
        }
    } else {
        $_SESSION["error_message"] = "Por favor, complete todos los campos";
        header("Location: Main.php");
        exit();
    }
} else {
    // Si no es una petición POST, redirigir
    header("Location: Main.php");
    exit();
}