<?php 
session_start();

unset($_SESSION['idUsuario']);
unset($_SESSION['nombreCompleto']);
unset($_SESSION['email']);
unset($_SESSION['avatar']);
unset($_SESSION['rol']);

session_destroy();

header('location:index.php');
?>