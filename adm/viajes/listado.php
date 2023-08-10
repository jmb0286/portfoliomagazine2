<?php
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

session_start();

$notificacion = "";

// CARGA DE CATEGORIAS
$query = "SELECT * FROM viajes";

$viajes = $connection->query($query);

?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de Viajes</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Viajes</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while ($viaje = $viajes->fetch_assoc()) {
                        echo '<tr>
                            <td>'.$viaje['idViaje'].'</td>
                            <td>'.$viaje['viaje'].'</td>
                            <td>
                                <a href="modificar.php?id='.$viajes['idViaje'].'" class="btn btn-success">Modificar</i></a>
                                <a href="eliminar.php?id='.$viajes['idViaje'].'" class="btn btn-danger">Eliminar</a>
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