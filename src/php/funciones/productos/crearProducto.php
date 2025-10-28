<?php
function crearProducto() {
    require __DIR__ . "/../../conexion/conexionDB.php";

    try {
        // Validar que existan datos
        if (!isset($_POST["nombreProducto"], $_POST["precioProducto"], $_POST["stockProducto"]) || !isset($_FILES["imagenProducto"])) {
            echo json_encode(["exito" => false, "mensaje" => "No se recibieron datos válidos"]);
            return;
        }

        // Asignar variables
        $nombre = $_POST["nombreProducto"];
        $precio = $_POST["precioProducto"];
        $stock = $_POST["stockProducto"];
        // validar que precio y stock no sean menor o igual a 0
        if ($precio <= 0 || $stock <= 0) {
        echo json_encode(["exito" => false, "mensaje" => "Precio y stock deben ser mayores a 0"]);
        return;
            }
        $imagen = file_get_contents($_FILES["imagenProducto"]["tmp_name"]);
        $null = null;

        // Insertar
        $sql = "INSERT INTO productos (nombre, precio, stock, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        if (!$stmt) {
            echo json_encode(["exito" => false, "mensaje" => $db->error]);
            return;
        }
     
        // "s" string, "d" double/decimal, "i" integer, "b" blob
        $stmt->bind_param("sdib", $nombre, $precio, $stock, $null);

        // Pasar el BLOB
        $stmt->send_long_data(3, $imagen);

        if (!$stmt->execute()) {
            echo json_encode(["exito" => false, "mensaje" => $stmt->error]);
            return;
        }

        $stmt->close();
        echo json_encode(["exito" => true, "mensaje" => "Producto creado correctamente"]);
    } catch (\Throwable $th) {
        echo json_encode(["exito" => false, "mensaje" => $th->getMessage()]);
    }
}
crearProducto();
?>
