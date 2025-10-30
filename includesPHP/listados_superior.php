<?php
require_once 'src/php/funciones/sesion/sesion.php';
iniciarSesion();
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
        <div class=" contenedor-superior">
            <h1 class="logo-listados">Whisky Bear <span>cartago</span></h1>
            <div class="superior-derecha">
                  <nav class="navegacion-principal">
                      <a id="producto" href="productos.php">productos</a>
                      <a id="clientes" href="clientes.php">clientes</a>
                      <a id="proveedores" href="proveedores.php">proveedores</a>
                  </nav>
                  <div class="contenedor-modo">
                      <button class="btn rounded-fill" id="btnModo"><i class="fa-solid fa-moon fa-xl" style="color: #ffffffff;"></i></button>
                  </div>

            </div> 
       </div>
       <div class="contenedor-usuario">
                  <div class="menu-cerrar">
                      <i class="fa-solid fa-bars  fa-xl" style="color: #ffffffff;"></i>
                        <div class="contenido-menu">
                          <div class="contenedor-usuarioNuevo no-display">
                              <a href="usuario_nuevo.php"><i class="fa-solid fa-user-plus fa-xl" style="color: #ffffffff" id="btnUsuario"></i></a>
                              <p>Añadir usuario</p>
                              
                          </div>
                          <ul class="contenedor-info-usuario no-display">
                            <li><p>usuario: <?php  echo $_SESSION['usuario']; ?></p></li>
                            <li><p>rol: <?php  echo $_SESSION['rol']; ?></p></li>
                            <div class="contenedor-cerrar">
                                <a href="src/php/funciones/sesion/cerrarSesion.php"><i class="fa-solid fa-right-from-bracket " style="color: #ff0000;"></i></a>
                                <p class="texto-cerrar">Cerrar Sesion</p>
                            
                            </div>
                          </ul>
                          

                      </div>
                        
                      
                  </div>
                  
        </div>
        

    </header>
    <div class="contenedor-opciones">
        <h3 class="nuevo">Nuevo+</h3>
        <h3 class="modificar btn-azul">Modificar</h3>

    </div>
                
                 <script src="dist/js/sesion/sesion.js"></script>
    




    