<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- // funcion para cambiar el tema al instante que se cargue la pagina -->
      <script>
    function cargar() {
      const tema = localStorage.getItem("tema") || "light";
      document.documentElement.setAttribute("data-bs-theme", tema);
    } cargar();
  </script>
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
<body >
    <header>
        <div class="contenedor-logo">
            <div class="contenedor-usuario-cerrar">
                <div class="contenedor-usuario">
                    <p class="texto-claro">usuario: <?php  echo $_SESSION['usuario']; ?></p>
                    <p class="texto-claro">Rol: <?php  echo $_SESSION['rol']; ?></p>
                </div>
                <div class="contenedor-cerrar">
                        <a href="src/php/funciones/sesion/cerrarSesion.php"><i class="fa-solid fa-right-from-bracket " style="color: #ff0000;"></i></a>
                        <p class="texto-cerrar">Cerrar Sesion</p>
                        
                </div>
            </div>
                
         <h1 class="logo-listados">Whisky Bear <span>cartago</span></h1>
         
            <div class="contenedor-usuarioNuevo">
                <a href="usuario_nuevo.php"><i class="fa-solid fa-user-plus fa-2xl" style="color: #000000" id="btnUsuario"></i></a>
                <p class="texto-claro">Añadir usuario</p>
                
            </div>
            <div class="contenedor-modo">
                <button class="btn rounded-fill" id="btnModo"><i class="fa-solid fa-moon fa-xl"></i></button>
            </div>
     </div>
         <div class="container-fluid p-0">
            <nav class="row m-0  py-4 bg-black text-center py-md-3">
                <a class="col-12 col-md-4 mt-0 pt-4 pb-4 p-md-0 text-white " id="producto" href="productos.php">productos</a>
                <a class="col-12 col-md-4  mt-2 mb-2 pt-4 pb-4 p-md-0  text-white " id="clientes" href="clientes.php">clientes</a>
                <a class="col-12 col-md-4 pt-4 pb-4 p-md-0  mb-4 mb-md-0 text-white " id="proveedores" href="proveedores.php">proveedores</a>
            </nav>
        </div>

    </header>
    <div class="contenedor-opciones">
        <h3 class="nuevo">Nuevo+</h3>
        <h3 class="modificar">Modificar</h3>
        <h3 class="listar">Listar</h3>
    </div>
                
                 <script src="dist/js/sesion.js"></script>
    




    