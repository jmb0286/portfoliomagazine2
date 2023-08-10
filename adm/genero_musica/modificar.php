<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
session_start();

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $idGenero = $_GET['id'];
        $query = "SELECT * FROM genero_musica WHERE idGenero = '$idGenero'";
        $resultGenero = $connection->query($query);
        $datosGenero = $resultGenero->fetch_assoc();
        $genero = $datosGenero['genero'];
    }else{
        echo 'Error: No ha ingresado un ID a eliminar.';
    }
}




if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // ASIGNACION DE VARIABLES PROVENIENTES DEL FORMULARIO
    $idGenero = $_POST['idGenero'];
    $genero = $_POST['genero'];

    
    if(empty($genero)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        $query = "UPDATE genero_musica SET genero = '$genero' WHERE idGenero = '$idGenero'";
            $result = $connection->query($query);
            if($result){
                header('Location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar la lección.";
                echo $connection->error;
            }
    }
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Modificar Música</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <form action="modificar.php" method="POST" class="col-6 mx-auto">
            <input type="hidden" name="idGenero" value="<?php echo $idGenero; ?>">

            <div class="mb-3">
                <label for="">Genero</label>
                <input type="text" name="genero" class="form-control" value="<?php echo $genero; ?>">
            </div>
            
           <button type="submit" class="btn btn-success mt-3">Modificar Música</button>

           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>