
<?php

function eliminarCliente() {
    require_once '../../conexion/conexionDB.php';
    try {

        $data=file_get_contents("php://input");
        if(empty($data)){
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
            return; 

        }
        $input=json_decode($data,true);
        $id=$input['idClienteEliminar'];
         if (!is_numeric($id) || $id <= 0) {
        echo json_encode(["exito" => false, "mensaje" => "ID inválido"]);
        return;
         }
        $sql="DELETE FROM clientes WHERE id=?";
        $stmt=$db->prepare($sql);
        if(!$stmt){
            echo json_encode(["exito"=>false,"mensaje"=>$db->error]);
            return;
        }
        $stmt->bind_param("i",$id);
        if(!$stmt->execute()){
            echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
            return;

        }
        $stmt->close();
        echo json_encode(["exito"=>true,"mensaje"=>"Cliente Eliminado"]);


        
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
        return;
    }

}
eliminarCliente();
?>