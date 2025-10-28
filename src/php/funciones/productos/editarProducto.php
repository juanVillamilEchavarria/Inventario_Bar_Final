<?php
function editarProducto(){
    require_once '../conexion/conexionDB.php';

    $nombre = $_POST['nombreProductoModificar'];
    $precio = $_POST['precioProductoModificar'];
    $stock  = $_POST['stockProductoModificar'];
    $id     = $_POST['idProductoModificar'];
        // Validaciones de datos
    if (empty($nombre)) {
        echo json_encode(["exito" => false, "mensaje" => "El nombre no puede estar vacío"]);
        return;
    }

    if (!is_numeric($precio) || $precio <= 0) {
        echo json_encode(["exito" => false, "mensaje" => "El precio debe ser un número mayor que 0"]);
        return;
    }

    if (!is_numeric($stock) || $stock < 0) {
        echo json_encode(["exito" => false, "mensaje" => "El stock debe ser un número igual o mayor que 0"]);
        return;
    }

    if (!is_numeric($id) || $id <= 0) {
        echo json_encode(["exito" => false, "mensaje" => "ID inválido"]);
        return;
    }

    // si viene imagen
    if (isset($_FILES['imagenProductoModificar']) && is_uploaded_file($_FILES['imagenProductoModificar']['tmp_name'])) {
        $imagen = file_get_contents($_FILES['imagenProductoModificar']['tmp_name']);

        $sql = "UPDATE productos SET nombre = ?, precio = ?, stock = ?, imagen = ? WHERE id = ?";
        $stmt = $db->prepare($sql);

        if (!$stmt) {
            echo json_encode(["exito" => false, "mensaje" => $db->error]);
            return;
        }
        $null=null;
       
        $stmt->bind_param("sdibi", $nombre, $precio, $stock, $null, $id);
        $stmt->send_long_data(3, $imagen);

        if (!$stmt->execute()) {
            echo json_encode(["exito" => false, "mensaje" => $stmt->error]);
            return;
        }

        $stmt->close();
        echo json_encode(["exito" => true, "mensaje" => "Producto modificado con imagen"]);
        return;
    }

    // si NO hay imagen 
    $sql = "UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?";
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        echo json_encode(["exito" => false, "mensaje" => $db->error]);
        return;
    }

    $stmt->bind_param("sdii", $nombre, $precio, $stock, $id);

    if (!$stmt->execute()) {
        echo json_encode(["exito" => false, "mensaje" => $stmt->error]);
        return;
    }

    $stmt->close();
    echo json_encode(["exito" => true, "mensaje" => "Producto modificado sin imagen"]);
}
editarProducto();
?>
