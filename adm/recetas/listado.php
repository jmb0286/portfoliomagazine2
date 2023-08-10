<?php
session_start();
include("../../includes/config.php");   


if(!isset($_SESSION['idUsuario'])){
    header('Location: ../index.php'); 
}

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php"); 

$notificacion = "";

// CARGA DE RECETAS
$query = "SELECT * FROM recetas ORDER BY fechaPublicacion DESC";

$recetas = $connection->query($query);

?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de Recetas</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove recetas">
                <thead>
                    <tr>
                        <th scope="col">Imágen</th>
                        <th scope="col">Título</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php 
                    while ($receta = $recetas->fetch_assoc()) {
                        echo '<tr>
                            <td><img src="'.RUTARAIZ.'/imgs/magazine/recetas/'.$receta['portada'].'" alt="" class="img-fluid" style="max-width:80px"></td>
                            <td>'.$receta['titulo'].'</td>
                            <td>'.date("d/m/Y", strtotime($receta['fechaPublicacion'])).'</td>
         
                            <td>'.$receta['descripcion'].'</td>
                            <td>
                                <div class="d-flex">
                                    <a href="eliminar.php?id='.$receta['idReceta'].'" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    <a href="modificar.php?id='.$receta['idReceta'].'" class="btn btn-success">
                                    <i class="fa-solid fa-gear"></i></a>
                                </div>

                             
                            </td>
                        </tr>';
                    }
                ?>
                
                
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>