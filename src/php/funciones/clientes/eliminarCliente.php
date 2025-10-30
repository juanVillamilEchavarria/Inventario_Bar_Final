
<?php

  require_once __DIR__ ."/../../classes/app.php";
    use App\modelos\Cliente;
    try {
         if(!isset($_POST["idClienteEliminar"])){
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
            return;
        }
        $cliente=Cliente::find($_POST['idClienteEliminar']);
        if (!$cliente) {
            echo json_encode(["exito" => false, "mensaje" => "El cliente con ID {$_POST['idClienteEliminar']} no existe."]);
            return;
        }
        if (!$cliente->eliminar()) {
            echo json_encode(["exito" => false, "mensaje" => "Error al eliminar el cliente."]);
            return;
        }
        echo json_encode(["exito"=>true,"mensaje"=>"Cliente eliminado"]);

        
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
        return;
    }

