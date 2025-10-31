<?php
require_once '../src/php/funciones/admin_usuarios/indexAdminUsuario.php';
require_once '../src/php/funciones/admin_usuarios/eliminarUsuario.php';


?>

<main>
    <!-- mensajes de exito -->
    <?php switch($resultado): case 1: ?>
        <h3 class="exitoso">Usuario creado correctamente</h3>
    <?php break; case 2: ?>
        <h3 class="exitoso">Usuario modificado correctamente</h3>
    <?php break; case 3: ?>
        <h3 class="exitoso">Contraseña modificada correctamente</h3>
    <?php break; case 4: ?>
        <h3 class="exitoso">Usuario eliminado correctamente</h3>
    <?php break; endswitch; ?>

    <!-- errores -->
     <?php switch($errorQuery): case 1: ?>
        <h3 class="error">Error al crear el usuario</h3>
    <?php break; case 2: ?>
        <h3 class="error">Error al modificar el usuario</h3>
    <?php break; case 3: ?>
        <h3 class="error">Error al modificar la contrasena</h3>
    <?php break; case 4: ?>
        <h3 class="error">Error al eliminar el usuario</h3>
    <?php break; endswitch; ?>
    


    <section class="contenedor">
        <table class="tabla-users">
            <thead>
                <tr>
                    <th class="text-center">id</th>
                    <th class="text-center">usuario</th>
                    <th class="text-center">rol</th>
                    <th class="text-center">acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td class="text-center"><?=$usuario->id?></td>
                        <td class="text-center"><?=$usuario->nombre_usuario?></td>
                        <td class="text-center"><?=$usuario->rol?></td>
                        <td class="text-center">
                            
                            <a href="propiedades/usuario_editar.php?id=<?=$usuario->id?>"><i class="fa-solid fa-pen" style="color: #3b69ffff;"></i></a>
                            <?php if($usuario->rol !== 'admin' && $_SESSION['usuario'] !== $usuario->nombre_usuario): ?>
                          
                            <button class="eliminar-user" id="eliminar-user"><i class="fa-solid fa-trash" style="color: #fa1818ff;"></i></button>
                              <a href="propiedades/usuario_editar_password.php?id=<?=$usuario->id?>"><i class="fa-solid fa-key" style="color: #FFD43B;"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </section>
    <!-- modal eliminar -->
    <div class="modal fade " data-bs-backdrop="static" id="modalEliminarUsuario" tabindex="-1" aria-labelledby="modalUsuarioProductoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarUsuarioLabel"><span class="text-danger">Eliminar</span> Usuario</h5>
                
                </div>
            <form method="POST" >
                <div class="modal-body">
                    <p class="eliminar">¿Está seguro de eliminar este Usuario?</p>
                    <input type="hidden" name="idUsuarioEliminar" value="<?php echo $usuario->id?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
                </div>
            </div>
            </form>
    </div>
    <?php include_once '../includesPHP/scripts.php'; ?>
             <script src="../dist/js/temaPagina/modoOscuro.js"></script>
             <script src="../dist/js/admin/mensajes.js"></script>
             <script src="../dist/js/admin/eliminarUsuario.js"></script>
            <script src="../dist/js/sesion/menuCerrar.js"></script>

</main>
