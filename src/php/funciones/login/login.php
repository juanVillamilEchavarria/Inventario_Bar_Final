<?php

 function verificarInicio(){
    
    try {
        require __DIR__   . "/../../conexion/conexionDB.php";
        $db=conectarDB();

        // traer datos desde js

        $data= file_get_contents("php://input");
        $input = json_decode($data, true);

        // validar que lleguen datos de js

          if (!$input || !isset($input["usuario"], $input["contrasena"])) {
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos validos"]);
            return;
        }

        // asignar variables
        $usuario = $input['usuario'];
        $contrasena =  $input['contrasena'];

        // hacer consulta
            $sql="SELECT * FROM usuarios WHERE nombre_usuario= ?;";
            $stmt=$db->prepare($sql);
            $stmt->execute([$usuario]);
            if (!$stmt) {
                echo json_encode(["exito"=>false,"mensaje"=>$db->errorInfo()]);
                return;
            }
            $resultado=$stmt->fetch(PDO::FETCH_ASSOC);
        // validar si existe el usuario
             if (!$resultado) {
            echo json_encode(["exito"=>false,"mensaje"=>"Usuario no encontrado"]);
            return;
                
        }
        // verificar contraseña
            $password=$resultado['contraseña'];
            $rol=$resultado['rol'];
            $passwordDeshaheada=password_verify($contrasena,$password);
            if ($passwordDeshaheada &&  $usuario==$resultado['nombre_usuario']) {
                 session_start();
                 $_SESSION['usuario']=$usuario;
                 $_SESSION['rol']=$rol; 
                echo json_encode(array("exito" => true, "rol"=>$rol));
            
            }else{
                echo json_encode(array("exito" => false, "mensaje"=>"Usuario o contraseña incorrectos"));
            
            }
            
    
    } catch (\Throwable $th) {
         echo json_encode(["exito"=>false,"error"=>$th->getMessage()]);
    }
    
 }
verificarInicio();
?>