<?php

  function crearProveedor(){
   require_once '../../conexion/conexionDB.php';
   try {
    if (!isset($_POST['nombreProveedor'],$_POST['telefonoProveedor'],$_POST['correoProveedor'],$_POST['categoriaProveedor'],$_FILES['imagenProveedor'])) {
        echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos validos"]);
        return;
    }
    $nombre=$_POST['nombreProveedor'];
    $telefono=$_POST['telefonoProveedor'];
    $correo=$_POST['correoProveedor'];
    $categoria=$_POST['categoriaProveedor'];
    $imagen=file_get_contents($_FILES['imagenProveedor']['tmp_name']);
    $null=null;
    $sql="INSERT INTO proveedores(nombre,telefono,correo,categoria,imagen) VALUES(?,?,?,?,?)";
    $stmt=$db->prepare($sql);
    if (!$stmt) {
        echo json_encode(["exito"=>false,"mensaje"=>$db->error]);
        
    }
    $stmt->bind_param("ssssb",$nombre,$telefono,$correo,$categoria,$null);
    $stmt->send_long_data(4,$imagen);
    if (!$stmt->execute()) {
        echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
        
    }
    $stmt->close();
    echo json_encode(["exito"=>true,"mensaje"=>"Proveedor creado"]);
    
   
   } catch (\Throwable $th) {
    echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
   }
  }
crearProveedor();

?>