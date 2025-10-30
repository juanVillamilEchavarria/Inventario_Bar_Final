<?php
  require_once __DIR__ ."/../../classes/app.php";
    use App\modelos\Usuario;

    
    try {
        // traer datos desde js

        if(!isset($_POST['usuario']) || !isset($_POST['contrasena'])){
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos"]);
            return;
        }

        // asignar variables
        $usuarioPost = $_POST['usuario'];
        $contrasena =  $_POST['contrasena'];

        $usuario=Usuario::findUsername($usuarioPost);
        if (!$usuario) {
            echo json_encode(array("exito" => false, "mensaje"=>"Usuario o contraseña incorrectos"));
            return;
        }
        $resultado=$usuario->toArray();
        // verificar contraseña
        $passwordDeshaheada=$usuario->verificarPassword($contrasena);
        
        $rol=$resultado['rol'];
            if ($passwordDeshaheada &&  $usuarioPost==$resultado['nombre_usuario']) {
                 session_start();
                 $_SESSION['usuario']=$usuarioPost;
                 $_SESSION['rol']=$rol; 
                echo json_encode(array("exito" => true, "rol"=>$rol));
            
            }else{
                echo json_encode(array("exito" => false, "mensaje"=>"Usuario o contraseña incorrectos"));
            
            }
            
    
    } catch (\Throwable $th) {
         echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
    }
    

?>