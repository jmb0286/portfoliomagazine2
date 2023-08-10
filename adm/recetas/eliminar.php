<?php
session_start();
include("../../includes/config.php");   


if(!isset($_SESSION['idUsuario'])){
    header('Location: ../index.php'); 
}

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php"); 


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $idReceta = $_GET['id'];
    }else{
        echo 'Error: No ha ingresado un ID a eliminar.';
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idReceta = $_POST['idReceta'];
    if(empty($idReceta)){
        $notificacion = "Error: El id de la receta está vacio";
    }else{
        $query = "DELETE FROM recetas WHERE idReceta = $idReceta";
            $result = $connection->query($query);
            if($result){
                $notificacion = "Exito: Se ha eliminado la receta correctamente.";
            }else{
                $notificacion = "Error: No se ha podido eliminar la receta solicitada.";
                echo $connection->error;
            }
    }
}
?>


<?php include_once('../../includes/header.php') ?>

<section class="eliminar py-4">
    <div class="container">
    <h1 class="text-center">Eliminar Receta</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <?php if(empty($notificacion)): ?>
        <form action="eliminar.php" method="POST" class="col-6 mx-auto p-5 bg-dark text-white text-center">
            <input type="hidden" name="idReceta" value="<?php echo isset($idReceta) ? $idReceta : '' ?>">
            <label for="" class="d-block">Está seguro de eliminar la receta seleccionada?</label>
            <button type="submit" class="btn btn-danger mt-4">Eliminar</button>
        </form>
        <?php else: ?>
            <p class='bg-dark mt-3 p-2 text-white text-center'><?php echo $notificacion; ?></p>
        <?php endif; ?>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>