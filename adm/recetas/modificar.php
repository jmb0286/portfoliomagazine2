<?php
session_start();
include("../../includes/config.php");   


if(!isset($_SESSION['idUsuario'])){
    header('Location: ../index.php'); 
}

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php"); 


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idReceta = $_GET['id'];
    $query = "SELECT * FROM recetas WHERE idReceta = '$idReceta'";
    $resultReceta = $connection->query($query);
    $receta = $resultReceta->fetch_assoc();
    $titulo = $receta['titulo'];
    $descripcion = $receta['descripcion'];
    $contenido = $receta['contenido'];
    $imgActual = $receta['portada'];
    $idCategoriaReceta = $receta['idCategoriaReceta'];
    $urlVideo = $receta['urlVideo'];
}

$query = "SELECT * FROM categorias_recetas";
$resultCategorias = $connection->query($query);

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idReceta = $_POST['idReceta'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $contenido = $_POST['contenido'];
    $imgPost = $_FILES['nuevo_img']['tmp_name'];
    $imgName = $_FILES['nuevo_img']['name'];
    $imgActual = $_POST['imgActual'];
    $idCategoriaReceta = $_POST['categoriaReceta'];
    $autor = $_SESSION['idUsuario'];
    $fecha = date ('Y-m-d');
    $urlVideo = $_POST['urlVideo'];

    
    if(empty($titulo) || empty($descripcion)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        if(empty($imgName)){
            $imgName=$imgActual;
        }else{
            // SUBIR IMAGEN
            $archivo_destino = '../../imgs/magazine/recetas/'.$_FILES['nuevo_img']['name'];
            move_uploaded_file($imgPost,$archivo_destino);
        }


        $query = "UPDATE recetas SET titulo='$titulo',descripcion='$descripcion',contenido='$contenido',portada='$imgName',urlVideo='$urlVideo',idCategoriaReceta='$idCategoriaReceta' WHERE idReceta = '$idReceta'";
       
        $result = $connection->query($query);
        
            if($result){
                 header('location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar la Receta.";
                echo $connection->error;
            }
    }
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Modificar Receta</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>

        <form action="modificar.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
            <input type="hidden" name="idReceta" value = "<?= $idReceta; ?>">
            <div class="mb-3">
                <label for="">Título de la receta</label>
                <input type="text" name="titulo" class="form-control" value = "<?= $titulo; ?>">
            </div>
            <div class="mb-3">
                <label for="post-img">Imágen principal</label>
                <input type="file" class="form-control" name="nuevo_img" id="post-img">
                <input type="hidden" name="imgActual" value = "<?= $imgActual; ?>">
            </div>

            <div class="mb-3">
                <label for="">Descripción</label>
                <textarea name="descripcion" class="form-control"  rows="4"><?= $descripcion; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="">Contenido</label>
                <textarea id="editor" name="contenido" class="form-control"  rows="8"><?= $contenido; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="">Categoría</label>
                <select name="categoriaReceta" id="" class="form-select">
                    <?php 
                    while ($categoria = $resultCategorias->fetch_assoc()) {
                        if($idCategoriaReceta == $categoria['idCategoriaReceta']){
                            echo '<option value="'.$categoria['idCategoriaReceta'].'" selected>'.$categoria['categoriaReceta'].'</option>';
                        }else{
                            echo '<option value="'.$categoria['idCategoriaReceta'].'">'.$categoria['categoriaReceta'].'</option>';
                        }
                     
                    }
                    ?>
                    
                </select>
            </div>

            <div class="mb-3">
                <label for="">Vídeo de la receta</label>
                <input type="text" name="urlVideo" class="form-control" value = "<?= $urlVideo; ?>">
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
</script>

<?php include_once('../../includes/footer.php') ?>
