<?php
namespace App\modelos;
use PDO;
use App\utilities\Sanitizar;

class Cliente{
    public $id;
    public $nombre;
    public $correo;
    public $telefono;

    protected static $db;


    protected static $mapaPropiedades=[
        "id"=> ["idCliente","idClienteModificar", "idClienteEliminar"],
        "nombre"=> ["nombreCliente","nombreClienteModificar", "nombreClienteEliminar"],
        "correo"=> ["correoCliente","correoClienteModificar", "correoClienteEliminar"],
        "telefono"=> ["telefonoCliente","telefonoClienteModificar", "telefonoClienteEliminar"]

    ];
    
    public function __construct(array $args=[])
    {
        $this->id= Sanitizar::limpiarInt($args['id'] ?? null) ?? null;
        $this->nombre= Sanitizar::limpiarSrtring($args['nombre'] ?? null) ?? null;
        $this->correo= Sanitizar::limpiarSrtring($args['correo'] ?? null) ?? null;
        $this->telefono = Sanitizar::limpiarSrtring($args['telefono'] ?? null) ?? null;


        $this->sincronizar($args);
        
    }

    public static function setDB($db){
        self::$db=$db;
    }

    protected function sincronizar(array $data=[]){
        foreach(self::$mapaPropiedades as $propiedadCorta => $nombresLargos){
            $valor=null;
            foreach($nombresLargos as $nombreLargo){
                if(isset($data[$nombreLargo])){
                    $valor=$data[$nombreLargo];
                    break;
                }
            }
            if($valor!==null){
                switch($propiedadCorta){
                    case 'id':
                        $this->$propiedadCorta=Sanitizar::limpiarInt($valor);
                        break;
                    case 'nombre':
                    case 'correo':
                    case 'telefono':
                    default:
                        $this->$propiedadCorta=Sanitizar::limpiarSrtring($valor);
                        break;
                }
            }
            
        }
    }

    public function toArray(){
        $atributos = [];
        $atributos['id'] = $this->id;
        $atributos['nombre'] = $this->nombre;
        $atributos['correo'] = $this->correo;
        $atributos['telefono'] = $this->telefono;
        return $atributos;
    }

    // funciones CRUD

    public function crear(){
        $sql = "INSERT INTO clientes (nombre, correo, telefono) VALUES (?, ?, ?)";
        $stmt = self::$db->prepare($sql);
        if (!$stmt) {
            error_log("Error de preparación SQL: " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        $resultado = $stmt->execute([$this->nombre, $this->correo, $this->telefono]);
        return $resultado;
    }

    public function actualizar(){
        $sql = "UPDATE clientes SET nombre = ?, correo = ?, telefono = ? WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        if (!$stmt) {
            error_log("Error de preparación SQL: " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        $resultado = $stmt->execute([$this->nombre, $this->correo, $this->telefono, $this->id]);
        return $resultado;
    }
    
    public function eliminar(){
        $sql = "DELETE FROM clientes WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $resultado = $stmt->execute([$this->id]);
        return $resultado;
    }

    public static function find($id){
        $id = Sanitizar::limpiarInt($id);
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([$id]);
        $registro = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$registro) {
            return null;
        }
        return new self($registro);
    }

    public static function obtenerTodos(){
        $sql = "SELECT * FROM clientes";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $clientes= [];
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($registros as $registro) {
            $clientes[] = new self($registro);
        }
        return $clientes;
    }


}