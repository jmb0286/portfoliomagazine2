<?php
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

session_start();

$notificacion = "";

// CARGA DE CATEGORIAS
$query = "SELECT * FROM lugares";

$lugares = $connection->query($query);

?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de lugares</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Lugar</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while ($lugar = $lugares->fetch_assoc()) {
                        echo '<tr>
                            <td>'.$lugar['idLugar'].'</td>
                            <td>'.$lugar['lugar'].'</td>
                            <td>
                                <a href="modificar.php?id='.$lugar['idLugar'].'" class="btn btn-success">Modificar</i></a>
                                <a href="eliminar.php?id='.$lugar['idLugar'].'" class="btn btn-danger">Eliminar</a>
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