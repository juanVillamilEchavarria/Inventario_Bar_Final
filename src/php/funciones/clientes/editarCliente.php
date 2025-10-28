<?php

  function editarCliente(){
    require_once '../../conexion/conexionDB.php';
    try {
      // traer datos
        $data=file_get_contents("php://input");
        if(empty($data)){
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
            return; 

        }
        $input=json_decode($data,true);
        // asignar variables
        $id=$input['idClienteModificar'];
        $nombre=$input['nombreClienteModificar'];
        $telefono=$input['telefonoClienteModificar'];
        $correo=$input['correoClienteModificar'];
        // validar
        if (!is_numeric($id) || $id <= 0) {
        echo json_encode(["exito" => false, "mensaje" => "ID inválido"]);
        return;
         }
        //  hacer consulta
        $sql="UPDATE clientes SET nombre=?,telefono=?,correo=? WHERE id=?;";
        $stmt=$db->prepare($sql);
        if (!$stmt) {
            echo json_encode(["exito"=>false,"mensaje"=>$db->error]);
            return;
        }
        $stmt->bind_param("sssi",$nombre,$telefono,$correo,$id);
        if (!$stmt->execute()) {
            echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
            return;
        }
        $stmt->close();
        echo json_encode(["exito"=>true,"mensaje"=>"Cliente modificado"]);
        
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
  }
  editarCliente();  

?>