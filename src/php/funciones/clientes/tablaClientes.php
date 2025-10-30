<?php
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Cliente;
   

    try {
         $cliente = Cliente::obtenerTodos();
    
       
         $clientes = [];
         foreach($cliente as $cli){
             
             $clientes[] = $cli->toArray();
             
         }
    echo json_encode($clientes);
    return $clientes;

    } catch (\Throwable $th) {
        echo $th->getMessage();
    }

