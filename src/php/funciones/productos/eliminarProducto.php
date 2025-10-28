<?php

  function eliminarProducto(){
    require_once '../conexion/conexionDB.php';
    try {
        $data=file_get_contents("php://input");
    if (!$data) {
      echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos validos"]);
      return;
    }
    $input=json_decode($data,true);
    if (!isset($input['idProductoEliminar']) || !is_numeric($input['idProductoEliminar'])) {
        echo json_encode(["exito" => false, "mensaje" => "ID de producto inválido"]);
        return;
    }

    $id = $input['idProductoEliminar'];

    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $db->prepare($sql);
    if (!$stmt) {
      echo json_encode(["exito"=>false,"mensaje"=>$db->error]);
      return;
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
      echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
      return;
    }
    $stmt->close();
    echo json_encode(["exito"=>true,"mensaje"=>"Producto eliminado"]);
        
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
    
  }
  eliminarProducto();
?>