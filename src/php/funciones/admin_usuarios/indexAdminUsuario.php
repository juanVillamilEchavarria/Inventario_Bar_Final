<?php
$es_admin=true;
require_once __DIR__. '/../../../../includesPHP/listados_superior.php';
require_once __DIR__. '/tablaUsuarios.php';

$resultado=$_GET['resultado'] ?? null;
$errorQuery = $_GET['error'] ?? null;
