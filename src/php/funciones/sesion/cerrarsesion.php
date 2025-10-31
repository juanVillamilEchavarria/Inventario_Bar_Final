<?php
session_start();
session_destroy();
header("Location: /interGraficas/index.php");
?>