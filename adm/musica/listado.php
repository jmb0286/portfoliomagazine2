<?php
session_start();

if(!isset($_SESSION['idUsuario'])){
    header('Location: ../index.php'); 
}

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";

// CARGA DE RECETAS
$query = "SELECT * FROM musica INNER JOIN genero_musica ON genero_musica.idGenero = musica.idGenero";
$musica = $connection->query($query);

?>
<?php include_once('../../includes/header.php') ?>

<section class="listado">
    <div class="container">
        <h1 class="text-center">Listado de Música</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hove recetas">
                <thead>
                    <tr>
                      
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Genero</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php 
                    while ($fila = $musica->fetch_assoc()) {
                        echo '<tr>
                           
                            <td>'.$fila['titulo'].'</td>
                            <td>'.$fila['descripcion'].'</td>
                            <td>'.$fila['genero'].'</td>
                            <td>
                                <a href="modificar.php?id='.$fila['idMusica'].'" class="btn btn-success">Modificar</a>
                                <a href="eliminar.php?id='.$fila['idMusica'].'" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>';
                    }
                ?>
                
                
                </tbody>
            </table>
        </div>
    </div>
</section>


<!-- 

Spotify

<iframe style="border-radius:12px" src="https://open.spotify.com/embed/playlist/7A7zXuxRWEJ7ZR5IkiDoBO?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

                -->

<?php include_once('../../includes/footer.php') ?>