<?php
    include("../../includes/config.php");   
    // CONEXION A LA BASE DE DATOS.
    include("../../includes/conexion.php"); 
    
    $notificacion = '';

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
        $idLeccion = $_GET['id'];

        }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idLeccion = $_POST['idLeccion'];
       
        $query = "DELETE FROM detalle_categoria_leccion WHERE idLeccion = '$idLeccion'";
        $result = $connection->query($query);

        $query = "DELETE FROM lecciones WHERE idLeccion = '$idLeccion'";
        $result = $connection->query($query);

        if ($result){
            header('Location: listado.php');

        }else{
            $notificacion = "Error: No se ha podido Eliminar la lección";
        } 
    }

    

    include("../../includes/header.php");
?>

<main class="lecciones-eliminar">

    <section class="panel-adm py-4">
        <div class="container">

            <div class="row">

                <?php include("../../includes/adm-side-menu.php"); ?>

                <div class="sidebar-content">
                    <h1 class="text-center">Eliminar Lección</h1>
                    <?php if($notificacion == ''): ?>
                    <form action="eliminar.php" method="POST" class="col-md-6 mx-auto">
                        <?php if(isset($notificacion)) :  ?>
                        <p class="text-center"><?php echo $notificacion; ?></p>
                        <?php endif;  ?>
                        <input type="hidden" name="idLeccion" value="<?php echo $idLeccion; ?>">
                        <p class="my-4">Está seguro que desea eliminar la Lección seleccionada?</p>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    <?php else: ?>
                    <p class='bg-dark mt-3 p-2 text-white text-center'><?php echo $notificacion; ?></p>
                    <?php endif; ?>
                </div>
            </div>



        </div>
    </section>


</main>



<?php include("../../includes/footer.php"); ?>