<?php
namespace App\modelos;
use PDO;
use App\utilities\Sanitizar;

class Usuario{
    protected static $db;
    public $id;
    public $nombre_usuario;
    public $password;
    public $rol;
    public $fecha_creado;

    public function __construct(array $args=[]){
        $this->id = Sanitizar::limpiarInt($args['id'] ?? null) ?? null;
        $this->nombre_usuario = Sanitizar::limpiarSrtring($args['nombre_usuario'] ?? null) ?? null;
        $this->password = Sanitizar::limpiarSrtring($args['contrasena'] ?? null) ?? null;
        $this->rol = Sanitizar::limpiarSrtring($args['rol'] ?? null) ?? null;
        $this->fecha_creado = Sanitizar::limpiarSrtring($args['fecha_creacion'] ?? null) ?? null;
    }

    public static function setDB($db){
        self::$db = $db;
    }

    protected function encriptarPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function toArray(){
        $atributos = [];
        $atributos['id'] = $this->id;
        $atributos['nombre_usuario'] = $this->nombre_usuario;
        $atributos['contrasena'] = $this->password;
        $atributos['rol'] = $this->rol;
        $atributos['fecha_creacion'] = $this->fecha_creado;
        return $atributos;
    }
    public static function findId($id){
        $id=Sanitizar::limpiarInt($id);
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([$id]);
        $registro=$stmt->fetch(PDO::FETCH_ASSOC);
        if (!$registro) {
            return null;
        }
        return new self($registro);
    }
    public static function findUsername($username){
        $username=Sanitizar::limpiarSrtring($username);
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([$username]);
        $registro=$stmt->fetch(PDO::FETCH_ASSOC);
        if (!$registro) {
            return null;
        }
        return new self($registro);
    }

    public function verificarPassword($password){
        return password_verify($password, $this->password);
    }
}