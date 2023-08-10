<?php
session_start();
$pagina = 'lecciones';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idLeccion = $_GET['id'];
    $query = "SELECT * FROM lecciones WHERE idLeccion = $idLeccion";
    $resultadoLeccion = $connection->query($query);
    
    $leccion = $resultadoLeccion->fetch_assoc();
    }

include("../../includes/header.php");



?>


<section class="lecciones">
<div class="container">
        <h3 class="titulo-leccion"><?php echo $leccion['titulo']; ?></h3>
        <div class="contenido">
            <?php echo $leccion['contenido']; ?>
            
        </div>
</div>

</section>


<?php if(!isset($_SESSION['idUsuario'])) :?>
   
   <div class="bottomnav">
       
           <a href="../../procesos/registro.php">Regístrate</a>
           <a href="../../procesos/iniciar_sesion.php">Iniciar Sesión</a>
   
    </div>

    <?php endif; ?>
<?php

    include("../../includes/footer.php");
   
?>