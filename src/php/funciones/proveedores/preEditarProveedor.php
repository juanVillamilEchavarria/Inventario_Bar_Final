<?php

  function preEditarProveedor(){
    require_once "../conexion/conexionDB.php";
    try {
        $data=file_get_contents("php://input");
        if(empty($data)){
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
            return;
        }
     
        $input=json_decode($data,true);
        $id=(int)$input['idProveedorModificar'];

        $sql="SELECT nombre,telefono,correo,categoria FROM proveedores WHERE id= ?";
        $stmt=$db->prepare($sql);
        if(!$stmt){
            echo json_encode(["exito"=>false,"mensaje"=>"desde prepare".$db->error]);
            return;
        }
        $stmt->bind_param("i",$id);
        if(!$stmt->execute()){
            echo json_encode(["exito"=>false,"mensaje"=>"desde execute".$stmt->error]);
            return;
        }
        $resultado=$stmt->get_result();
        if($resultado->num_rows>0){
            $proveedor=$resultado->fetch_assoc();
            echo json_encode(["exito"=>true,"proveedor"=>$proveedor]);
        }
       
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
  }
  preEditarProveedor();

?>