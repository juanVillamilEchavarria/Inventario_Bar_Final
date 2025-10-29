<?php


function conectarDB(){
    $host="localhost";
    $user="root";
    $pass="";
    $database="whiskyb_inventario";
    $db = new  PDO ("mysql:host=$host;dbname=$database;charset=utf8", $user, $pass);
    return $db;
}

