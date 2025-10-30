<?php
      require_once __DIR__ ."/../../classes/app.php";
    use App\modelos\Producto;


    try {
         $producto=Producto::obtenerTodos();
    $productos = [];
    foreach ($producto as $prod) {
        $productos[] = $prod->toArray();
    }

    echo json_encode($productos);
    return $productos;
        
    } catch (\Throwable $th) {
        echo $th;
    }


?>