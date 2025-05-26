<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

function getConexion() {
    try {
        // crear conexion
        $conexion = new PDO("mysql:host=localhost;dbname=tfg", "root", "");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $conexion = null;
        error_log("ERROR Conexion DAO: " . $e->getMessage());
        // die();
    }
    return $conexion;
}

function paisAleatorio() {
    $pdo= getConexion();
    $sql = "SELECT * FROM pais ORDER BY RAND() LIMIT 1";
    $stmt = $pdo->query($sql);
    $pais = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pais) {
        die("No se encontraron países.");
    }
    return $pais;
}

function sacarUsuario($nombre){
    $pdo= getConexion();
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE Nombre = :nombre LIMIT 1");

    // Ejecutar con parámetros
    $stmt->execute([
        ':nombre' => $nombre,
    ]);

    // Obtener los resultados
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $usuario;
}
function sacarUsuarioOnline($nombre){
    $pdo = getConexion();
    $stmt = $pdo->prepare("SELECT * FROM versus WHERE Nombre1 = :nombre OR Nombre2 = :nombre");
    $stmt->execute([':nombre' => $nombre]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $usuario;
}

function tieneMulti($nombre) {
    $pdo = getConexion();
    $stmt = $pdo->prepare("SELECT * FROM versus WHERE Nombre1 = :nombre OR Nombre2 = :nombre");
    $stmt->execute([':nombre' => $nombre]);

    return (bool) $stmt->fetch();
}


function eliminarMulti($nombre) {
    $pdo = getConexion();
    $stmt = $pdo->prepare("DELETE FROM versus WHERE Nombre1 = :nombre OR Nombre2 = :nombre");
    $stmt->execute([':nombre' => $nombre]);

}

// Función para normalizar texto (eliminar acentos)
function normalizeString($string) {
    // Convertir a minúsculas primero
    $string = strtolower($string);

    // Eliminar acentos
    $unwanted_array = array(
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u',
        'ñ' => 'n'
    );
    return strtr($string, $unwanted_array);
}

function sacarRazon(){
    $pdo= getConexion();
    
    $sql = "SELECT 
        ag.razon,
        ag.pais1, ag.pais2, ag.pais3, ag.pais4,
        p1.nombre AS nombre_1, p1.url_imagen AS bandera_1,
        p2.nombre AS nombre_2, p2.url_imagen AS bandera_2,
        p3.nombre AS nombre_3, p3.url_imagen AS bandera_3,
        p4.nombre AS nombre_4, p4.url_imagen AS bandera_4
    FROM 
        agrupacion_paises ag
    JOIN 
        pais p1 ON ag.pais1 = p1.cnn3m
    JOIN 
        pais p2 ON ag.pais2 = p2.cnn3m
    JOIN 
        pais p3 ON ag.pais3 = p3.cnn3m
    JOIN 
        pais p4 ON ag.pais4 = p4.cnn3m
    ORDER BY 
        RAND() 
    LIMIT 4";

    $stmt = $pdo->query($sql);
    $agrupaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $agrupaciones;
}