<?php
require_once __DIR__ .'/../../classes/app.php';
use App\modelos\Usuario;

$usuario = new Usuario();

$errores=[];
$error=0;


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario = new Usuario($_POST);

    if($usuario->nombre_usuario===false){
        $errores['nombre_usuario']="El nombre de usuario es obligatorio";
        $error++;
    }
    if($usuario->contrasena===false){
        $errores['password']="El password es obligatorio";
        $error++;
    }
    if($usuario->contrasena!==$_POST['confirmarContrasena']){
        $errores['confirmarContrasena']="Las contrasenas no coinciden";
        $error++;
    }
    if($usuario->rol===false){
        $errores['rol']="El rol es obligatorio";
        $error++;
    }
    if(empty($errores)){
        $resultado = $usuario->crear();
        if($resultado){
            header('Location: /interGraficas/admin/index.php?resultado=1');
        }else{
            header('Location: /interGraficas/admin/index.php?error=1');
        }
    }
   

}