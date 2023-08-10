<?php
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
session_start();
$notificacion = "";
if(isset($_GET['idBusqueda'])){
    $filtro = $_GET['idBusqueda'];
    // CARGA DE CATEGORIAS
    $query = "SELECT idTutorial, imagen_principal, tutoriales.nombre,tutoriales.descripcion,categoria.nombre as categoria,dificultad.dificultad as nivel, visitas FROM tutoriales INNER JOIN categoria ON categoria.idCategoria = tutoriales.idCategoria INNER JOIN dificultad ON dificultad.idDificultad = tutoriales.idDificultad WHERE idCategoriaPadre = '$filtro' ORDER BY categoria.nombre,tutoriales.idTutorial";
    $tutoriales = $connection->query($query);
    }else{
        $query = "SELECT idTutorial, imagen_principal, tutoriales.nombre,tutoriales.descripcion,categoria.nombre as categoria, visitas FROM tutoriales INNER JOIN categoria ON categoria.idCategoria = tutoriales.idCategoria ORDER BY categoria.nombre,tutoriales.idTutorial";
        $tutoriales = $connection->query($query);
        }








?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de tutoriales</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove">
                <thead>
                    <tr>
                        <th scope="col">Portada</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Visitas</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    while ($tutorial = $tutoriales->fetch_assoc()) {
                        echo '<tr>
                            <td style="max-width: 32px;"><img src="'.RUTARAIZ.'/imgs/tutoriales/'.$tutorial['imagen_principal'].'" alt="" class="img-fluid"></td>
                            <td>'.$tutorial['nombre'].'</td>
                            <td>'.$tutorial['descripcion'].'</td>
                            <td>'.$tutorial['categoria'].'</td>
                            <td>'.$tutorial['visitas'].'</td>
                            <td>
                                <a href="eliminar.php?id='.$tutorial['idTutorial'].'" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                <a href="modificar.php?id='.$tutorial['idTutorial'].'" class="btn btn-success"><i class="fa-solid fa-gear"></i></a>
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