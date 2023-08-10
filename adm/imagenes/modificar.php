<?php
session_start();

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");



$notificacion = "";
// CARGA DE CATEGORIAS DE TUTORIALES
$query = "SELECT * FROM lugares";
$resultLugares = $connection->query($query);

$query = "SELECT * FROM viajes";
$resultViajes = $connection->query($query);


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idImagen = $_GET['id'];
    $query = "SELECT * FROM imagenes WHERE idImagen = '$idImagen'";
    $result = $connection->query($query);
    $imagen = $result->fetch_assoc();
    $anio = $imagen['anio'];
    $mes = $imagen['mes'];
    $idViaje = $imagen['idViaje'];
    $idLugar = $imagen['idLugar'];
    $imgActual = $imagen['url_img'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idImagen = $_POST['idImagen'];  

    $imgPost = $_FILES['nuevo_img']['tmp_name'];
    $imgName = $_FILES['nuevo_img']['name'];
    $imgActual = $_POST['imgActual'];

    $anio = $_POST['anio'];  
    $mes = $_POST['mes'];
    $idViaje = $_POST['idViaje'];
    $idLugar = $_POST['idLugar'];

    
    if(empty($anio) || empty($mes)){
        $notificacion = "No puede haber campos vacios.";
    }else{
        
        if(empty($imgName)){
            $imgName=$imgActual;
        }else{
            // SUBIR IMAGEN
            $archivo_destino = '../../imgs/magazine/imagenes/'.$anio.'/'.$mes.'/'.$_FILES['nuevo_img']['name'];
            move_uploaded_file($imgPost,$archivo_destino);
        }


        $query = "UPDATE imagenes SET mes='$mes', anio='$anio', url_img='$imgName', idLugar='$idLugar', idViaje='$idViaje' WHERE idImagen = '$idImagen'";
        // echo $query;
        $result = $connection->query($query);

            if($result){
            
                $notificacion = "Exito: Se ha podido modificar la imagen de manera correcta.";
                header('location:listado.php');
            }else{
                $notificacion = "Error: No se ha podido modificar la imagen.";
                echo $connection->error;
            }
        
       

        }
}

include("../../includes/header.php");
?>



