<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- google foonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Federant&family=Libertinus+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <!-- font awesome (iconos con css) -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.min.css">
    <!-- css -->
    <link rel="preload" href="dist/css/app.css">
    <link rel="stylesheet" href="dist/css/app.css">
    <title>Whisky Bear</title>
</head>
<body>
    <div class="bg-dark contenedor-general">
        <div class="contenedor-agregarUsuario ">
           <picture class="imagenInicio">
                <source srcset="dist/img/imagenUsuarioNuevo.avif" type="image/avif">
                <source srcset="dist/img/imagenUsuarioNuevo.webp" type="image/webp">
                <img src="dist/img/imagenUsuarioNuevo.jpg" alt="inicio sesión">
            </picture>

               <form action="" class="formulario-usuarioNuevo">

                   <h1><span>Agregar</span> Usuario</h1>
                <input id="usuario" type="text" placeholder="Usuario">
                <input id="contrasena" type="password" placeholder="Contraseña">
                <input id="confirmarContrasena" type="password" placeholder="Confirmar Contraseña">
                <select id="rol" class="formulario-campo">
                        <option disabled selected>Rol</option>
                        <option value="vendedor">vendedor</option>
                        <option value="admin">admin</option>
                </select>
                <div class="formulario-botones">
                <a href="productos.php">Atras</a>
                <button id="btnConfirmar" type="submit">Confirmar</button>
                </div>

            </form>

        </div>
       

    </div>
    <?php include_once 'includesPHP/scripts.php'; ?>
    <script src="dist/js/usuarioNuevo.js"></script>
    
</body>
</html>