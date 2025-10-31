<?php
  require_once __DIR__ ."/../../classes/app.php";
    use App\modelos\Usuario;

        $usuarios = Usuario::obtenerTodos();
       
