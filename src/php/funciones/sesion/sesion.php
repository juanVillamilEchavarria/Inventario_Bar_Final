<?php
session_start();
header("Content-Type: application/json");

if (!isset($_SESSION['usuario'])) {
    echo json_encode([
        "exito" => false,
        "mensaje" => "No estás logueado"
    ]);
    exit;
}

echo json_encode([
    "exito" => true,
    "usuario" => $_SESSION['usuario'],
    "rol" => $_SESSION['rol']
]);
