<?php

function tablaProveedores(){
     require_once __DIR__ ."/../conexion/conexionDB.php";

    try {
         $sql = "SELECT * FROM proveedores";
    $consulta = mysqli_query($db,$sql);
    $proveedores = mysqli_fetch_all($consulta,MYSQLI_ASSOC);
    foreach ($proveedores as &$proveedor) {
            if (!empty($proveedor['imagen'])) {
                $proveedor['imagen'] = base64_encode($proveedor['imagen']);
            }
        }
    echo json_encode($proveedores);
    return $proveedores;
        
    } catch (\Throwable $th) {
        echo $th;
    }
}   
tablaProveedores();

?>