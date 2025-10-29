<?php

function tablaClientes(){
     require_once __DIR__ ."/../../conexion/conexionDB.php";

    try {
         $sql = "SELECT * FROM clientes where id > ?";
         $stmt = $db->prepare($sql);
         $stmt->execute([0]);
         $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

   
    echo json_encode($clientes);
    return $clientes;
        
    } catch (\Throwable $th) {
        echo $th;
    }
}   
tablaClientes();

?>