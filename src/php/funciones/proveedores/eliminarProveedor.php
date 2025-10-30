<?php
ob_start();
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Proveedor;

    try {
        if (!isset($_POST["idProveedorEliminar"])) {
            ob_end_clean();
            echo json_encode(["exito" => false, "mensaje" => "No se recibieron datos"]);
            exit;
        }
        $idProveedor= $_POST["idProveedorEliminar"];
        $proveedor = Proveedor::find($idProveedor);
        if (!$proveedor) {
            ob_end_clean();
            echo json_encode(["exito" => false, "mensaje" => "El proveedor con ID {$idProveedor} no existe."]);
            exit;
        }
        $proveedor->eliminarImagen();
        if (!$proveedor->eliminar()) {
            ob_end_clean();
            echo json_encode(["exito" => false, "mensaje" => "Error al eliminar el proveedor."]);
            exit;
        }
        ob_end_clean();
        echo json_encode(["exito" => true, "mensaje" => "Proveedor eliminado"]);
        
    } catch (\Throwable $th) {
        ob_end_clean();
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
    
