<?php
   require_once __DIR__ ."/../../classes/app.php";

use App\modelos\Producto;
    try {
        $idProducto=$_POST['idProductoModificar'];
       
      $producto= Producto::find($idProducto);
      $producto=$producto->toArray();
        echo json_encode(["exito" => true, "producto" => $producto]);

           
        


        //code...
    } catch (\Throwable $th) {
        echo json_encode(["exito" => false, "mensaje" => $th->getMessage()]);
        //throw $th;
    }
   


?>