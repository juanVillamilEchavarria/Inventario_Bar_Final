<?php


namespace App\utilities;

class Sanitizar{
    public static function limpiarSrtring(?string $string) : mixed{
        if (empty($string) || !is_string($string)) {
            return false;
        }
        $string = trim($string);
        $string = htmlspecialchars($string);
        return $string;
    }
    public static function limpiarInt(?float $int): mixed{
        if (is_null($int)) {
            return false;
        }
        $int = filter_var($int, FILTER_VALIDATE_INT);
        if($int !==false && $int > 0){
             return $int;
        }
        return false;
       
    }
    public static function limpiarFloat(?float $float): mixed{
        if (is_null($float)) {
            return false;
        }
        $float = filter_var($float, FILTER_VALIDATE_FLOAT);
        if ($float!=false && $float > 0) {
            return $float;
        }
        return false;
    }
}