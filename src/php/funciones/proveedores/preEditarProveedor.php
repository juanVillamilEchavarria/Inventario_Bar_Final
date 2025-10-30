<?php
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Proveedor;

    try {
        if (!isset($_POST["idProveedorModificar"])) {
            echo json_encode(["exito" => false, "mensaje" => "No se recibieron datos"]);
            return;
        }
        $idProveedor = $_POST["idProveedorModificar"];
        $proveedor = Proveedor::find($idProveedor);
        $proveedor = $proveedor->toArray();
        echo json_encode(["exito" => true, "proveedor" => $proveedor]);
       
    } catch (\Throwable $th) {
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
