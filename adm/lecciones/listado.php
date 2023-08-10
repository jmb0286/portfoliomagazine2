<?php
    include("../../includes/config.php");   
    // CONEXION A LA BASE DE DATOS.
    include("../../includes/conexion.php"); 

    $query = "SELECT * FROM categorias";
    $resultCategorias = $connection->query($query);

    if(isset($_GET['filtro'])){
        $idCategoria = $_GET['filtro'];
        $query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion as dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = '$idCategoria' ORDER BY portadaLeccion";
        $resultLecciones = $connection->query($query);
    }else{
        $query = "SELECT * FROM lecciones ORDER BY portadaLeccion";
        $resultLecciones = $connection->query($query);
    }
    



    include("../../includes/header.php");
?>




<main class="lecciones-listar">



    <section class="panel-adm py-4">

        <div class="container">
            <h3 class="center">Panel Administrativo</h3>
            <div class="row">

                <?php include("../../includes/adm-side-menu.php"); ?>

                <div class="sidebar-content p-2">
                    <div class="d-flex justify-content-start mb-3">
                        <a href="crear.php" class="btn btn-primary">Nueva Lección</a>
                    </div>
                    
          
                    <div class="table-responsive">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Portada</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                      while ($leccion = $resultLecciones->fetch_assoc()){
                        $estado = ($leccion['baja_leccion'] == 0) ? 'activo': 'baja';
                        echo '<tr>
                                <td>'.$leccion['idLeccion'].'</td>
                                <td>'.$estado.'</td>
                                <td>'.$leccion['portadaLeccion'].'</td>
                                <td>'.$leccion['titulo'].'</td>
                                <td>'.$leccion['descripcion'].'</td>
                                <td>
                                    <a href="detalle.php?id='.$leccion['idLeccion'].'" class="btn btn-success">Ver más</a>                  
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


</main>














<?php include("../../includes/footer.php"); ?>