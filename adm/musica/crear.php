<?php
session_start();

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";

$query = "SELECT * FROM genero_musica";
$resultGeneros = $connection->query($query);

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $titulo = $_POST['titulo'];
    $idGenero = $_POST['genero'];
    $descripcion = $_POST['descripcion'];
    /*$imgPortada = $_FILES['nuevo_img']['tmp_name'];
    $imgName = $_FILES['nuevo_img']['name'];*/
    $portada = null;
    $url = $_POST['url'];
       
    if(empty($titulo) || empty($descripcion) || empty($url)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        // SUBIR IMAGEN
       /* $archivo_destino = '../../imgs/magazine/musica/'.$_FILES['nuevo_img']['name'];
        move_uploaded_file($imgName, $archivo_destino);*/

        $query = "INSERT INTO musica(titulo, descripcion, portada, urlLista, idGenero) VALUES ('$titulo', '$descripcion', '$portada', '$url', '$idGenero')";
        $result = $connection->query($query);
            if($result){
                 header('location: listado.php');
            }else{
                $notificacion = "Error: No se ha podido crear la lista de reproducción.";
                echo $connection->error;
            }
    }
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Nueva Música</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>

        <form action="crear.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="">Título</label>
                <input type="text" name="titulo" class="form-control">
            </div>
            <div class="mb-3">
                <label for="url">Url Spotify</label>
                <input type="text" class="form-control" name="url" id="url" required>
            </div>

            <div class="mb-3">
                <label for="post-img">Imágen principal</label>
                <input type="file" class="form-control" name="nuevo_img" id="post-img">
            </div>

            <div class="mb-3">
                <label for="genero">Genero</label>
                <select name="genero" id="genero" class="form-select">
                    
                    <?php 
                        while ($genero = $resultGeneros->fetch_assoc()) {
                            echo '<option value="'.$genero['idGenero'].'">'.$genero['genero'].'</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="">Descripción</label>
                <textarea name="descripcion" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-success mt-3">Crear nueva lista</button>

            <?php 
            if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
            } 
            ?>

        </form>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>