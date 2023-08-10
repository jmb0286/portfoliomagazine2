<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

session_start();

// CONSULTAMOS A LA BD LOS DATOS DEL TUTORIAL
if(isset($_GET['id'])){
    $idCategoria = $_GET['id'];
    $query = "SELECT * FROM categorias WHERE idCategoria = '$idCategoria'";
    $resultCategoria = $connection->query($query);
    $categoria = $resultCategoria->fetch_assoc();
    $nombre = $categoria['nombreCategoria'];
    $idCategoria = $categoria['idCategoria'];
    
}

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $idCategoria = $_POST['idCategoria'];

    if(empty($nombre) || empty($idCategoria)){
        $notificacion = "Error: No puede haber campos vacios.";
    }else{
        $query = "UPDATE categorias SET nombreCategoria='$nombre' WHERE idCategoria = '$idCategoria' ";
            $result = $connection->query($query);
            if($result){
                header('Location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar la categoria.";
                echo $connection->error;
            }
    }
    
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-5">
    <div class="container">
    <h1 class="text-center">Modificar Categoría</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <form action="modificar.php" method="POST" class="col-6 mx-auto">
            <input type="hidden" name="idCategoria" value="<?php echo $idCategoria; ?>">
            <div>
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo (isset($nombre)) ? $nombre : '' ?>">
            </div>
            
            

            <button type="submit" class="btn btn-success mt-3">Modificar Categoría</button>


           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>