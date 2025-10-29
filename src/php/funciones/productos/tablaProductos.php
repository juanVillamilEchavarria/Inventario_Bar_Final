<?php

function tablaProductos(){
     require_once __DIR__ ."/../../conexion/conexionDB.php";
     $db=conectarDB();

    try {
         $sql = "SELECT * FROM productos";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($productos as $key => $producto) {
    if (isset($producto['imagen']) && $producto['imagen'] !== null) {
        $productos[$key]['imagen_base64'] = base64_encode($producto['imagen']);
    } else {
        $productos[$key]['imagen_base64'] = null;
    }
    unset($productos[$key]['imagen']);
}

    echo json_encode($productos);
    return $productos;
        
    } catch (\Throwable $th) {
        echo $th;
    }
}   
tablaProductos();

?>