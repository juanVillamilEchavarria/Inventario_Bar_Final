<?php
require_once __DIR__ .'/../../classes/app.php';
use App\modelos\Usuario;

$usuario = Usuario::findId($_GET['id']);

$errores=[];
$error=0;

if($_SERVER['REQUEST_METHOD']==='POST'){
    $usuario->sincronizar($_POST);
    if($usuario->contrasena===false){
        $errores['password']="El password es obligatorio";
        $error++;
    }
    if($usuario->contrasena!==$_POST['confirmarContrasena']){
        $errores['confirmarContrasena']="Las contrasenas no coinciden";
        $error++;
    }
    if(empty($errores)){
    
        $resultado=$usuario->modificarContrasena($_POST['contrasena']);
        if($resultado){
            header('Location: /interGraficas/admin/index.php?resultado=3');
        }else{
            header('Location: /interGraficas/admin/index.php?error=3');
        }
    }

}