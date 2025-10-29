<?php
  require_once __DIR__ ."/../../classes/app.php";

use App\utilities\Sanitizar;
function crearProducto() {
    require __DIR__ . "/../../conexion/conexionDB.php";
    $db = conectarDB();
  

    try {
        // Validar que existan datos
        if (!isset($_POST["nombreProducto"], $_POST["precioProducto"], $_POST["stockProducto"]) || !isset($_FILES["imagenProducto"])) {
            echo json_encode(["exito" => false, "mensaje" => "No se recibieron datos válidos"]);
            return;
        }

        // Asignar variables
        $nombre = Sanitizar::limpiarSrtring($_POST["nombreProducto"]);
        $precio = Sanitizar::limpiarFloat($_POST["precioProducto"]);
        $stock = Sanitizar::limpiarInt($_POST["stockProducto"]);
        // validar que precio y stock no sean menor o igual a 0
        if ($precio === false || $precio <= 0 || $stock <= 0 || $stock === false) {
        echo json_encode(["exito" => false, "mensaje" => "Precio y stock deben ser mayores a 0"]);
        return;
            }
        $imagen = file_get_contents($_FILES["imagenProducto"]["tmp_name"]);

        // Insertar
        $sql = "INSERT INTO productos (nombre, precio, stock, imagen) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $precio);
        $stmt->bindParam(3, $stock);
        $stmt->bindParam(4, $imagen, PDO::PARAM_LOB);

        if (!$stmt->execute()) {
            echo json_encode(["exito" => false, "mensaje" => $db->errorInfo()]);
            return;
        }
        echo json_encode(["exito" => true, "mensaje" => "Producto creado correctamente"]);
    } catch (\Throwable $th) {
        echo json_encode(["exito" => false, "mensaje" => $th->getMessage()]);
    }
}
crearProducto();
?>
