<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Federant&family=Libertinus+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/app.css">
    <title>Whisky Bear</title>

</head>
<body>
    <div class="container-fluid p-0" >
       <div class="row back-inicio g-0 vh-100">
        <div class="col-md-7 order-2 order-md-1 h-100">
            <picture class="imagenInicio">
                <source srcset="dist/img/imagenInicio.avif" type="image/avif">
                <source srcset="dist/img/imagenInicio.webp" type="image/webp">
                <img src="dist/img/imagenInicio.jpg" alt="inicio sesión">
            </picture>

        </div>

            <div class="col-md-5 order-1 order-md-2 m-0">
                <h1 class="logo-inicio">Whisky Bear <span>cartago</span></h1>
                <div class="contenedor-formulario">
                    <h2 class="titulo-formulario">Inventario</h2>
                    <form id="formularioLogin" class=" contenedor-formulario formulario" action="">
                        <input id="usuario" class="campo--input bg-dark" placeholder="Usuario" type="text">
                        <input id="contrasena" class="campo--input bg-dark" placeholder="Contraseña" type="password">
                        
                        <a id="botonInicio" class="btn btn-primary  rounded-4 p-4"  >Iniciar Sesion</a>
                        
                    </form>
                </div>
            </div>
            </div>


    </div>

    

    <script src="dist/js/script.js"></script>

</body>
</html>