<?php

function tablaClientes(){
     require_once __DIR__ ."/../../conexion/conexionDB.php";

    try {
         $sql = "SELECT * FROM clientes where id > ?";
         $stmt= mysqli_prepare($db,$sql);
           if(!$stmt){
            throw new Exception("Error al preparar la consulta: " . mysqli_error($db));
        }
        $minId = 0;
        mysqli_stmt_bind_param($stmt, "i", $minId);
        mysqli_stmt_execute($stmt);
    $consulta = mysqli_stmt_get_result($stmt);
    $clientes = mysqli_fetch_all($consulta,MYSQLI_ASSOC);
   
    echo json_encode($clientes);
    return $clientes;
        
    } catch (\Throwable $th) {
        echo $th;
    }
}   
tablaClientes();

?>