<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";
session_start();
// CARGA DE CATEGORIAS
$query = "SELECT * FROM categoria";
$resultCategorias = $connection->query($query);

// CARGA DE DIFICULTAD 
$query = "SELECT * FROM dificultad";
$resultDificultad = $connection->query($query);

$query = "SELECT * FROM categoria WHERE nombre IN ('Back-End', 'Front-End', 'Maquetado Web')";
$resultCategoriasGenerales = $connection->query($query);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $idCategoria = $_POST['idCategoria'];
    $idCategoriaPadre = $_POST['idCategoriaPadre'];
    $video = $_POST['video'];
    $duracion = $_POST['duracion'];
    $imgPost = $_FILES['img-nueva']['tmp_name'];
    $imgName = $_FILES['img-nueva']['name'];

    if(empty($nombre) || empty($descripcion) || empty($idCategoria)){
        $notificacion = "Error: No puede haber campos vacios.";
    }else{
        
        $archivo_destino='../../imgs/tutoriales/'.$_FILES['img-nueva']['name'];
        move_uploaded_file($imgPost,$archivo_destino);
        
        $query = "INSERT INTO tutoriales(nombre, descripcion, visitas, video, duracion, imagen_principal, idCategoria,idCategoriaPadre) VALUES ('$nombre','$descripcion',0, '$video', '$duracion', '$imgName', '$idCategoria','$idCategoriaPadre' )";


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
    <h1 class="text-center">Nuevo Tutorial</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
    <hr>
        <form action="crear.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
            <div>
                <label for="">Nombre del tutorial</label>
                <input type="text" name="nombre" class="form-control">
            </div>
            <br>
            <div>
                <label for="imagen_portada">Imágen Principal</label>
                <input type="file" class="form-control" name="img-nueva" id="img-nueva">
            </div>
            <br>
            <div>
                <label for="">Descripción del tutorial</label>
                <input type="text" name="descripcion" class="form-control">
            </div>
            <br>
            <div>
                <label for="">Categoría</label>
                <select name="idCategoria" id="" class="form-select">
                    <option value="">-- SELECCIONE UNA CATEGORÍA --</option>
                    <?php 
                        while ($fila = $resultCategorias->fetch_assoc()) {
                            echo '<option value="'.$fila['idCategoria'].'">'.$fila['nombre'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <br>        
            <div>
                <label for="">Categoria General</label>
                <select name="idCategoriaPadre" id="" class="form-select">
                    <option value="">-- SELECCIONE UNA CATEGORIA GENERAL --</option>
                    <?php 
                        while ($fila = $resultCategoriasGenerales->fetch_assoc()) {
                            echo '<option value="'.$fila['idCategoria'].'">'.$fila['nombre'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <br>    
            <div class="mb-3">
                <label for="post-video">Video tutorial</label>
                <input type="text" class="form-control" name="video" id="post-video" required>
            </div>
            <br>            
            <div class="mb-3">
                <label for="duracion">Duracion del Tutorial</label>
                <input type="text" class="form-control" name="duracion" id="duracion" required>
            </div>  

            <button type="submit" class="btn btn-success mt-3">Nuevo tutorial</button>


           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>