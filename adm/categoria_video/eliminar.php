<?php 
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

session_start();

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $idCategoria = $_GET['id'];
    }else{
        echo 'Error: No ha ingresado un ID a eliminar.';
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idCategoria = $_POST['idCategoria'];
    if(empty($idCategoria)){
        $notificacion = "Error: El id de la leccion está vacio";
    }else{
        $query = "DELETE FROM categoria_videos WHERE idCategoriaVideo = $idCategoria";
            $result = $connection->query($query);
            if($result){
                header('location: listado.php');
            }else{
                $notificacion = "Error: No se ha podido eliminar el tutorial solicitada.";
                echo $connection->error;
            }
    }
}
?>


<?php include_once('../../includes/header.php') ?>

<section class="eliminar py-4">
    <div class="container">
    <h1 class="text-center">Eliminar Categoría</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <?php if(empty($notificacion)): ?>
        <form action="eliminar.php" method="POST" class="col-6 mx-auto p-5 bg-dark text-white text-center">
            <input type="hidden" name="idCategoria" value="<?php echo isset($idCategoria) ? $idCategoria : '' ?>">
            <label for="" class="d-block">Está seguro de eliminar categoría seleccionada?</label>
            <button type="submit" class="btn btn-danger mt-4">Eliminar</button>
        </form>
        <?php else: ?>
            <p class='bg-dark mt-3 p-2 text-white text-center'><?php echo $notificacion; ?></p>
        <?php endif; ?>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>