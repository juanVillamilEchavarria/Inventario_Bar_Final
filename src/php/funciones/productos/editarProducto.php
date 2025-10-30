<?php
//  Iniciar el Buffer de Salida para capturar cualquier salida inesperada (warnings, espacios, etc.)
ob_start();

require_once __DIR__ ."/../../classes/app.php";

use App\modelos\Producto;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

try {
    //  Validar que existan datos POST mínimos
    if (!isset($_POST["nombreProductoModificar"], $_POST["precioProductoModificar"], $_POST["stockProductoModificar"], $_POST["idProductoModificar"])) {
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => "No se recibieron datos obligatorios para la modificación."]);
        return;
    }

    //  Crear y sincronizar el producto
    $producto = new Producto($_POST);

    //  Validaciones de datos (usando el resultado de Sanitizar de la clase Producto)
    if ($producto->id === false || $producto->id === null) {
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => "ID de producto inválido para modificar."]);
        return;
    }
    
    if (empty($producto->nombre) || $producto->nombre === false) {
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => "El nombre no puede estar vacío."]);
        return;
    }

    if ($producto->precio === false || $producto->stock === false) {
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => "El precio y el stock deben ser números mayores que 0."]);
        return;
    }
    
    //  Manejo de la Imagen
    if(isset($_FILES['imagenProductoModificar']) && $_FILES['imagenProductoModificar']['tmp_name']){
        
        //  Generar nombre único y procesar imagen
        $nombreImagen = md5(uniqid(rand(), true)).".jpg";
        $manager = new Image(Driver::class);
        $imagen = $manager->read($_FILES['imagenProductoModificar']['tmp_name'])->cover(800, 600);
        
        // setImagen elimina la imagen antigua si existe y asigna la nueva
        $producto->setImagen($nombreImagen);
        
        //  Crear la carpeta de imágenes si no existe
        $carpetaImagenes = CARPETA_IMAGENES . "productos/";
        if(!is_dir($carpetaImagenes)) {
            if (!mkdir($carpetaImagenes, 0755, true)) {
                 ob_end_clean();
                 echo json_encode(["exito" => false, "mensaje" => "Error al crear la carpeta de imágenes."]);
                 return;
            }
        }
        
        //  Guardar la nueva imagen
        $imagen->save($carpetaImagenes . $nombreImagen);
    }
    
    //  Actualizar en la base de datos
    if(!$producto->actualizar()){
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => "Error al actualizar el producto en la Base de Datos."]);
        return;
    }
    
    //  ÉXITO (Independientemente de si se subió imagen o no)
    ob_end_clean();
    echo json_encode(["exito" => true, "mensaje" => "Producto actualizado"]);
    
}catch (\Throwable $th) {
    // Manejo de errores fatales
    ob_end_clean();
    echo json_encode(["exito" => false, "mensaje" => "Error interno del servidor: " . $th->getMessage()]);
}
