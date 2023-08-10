<?php
session_start();

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";

$query = "SELECT * FROM imagenes INNER JOIN lugares ON lugares.idLugar = imagenes.idLugar INNER JOIN viajes ON viajes.idViaje = imagenes.idViaje";
$imagenes = $connection->query($query);

?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de Imágenes</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove recetas">
                <thead>
                    <tr>
                        <th scope="col">Anio</th>
                        <th scope="col">Mes</th>
                        <th scope="col">Lugar</th>
                        <th scope="col">Viaje</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php 
                    while ($imagen = $imagenes->fetch_assoc()) {
                        echo '<tr>
                            <td>'.$imagen['anio'].'</td>    
                            <td>'.$imagen['mes'].'</td> 
                            <td>'.$imagen['lugar'].'</td> 
                            <td>'.$imagen['viaje'].'</td> 
                            <td><img src="'.RUTARAIZ.'/imgs/magazine/imagenes/'.$imagen['anio'].'/'.$imagen['mes'].'/'.$imagen['url_img'].'" class="d-block " style="width:100px; height:100px!important;" alt="..."></td>
                            <td>
                                <a href="eliminar.php?id='.$imagen['idImagen'].'" class="btn btn-danger">Eliminar</i></a>
                                <a href="modificar.php?id='.$imagen['idImagen'].'" class="btn btn-success">Modificar</a>
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