<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

session_start();

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $nombre = $_POST['nombre'];
    

    if(empty($nombre)){
       
        $notificacion = "Error: No puede haber campos vacios.";
    
    }else{

        $query = "INSERT INTO categoria_videos (nombre) VALUES ('$nombre')";
       
            $result = $connection->query($query);
            
            if($result){
                header('location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido crear el tutorial.";
                echo $connection->error;
            }
            
            
    }
    
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-5">
    <div class="container">
    <h1 class="text-center">Nueva Categoría Video</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <form action="crear.php" method="POST" class="col-6 mx-auto">
            <div>
                <label for="">Nombre de la Categoría Video</label>
                <input type="text" name="nombre" class="form-control">
            </div>


            <button type="submit" class="btn btn-success mt-3">Nueva Categoría</button>


           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>