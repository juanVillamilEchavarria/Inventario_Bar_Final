<?php
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Cliente;
    try {
        if(!isset($_POST["idClienteModificar"])){
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
            return;
        }
        $idCliente=$_POST['idClienteModificar'];
        $cliente=Cliente::find($idCliente);
        $cliente=$cliente->toArray();
        echo json_encode(["exito" => true, "cliente" => $cliente]);
        
    } catch (\Throwable $th) {
       echo json_encode(["exito"=>false,"mensaje"=>"desde catch".$th->getMessage()]);
    }
