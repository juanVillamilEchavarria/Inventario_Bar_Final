<?php

 function crearCliente(){   
    require_once '../conexion/conexionDB.php';
    try {
        $data=file_get_contents("php://input");
        $input=json_decode($data,true);
        $nombre=$input['nombreCliente'];
        $telefono=$input['telefonoCliente'];
        $correo=$input['correoCliente'];
        $sql="INSERT INTO clientes (nombre,telefono,correo) VALUES(?,?,?)";
        $stmt=$db->prepare($sql);
        if (!$stmt) {
            echo json_encode(["exito"=>false,"mensaje"=>$db->error]);
            return;
        }
        $stmt->bind_param("sss",$nombre,$telefono,$correo);
        if (!$stmt->execute()) {
            echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
            return;
        }
        $stmt->close();
        echo json_encode(["exito"=>true,"mensaje"=>"Cliente creado"]);
        
    } catch (\Throwable $th) {
       echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
 }
 crearCliente();

?>