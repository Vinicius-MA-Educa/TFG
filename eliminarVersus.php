<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

session_start();

include './LiberiaPHP/Funciones.php';

eliminarMulti($_SESSION["user"]);

header("Location: Menu.php");