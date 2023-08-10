<?php
session_start();

 /* 
 
 REMPLAZAR SIMBOSLOS < > con
 &lt; y &gt;
 
 */
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

$notificacion = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $categoria = $_POST['categoria'];
    $codigo = $_POST['codigo'];

       
    if(empty($codigo) || empty($categoria)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        // SUBIR IMAGEN
       /* $archivo_destino = '../../imgs/magazine/musica/'.$_FILES['nuevo_img']['name'];
        move_uploaded_file($imgName, $archivo_destino);*/

        $query = "INSERT INTO codigo_ejemplo(categoria, codigo) VALUES ('$categoria', '$codigo')";
        $result = $connection->query($query);
            if($result){
                 header('location: listado.php');
            }else{
                $notificacion = "Error: No se ha podido crear el código de ejemplo.";
                echo $connection->error;
            }
    }
}

?>



<?php include_once('../../includes/header.php') ?>


<section class="form-adm py-3">

    <div class="container">
        <h1 class="text-center">Nuevo Codigo Ejemplo</h1>
        <div class="botonera d-flex justify-content-end">
            <a href="../panel.php" class="btn btn-outline-primary">Volver al Panel</a>
        </div>
        <hr>

        <form action="crear.php" method="POST" class="col-6 mx-auto" enctype="multipart/form-data">
        
            <div class="mb-3">
                <label for="">Categoria</label>
                <select name="categoria" id="" class="form-select">
                    <option value="HTML">HTML</option>
                    <option value="CSS">CSS</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="PHP">PHP</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="codigo">Codigo</label>
                <textarea id="codigo" name="codigo" class="form-control" rows="5"></textarea>
            </div>


            <button type="submit" class="btn btn-success mt-3">Crear nuevo codigo</button>

            <?php 
            if($notificacion != ''){
               echo "<p class='bg-dark mt-3 p-2 text-white'>$notificacion</p>";
            } 
            ?>

        </form>
    </div>
</section>

<?php include_once('../../includes/footer.php') ?>