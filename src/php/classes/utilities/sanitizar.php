<?php


namespace App\utilities;

class Sanitizar{
    public static function limpiarSrtring(string $string){
        $string = trim($string);
        $string = htmlspecialchars($string);
        return $string;
    }
    public static function limpiarInt(int $int){
        $int = filter_var($int, FILTER_VALIDATE_INT);
        if($int !==false && $int > 0){
             return $int;
        }
        return false;
       
    }
    public static function limpiarFloat(float $float){
        $float = filter_var($float, FILTER_VALIDATE_FLOAT);
        if ($float!=false && $float > 0) {
            return $float;
        }
        return false;
    }
}