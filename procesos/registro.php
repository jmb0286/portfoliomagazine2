
<?php
session_start();

if(isset($_SESSION['idUsuario'])){
    header('Location:../index.php'); 
}

$pagina = 'registro';

include("../includes/conexion.php");



// CAPTURO LAS VARIABLES DEL FORMULARIO
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $notificacion = "";
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $email = $_POST['correo'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];
    $imgAvatar = $_FILES['avatar']['tmp_name'];
    $imgName = $_FILES['avatar']['name'];

    // VALIDO QUE LOS CAMPOS DEL FORMULARIO NO ESTÉN VACÍOS. P.D.: LO QUE ESTÁ ADENTRO DE LOS PARENTESIS ES LA VARIABLE QUE VIENE DEL NAME
    // DEL FORMULARIO
    if(empty($email) || empty($nombre) || empty($apellido) || empty($password) || empty($passwordConfirm) || empty($telefono)){
        $notificacion = "Error: No puede dejar campos vacios.";
    // VERIFICO SI ES UN EMAIL VÁLIDO
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $notificacion = "Error: el mail ingresado no es valido.";
    // VERIFICO SI LAS CONTRASEÑAS NO COINCIDEN. DE SERLO MUESTRO UN MENSAJE DE ERROR
    }else if($password != $passwordConfirm) {
        $notificacion = "Error: las contraseñas ingresadas no coinciden";
    // VERFICO LAS CARACTERÍSTICAS DE LA CONTRASEÑA. SOLO NUMEROS DE 8 DIGITOS
    }else if (!preg_match("/[0-8]{8}/", $password)){
        $notificacion = "Error: la contraseña debe contener solo numeros y ser de una longitud igual a 8";
    }else{
        // CONSULTA SQL PARA OBTENER SI UN USUARIO YA POSEE EL CORREO QUE SE ESTÁ INTENTANDO REGISTRAR
        $query = "SELECT * FROM usuarios WHERE correo = '$email' ";
        $result = $connection->query($query);
        // PREGUNTO POR SI HAY MAS DE UN USUARIO REGISTRADO. SI DE VUELVE SI.
        if($result->num_rows > 0){
            $notificacion = "Error: el correo ingresado ya existe";
        }else{          
            // CARGA DE IMAGEN
            $archivo_destino='../imgs/usuarios/perfil/'.$_FILES['avatar']['name'];
            move_uploaded_file($imgAvatar, $archivo_destino);
            // INGRESA EL USUARIO.
            $query = "INSERT INTO usuarios (nombre, apellido, telefono, correo, password, avatar, rol) VALUES ('$nombre', '$apellido', '$telefono', '$email','$password', '$imgName', 'usuario')";
            $result = $connection->query($query);
            //
            if($result){
                //$notificacion = "Exito: Se ha creado su cuenta.";
                // FUNCION PARA REDIRECCIONAR HACIA UNA URL / DOCUMENTO
                header('location:iniciar_sesion.php'); // REDIRECCIONA AL LOGIN.PHP
            }else{
                $notificacion = "Error: Ha ocurrido un error al intentar crear el usuario.";
                // Me muestra el error que esta ocurriendo la intentar crear al usuario.
                echo $connection->error;
            }

        }
    }
}

include("../includes/header.php");
?>


 <section class="registro">

      
    <div class="container">
        
            <form action="registro.php"  method="POST" enctype="multipart/form-data">

                <div class="contenedor-botones">
                <a href="registro.php" class="btn-registro text-center">Registro</a>
                    <a href="iniciar_sesion.php" class="btn-iniciar">Iniciar Sesión</a>
                </div>

                <div class="row">

                    <div class="col-md-6 col-inputs">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre:" class="form-control mb-3">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="apellido" id="apellido" placeholder="Apellido:" class="form-control mb-3">
                            </div>

                            <div class="col-12">
                                <input type="text" name="telefono" id="telefono" placeholder="Teléfono:" class="form-control mb-3">
                            </div>
                            <div class="col-12">
                                <input type="email" name="correo" id="correo" placeholder="Correo:" class="form-control mb-3">
                            </div>




                            <div class="col-md-6">
                                <input type="password" name="password" id="password" placeholder="Contraseña" class="form-control mb-3">
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirmar Contraseña " class="form-control mb-3">
                            </div>

                      

                            <div class="col-12">
                            <input type="file" name="avatar" id="avatar" class="form-control mb-3">
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
           
                <div class="bottomnav">
                        <button type="submit">Regístrate</button>
                      
                        <a href="../procesos/iniciar_sesion.php">Iniciar Sesión</a>
                
                </div>

            </form>
        
                    
            </div>
</section> 




<?php include("../includes/footer.php") ?>