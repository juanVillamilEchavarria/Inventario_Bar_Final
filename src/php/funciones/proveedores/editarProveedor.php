<?php

  function editarProveedor(){
    require_once "../conexion/conexionDB.php";
    try {
    
        $id = $_POST["idProveedorModificar"];
        $nombre = $_POST["nombreProveedorModificar"];
        $telefono = $_POST["telefonoProveedorModificar"];
        $correo = $_POST["correoProveedorModificar"];
        $categoria = $_POST["categoriaProveedorModificar"];
         // Validaciones de datos
    if (empty($nombre)) {
        echo json_encode(["exito" => false, "mensaje" => "El nombre no puede estar vacío"]);
        return;
    }

    if (empty($telefono)) {
        echo json_encode(["exito" => false, "mensaje" => "El telefono no puede estar vacío"]);
        return;
    }

    if (empty($correo) ) {
        echo json_encode(["exito" => false, "mensaje" => "El correo no puede estar vacío"]);
        return;
    }
    if (empty($categoria) ) {
        echo json_encode(["exito" => false, "mensaje" => "La categoria no puede estar vacío"]);
        return;
    }

    if (!is_numeric($id) || $id <= 0) {
        echo json_encode(["exito" => false, "mensaje" => "ID inválido"]);
        return;
    }
        
        if (isset($_FILES['imagenProveedorModificar']) && is_uploaded_file($_FILES['imagenProveedorModificar']['tmp_name'])) {
            $imagen = file_get_contents($_FILES['imagenProveedorModificar']['tmp_name']);
            $sql = "UPDATE proveedores SET nombre = ?, telefono = ?, correo = ?, categoria = ?, imagen = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            if (!$stmt) {
                echo json_encode(["exito" => false, "mensaje" => $db->error]);
                return;
            }

            $null=null;
            $stmt->bind_param("ssssbi", $nombre, $telefono, $correo, $categoria, $null, $id);
            $stmt->send_long_data(4, $imagen);
            
        if (!$stmt->execute()) {
            echo json_encode(["exito" => false, "mensaje" => $stmt->error]);
            return;
        }

        $stmt->close();
        echo json_encode(["exito" => true, "mensaje" => "Proveedor modificado exitosamente"]);
        return;
    
        } 
    // si NO hay imagen
            $sql = "UPDATE proveedores SET nombre = ?, telefono = ?, correo = ?, categoria = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            if (!$stmt) {
                echo json_encode(["exito" => false, "mensaje" => $db->error]);
                return;
            }
            $stmt->bind_param("ssssi", $nombre, $telefono, $correo, $categoria, $id);
        
        if (!$stmt->execute()) {
            echo json_encode(["exito" => false, "mensaje" => $stmt->error]);
            return;
        }
        $stmt->close();
        echo json_encode(["exito" => true, "mensaje" => "Proveedor editado exitosamente"]);
        
    } catch (\Throwable $th) {
        echo json_encode(["exito" => false, "mensaje" => $th->getMessage()]);
        
    }
}
editarProveedor();

?>