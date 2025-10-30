<?php
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Cliente;
   

    try {
        if(!isset($_POST["nombreCliente"]) || !isset($_POST["correoCliente"]) || !isset($_POST["telefonoCliente"])){
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
            return;
        }
        $cliente = new Cliente($_POST);
        if($cliente->nombre===false){
            echo json_encode(["exito"=>false,"mensaje"=>"El nombre es obligatorio"]);
        }
        if($cliente->correo===false){
            echo json_encode(["exito"=>false,"mensaje"=>"El correo es obligatorio"]);
        }
        if($cliente->telefono===false){
            echo json_encode(["exito"=>false,"mensaje"=>"El telefono es obligatorio"]);
        }
        if(!$cliente->crear()){
            echo json_encode(["exito"=>false,"mensaje"=>"Error al crear el cliente"]);
        }
        echo json_encode(["exito"=>true,"mensaje"=>"Cliente creado"]);
    } catch (\Throwable $th) {
       echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }


