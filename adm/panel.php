<?php
    
    session_start();

    // CONEXION A LA BASE DE DATOS.
    include("../includes/conexion.php");   

    include("../includes/header.php");

?>


<section class="panel-adm py-4">

    <div class="container">

        <h3 class="center">Panel Administrativo</h3>
        <div class="row"> 
            <?php  include("../includes/adm-side-menu.php");    ?> 
            <!-- 
            <div class="col-md-4 sidebar">
                <h6>Panel de Usuarios</h6>
                    <a href="usuarios/listado.php"><i class="fa-solid fa-user icono-principal"></i>Usuarios</a>
                <h6>Portfolio</h6>
                    <a href="">Categorías</a>
                    <a href="">Lecciones</a>
                    <a href="">Código Ejemplo</a>
                <h6>Magazine</h6>
                    <a href=""><i class="fa-solid fa-image"></i>Imágenes</a>
                    <a href=""><i class="fa-solid fa-music"></i>Música</a>
                    <a href=""><i class="fa-solid fa-receipt"></i>Recetas</a>
                    <a href=""><i class="fa-solid fa-video"></i>Videos</a>
            </div>
-->

            <div class="sidebar-content">
                
            </div> 

        </div>  

    </div>
</section>



<?php include("../includes/footer.php"); ?>