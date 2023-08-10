<?php
session_start();
$pagina = 'musica';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idLista = $_GET['id'];

        $query = "SELECT * FROM musica WHERE idMusica = '$idLista'";
        $resultMusica= $connection->query($query);
        $lista = $resultMusica->fetch_assoc();
}

include("../../includes/header.php");

?>

<section class="detalle-lista">
    <div class="container">
        <h2><?= $lista['titulo']; ?></h2>
        <iframe style="border-radius:12px" src="<?= $lista['urlLista']; ?>" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
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