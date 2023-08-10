<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
session_start();
// CONSULTAMOS A LA BD LOS DATOS DEL TUTORIAL
if(isset($_GET['id'])){
    $idTutorial = $_GET['id'];
    $query = "SELECT * FROM tutoriales WHERE idTutorial = '$idTutorial'";
    $resultTutorial = $connection->query($query);
    $tutorial = $resultTutorial->fetch_assoc();
    $nombre = $tutorial['nombre'];
    $descripcion = $tutorial['descripcion'];
    $temario = $tutorial['descripcion_temario'];
    $duracion = $tutorial['duracion'];
    $precio = $tutorial['precio'];
    $video = $tutorial['video'];
    $portada = $tutorial['imagen_principal'];
    $idCategoria = $tutorial['idCategoria'];
    $idDificultad = $tutorial['idDificultad'];

}

$notificacion = "";

// CARGA DE CATEGORIAS
$query = "SELECT * FROM categoria";
$resultCategorias = $connection->query($query);

// CARGA DE DIFICULAD 
$query = "SELECT * FROM dificultad";
$resultDificultad = $connection->query($query);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $temario = $_POST['temario'];
    $duracion = $_POST['duracion'];
    $precio = $_POST['precio'];
    $video = $_POST['video'];
    $img = $_FILES['img-nueva']['name'];
    $imgTmpName = $_FILES['img-nueva']['tmp_name'];
	$imgActual = $_POST['img-actual'];  
    $idCategoria = $_POST['idCategoria'];
    $idDificultad = $_POST['idDificultad'];
    $idTutorial = $_POST['idTutorial'];




    if(empty($img)){
        $img = $imgActual;
    }else{
        $archivo_destino='../../imgs/tutoriales/'.$_FILES['img-nueva']['name'];
        move_uploaded_file($imgTmpName,$archivo_destino);
    }

    if(empty($nombre) || empty($descripcion) || empty($idCategoria) || empty($idDificultad)){
        $notificacion = "Error: No puede haber campos vacios.";
    }else{
     
        
        $query = "UPDATE tutoriales SET nombre='$nombre',descripcion='$descripcion', descripcion_temario='$temario' ,duracion='$duracion', precio = '$precio', video = '$video', imagen_principal = '$img', idCategoria='$idCategoria',idDificultad='$idDificultad' WHERE idTutorial = '$idTutorial' ";
        echo $query;
            $result = $connection->query($query);
            if($result){
                header('Location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar el tutorial.";
                echo $connection->error;
            }
    }
    
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-5">
    <div class="container">
    <h1 class="text-center">Modificar Tutorial</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <form action="modificar.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
            <input type="hidden" name="idTutorial" value="<?php echo $idTutorial; ?>">
            <div>
                <label for="">Nombre del tutorial</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo (isset($nombre)) ? $nombre : '' ?>">
            </div>
            <br>
            <div>
                <label for="">Descripción del tutorial</label>
                
                <textarea name="descripcion" class="form-control" rows="10"><?php echo (isset($descripcion)) ? $descripcion: '' ?></textarea>
            </div>
            <br>
            <div>
                <label for="">Temario del curso</label>
                
                <textarea name="temario" class="form-control" rows="10"><?php echo (isset($temario)) ? $temario: '' ?></textarea>
            </div>
            <br>
            <div>
                <label for="video">Video</label>
                <input type="text" name="video" class="form-control" value="<?php echo (isset($video)) ? $video: '' ?>">
            </div>
            <br>
            <div>
                <label for="duracion">Duracion</label>
                <input type="text" name="duracion" class="form-control" value="<?php echo (isset($duracion)) ? $duracion: '' ?>">
            </div>
            <br>
             <div>
                 <label for="imagen_principal">Seleccione una Portada</label>
                <input type="file" class="form-control" name="img-nueva" id="img-nueva">
                <input type="hidden" name="img-actual" value="<?php echo (isset($portada)) ? $portada : '' ?>">
            </div>  
            <br>
            <div>
                <label for="">Categoría</label>
                <select name="idCategoria" id="" class="form-select">
                    <option value="">-- SELECCIONE UNA CATEGORÍA --</option>
                    <?php 
                        while ($fila = $resultCategorias->fetch_assoc()) {
                            if($tutorial['idCategoria'] == $fila['idCategoria']){
                                echo '<option value="'.$fila['idCategoria'].'" selected>'.$fila['nombre'].'</option>';
                            }else{
                                echo '<option value="'.$fila['idCategoria'].'">'.$fila['nombre'].'</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <br>
            <div>
                <label for="">Dificultad</label>
                <select name="idDificultad" id="" class="form-select">
                    <option value="">-- SELECCIONE UNA DIFICULTAD --</option>
                    <?php 
                        while ($fila = $resultDificultad->fetch_assoc()) {
                            if($tutorial['idDificultad'] == $fila['idDificultad']){
                                echo '<option value="'.$fila['idDificultad'].'" selected>'.$fila['dificultad'].'</option>';
                            }else{
                                echo '<option value="'.$fila['idDificultad'].'">'.$fila['dificultad'].'</option>';
                            }
                            
                        }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-success mt-3">Modificar tutorial</button>


           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>