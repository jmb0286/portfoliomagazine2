
<?php

session_start();

if(isset($_SESSION['idUsuario'])){
    header('Location: ../index.php'); 
}

$pagina = 'iniciar_sesion';

// CONEXION A LA BASE DE DATOS.
include("../includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)){
        $notificacion = "Error: No se pueden dejar campos vacíos";
    }else{
        $query = "SELECT * FROM usuarios WHERE correo = '$email' AND password = '$password' ";
        $result = $connection->query($query);
        if($result->num_rows > 0){
           $usuario = $result->fetch_assoc();
           /*
                Variables de sesión: Son variables globales que se mantienen activas durante la navegación del usuario, mientras no cierre sesión.
                Esto quiere decir que puede acceder a ellas desde cualquier documento, no se pierden.
                Me sirven para alamacenar los datos del usuarios que se acaba de logear.
                Puedo validar que un usuario este logeado a través de estas variables.
           */
           $_SESSION['idUsuario'] = $usuario['idUsuario'];
           $_SESSION['nombreCompleto'] = $usuario['nombre'] . ' ' . $usuario['apellido'];
           $_SESSION['apellido'] = $usuario['apellido'];
           $_SESSION['email'] = $usuario['email'];
           $_SESSION['avatar'] = $usuario['avatar'];
           $_SESSION['rol'] = $usuario['rol'];  

           // REDIRECCIONAR A OTRA PAGINA O OTRO DOCUMENTO.
           header('Location:../index.php'); 
        }else{
            $notificacion = "Error: Usuario y/o Contraseña Incorrectos";
        }
    }
}

include("../includes/header.php");



?>

<section class="registro">
    <div class="container">

        <form action="iniciar_sesion.php" method="POST" class="login">
                <div class="contenedor-botones">
                    <a href="registro.php" class="btn-registro text-center">Registro</a>
                    <a href="iniciar_sesion.php" class="btn-iniciar">Iniciar Sesión</a>
                </div>

                
                <div class="row">

                    <div class="col-md-6 col-inputs">
                        <div class="row">
                       

                            <div class="col-12">
                                <input type="email" name="email" id="email" class="form-control my-3" placeholder="Correo Electrónico">
                            </div>
                            <div class="col-12">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese Contraseña">
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4 class="text-center my-4">Acceda a más contenido!</h4>
                        <div class="contenedor-iconos d-flex justify-content-center">
                            <i class="fa-solid fa-image mx-4"></i>
                            <i class="fa-solid fa-music mx-4"></i>
                            <i class="fa-solid fa-receipt mx-4"></i>
                            <i class="fa-solid fa-video mx-4"></i>
                        </div>
                    </div>

                </div>


            
            <?php if(isset($notificacion)) :  ?>
                    <p class="text-center"><?php echo $notificacion; ?></p>
            <?php endif;  ?>
       
        
    
    </div>

</section>
<div class="bottomnav" >
                <a href="../procesos/registro.php">Registrarse </a>
                <input type="submit" class="btn-login" value="Iniciar Sesión">
            </div>
<?php

    include("../includes/footer.php");
   
?>