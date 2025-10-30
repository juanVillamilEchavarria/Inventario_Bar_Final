<?php
ob_start();
require_once __DIR__ ."/../../classes/app.php";

use App\modelos\Producto;
    try {
       if(!isset($_POST["idProductoEliminar"])){
        ob_end_clean();
        echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
        exit;
    }
    $id=$_POST["idProductoEliminar"];
    $producto=Producto::find($id);
    if (!$producto) {
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => "El producto con ID {$id} no existe."]);
        exit;
    }
    $producto->eliminarImagen();
    if (!$producto->eliminar()) {
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => "Error al eliminar el producto."]);
        exit;
    }
    ob_end_clean();
    echo json_encode(["exito"=>true,"mensaje"=>"Producto eliminado"]);
        
    } catch (\Throwable $th) {
        ob_end_clean();
        echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
    

