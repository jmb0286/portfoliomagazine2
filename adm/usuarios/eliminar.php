<?php 
session_start();

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['id'])){
        $idUsuario = $_GET['id'];
    }else{
        $notificacion = 'Error: No ha ingresado un ID a eliminar.';
    }

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // RECIBO UNA PETICION TIPO POST EN EL SERVIDOR
    // CAPTURO LA VARIABLE DEL INPUT DEL FORMULARIO
    $idUsuario = $_POST['idUsuario'];
    if(empty($idUsuario)){
        $notificacion = "Error: El id de la leccion está vacio";
    }else{
        // ELIMINO EL USUARIO DE LA BASE DE DATOS.
        $query = "DELETE FROM usuarios WHERE idUsuario = $idUsuario";
            $result = $connection->query($query);
            if($result){
                $notificacion = "Exito: Se ha eliminado el usuario correctamente.";
            }else{
                $notificacion = "Error: No se ha podido eliminar el usuario solicitada.";
                echo $connection->error;
            }
            
    }
}
?>


<?php include_once('../../includes/header.php') ?>

<section class="panel-adm py-4">
    <div class="container">
       
        <div class="row">

            <?php include("../../includes/adm-side-menu.php"); ?>

            <div class="sidebar-content">
            <h1 class="text-center">Eliminar Usuario</h1>
                <?php if($notificacion == ''): ?>
                <form action="eliminar.php" method="POST" class="col-6 mx-auto p-5 bg-dark text-white text-center">
                    <input type="hidden" name="idUsuario" value="<?php echo isset($idUsuario) ? $idUsuario : '' ?>">
                    <label for="" class="d-block">Está seguro de eliminar el usuario seleccionado?</label>
                    <button type="submit" class="btn btn-danger mt-4">Eliminar</button>
                </form>
                <?php else: ?>
                <p class='bg-dark mt-3 p-2 text-white text-center'><?php echo $notificacion; ?></p>
                <?php endif; ?>
            </div>
        </div>



    </div>
</section>

<?php include_once('../../includes/footer.php') ?>