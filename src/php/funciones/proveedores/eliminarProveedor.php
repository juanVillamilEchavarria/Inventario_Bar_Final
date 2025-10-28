<?php

 function eliminarProveedor(){
    require_once '../conexion/conexionDB.php';
    try {
        $data=file_get_contents("php://input");
    if (!$data) {
      echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos validos"]);
      return;
    }
    $input=json_decode($data,true);
    if (!isset($input['idProveedorEliminar']) || !is_numeric($input['idProveedorEliminar'])) {
        echo json_encode(["exito" => false, "mensaje" => "ID de proveedor inválido"]);
        return;
    }

    $id = $input['idProveedorEliminar'];

    $sql = "DELETE FROM proveedores WHERE id = ?";
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
    echo json_encode(["exito"=>true,"mensaje"=>"Proveedor eliminado exitosamente"]);
        
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
    
 }
 eliminarProveedor();

?>