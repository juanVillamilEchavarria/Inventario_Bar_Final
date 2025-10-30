<?php

require_once __DIR__. '/../../../vendor/autoload.php';
require_once __DIR__.'/../conexion/conexionDB.php';
require_once __DIR__. '/../../../includesPHP/rutas.php';
$db=conectarDB();
use App\utilities\Sanitizar;
use App\modelos\Producto;
Producto::setDB($db);
