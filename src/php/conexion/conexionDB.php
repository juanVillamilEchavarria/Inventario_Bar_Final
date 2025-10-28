<?php
$host="localhost";
$user="root";
$pass="";
$database="whiskyb_inventario";

$db=mysqli_connect($host,$user,$pass,$database );

    if (!$db) {
        die( "Error: No se pudo conectar a MySQL." . mysqli_connect_error() );
        # code...
    }
?>