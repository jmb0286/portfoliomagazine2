<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location: ../index.php'); 
}

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";

// CARGA DE RECETAS
$query = "SELECT * FROM codigo_ejemplo";
$resultGeneros = $connection->query($query);

?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de Código ejemplo</h1>
        <div class="botonera d-flex justify-content-end">
        <a href="../codigo_ejemplo/crear.php" class="btn btn-outline-primary"><i class="fa-solid fa-plus icono-secundario"></i></a> 
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove recetas">
                <thead>
                    <tr>
                      
                        <th scope="col">Código</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php 
                    while ($fila = $resultGeneros->fetch_assoc()) {
                        echo '<tr>
                           
                            <td>'.$fila['codigo'].'</td>
                            <td>'.$fila['categoria'].'</td>
                            <td>
                                <a href="modificar.php?id='.$fila['idCodigoEjemplo'].'" class="btn btn-success">Modificar</a>
                                <a href="eliminar.php?id='.$fila['idCodigoEjemplo'].'" class="btn btn-danger">Eliminar</a>
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