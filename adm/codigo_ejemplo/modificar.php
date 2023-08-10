<?php

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");
session_start();

$notificacion = "";

 /* 
 
 REMPLAZAR SIMBOSLOS < > con
 &lt; y &gt;
 
 */

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_GET['id'])){
        $idCodigoEjemplo = $_GET['id'];
        $query = "SELECT * FROM codigo_ejemplo WHERE idCodigoEjemplo = '$idCodigoEjemplo'";
        $resultCodigo = $connection->query($query);
        $datosCodigo = $resultCodigo->fetch_assoc();
        $codigo = $datosCodigo['codigo'];
        $categoria = $datosCodigo['categoria'];
   
        $codigoFormateado1 = str_replace("<","&lt;",$codigo);
        echo $codigoFormateado1;
        $codigoFormateadoFinal = str_replace('>','&gt;',$codigoFormateado1);
    }else{
        echo 'Error: No ha ingresado un ID a eliminar.';
    }
}




if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // ASIGNACION DE VARIABLES PROVENIENTES DEL FORMULARIO
    $idCodigoEjemplo = $_POST['idCodigoEjemplo'];
    $codigo = $_POST['codigo'];
    $categoria = $_POST['categoria'];

    
    if(empty($codigo)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        $query = "UPDATE codigo_ejemplo SET codigo = '$codigo', categoria='$categoria' WHERE idCodigoEjemplo = '$idCodigoEjemplo'";
            $result = $connection->query($query);
            if($result){
                header('Location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar la lección.";
                echo $connection->error;
            }
    }
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Modificar Código</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="listado.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>
        <form action="modificar.php" method="POST" class="col-6 mx-auto">
            <input type="hidden" name="idCodigoEjemplo" value="<?php echo $idCodigoEjemplo; ?>">

        

            <div class="mb-3">
                <label for="">Categoria</label>
                <select name="categoria" id="" class="form-select">
            
                    <option value="HTML" <?= ($categoria == 'HTML') ? 'selected' : '' ; ?>>HTML</option>
                    <option value="CSS" <?= ($categoria == 'CSS') ? 'selected' : '' ; ?>>CSS</option>
                    <option value="JavaScript" <?= ($categoria == 'JavaScript') ? 'selected' : '' ; ?>>JavaScript</option>
                    <option value="PHP" <?= ($categoria == 'PHP') ? 'selected' : '' ; ?>>PHP</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="">Código</label>
       
                <textarea  name="codigo" class="form-control" rows="5"><?php echo $codigoFormateadoFinal; ?></textarea>
            </div>
            
           <button type="submit" class="btn btn-success mt-3">Modificar Código</button>

           <?php if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
           } ?>
        </form>
    </div>
</section>
  
<?php include_once('../../includes/footer.php') ?>