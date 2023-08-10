<?php
session_start();

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$query = "SELECT * FROM categoria_videos";
$resultCategorias = $connection->query($query);


$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titulo = $_POST['titulo'];
    $url = $_POST['url'];
    $descripcion = $_POST['descripcion'];
    $idCategoria = $_POST['categoria'];


    if(empty($titulo) || empty($url) || empty($descripcion)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        $query = "INSERT INTO videos (titulo, url, descripcion, idCategoriaVideo) VALUES ('$titulo','$url', '$descripcion', '$idCategoria')";
        $result = $connection->query($query);
            if($result){
                 header('location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido crear el video.";
                echo $connection->error;
            }
    }
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Nuevo Video</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>

        <form action="crear.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">

        <div class="mb-3">
                <label for="categoriaVideo">Genero</label>
                <select name="categoria" id="categoriaVideo" class="form-select">
                    
                    <?php 
                        while ($categoriaVideo = $resultCategorias->fetch_assoc()) {
                            echo '<option value="'.$categoriaVideo['idCategoriaVideo'].'">'.$categoriaVideo['nombre'].'</option>';
                        }
                    ?>
                </select>
            </div>

        <div class="mb-3">
                <label for="">Título</label>
                <input type="text" name="titulo" class="form-control">
            </div>
    
            <div class="mb-3">
                <label for="url">Url YouTuBe</label>
                <input type="text" class="form-control" name="url" id="url" required>
            </div>
          

            <div class="mb-3">
                <label for="">Descripción</label>
                <textarea name="descripcion" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Crear nuevo vídeo</button>

            <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>