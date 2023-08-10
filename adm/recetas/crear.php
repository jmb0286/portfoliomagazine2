<?php
session_start();
include("../../includes/config.php");   


if(!isset($_SESSION['idUsuario'])){
    header('Location: ../index.php'); 
}

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php"); 


$query = "SELECT * FROM categorias_recetas";
$resultCategorias = $connection->query($query);

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $ingredientes = $_POST['ingredientes'];
    $preparacion = $_POST['preparacion'];

    $carruselNames = $_FILES['carrusel_img']['name'];
    $carruselTmpNames = $_FILES['carrusel_img']['tmp_name'];

    $imgPost = $_FILES['nuevo_img']['tmp_name'];
    $imgName = $_FILES['nuevo_img']['name'];
    $idCategoriaReceta = $_POST['categoriaReceta'];
    $autor = $_SESSION['idUsuario'];
    $fecha = date ('Y-m-d');
    $urlVideo = $_POST['urlVideo'];

    
    if(empty($titulo) || empty($descripcion) || empty($imgName)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        // SUBIR IMAGEN
        $archivo_destino = '../../imgs/magazine/recetas/'.$_FILES['nuevo_img']['name'];
        move_uploaded_file($imgPost,$archivo_destino);

        $query = "INSERT INTO recetas(titulo, descripcion, ingredientes, preparacion, portada,urlVideo, fechaPublicacion, idCategoriaReceta, idAutor) VALUES ('$titulo','$descripcion','$ingredientes', '$preparacion', '$imgName', '$urlVideo', '$fecha','$idCategoriaReceta','$autor')";
       
        $result = $connection->query($query);
        
            if($result){
                $idReceta = $connection->insert_id;
                    for ($i=0; $i < count($carruselNames); $i++) { 
                        $imgNombre = $carruselNames[$i];
                        $imgTmpNombre = $carruselTmpNames[$i];
                        $archivo_destino = '../../imgs/magazine/recetas/carrusel/'.$imgNombre;
                        move_uploaded_file($imgTmpNombre,$archivo_destino);
                        $query = "INSERT INTO recetas_carrousel (img_receta, idReceta) VALUES ('$imgNombre', '$idReceta')";
                        $result = $connection->query($query);
                    }
                 header('location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido crear la Receta.";
                echo $connection->error;
            }
    }
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Nueva Receta</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>

        <form action="crear.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="">Título de la receta</label>
                <input type="text" name="titulo" class="form-control">
            </div>
            <div class="mb-3">
                <label for="post-img">Imágen principal</label>
                <input type="file" class="form-control" name="nuevo_img" id="post-img" required>
            </div>

            <div class="mb-3">
                <label for="post-img">Carrusel de imágenes</label>
                <input type="file" class="form-control" name="carrusel_img[]" id="post-img" multiple="multiple">
            </div>

            <div class="mb-3">
                <label for="">Descripción</label>
                <textarea name="descripcion" class="form-control"  rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="">Ingredientes</label>
                <textarea id="editor" name="ingredientes" class="form-control"  rows="8"></textarea>
            </div>

            <div class="mb-3">
                <label for="">Preparación</label>
                <textarea id="editor2" name="preparacion" class="form-control"  rows="8"></textarea>
            </div>

            <div class="mb-3">
                <label for="">Categoría</label>
                <select name="categoriaReceta" id="" class="form-select">
                    <?php 
                    while ($categoria = $resultCategorias->fetch_assoc()) {
                        echo '<option value="'.$categoria['idCategoriaReceta'].'">'.$categoria['categoriaReceta'].'</option>';
                    }
                    ?>
                    
                </select>
            </div>

            <div class="mb-3">
                <label for="">Vídeo de la receta</label>
                <input type="text" name="urlVideo" class="form-control">
            </div>

            <button type="submit" class="btn btn-success mt-3">Nueva Receta</button>

            <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>

<!-- Editor de contenido -->
<script>
    CKEDITOR.replace( 'editor' );
    CKEDITOR.replace( 'editor2' );
</script>

<?php include_once('../../includes/footer.php') ?>
