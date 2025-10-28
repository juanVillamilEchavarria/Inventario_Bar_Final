<?php

function encriptarPassword($passwordPlano){
    try {

        require __DIR__ ."/../conexion/conexionDB.php";

      return password_hash($passwordPlano, PASSWORD_DEFAULT);
    
    } catch (\Throwable $th) {
       echo($th);
    }
    
}   

?>