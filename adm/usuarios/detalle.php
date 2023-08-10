<?php
    
    session_start();

    // CONEXION A LA BASE DE DATOS.
    include("../../includes/conexion.php");   

    $notificacion = "";

    if(isset($_GET['id'])){
        $idUsuario = $_GET['id'];
        $query = "SELECT * FROM usuarios WHERE idUsuario = '$idUsuario'";
        $resultUsuario = $connection->query($query);
        $usuario = $resultUsuario->fetch_assoc();
        $nombre = $usuario['nombre'];
        $apellido = $usuario['apellido'];
        $password = $usuario['password'];
        $correo = $usuario['correo'];
        $telefono = $usuario['telefono'];
        $imgActual = $usuario['avatar'];
        $rol = $usuario['rol'];
        $notificar = $usuario['notificacion'];
    }

    
// REQUEST METHOD -> CONSULTA EL TIPO DE PETICION QUE ESTÁ RECIBIENDO EL SERVIDOR -> POST o GET.
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];
    $idUsuario = $_POST['idUsuario'];
    $notificar = ($_POST['notificar']) ? '1' : '0';

    $imgActual = $_POST['imgActual'];
    $imgPost = $_FILES['nuevo_img']['tmp_name'];
    $imgName = $_FILES['nuevo_img']['name'];

    if(empty($nombre) || empty($apellido) || empty($correo) || empty($password) || empty($passwordConfirm) || empty($telefono) || empty($rol)){
        $notificacion = "Error: No puede haber campos vacios.";
    }if($password != $passwordConfirm){
        $notificacion = "Error: Las contraseñas no coinciden.";
    }else if (!preg_match("/[0-8]{8}/", $password)){
        $notificacion = "Error: la contraseña debe contener solo numeros y ser de una longitud igual a 8";
    }
    else{
        if(empty($imgName)){
            $imgName=$imgActual;
        }else{
            // SUBIR IMAGEN
            $archivo_destino = '../../imgs/usuarios/perfil/'.$_FILES['nuevo_img']['name'];
            move_uploaded_file($imgPost,$archivo_destino);
        }
        $query = "UPDATE usuarios SET nombre='$nombre',apellido='$apellido',correo='$correo',password='$password',avatar='$imgName',telefono='$telefono',rol='$rol', notificacion = '$notificar' WHERE idUsuario = '$idUsuario' ";
            $result = $connection->query($query);
            if($result){
                header('Location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar el Usuario.";
                echo $connection->error;
            }
    }
    
}



    include("../../includes/header.php");

?>


<section class="panel-adm py-4">

    <div class="container">
        <h3 class="center">Panel Administrativo</h3>
        <div class="row">

            <?php include("../../includes/adm-side-menu.php"); ?>

            <div class="sidebar-content p-4">

                <form action="detalle.php" method="POST" class="col-12 mx-auto form-modificar">
                    <input type="hidden" name="idUsuario" value="<?php echo $idUsuario; ?>">

                    <div class="row">

                        <div class="col-md-6">
                            <div>
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="form-control"
                                    value="<?php echo (isset($nombre)) ? $nombre : '' ?>">
                            </div>
                            <div>
                                <label for="">Teléfono</label>
                                <input type="text" name="telefono" class="form-control mb-3"
                                    value="<?php echo (isset($telefono)) ? $telefono: '' ?>">
                            </div>
                            <div>
                                <input type="password" name="password" id="password" placeholder="Contraseña"
                                    class="form-control my-3" value="<?php echo (isset($password)) ? $password : '' ?>">
                            </div>
                            <div class="d-flex align-items-center chk-box">
                                <label for="notificar">Notificar</label>
                                <input type="checkbox" name="notificar" id="notificar" placeholder="" class="form-check"
                                    <?php echo (isset($notificar) && !empty($notificar)) ? 'checked' : '' ?>>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div>
                                <label for="">Apellido</label>
                                <input type="text" name="apellido" class="form-control"
                                    value="<?php echo (isset($apellido)) ? $apellido : '' ?>">
                            </div>
                            <div>
                                <label for="">Correo</label>
                                <input type="text" name="correo" class="form-control"
                                    value="<?php echo (isset($correo)) ? $correo : '' ?>">
                            </div>
                            <div>
                                <input type="password" name="passwordConfirm" id="passwordConfirm"
                                    placeholder="Confirmar Contraseña " class="form-control mt-3 mb-3"
                                    value="<?php echo (isset($password)) ? $password : '' ?>">
                            </div>

                            <div>
                                <label for="">Rol</label>
                                <select name="rol" id="" class="form-select">
                                    <option value="usuario"
                                        <?php echo (isset($rol) && $rol == 'usuario') ? 'selected' : ''?>>
                                        Usuario</option>
                                    <option value="admin"
                                        <?php echo (isset($rol) && $rol == 'admin') ? 'selected' : ''?>>
                                        Admin
                                    </option>
                                    <option value="privado"
                                        <?php echo (isset($rol) && $rol == 'privado') ? 'selected' : ''?>>
                                        Privado</option>
                                </select>
                            </div>

                        </div>


                    </div>



                    <!-- 
                    <div class="mb-3">
                        <label for="post-img">Imágen avatar</label>
                        <input type="file" class="form-control" name="nuevo_img" id="post-img">
                        <input type="hidden" name="imgActual"
                            value="<?php // echo (isset($imgActual)) ? $imgActual: '' ?>">
                    </div>
-->

                    <div class="contenedor-btn d-flex justify-content-center align-items-center mt-5">
                        <a href="listado.php" class="btn btn-primary">Listado</a>
                        <button type="submit" class="btn btn-success mx-5">Modificar usuario</button>
                        <a href="eliminar.php?id=<?php echo $idUsuario; ?>" class="btn btn-danger">Eliminar</a>
                    </div>



                    <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
                </form>

            </div>
        </div>

    </div>
</section>



<?php include("../../includes/footer.php"); ?>