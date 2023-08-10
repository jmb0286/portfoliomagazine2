<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

session_start();

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $lugar = $_POST['lugar'];
    

    if(empty($lugar)){
       
        $notificacion = "Error: No puede haber campos vacios.";
    
    }else{

        $query = "INSERT INTO lugares (lugar) VALUES ('$lugar')";
       
            $result = $connection->query($query);
            
            if($result){
                header('location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido crear el lugar.";
                echo $connection->error;
            }
            
            
    }
    
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-5">
    <div class="container">
    <h1 class="text-center">Alta Lugares</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <form action="crear.php" method="POST" class="col-6 mx-auto">
            <div>
                <label for="">Lugar</label>
                <input type="text" name="lugar" class="form-control">
            </div>


            <button type="submit" class="btn btn-success mt-3">Nuevo Lugar</button>


           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>