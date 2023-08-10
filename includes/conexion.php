<?php

$connection = new mysqli("localhost", "root", "", "portfoliomagazine");

if (mysqli_connect_error()){
    printf("Error de conexión: %s\n", mysqli_connect_error());
    exit();
}
$connection->set_charset("utf8")
?>