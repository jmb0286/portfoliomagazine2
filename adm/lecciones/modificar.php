<?php
    include("../../includes/config.php");   
    // CONEXION A LA BASE DE DATOS.
    include("../../includes/conexion.php"); 
    

    $query = "SELECT * FROM categorias";
    $resultCategorias = $connection->query($query);

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
        $idLeccion = $_GET['id'];
        $query = "SELECT * FROM lecciones WHERE idLeccion = '$idLeccion'";
        $result = $connection->query($query);
        $leccion = $result->fetch_assoc();
        $titulo = $leccion['titulo'];
        $descripcion = $leccion['descripcion'];
        $url_video = $leccion['urlVideo'];
        $portada = $leccion['portadaLeccion'];
        $contenido = $leccion['contenido'];
        $baja = $leccion['baja_leccion'];

        // LISTO TODAS LAS CATEGORIAS DE LA LECCION
        $query = "SELECT * FROM detalle_categoria_leccion as dcl INNER JOIN categorias ON categorias.idCategoria = dcl.idCategoria WHERE idLeccion = '$idLeccion'";
        $resultCategoriasLeccion = $connection->query($query);
        $listadoCategorias = [];
        while ($categoria = $resultCategoriasLeccion->fetch_assoc()) {
            array_push($listadoCategorias,$categoria);
        }
     
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idLeccion = $_POST['idLeccion'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $url_video = $_POST['url_video'];
        $contenido = $_POST['editor'];
        $categorias = $_POST['categorias'];
        $portada = $_POST['portada'];
        $estado = $_POST['estado'];

        if(empty($titulo) || empty($descripcion) || empty($idLeccion) || empty($contenido) || empty($categorias)){
            $notificacion = "Error: No puede dejar campos vacíos.";
        }else{
            $query = "UPDATE lecciones SET titulo='$titulo',descripcion='$descripcion',contenido='$contenido',urlVideo='$url_video',portadaLeccion='$portada',baja_leccion='$estado' WHERE idLeccion = '$idLeccion' ";
            $result = $connection->query($query);
            if($result){
                $query = "DELETE FROM detalle_categoria_leccion WHERE idLeccion = '$idLeccion'";
                $result = $connection->query($query);

                for ($i=0; $i < count($categorias); $i++) { 
                    $idCategoria = $categorias[$i];
                    $query = "INSERT INTO detalle_categoria_leccion(idLeccion, idCategoria) VALUES ('$idLeccion', '$idCategoria')";
                    $result = $connection->query($query);
                }

                header('location:listado.php');
            }else{
                $notificacion = "Error: Ha ocurrido un error al intentar procesar la petición.";
            }
        }
    }

    include("../../includes/header.php");
?>

<main class="lecciones-modificar">

    <section class="py-5">
        <h2 class="text-center mb-3">Modificar Lecciones</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <form action="modificar.php" method="POST" enctype="multipart/form-data">
                        <?php if(isset($notificacion)) :  ?>
                            <p class="text-center"><?php echo $notificacion; ?></p>
                        <?php endif;  ?>

                                <input type="hidden" name="idLeccion" value="<?php echo $idLeccion; ?>">
                                <input type="text" name="titulo" id="titulo" placeholder="Títutlo de la lección" class="form-control mb-3" value="<?php echo $titulo; ?>">
                                <input type="text" name="descripcion" id="descripcion" placeholder="Descripción de la lección" class="form-control mb-3" value="<?php echo $descripcion; ?>">
                                <input type="text" name="url_video" id="video" placeholder="Url del vídeo" class="form-control mb-3" value="<?php echo $url_video; ?>">
                                <div class="mb-3">
                                 
                                    <input type="text" name="portada" id="portada" class="form-control" placeholder="Portada Lección" value="<?php echo $portada; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="editor">Contenido principal</label>
                                    <textarea class="form-control" id="editor" name="editor" rows="6"><?php echo $contenido; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado" class="form-select">
                                        <option value="0" <?php echo ($baja == 0) ? 'selected' : ''; ?>>Activo</option>
                                        <option value="1" <?php echo ($baja != 0) ? 'selected' : ''; ?>>Baja</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                
                                    <?php 
                                    
                                        while ($categoria = $resultCategorias->fetch_assoc()) {
                                            $bandera = false;
                                            for ($i=0; $i <  count($listadoCategorias) ; $i++) { 
                                                if($listadoCategorias[$i]['idCategoria'] == $categoria['idCategoria']){
                                                   $bandera = true;
                                                }
                                            }

                                            if($bandera){
                                                echo '
                                                <div class="form-check form-check-inline">
                                                  
                                                    <input class="form-check-input" type="checkbox" name="categorias[]" id="'.$categoria['nombreCategoria'].'"  value="'.$categoria['idCategoria'].'" checked>
                                                    <label class="form-check-label" for="'.$categoria['nombreCategoria'].'">'.strtoupper($categoria['nombreCategoria']).'</label>
                                                </div>
                                            ';
                                            }else{
                                                echo '
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" name="categorias[]" id="'.$categoria['nombreCategoria'].'"  value="'.$categoria['idCategoria'].'">
                                                    <label class="form-check-label" for="'.$categoria['nombreCategoria'].'">'.strtoupper($categoria['nombreCategoria']).'</label>
                                                </div>
                                            ';
                                            }
                                            
                                           
                                        }
                                    
                                    ?>
                                
                                </div>

                                <button type="submit" class="btn btn-success">Modificar</button>
                                
                        </form>
                    </div>
                </div>
        
            </div>
    </section>

</main>

<!-- Editor de contenido -->
<script>
    CKEDITOR.replace( 'editor' );
</script>
<?php include("../../includes/footer.php"); ?>