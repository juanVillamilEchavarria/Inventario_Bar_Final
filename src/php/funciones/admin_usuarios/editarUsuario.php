<?php
require_once __DIR__ .'/../../classes/app.php';
use App\modelos\Usuario;

$usuario = Usuario::findId($_GET['id']);

$errores=[];
$error=0;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $usuario->sincronizar($_POST);
    if($usuario->nombre_usuario===false){
        $errores['nombre_usuario']="El nombre de usuario es obligatorio";
        $error++;
    }
    if($usuario->rol===false){
        $errores['rol']="El rol es obligatorio";
        $error++;
    }
    if(empty($errores)){
        $resultado=$usuario->modificarCampos();
         if($resultado){
            header('Location: /interGraficas/admin/index.php?resultado=2');
        }else{
            header('Location: /interGraficas/admin/index.php?error=2');
        }
    }


}