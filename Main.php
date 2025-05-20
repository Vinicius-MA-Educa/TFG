<?php
session_start();
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="Estilo/Login.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Roboto+Serif:ital,opsz,wght@0,8..144,100..900;1,8..144,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #2c3e50;
            }
        </style>
    </head>
    <body>
        <h1 class="titulo">GEOGUIZZ ONLINE</h1>
        <div class="container centrado  my-5">
            <div class="row justify-content-center">
                <div class="col-10 d-flex text-center fondo">
                    <div class="container "> 
                        <div class="row justify-content-center">
                            <div class="col-4">


                            </div>
                            <div class="col-4">
                                <!-- Sección para mostrar mensajes -->
                                <?php if (isset($_SESSION["error_message"])): ?>
                                    <div class="alert alert-danger">
                                        <?php
                                        echo $_SESSION["error_message"];
                                        unset($_SESSION["error_message"]); // Limpiar mensaje después de mostrarlo
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <form class="needs-validation text-center" action="InicioSesion.php" method="post" novalidate>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Usuario</label>
                                        <input type="text" class="form-control text-center" name="user" id="exampleFormControlInput1" required>
                                        <div class="invalid-feedback">
                                            No puede estar vacio
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput2" class="form-label">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control text-center" name="contra" id="exampleFormControlInput2" required/>
                                            <button class="btn btn-light" type="button" id="button-addon2"><i class="bi bi-eye"></i></button>
                                        </div>

                                        <div class="invalid-feedback">
                                            No puede estar vacio
                                        </div>
                                    </div>
                                    <div class="my-3 d-flex text-center justify-content-center align-items-center">
                                        <button type="submit" class="btn btn-custom2">Login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
            <script>
                const mostrar = document.getElementById("button-addon2");
                const contra = document.getElementById("exampleFormControlInput2");

                function mostrarContra() {
                    contra.type = "text";
                    console.log("Boton pulsado")
                }

                function ocultarContra() {
                    contra.type = "password";
                    console.log("Boton despulsado")
                }
                mostrar.addEventListener('mousedown', mostrarContra);
                mostrar.addEventListener('mouseup', ocultarContra);
                mostrar.addEventListener('mouseleave', ocultarContra);

            </script>
    </body>
</html>
