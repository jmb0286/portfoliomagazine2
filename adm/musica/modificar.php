<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
session_start();

$notificacion = "";

$query = "SELECT * FROM genero_musica";
$resultGeneros = $connection->query($query);

if(isset($_GET['id'])){
    $idMusica = $_GET['id'];
    $query = "SELECT * FROM musica WHERE idMusica = '$idMusica'";
    $resultMusica = $connection->query($query);
    $musica = $resultMusica->fetch_assoc();
    $titulo = $musica['titulo'];
    $idGenero = $musica['idGenero'];
    $url = $musica['urlLista'];
    $descripcion = $musica['descripcion'];
    }


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // ASIGNACION DE VARIABLES PROVENIENTES DEL FORMULARIO
    $idMusica = $_POST['idMusica'];
    $titulo = $_POST['titulo'];
    $url = $_POST['url'];
    $idGenero = $_POST['genero'];
    $descripcion = $_POST['descripcion'];
    
    if(empty($titulo) || empty($url)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        $query = "UPDATE musica SET titulo='$titulo', urlLista='$url', descripcion = '$descripcion', idGenero = '$idGenero' WHERE idMusica = '$idMusica'";
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
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <form action="modificar.php" method="POST" class="col-6 mx-auto">
            <input type="hidden" name="idMusica" value="<?php echo $idMusica; ?>">
            <div>
                <label for="">Título</label>
                <input type="text" name="titulo" class="form-control" value="<?php echo (isset($titulo)) ? $titulo : '' ?>">
            </div>
            <div>
                <label for="">URL</label>
                <input type="text" name="url" class="form-control" value="<?php echo (isset($url)) ? $url: '' ?>">
            </div>

            <div class="mb-3">
                <label for="genero">Genero</label>
                <select name="genero" id="genero" class="form-select">
                    
                    <?php 
                        while ($genero = $resultGeneros->fetch_assoc()) {
                            if($idGenero == $genero['idGenero']){
                                echo '<option value="'.$genero['idGenero'].'" selected>'.$genero['genero'].'</option>';
                            }else{
                                echo '<option value="'.$genero['idGenero'].'">'.$genero['genero'].'</option>';
                            }
                            
                        }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="">Descripción</label>
                <textarea name="descripcion" class="form-control" cols="30" rows="10"><?= (isset($descripcion)) ? $descripcion: '' ?></textarea>
            </div>
            
           <button type="submit" class="btn btn-success mt-3">Modificar Música</button>

           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>