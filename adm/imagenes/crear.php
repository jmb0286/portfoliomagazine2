<?php
session_start();

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");



$notificacion = "";

$query = "SELECT * FROM lugares";
$resultLugares = $connection->query($query);

$query = "SELECT * FROM viajes";
$resultViajes = $connection->query($query);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $imgPost = $_FILES['nuevo_img']['tmp_name'];
    $imgName = $_FILES['nuevo_img']['name'];
 
    $anio = $_POST['anio'];  
    $mes = $_POST['mes'];
    $idLugar= $_POST['idLugar'];
    $idViaje= $_POST['idViaje'];
    
    if(empty($anio) || empty($imgPost) || empty($mes) || empty($idLugar)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        
        // SUBIR IMAGEN
        $archivo_destino = '../../imgs/magazine/imagenes/'.$anio.'/'.$mes.'/'.$_FILES['nuevo_img']['name'];
        move_uploaded_file($imgPost,$archivo_destino);
        $query = "INSERT INTO imagenes (mes,anio,url_img, idLugar, idViaje) VALUES ('$mes', '$anio', '$imgName','$idLugar', '$idViaje')";
        $result = $connection->query($query);

        if($result){
            $notificacion = "Exito: Se ha podido cargar la imagen de manera correcta.";
            header('location:listado.php');
        }else{
            $notificacion = "Error: No se ha podido crear la imágen.";
            echo $connection->error;
        }
        
    }
}

include("../../includes/header.php");
?>



<main class="imagenes-crear">

    <section class="py-5">
        <h2 class="text-center mb-3">Alta Imágenes</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="crear.php" method="POST" enctype="multipart/form-data">
                    <?php if(isset($notificacion)) :  ?>
                        <p class="text-center"><?php echo $notificacion; ?></p>
                    <?php endif;  ?>

                    <div class="mb-3">
                        <label for="nuevo_img">Cargar Imágen</label>
                        <input type="file" class="form-control" name="nuevo_img" id="post-img" required>
                    </div>
                        
                        
                        <div class="mt-3">
                            <select name="anio" id="anio" class="form-select">
                            <option value="2003" <?= (isset($anio) && $anio==2003) ? 'selected' :''; ?>>2003</option>
                            <option value="2004" <?= (isset($anio) && $anio==2004) ? 'selected' :''; ?>>2004</option>
                            <option value="2005" <?= (isset($anio) && $anio==2005) ? 'selected' :''; ?>>2005</option>
                            <option value="2006" <?= (isset($anio) && $anio==2006) ? 'selected' :''; ?>>2006</option>
                            <option value="2007" <?= (isset($anio) && $anio==2007) ? 'selected' :''; ?>>2007</option>
                            <option value="2008" <?= (isset($anio) && $anio==2008) ? 'selected' :''; ?>>2008</option>
                            <option value="2009" <?= (isset($anio) && $anio==2009) ? 'selected' :''; ?>>2009</option>
                            <option value="2010" <?= (isset($anio) && $anio==2010) ? 'selected' :''; ?>>2010</option>
                            <option value="2011" <?= (isset($anio) && $anio==2011) ? 'selected' :''; ?>>2011</option>
                            <option value="2012" <?= (isset($anio) && $anio==2012) ? 'selected' :''; ?>>2012</option>
                            <option value="2013" <?= (isset($anio) && $anio==2013) ? 'selected' :''; ?>>2013</option>
                            <option value="2014" <?= (isset($anio) && $anio==2014) ? 'selected' :''; ?>>2014</option>
                            <option value="2015" <?= (isset($anio) && $anio==2015) ? 'selected' :''; ?>>2015</option>
                            <option value="2016" <?= (isset($anio) && $anio==2016) ? 'selected' :''; ?>>2016</option>
                            <option value="2017" <?= (isset($anio) && $anio==2017) ? 'selected' :''; ?>>2017</option>
                            <option value="2018" <?= (isset($anio) && $anio==2018) ? 'selected' :''; ?>>2018</option>
                            <option value="2019" <?= (isset($anio) && $anio==2019) ? 'selected' :''; ?>>2019</option>
                            <option value="2020" <?= (isset($anio) && $anio==2020) ? 'selected' :''; ?>>2020</option>
                            <option value="2021" <?= (isset($anio) && $anio==2021) ? 'selected' :''; ?>>2021</option>
                            <option value="2022" <?= (isset($anio) && $anio==2022) ? 'selected' :''; ?>>2022</option>
                        </select>
                        
                        <label for="mes">Seleccione un Mes</label>
                            <select name="mes" class="form-select">
                                <option value="enero">Enero</option>
                                <option value="febrero">Febrero</option>
                                <option value="marzo">Marzo</option>
                                <option value="abril">Abril</option>
                                <option value="mayo">Mayo</option>
                                <option value="junio">Junio</option>
                                <option value="julio">Julio</option>
                                <option value="agosto">Agosto</option>
                                <option value="setiembre">Setiembre</option>
                                <option value="octubre">Octubre</option>
                                <option value="noviembre">Noviembre</option>
                                <option value="diciembre">Diciembre</option>
                            </select>

                         <label for="lugar">Seleccione un Lugar</label>
                         <select name="idLugar" class="form-select">
                            <?php 
                                while($lugar = $resultLugares->fetch_assoc()){
                                    echo '<option value="'.$lugar['idLugar'].'">'.$lugar['lugar'].'</option>';
                                }
                            ?>
                         </select>
                        
                         
                         <label for="viajes">Seleccione un Viaje</label>
                         <select name="idViaje" class="form-select">
                            <?php 
                                while($viaje = $resultViajes->fetch_assoc()){
                                    echo '<option value="'.$viaje['idViaje'].'">'.$viaje['viaje'].'</option>';
                                }
                            ?>
                         </select>

                        </div>
                            <button type="submit" class="btn btn-success">Crear</button>
                            
                    </form>
                </div>  
            </div>
        </div>
    </section>
</main>