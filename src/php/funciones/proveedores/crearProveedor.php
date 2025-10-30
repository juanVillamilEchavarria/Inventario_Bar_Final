<?php
ob_start();
  require_once __DIR__ ."/../../classes/app.php";
  use App\modelos\Proveedor;
  use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;


   try {
    if (!isset($_POST['nombreProveedor'],$_POST['telefonoProveedor'],$_POST['correoProveedor'],$_POST['categoriaProveedor'],$_FILES['imagenProveedor']) || $_FILES['imagenProveedor']['error'] !== UPLOAD_ERR_OK) {
        ob_end_clean();
        echo json_encode(["exito"=>false,"mensaje"=>"No se recibieron datos validos"]);
        return;
    }
   $proveedor=new Proveedor($_POST);
   
   if($proveedor->nombre===false){
    ob_end_clean();
    echo json_encode(["exito"=>false,"mensaje"=>"El nombre es obligatorio"]);
    exit;
   }
   if($proveedor->telefono===false){
    ob_end_clean();
    echo json_encode(["exito"=>false,"mensaje"=>"El telefono es obligatorio"]);
    exit;
   }
   if($proveedor->correo===false){
    ob_end_clean();
    echo json_encode(["exito"=>false,"mensaje"=>"El correo es obligatorio"]);
    exit;
   }
   if($proveedor->categoria===false){
    ob_end_clean();
    echo json_encode(["exito"=>false,"mensaje"=>"La categoria es obligatoria"]);
    exit;
   }
        $nombreImagen = md5(uniqid(rand(), true)).".jpg";
         $manager = new Image(Driver::class);
         $imagen = $manager->read($_FILES['imagenProveedor']['tmp_name'])->cover(800,600);
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
   if(!$proveedor->crear()){
    ob_end_clean();
    echo json_encode(["exito"=>false,"mensaje"=>"Error al crear el proveedor"]);
   }
   ob_end_clean();
   echo json_encode(["exito"=>true,"mensaje"=>"Proveedor creado"]);
    
   
   } catch (\Throwable $th) {
    ob_end_clean();
    echo json_encode(["exito"=>false,"mensaje"=>$th->getMessage()]);
   }