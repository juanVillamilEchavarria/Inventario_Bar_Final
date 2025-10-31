<?php
require_once __DIR__ .'/../../classes/app.php';
use App\modelos\Usuario;



if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_POST['idUsuarioEliminar'];
    $usuario = Usuario::findId($_POST['idUsuarioEliminar']);

    $resultado = $usuario->eliminar();
    if($resultado){
        header('Location: /interGraficas/admin/index.php?resultado=4');
    }else{
        header('Location: /interGraficas/admin/index.php?error=4');
    }
    
    
}
