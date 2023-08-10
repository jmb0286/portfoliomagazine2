<?php 
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
include("../../includes/config.php");
$notificacion = "";
session_start();


if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $idImagen = $_GET['id'];
    }else{
        $notificacion = 'Error: No ha ingresado un ID a eliminar.';
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idImagen = $_POST['idImagen'];
    if(empty($idImagen)){
        $notificacion = "Error: El id de la imagen está vacio";
    }else{
            $query = "SELECT * FROM imagenes WHERE idImagen = '$idImagen'";
            $resultado = $connection->query($query);
            $imagen = $resultado->fetch_assoc();

            if(file_exists('../../imgs/magazine/imagenes/'.$imagen['fecha'].'/'.$imagen['mes'].'/'.$imagen['imagen'])){
                if(unlink('../../imgs/magazine/imagenes/'.$imagen['fecha'].'/'.$imagen['mes'].'/'.'/'.$imagen['imagen'])){
                    
                    $query = "DELETE FROM imagenes WHERE idImagen = $idImagen";
                    $result = $connection->query($query); 
                    if($result){
                        $notificacion = "Éxito: el archivo ha sido eliminado correctamente";
                    }else{
                        $notificacion = "Error: No se ha podido eliminar la imagen de la base de datos.";
                    }
                    
                }else{
                    $notificacion = "Error: Ha ocurrido un error al intentar eliminar el archivo del servidor.";
                }
            }else{

             
                $query = "DELETE FROM imagenes WHERE idImagen = $idImagen";
                    $result = $connection->query($query); 
                    if($result){
                        $notificacion = "Éxito: el archivo ha sido eliminado correctamente";
                     
                    }else{
                        $notificacion = "Error: No se ha podido eliminar la imagen de la base de datos.";
                    }
            }

            
    }
}
?>


<?php include_once('../../includes/header.php') ?>

<section class="eliminar py-4">
    <div class="container">
    <h1 class="text-center">Eliminar Imágen</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <?php if(empty($notificacion)): ?>
        <form action="eliminar.php" method="POST" class="col-6 mx-auto p-5 bg-dark text-white text-center">
            <input type="hidden" name="idImagen" value="<?php echo isset($idImagen) ? $idImagen : '' ?>">
            <label for="" class="d-block">Está seguro de eliminar la imágen seleccionada?</label>
            <button type="submit" class="btn btn-danger mt-4">Eliminar</button>
        </form>
        <?php else: ?>
            <p class='bg-dark mt-3 p-2 text-white text-center'><?php echo $notificacion; ?></p>
        <?php endif; ?>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>