<main class="imagenes-crear">

    <section class="py-5">
        <h2 class="text-center mb-3">Modificar Imágenes</h2>
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="modificar.php" method="POST" enctype="multipart/form-data">
                    <?php if(isset($notificacion)) :  ?>
                        <p class="text-center"><?php echo $notificacion; ?></p>
                    <?php endif;  ?>
                            <input type="hidden" name="idImagen" value="<?php echo $idImagen; ?>">
                           
                            <select name="anio" id="selectAnio" class="form-select">
                                <option value="" <?= (isset($anio) && empty($anio)) ? 'selected' :''; ?>>Todas</option>
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
                                <option value="2023" <?= (isset($anio) && $anio==2023) ? 'selected' :''; ?>>2023</option>
                            </select>
                    
                            <select name="mes" id="" class="form-select">
                                    <option value="enero" <?php echo ($mes == 'enero') ? 'selected' : '' ; ?>>Enero</option>
                                    <option value="febrero" <?php echo ($mes == 'febrero') ? 'selected' : '' ; ?>>Febrero</option>
                                    <option value="marzo" <?php echo ($mes == 'marzo') ? 'selected' : '' ; ?>>Marzo</option>
                                    <option value="abril" <?php echo ($mes == 'abril') ? 'selected' : '' ; ?>>Abril</option>
                                    <option value="mayo" <?php echo ($mes == 'mayo') ? 'selected' : '' ; ?>>Mayo</option>
                                    <option value="junio" <?php echo ($mes == 'junio') ? 'selected' : '' ; ?>>Junio</option>
                                    <option value="julio" <?php echo ($mes == 'julio') ? 'selected' : '' ; ?>>Julio</option>
                                    <option value="agosto" <?php echo ($mes == 'agosto') ? 'selected' : '' ; ?>>Agosto</option>
                                    <option value="setiembre" <?php echo ($mes == 'setiembre') ? 'selected' : '' ; ?>>Setiembre</option>
                                    <option value="octubre" <?php echo ($mes == 'octubre') ? 'selected' : '' ; ?>>Octubre</option>
                                    <option value="noviembre" <?php echo ($mes == 'noviembre') ? 'selected' : '' ; ?>>Noviembre</option>
                                    <option value="diciembre" <?php echo ($mes == 'diciembre') ? 'selected' : '' ; ?>>Diciembre</option>
                    
                            </select>
                            
                            <select name="idViaje" id="" class="form-select">
                            <?php 
                                while ($viajes = $resultViajes->fetch_assoc()) {
                                    if($idViaje == $viajes['idViaje']){
                                        echo '<option value="'.$viajes['idViaje'].'" selected>'.$viajes['viaje'].'</option>';
                                    }else{
                                        echo '<option value="'.$viajes['idViaje'].'">'.$viajes['viaje'].'</option>';
                                    }
                                    
                                }
                            ?>
                            </select>

                            <select name="idLugar" id="" class="form-select">
                            <?php 
                                while ($lugar = $resultLugares->fetch_assoc()) {
                                    if($idLugar == $lugar['idLugar']){
                                        echo '<option value="'.$lugar['idLugar'].'" selected>'.$lugar['lugar'].'</option>';
                                    }else{
                                        echo '<option value="'.$lugar['idLugar'].'">'.$lugar['lugar'].'</option>';
                                    }
                                    
                                }
                            ?>
                            </select>
                            
                            <input type="file" class="form-control" name="nuevo_img" id="post-img">
                            <input type="hidden" name="imgActual" value="<?= $imgActual; ?>">
                            <br>
                          
                            <button type="submit" class="btn btn-success">Modificar</button>
                            
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Seleccione las personas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    while ($persona = $resultPersona->fetch_assoc()) {
                        $bandera = false;
                        for ($i=0; $i <  count($listadoPersonas) ; $i++) { 
                            if($listadoPersonas[$i]['idPersona'] == $persona['idPersona']){
                                $bandera = true;
                            }
                        }
                        echo '
                        <tr>
                            <td>'.$persona['idPersona'].'</td>
                            <td>'.$persona['nombre'].'</td>
                            <td>';
                        if($bandera){
                            echo '<input class="form-check-input me-3 btnSeleccionarPersona" type="checkbox" value="'.$persona['idPersona'].'" checked>';
                        }else{
                            echo '<input class="form-check-input me-3 btnSeleccionarPersona" type="checkbox" value="'.$persona['idPersona'].'">';
                        }                               
                        echo '</td>
                        </tr>
                        ';
                    }
                
                ?>
                
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>



<script>

    let listadoPersonasActual = JSON.parse('<?php echo json_encode($listadoPersonas); ?>');
    console.log(listadoPersonasActual);

    let botonesSeleccionar = document.querySelectorAll('.btnSeleccionarPersona');
    let contenedorPersonas = document.querySelector('#contenedorPersonas');

    let personasSeleccionadas = [];
    if(listadoPersonasActual.length > 0){
        listadoPersonasActual.forEach(persona => {
            personasSeleccionadas.push(persona.idPersona);
            contenedorPersonas.innerHTML += `<input type="hidden" name="personas[]" value="${persona.idPersona}">`;
        });
    }

    console.log(personasSeleccionadas);
    botonesSeleccionar.forEach(btn => {
        btn.addEventListener('change', () => {


            if(btn.checked){
                personasSeleccionadas.push(btn.value);
            }else{
                //console.log('Indice: '+ personasSeleccionadas.indexOf(btn.value));
                indiceEliminar = personasSeleccionadas.indexOf(btn.value);
                personasSeleccionadas.splice(indiceEliminar, 1);
            }

            contenedorPersonas.innerHTML = '';
            personasSeleccionadas.forEach(persona => {
                
                contenedorPersonas.innerHTML += `<input type="hidden" name="personas[]" value="${persona}">`;

            });

            console.log(personasSeleccionadas);
            
        });
    });
</script>

<?php include("../../includes/footer.php"); ?>