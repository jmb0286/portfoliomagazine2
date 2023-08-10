<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

session_start();

// CONSULTAMOS A LA BD LOS DATOS DEL TUTORIAL
if(isset($_GET['id'])){
    $idLugar = $_GET['id'];
    $query = "SELECT * FROM lugares WHERE idLugar = '$idLugar'";
    $resultLugares = $connection->query($query);
    $lugares = $resultLugares->fetch_assoc();
    $lugar = $lugares['lugar'];
    $idLugar = $lugares['idLugar'];
    
}

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $lugar = $_POST['lugar'];
    $idLugar = $_POST['idlugar'];

    if(empty($lugar) || empty($idLugar)){
        $notificacion = "Error: No puede haber campos vacios.";
    }else{
        $query = "UPDATE lugares SET lugar='$lugar' WHERE idLugar = '$idLugar' ";
            $result = $connection->query($query);
            if($result){
                header('Location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar el lugar.";
                echo $connection->error;
            }
    }
    
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-5">
    <div class="container">
    <h1 class="text-center">Modificar Lugar</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <form action="modificar.php" method="POST" class="col-6 mx-auto">
            <input type="hidden" name="idlugar" value="<?php echo $idLugar; ?>">
            <div>
                <label for="nombre">Nombre del Lugar</label>
                <input type="text" name="lugar" class="form-control" value="<?php echo (isset($lugar)) ? $lugar : '' ?>">
            </div>
            
            

            <button type="submit" class="btn btn-success mt-3">Modificar Lugar</button>


           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>