<?php

namespace App\modelos;
use PDO;
use App\utilities\Sanitizar;

class Producto{
    public $id;
    public $nombre;
    public $precio;
    public $stock;
    public $imagen;

    protected static $db;

    protected static $mapaPropiedades=[
        'id' => ['idProductoModificar', 'idProductoEliminar', 'idProducto'],
        'nombre' => ['nombreProductoModificar', 'nombreProducto'],
        'precio' => ['precioProductoModificar', 'precioProducto'],
        'stock' => ['stockProductoModificar', 'stockProducto'],
        'imagen' => ['imagenProductoModificar', 'imagenProducto']
    ];

    public function __construct(array $args=[])
    {
        $this->id = Sanitizar::limpiarInt($args['id'] ?? null) ?? null;
        $this->nombre = Sanitizar::limpiarSrtring($args['nombre'] ?? "") ?? null;
        $this->precio = Sanitizar::limpiarFloat($args['precio'] ?? null) ?? null;
        $this->stock = Sanitizar::limpiarInt($args['stock'] ?? null) ?? null;
        $this->imagen = Sanitizar::limpiarSrtring($args['imagen'] ?? null) ?? null;

        $this->sincronizar($args);
    }

    public static function setDB($db){
        self::$db=$db;
    }


    protected function sincronizar(array $data = []) {
        
        // Recorre las propiedades cortas de la clase
        foreach (self::$mapaPropiedades as $propiedadCorta => $nombresLargos) {
            
            // Busca el valor en $data usando cualquiera de los nombres largos posibles
            $valor = null;
            foreach ($nombresLargos as $nombreLargo) {
                if (isset($data[$nombreLargo])) {
                    $valor = $data[$nombreLargo];
                    break; // Encontró el valor, sale del bucle interno
                }
            }
            
            // Si encontró un valor en $_POST, lo limpia y asigna
            if ($valor !== null) {
                switch ($propiedadCorta) {
                    case 'id':
                        $this->$propiedadCorta = Sanitizar::limpiarInt($valor);
                        break;
                    case 'precio':
                        $this->$propiedadCorta = Sanitizar::limpiarFloat($valor);
                        break;
                    case 'stock':
                        $this->$propiedadCorta = Sanitizar::limpiarInt($valor);
                        break;
                    case 'nombre':
                    case 'imagen':
                    default:
                        $this->$propiedadCorta = Sanitizar::limpiarSrtring($valor);
                        break;
                }
            }
        }
    }
    public function toArray() : array {
        $atributos = [];
        // Solo incluimos las propiedades públicas
        $atributos['id'] = $this->id;
        $atributos['nombre'] = $this->nombre;
        $atributos['precio'] = $this->precio;
        $atributos['stock'] = $this->stock;
        $atributos['imagen'] = $this->imagen;
        
        return $atributos;
    }
    public function setImagen($imagen){
        // verificamos si tiene una imagen cargada y la eliminamos
        if (!is_null($this->id)) {
            $this->eliminarImagen();
        }

       if ($imagen) {
        $this->imagen = $imagen;

       }
    }
    public function eliminarImagen(){
         $existeArchivo= file_exists(CARPETA_IMAGENES. 'productos/'. $this->imagen);
        if ($existeArchivo && !empty($this->imagen)) {
            unlink(CARPETA_IMAGENES . 'productos/'. $this->imagen);
        }
        
    }

    // FUNCIONALIDADES DEL CRUD
    public function crear(){
        $sql = "INSERT INTO productos (nombre, precio, stock, imagen) VALUES (?, ?, ?, ?)";
        $stmt = self::$db->prepare($sql);
        if (!$stmt) {
            error_log("Error de preparación SQL: " . print_r(self::$db->errorInfo(), true));
             return false;
        }
        $resultado=$stmt->execute([$this->nombre, $this->precio, $this->stock, $this->imagen]);
        return $resultado;
        
    }

    public static function obtenerTodos(){
        $sql = "SELECT * FROM productos";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $productos=[];
        $registros=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($registros as $registro) {
            $productos[]=new self($registro);
        }
        return $productos;
    }

    public static function find($id){
        $id=Sanitizar::limpiarInt($id);
        $sql = "SELECT * FROM productos WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([$id]);
        $registro=$stmt->fetch(PDO::FETCH_ASSOC);
        if (!$registro) {
            return null;
        }
        
        // CRÍTICO: Devolver un objeto Productos
        return new self($registro);
        
    }

    public function actualizar(){
        $sql = "UPDATE productos SET nombre = ?, precio = ?, stock = ?, imagen = ? WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        if (!$stmt) {
           error_log("Error de preparación SQL: " . print_r(self::$db->errorInfo(), true));
             return false;
        }

        $resultado=$stmt->execute([$this->nombre, $this->precio, $this->stock, $this->imagen, $this->id]);
        return $resultado;
    }

    public function eliminar(){
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $resultado=$stmt->execute([$this->id]);
        return $resultado;

    }



    
}