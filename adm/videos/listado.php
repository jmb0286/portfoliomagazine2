<?php
session_start();


// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";

// CARGA DE RECETAS
$query = "SELECT * FROM videos";

$video = $connection->query($query);

?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de Videos</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove recetas">
                <thead>
                    <tr>
                      
                        <th scope="col">Título</th>
                        <th scope="col">Url</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php 
                    while ($fila = $video->fetch_assoc()) {
                        echo '<tr>
                           
                            <td>'.$fila['titulo'].'</td>
                            <td>'.$fila['url'].'</td>
                            <td>
                                <a href="modificar.php?id='.$fila['idVideo'].'" class="btn btn-success">Modificar</a>    
                                <a href="eliminar.php?id='.$fila['idVideo'].'" class="btn btn-danger">Eliminar</a>
                                
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