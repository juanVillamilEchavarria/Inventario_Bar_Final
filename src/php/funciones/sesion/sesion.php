<?php
function iniciarSesion(){
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: /interGraficas/index.php");
    }
    return true;
}
?>