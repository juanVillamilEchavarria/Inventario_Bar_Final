<?php 
// Este archivo es una plantilla de componente para ser incluida.
// Debe recibir las siguientes variables antes de ser incluido:
// $titulo: Título del formulario (ej: "Agregar Usuario", "Modificar Campos").
// $accion: Ruta del archivo que procesará el formulario (ej: "crear.php", "modificar.php").
// $errores: Array de errores para mostrar mensajes específicos.
// $usuario: Objeto Usuario con valores actuales (para precargar campos).
// $mostrarPassword: Booleano para mostrar/ocultar los campos de contraseña.
// $mostrarRol: Booleano para mostrar/ocultar el campo Rol.
// $textoBoton: Texto del botón principal (ej: "Confirmar", "Actualizar").

if (!isset($usuario)) {
    // Si el objeto no existe (ej. en Crear), creamos un placeholder
    $usuario = (object)['nombre_usuario' => '', 'rol' => ''];
}
?>

<div class="bg-dark contenedor-general">
    <div class="contenedor-agregarUsuario">
        
        <picture class="imagenInicio">
            <source srcset="/interGraficas/dist/img/imagenUsuarioNuevo.avif" type="image/avif">
            <source srcset="/interGraficas/dist/img/imagenUsuarioNuevo.webp" type="image/webp">
            <img src="/interGraficas/dist/img/imagenUsuarioNuevo.jpg" alt="inicio sesión">
        </picture>

        <!-- Formulario -->
        <form method="POST" class="formulario-usuarioNuevo">

            <h1 ><span class="<?php echo $claseSpan; ?>"><?php echo $span; ?></span> Usuario</h1>
            
            <?php if (isset($error) && $error >= 4): ?>
                <p class="error">Los campos no pueden estar vacíos</p>
            <?php endif; ?>

      
            <?php if (isset($mostrarNombre) && $mostrarNombre === true): ?>
            <input id="usuario" name="nombre_usuario" type="text" placeholder="Usuario" value="<?php echo htmlspecialchars($usuario->nombre_usuario ?? ''); ?>">
            <?php if (!empty($errores['nombre_usuario']) && $error < 4): ?>
                <p class="error">El nombre de usuario es obligatorio</p>
            <?php endif; ?>
            <?php endif; ?>

      
            <?php if (isset($mostrarPassword) && $mostrarPassword === true): ?>
                <input id="contrasena" name="contrasena" type="password" placeholder="Contraseña">
                <?php if (!empty($errores['password']) && $error < 4): ?>
                    <p class="error">El password es obligatorio</p>
                <?php endif; ?>
                <input id="confirmarContrasena" name="confirmarContrasena" type="password" placeholder="Confirmar Contraseña">
                <?php if (!empty($errores['confirmarContrasena']) && $error < 4): ?>
                    <p class="error">Las contraseñas no coinciden</p>
                <?php endif; ?>
            <?php endif; ?>
            

            <?php if (isset($mostrarRol) && $mostrarRol === true): ?>
                <select id="rol" name="rol" class="formulario-campo">
                    <option disabled selected>Rol</option>
                    <option <?php echo ($usuario->rol === 'vendedor' ? 'selected' : ''); ?> value="vendedor">vendedor</option>
                    <option <?php echo ($usuario->rol === 'admin' ? 'selected' : ''); ?> value="admin">admin</option>
                </select>
                <?php if (!empty($errores['rol']) && $error < 4): ?>
                    <p class="error">El rol es obligatorio</p>
                <?php endif; ?>
            <?php endif; ?>
            
            <!-- BOTONES -->
            <div class="formulario-botones">
                <a href="/interGraficas/admin/index.php">Atrás</a>
                <button class="<?php echo $claseBoton; ?>" id="btnConfirmar" type="submit">Confirmar</button>
            </div>
        </form>
    </div>
</div>
