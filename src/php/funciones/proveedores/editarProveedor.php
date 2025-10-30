<?php
ob_clean();
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Proveedor;
    use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

    try {
        if(!isset($_POST["idProveedorModificar"], $_POST["nombreProveedorModificar"], $_POST["correoProveedorModificar"], $_POST["telefonoProveedorModificar"])){
            ob_end_clean();
            echo json_encode(["exito" => false, "mensaje" => "No se recibieron datos"]);
            return;
        }
        $proveedor= new Proveedor($_POST);
        if($proveedor->id===false){
            ob_end_clean();
            echo json_encode(["exito"=>false,"mensaje"=>"El id es obligatorio"]);
            exit;
         }
         if($proveedor->nombre===false){
            ob_end_clean();
            echo json_encode(["exito"=>false,"mensaje"=>"El nombre es obligatorio"]);
            exit;
         }
         if($proveedor->correo===false){
            ob_end_clean();
            echo json_encode(["exito"=>false,"mensaje"=>"El correo es obligatorio"]);
            exit;
         }
         if($proveedor->telefono===false){
            ob_end_clean();
            echo json_encode(["exito"=>false,"mensaje"=>"El telefono es obligatorio"]);
            exit;
         }
         if( isset($_FILES["imagenProveedorModificar"]) || $_FILES["imagenProveedorModificar"]["tmp_name"]){
                $nombreImagen = md5(uniqid(rand(), true)).".jpg";
                 $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['imagenProveedorModificar']['tmp_name'])->cover(800,600);
                $proveedor->setImagen($nombreImagen);
                $carpetaImagenes = CARPETA_IMAGENES . "proveedores/";
                if(!is_dir($carpetaImagenes)) {
                    if (!mkdir($carpetaImagenes, 0755, true)) {
                        ob_end_clean();
                        echo json_encode(["exito"=>false,"mensaje"=>"Error al crear la carpeta de imágenes."]);
                        return;
                    }
                }

         $imagen->save($carpetaImagenes . $nombreImagen);

         }
         if(!$proveedor->actualizar()){
            ob_end_clean();
            echo json_encode(["exito"=>false,"mensaje"=>"Error al editar el proveedor"]);
            exit;
         }
         ob_end_clean();
         echo json_encode(["exito"=>true,"mensaje"=>"Proveedor editado"]);


        
    } catch (\Throwable $th) {
        ob_end_clean();
        echo json_encode(["exito" => false, "mensaje" => $th->getMessage()]);
        
    }