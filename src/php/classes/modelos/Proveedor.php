<?php

namespace App\modelos;
use PDO;
use App\utilities\Sanitizar;

class Proveedor{
    public $id;
    public $imagen;
    public $nombre;
    public $correo;
    public $telefono;
    public $categoria;

    protected static $db;
    protected static $mapaPropiedades = [
        'id' => ['idProveedor', 'idProveedorModificar', 'idProveedorEliminar'],
        'imagen' => ['imagenProveedor', 'imagenProveedorModificar', 'imagenProveedorEliminar'],
        'nombre' => ['nombreProveedor', 'nombreProveedorModificar', 'nombreProveedorEliminar'],
        'correo' => ['correoProveedor', 'correoProveedorModificar', 'correoProveedorEliminar'],
        'telefono' => ['telefonoProveedor', 'telefonoProveedorModificar', 'telefonoProveedorEliminar'],
        'categoria' => ['categoriaProveedor', 'categoriaProveedorModificar', 'categoriaProveedorEliminar'],
    ];

    public function __construct(array $args=[]){
        $this->id = Sanitizar::limpiarInt($args['id'] ?? null) ?? null;
        $this->imagen = Sanitizar::limpiarSrtring($args['imagen'] ?? null) ?? null;
        $this->nombre = Sanitizar::limpiarSrtring($args['nombre'] ?? null) ?? null;
        $this->correo = Sanitizar::limpiarSrtring($args['correo'] ?? null) ?? null;
        $this->telefono = Sanitizar::limpiarSrtring($args['telefono'] ?? null) ?? null;
        $this->categoria = Sanitizar::limpiarSrtring($args['categoria'] ?? null) ?? null;


        $this->sincronizar($args);
    }

    protected function sincronizar(array $data=[]){
        foreach (self::$mapaPropiedades as $propiedadCorta => $nombresLargos) {
            $valor = null;
            foreach($nombresLargos as $nombreLargo){
                if(isset($data[$nombreLargo])){
                    $valor = $data[$nombreLargo];
                    break;
                }
            }
             if($valor!==null){
                    switch($propiedadCorta){
                        case 'id':
                            $this->$propiedadCorta = Sanitizar::limpiarInt($valor);
                            break;
                        case 'imagen':
                        case 'nombre':
                        case 'correo':
                        case 'telefono':
                        case 'categoria':
                        default:
                            $this->$propiedadCorta = Sanitizar::limpiarSrtring($valor);
                        break;
                    }
                }
        }
    } 

    public static function setDB($db){
        self::$db = $db;
    }

    public function toArray(){
        $registros=[];
        $registros['id'] = $this->id;
        $registros['imagen'] = $this->imagen;
        $registros['nombre'] = $this->nombre;
        $registros['correo'] = $this->correo;
        $registros['telefono'] = $this->telefono;
        $registros['categoria'] = $this->categoria;
        return $registros;
    }

    public function setImagen($imagen){
        if (!is_null($this->id)) {
            $this->eliminarImagen();
        }
        if ($imagen) {
            $this->imagen = $imagen;
        }

    }

    public function eliminarImagen(){
        $existeArchivo= file_exists(CARPETA_IMAGENES . 'proveedores/'. $this->imagen);
        if ($existeArchivo && !empty($this->imagen)) {
            unlink(CARPETA_IMAGENES . 'proveedores/'. $this->imagen);
        }
    }

    // funciones del CRUD

    public function crear(){
        $sql = "INSERT INTO proveedores (imagen, nombre, correo, telefono, categoria) VALUES (?, ?, ?, ?, ?)";
        $stmt = self::$db->prepare($sql);
        if (!$stmt) {
            error_log("Error de preparación SQL: " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        $resultado=$stmt->execute([$this->imagen, $this->nombre, $this->correo, $this->telefono, $this->categoria]);
        return $resultado;
    }

    public function actualizar(){
        $sql = "UPDATE proveedores SET imagen = ?, nombre = ?, correo = ?, telefono = ?, categoria = ? WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        if (!$stmt) {
            error_log("Error de preparación SQL: " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        $resultado=$stmt->execute([$this->imagen, $this->nombre, $this->correo, $this->telefono, $this->categoria, $this->id]);
        return $resultado;
    }

    public function eliminar(){
        $sql = "DELETE FROM proveedores WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $resultado=$stmt->execute([$this->id]);
        return $resultado;
    }

    public static function obtenerTodos(){
        $sql = "SELECT * FROM proveedores";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $proveedores=[];
        $registros=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($registros as $registro) {
            $proveedores[]=new self($registro);
        }
        return $proveedores;

    }

    public static function find($id){
        $sql = "SELECT * FROM proveedores WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([$id]);
        $registro=$stmt->fetch(PDO::FETCH_ASSOC);
        if (!$registro) {
            return null;
        }
        return new self($registro);
    }

}