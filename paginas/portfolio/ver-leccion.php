<?php
session_start();
$pagina = 'Ver Leccion';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $idLeccion = $_GET['id'];

$query = "SELECT * FROM lecciones WHERE idLeccion = $idLeccion";
$result = $connection->query($query);
$leccion = $result->fetch_assoc();

}



include("../../includes/header.php");



?>


<main class="pagina-leccion">
    <section>

        <div class="container">

            <div class="breadcrumb">
                <ul>
                    <li class= ""><a href="frontend.php">Frontend</a></li>
                    <li class="mx-3">:</li>
                    <li><?= $leccion['titulo'] ?></li>
                </ul>
            </div>

            <h1 class="text-center"><?= $leccion['titulo'] ?></h1>
            <?php 
                echo $leccion['contenido'];
            ?>  

        </div>
    </section>
</main>


<?php if(!isset($_SESSION['idUsuario'])) :?>
   
   <div class="bottomnav">
       
           <a href="../../procesos/registro.php">Regístrate</a>
           <a href="../../procesos/iniciar_sesion.php">Iniciar Sesión</a>
   
    </div>

    <?php endif; ?>
<?php

    include("../../includes/footer.php");
   
?>