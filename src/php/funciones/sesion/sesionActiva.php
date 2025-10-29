<?php

require_once 'sesion.php';

function sesionActiva(){
    $sesionActiva=iniciarSesion();
    if ($sesionActiva) {
        echo json_encode(["exito" => true, "usuario" => $_SESSION['usuario'], "rol" => $_SESSION['rol']]);
    }else{
        echo json_encode(["exito" => false]);
    }
    
}

sesionActiva();
