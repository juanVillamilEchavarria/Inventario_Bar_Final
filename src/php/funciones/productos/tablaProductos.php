<?php

function tablaProductos(){
     require_once __DIR__ ."/../conexion/conexionDB.php";

    try {
         $sql = "SELECT * FROM productos";
    $consulta = mysqli_query($db,$sql);
    $productos = mysqli_fetch_all($consulta,MYSQLI_ASSOC);
    foreach ($productos as &$producto) {
        $producto['precio'] = number_format($producto['precio'], 0, ',', '.');
            if (!empty($producto['imagen'])) {
                $producto['imagen'] = base64_encode($producto['imagen']);
            }
        }

    echo json_encode($productos);
    return $productos;
        
    } catch (\Throwable $th) {
        echo $th;
    }
}   
tablaProductos();

?>