<?php

$pagina = 'blog';

session_start();
include("../../includes/config.php");   


// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php"); 

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idReceta = $_GET['id'];
    
    $query = "SELECT * FROM recetas INNER JOIN usuarios ON usuarios.idUsuario = recetas.idAutor INNER JOIN categorias_recetas ON categorias_recetas.idCategoriaReceta = recetas.idCategoriaReceta WHERE idReceta = '$idReceta'";
    
    $resultRecetas = $connection->query($query);
    $receta = $resultRecetas->fetch_assoc();

    $query = "SELECT * FROM recetas_carrousel WHERE idReceta = '$idReceta'";
    
    $resultCarruselRecetas = $connection->query($query);


    
}  

include("../../includes/header.php"); 

?>

<section class="recetapost">
    <h3><?= $receta['titulo']; ?></h3>    
    <div class="container">
        <div class="contenedorAutor d-flex justify-content-between">
            <span class="autor">por <?= $receta['nombre']; ?></span>
            <span class="calificacion">
            
            </span>
        </div>
        <div class="contenido">
            <div class="row mt-4 fila-titulos">
                <div class="col-4 text-center"> <h3>Ingredientes</h3></div>
                <div class="col-8 text-center"><h3>Preparación</h3></div>
            </div>
            <div class="row mt-4">
                <div class="col-4 col-ingredientes ">
                    <div class="p-3">      <?= $receta['ingredientes']; ?> </div>
             
                </div>
                <div class="col-8 col-preparacion">
                    <?= $receta['preparacion']; ?>
                </div>
            </div>
            <div class="mt-4 py-2 fila-titulos">
                <h4 class="text-center">Imágenes de la receta</h4>
            </div>
            <div class="row mt-4">
                <?php 
                    while ($img = $resultCarruselRecetas->fetch_assoc()) {
                        echo '   
                        <div class="col-12 col-md-3">
                            <a href="../../imgs/magazine/recetas/carrusel/'.$img['img_receta'].'"    data-lightbox="grilla-imaganes">
                                <img src="../../imgs/magazine/recetas/carrusel/'.$img['img_receta'].'" alt="" class="img-fluid">
                            </a>
                        </div>
                        ';
                    }
                    
                ?>
                
                </div>
            </div>
            <?php if($receta['urlVideo']): ?>
                <div class="video">
            
                        <iframe width="100%" height="400" src="<?= $receta['urlVideo']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
            
            <?php endif;?>
        

    </div>
</section>





    
<div class="bottomnav">
        
            <a href="procesos/registro.php">Regístrate</a>
            <a href="procesos/iniciar_sesion.php">Iniciar Sesión</a>
    
     </div>

         <!-- JQUERY --> 
    <script src="https://code.jquery.com/jquery-3.6.4.slim.js" integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>

<!-- LIGHTBOX JS -->
<script src="../../js/lightbox-plus-jquery.min.js"></script>

<?php

    include("../../includes/footer.php");
   
?>