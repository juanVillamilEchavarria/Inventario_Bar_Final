<?php
  require_once __DIR__ ."/../../classes/app.php";

use App\modelos\Producto;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;
    try {
      
        // Validar que existan datos
        if (!isset($_POST["nombreProducto"], $_POST["precioProducto"], $_POST["stockProducto"]) || !isset($_FILES["imagenProducto"]) || 
        $_FILES["imagenProducto"]["error"] !== UPLOAD_ERR_OK) {
            echo json_encode(["exito" => false, "mensaje" => "No se recibieron datos válidos"]);
            return;
        }
    //    creamos el producto
       $producto = new Producto($_POST);
    //    validaciones
        if ($producto->precio === false || $producto->stock === false) {
        echo json_encode(["exito" => false, "mensaje" => "Precio y stock deben ser mayores a 0"]);
        return;
         }
    //   asignamos nombre unico a la imagen
         $nombreImagen = md5(uniqid(rand(), true)).".jpg";
         $manager = new Image(Driver::class);
         $imagen = $manager->read($_FILES['imagenProducto']['tmp_name'])->cover(800,600);
         $producto->setImagen($nombreImagen);
    //     crear la carpeta de imagenes
            $carpetaImagenes = CARPETA_IMAGENES . "productos/";
            if(!is_dir($carpetaImagenes)) {
                if (!mkdir($carpetaImagenes, 0755, true)) {
                echo json_encode(["exito" => false, "mensaje" => "Error al crear la carpeta de imágenes."]);
                return;
        }
            }
            
            //guardar la imagen en el servidor
            $imagen->save($carpetaImagenes . $nombreImagen);

        if(!$producto->crear()){
            echo json_encode(["exito" => false, "mensaje" => "Error al crear el producto"]);
            return;
        }

        echo json_encode(["exito" => true, "mensaje" => "Producto creado"]);
    } catch (\Throwable $th) {
        echo json_encode(["exito" => false, "mensaje" => $th->getMessage()]);
    }


?>
