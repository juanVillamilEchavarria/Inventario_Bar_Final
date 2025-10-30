<?php
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Proveedor;



    try {
        $proveedor=Proveedor::obtenerTodos();
        $proveedores=[];
        foreach($proveedor as $prov){
            $proveedores[]=$prov->toArray();
        }

        echo json_encode($proveedores);
        return $proveedores;
        
    } catch (\Throwable $th) {
        echo $th;
    }
