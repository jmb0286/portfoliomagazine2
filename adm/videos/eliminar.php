<?php 
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
$notificacion = "";
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $idVideo = $_GET['id'];
    }else{
        echo 'Error: No ha ingresado un ID a eliminar.';
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idVideo = $_POST['idVideo'];
    if(empty($idVideo)){
        $notificacion = "Error: El id de la receta está vacio";
    }else{
        $query = "DELETE FROM videos WHERE idVideo = $idVideo";
            $result = $connection->query($query);
            if($result){
                $notificacion = "Exito: Se ha eliminado el video correctamente.";
            }else{
                $notificacion = "Error: No se ha podido eliminar el video solicitada.";
                echo $connection->error;
            }
    }
}
?>


<?php include_once('../../includes/header.php') ?>

<section class="eliminar py-4">
    <div class="container">
    <h1 class="text-center">Eliminar Video</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <?php if(empty($notificacion)): ?>
        <form action="eliminar.php" method="POST" class="col-6 mx-auto p-5 bg-dark text-white text-center">
            <input type="hidden" name="idVideo" value="<?php echo isset($idVideo) ? $idVideo: '' ?>">
            <label for="" class="d-block">Está seguro de eliminar la musica seleccionada?</label>
            <button type="submit" class="btn btn-danger mt-4">Eliminar</button>
        </form>
        <?php else: ?>
            <p class='bg-dark mt-3 p-2 text-white text-center'><?php echo $notificacion; ?></p>
        <?php endif; ?>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>