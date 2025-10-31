<?php
require_once __DIR__. '/../../src/php/funciones/admin_usuarios/crearUsuario.php';
require_once __DIR__.'/../../src/php/funciones/sesion/sesion.php';
iniciarSesion();
$span = "Agregar";// El archivo actual que procesa
$mostrarNombre = true;   // Mostrar campo de nombre
$mostrarPassword = true; // Mostrar campos de contraseña
$mostrarRol = true;      // Mostrar campo de rol
$color = "";
$colorBoton = ""; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once '../../includesPHP/admin_templates/head.php'; ?>
</head>
<body>

    <?php include_once '../../includesPHP/admin_templates/formularioBase.php'; ?>
    <?php include_once '../../includesPHP/scripts.php'; ?>
          <script src="../../dist/js/admin/mensajes.js"></script>
    
</body>
</html>