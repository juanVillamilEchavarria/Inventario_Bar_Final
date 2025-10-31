<?php
namespace App\modelos;
use PDO;
use App\utilities\Sanitizar;

class Usuario{
    protected static $db;
    public $id;
    public $nombre_usuario;
    public $contrasena;
    public $rol;
    public $fecha_creacion;

    public function __construct(array $args=[]){
        $this->id = Sanitizar::limpiarInt($args['id'] ?? null) ?? null;
        $this->nombre_usuario = Sanitizar::limpiarSrtring($args['nombre_usuario'] ?? null) ?? null;
        $this->contrasena = Sanitizar::limpiarSrtring($args['contrasena'] ?? null) ?? null;
        $this->rol = Sanitizar::limpiarSrtring($args['rol'] ?? null) ?? null;
        $this->fecha_creacion = Sanitizar::limpiarSrtring($args['fecha_creacion'] ?? null) ?? null;
    }
    // funcion para sincronizar el objeto con los argumentos
     public function sincronizar($args=[]) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = is_int($value) ? Sanitizar::limpiarInt($value) : Sanitizar::limpiarSrtring($value);
            }
        }
    }

    public static function setDB($db){
        self::$db = $db;
    }

    public function hashearPassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public function toArray(){
        $atributos = [];
        $atributos['id'] = $this->id;
        $atributos['nombre_usuario'] = $this->nombre_usuario;
        // $atributos['contrasena'] = $this->contrasena;
        $atributos['rol'] = $this->rol;
        $atributos['fecha_creacion'] = $this->fecha_creacion;
        return $atributos;
    }

    // FUNCIONALIDADES DE CRUD 

    public function crear(){
        $sql = "INSERT INTO usuarios (nombre_usuario, contrasena, rol) VALUES (?, ?, ?)";
        $stmt = self::$db->prepare($sql);
        if (!$stmt) {
            error_log("Error de preparación SQL: " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        $resultado = $stmt->execute([$this->nombre_usuario, $this->hashearPassword($this->contrasena), $this->rol]);
        return $resultado;
    }

     public function modificarCampos(): bool {
        // La contraseña NO se toca aquí
        $sql = "UPDATE usuarios SET nombre_usuario = ?, rol = ? WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        
        if (!$stmt) {
            error_log("Error de preparación SQL (modificarCampos): " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        
        $resultado = $stmt->execute([$this->nombre_usuario, $this->rol, $this->id]);
        return $resultado;
    }
    public function modificarContrasena(string $nuevoPasswordPlano): bool {
        
        $passwordHasheada = $this->hashearPassword($nuevoPasswordPlano);
        
        $sql = "UPDATE usuarios SET contrasena = ? WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        
        if (!$stmt) {
            error_log("Error de preparación SQL (modificarContrasena): " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        
        $resultado = $stmt->execute([$passwordHasheada, $this->id]);
        return $resultado;
    }
       public function eliminar(): bool {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = self::$db->prepare($sql);
        
        if (!$stmt) {
            error_log("Error de preparación SQL (eliminar): " . print_r(self::$db->errorInfo(), true));
            return false;
        }
        
        $resultado = $stmt->execute([$this->id]);
        return $resultado;
    }
        // --- Métodos de Consulta Estáticos ---
    public static function obtenerTodos(){
        $sql = "SELECT id, nombre_usuario, rol, fecha_creacion FROM usuarios";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usuarios = [];
        foreach ($registros as $registro) {
            $usuarios[] = new self($registro);
        }
        return $usuarios;
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
        return password_verify($password, $this->contrasena);
    }
}