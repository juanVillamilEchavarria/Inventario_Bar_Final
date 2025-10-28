<?php


function usuarioNuevo(){
    require_once __DIR__ ."/../conexion/conexionDB.php";
    require_once __DIR__ ."/../funciones/password.php";
    try{
        // traer datos desde js
        $data= file_get_contents("php://input");
        $input = json_decode($data, true);
        // validar
        if (!$input || !isset($input["usuario"], $input["contrasena"], $input["confirmarContrasena"], $input["rol"])) {
            echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos validos"]);
            return;
        }
        // asignar variables
        $usuario = $input['usuario'];
        $contrasena = $input['contrasena'];
        $confirmarContrasena = $input['confirmarContrasena'];
        $rol = $input['rol'];
        // validar contraseña
            if ($input['contrasena'] !== $input['confirmarContrasena']) {
                    echo json_encode(["exito"=>false,"mensaje"=>"Las contraseñas no coinciden"]);
                    return;
                }
            $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
            $stmt = $db->prepare($sql);
            if (!$stmt) {
                echo json_encode(["exito"=>false,"mensaje"=>$db->error]);
                return;
            }
            $stmt->bind_param("s", $usuario);
            if (!$stmt->execute()) {
                echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
                return;
            }
            $resultado = $stmt->get_result();
            if ($resultado->num_rows > 0) {
                echo json_encode(["exito"=>false,"mensaje"=>"El usuario ya existe"]);
                return;
            }
        // hashear contraseña
        $contrasenaHash = encriptarPassword($contrasena);
        // insertar
        $sql = "INSERT INTO usuarios (nombre_usuario, `contraseña`, rol) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
         // validar error
        if (!$stmt) {
            echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
            return;
        }
        $stmt->bind_param("sss", $usuario, $contrasenaHash, $rol);
        // ejecutar y validar error
                if (!$stmt->execute()) {
            echo json_encode(["exito"=>false,"mensaje"=>$stmt->error]);
            return;
                    }
        $stmt->close();
        // mostrar
        echo json_encode(["exito"=>true,"mensaje"=>"Usuario creado con exito"]);

    }catch(Exception $e){
      echo json_encode(["exito"=>false,"mensaje"=>$e->getMessage()]);
    }
}
usuarioNuevo(); 
?>