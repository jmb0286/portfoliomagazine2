<?php
    
    session_start();

    // CONEXION A LA BASE DE DATOS.
    include("../../includes/conexion.php");   

    $notificacion = "";

    // CARGA DE CATEGORIAS
    $query = "SELECT * FROM usuarios ORDER BY idUsuario";

    $usuarios =  $connection->query($query);

    include("../../includes/header.php");

?>


<section class="panel-adm py-4">

    <div class="container">
        <h3 class="center">Panel Administrativo</h3>
        <div class="row">
            
            <?php include("../../includes/adm-side-menu.php"); ?> 

            <div class="sidebar-content">
                <div class="table-responsive">
                    <table class="table table-striped table-hove">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Contraseña</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Acción</th>
            
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                    while ($usuario = $usuarios->fetch_assoc()) {
                        echo '<tr>
                            <td>'.$usuario['idUsuario'].'</td>
                            <td>'.$usuario['nombre'].'</td>
                            <td>'.$usuario['apellido'].'</td>
                            <td>'.$usuario['correo'].'</td>
                            <td>'.$usuario['telefono'].'</td>
                            <td>'.$usuario['password'].'</td> 
                            <td>'.$usuario['rol'].'</td>
                            <td>
                            <a href="detalle.php?id='.$usuario['idUsuario'].'" class="btn btn-success">Ver más</a>                        
                            </td>
                        </tr>';
                    }
                ?>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</section>



<?php include("../../includes/footer.php"); ?>