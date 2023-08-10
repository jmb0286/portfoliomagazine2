
<?php

$pagina = 'cuenta';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

include("../../includes/header.php");

?>



<div class="col-acciones">
        <form action="" method="POST" >
            <h3>Restablecer Contraseña</h3>
            <div class="col-inputs">
                <input type="password" name="pwd" id="pwd" placeholder="Contraseña Anterior">
                <input type="password" name="pwd" id="pwd" placeholder="Contraseña Nueva">
                <input type="passConfirmar" name="passConfirmar" id="passConfirmar" placeholder="Confirmar Contraseña">
                <button type="submit">Restablecer Contraseña</button>
            </div>
        </form>                
    </div>

    <div class="bottomnav">
        
        <a href="procesos/registro.php">Regístrate</a>
        <a href="procesos/iniciar_sesion.php">Iniciar Sesión</a>

 </div>
<?php

include("../../includes/footer.php");

?>
