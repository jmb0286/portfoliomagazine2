<?php
session_start();

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";



if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $genero = $_POST['genero'];

    if(empty($genero)){
        $notificacion = "No puede haber campos vacios.";
    }else{

        $query = "INSERT INTO genero_musica(genero) VALUES ('$genero')";
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
        <h1 class="text-center">Nuevo Genero</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>

        <form action="crear.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="">Genero</label>
                <input type="text" name="genero" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-success mt-3">Crear Genero</button>

            <?php 
            if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
            } 
            ?>

        </form>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>