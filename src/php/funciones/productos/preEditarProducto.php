<?php

function preEditarProducto(){
    require_once '../conexion/conexionDB.php';
    try {

      $idProducto = (int)$_POST["idProductoModificar"];
       
        $sql = "SELECT id, nombre, precio, stock FROM productos WHERE id = ?";
        $stmt = $db->prepare($sql);
         if (!$stmt) {
            echo json_encode(["exito" => false, "mensaje" => $db->error]);
            return;
        }
        $stmt->bind_param("i",$idProducto);
        if (!$stmt->execute()) {
            echo json_encode(["exito" => false, "mensaje" => $stmt->error]);
            return;
        }
        $resultado=$stmt->get_result();
         if ($resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();


            echo json_encode(["exito" => true, "producto" => $producto]);
        } else {
            echo json_encode(["exito" => false, "mensaje" => "Producto no encontrado"]);
        }


        //code...
    } catch (\Throwable $th) {
        echo json_encode(["exito" => false, "mensaje" => $th->getMessage()]);
        //throw $th;
    }
   
}
preEditarProducto();

?>