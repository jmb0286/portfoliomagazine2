<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";
session_start();

if(isset($_GET['id'])){
    $idVideo = $_GET['id'];
    $query = "SELECT * FROM videos WHERE idVideo = '$idVideo'";
    $resultVideo = $connection->query($query);
    $video = $resultVideo->fetch_assoc();
    $titulo = $video['titulo'];
    $url = $video['url'];
    }


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // ASIGNACION DE VARIABLES PROVENIENTES DEL FORMULARIO
    $idVideo = $_POST['idVideo'];
    $titulo = $_POST['titulo'];
    $url = $_POST['url'];

    
    if(empty($titulo) || empty($url)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        $query = "UPDATE videos SET titulo='$titulo', url='$url' WHERE idVideo = '$idVideo'";
            $result = $connection->query($query);
            if($result){
                header('Location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar el video.";
                echo $connection->error;
            }
    }
}

?>

<?php include_once('../../includes/header.php') ?>

<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Modificar Video</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <form action="modificar.php" method="POST" class="col-6 mx-auto">
            <input type="hidden" name="idVideo" value="<?php echo $idVideo; ?>">
            <div>
                <label for="">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?php echo (isset($titulo)) ? $titulo : '' ?>">
            </div>
            <div>
                <label for="">URL</label>
                <input type="text" name="url" class="form-control" value="<?php echo (isset($url)) ? $url: '' ?>">
            </div>
            
           <button type="submit" class="btn btn-success mt-3">Modificar Video</button>

           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>