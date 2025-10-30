<?php
   require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Cliente;
    try {


      if(!isset($_POST["idClienteModificar"]) || !isset($_POST["nombreClienteModificar"]) || !isset($_POST["correoClienteModificar"]) || !isset($_POST["telefonoClienteModificar"])){
          echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
          return;

      }
     $cliente= new Cliente($_POST);

     if($cliente->id===false){
        echo json_encode(["exito"=>false,"mensaje"=>"El id es obligatorio"]);
     }
     if($cliente->nombre===false){
        echo json_encode(["exito"=>false,"mensaje"=>"El nombre es obligatorio"]);
     }
     if($cliente->correo===false){
        echo json_encode(["exito"=>false,"mensaje"=>"El correo es obligatorio"]);
     }
     if($cliente->telefono===false){
        echo json_encode(["exito"=>false,"mensaje"=>"El telefono es obligatorio"]);
     }
     if(!$cliente->actualizar()){
        echo json_encode(["exito"=>false,"mensaje"=>"Error al editar el cliente"]);
     }
     
     echo json_encode(["exito"=>true,"mensaje"=>"Cliente editado"]);
      
        
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    } 