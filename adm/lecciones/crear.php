<?php
$titlePage = 'lecciones-crear';
    include("../../includes/config.php");   
    // CONEXION A LA BASE DE DATOS.
    include("../../includes/conexion.php"); 
    
    $query = "SELECT * FROM categorias WHERE idCategoria NOT IN (1,5,8)";
    $resultCategorias = $connection->query($query);


  

    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $url_video = $_POST['url_video'];
        $contenido = $_POST['editor'];
        $categorias = $_POST['categorias'];
        $portada = $_POST['portada'];
        

       if(empty($titulo) || empty($descripcion) || empty($url_video) || empty($contenido) || empty($categorias)){
            $notificacion = "Error: No puede dejar campos vacíos.";
       }else{

            $query = "INSERT INTO lecciones(titulo, descripcion, contenido, urlVideo, portadaLeccion) VALUES ('$titulo', '$descripcion','$contenido', '$url_video', '$portada')";
            $result = $connection->query($query);

            if($result){
                $leccion_id = $connection->insert_id;
                for ($i=0; $i < count($categorias); $i++) { 
                    $idCategoria = $categorias[$i];
                    $query = "INSERT INTO detalle_categoria_leccion(idLeccion, idCategoria) VALUES ('$leccion_id', '$idCategoria')";
                    $result = $connection->query($query);
                }
                
                header('location:../panel.php');
            }else{
                $notificacion = "Error: Ha ocurrido un error al intentar procesar la petición.";
            }

       }
    }

    include("../../includes/header.php");

?>

<main class="lecciones-crear">


    <section class="panel-adm py-4">

        <div class="container">
            <h3 class="center">Panel Administrativo</h3>
            <div class="row">

                <?php include("../../includes/adm-side-menu.php"); ?>

                <div class="sidebar-content p-4 col-md-8">
                    <form action="crear.php" method="POST" enctype="multipart/form-data">
                        <?php if(isset($notificacion)) :  ?>
                        <p class="text-center"><?php echo $notificacion; ?></p>
                        <?php endif;  ?>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" name="titulo" id="titulo" placeholder="Títutlo de la lección"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="url_video" id="video" placeholder="Url del vídeo"
                                        class="form-control mb-3">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="text" name="descripcion" id="descripcion"
                                        placeholder="Descripción de la lección" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <input type="text" name="portada" id="portada" class="form-control"
                                        placeholder="Portada">
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <label for="editor">Contenido principal</label>
                            <textarea class="form-control" id="editor" name="editor"></textarea>
                        </div>

                    

                        <div class="mb-3">
                            <div class="row mb-3 justify-content-center">
                                <div class="col-3 form-check form-check-inline py-3" style="background-color:#ccc;">
                                    <div class="d-flex justify-content-center">
                                        <input class="form-check-input me-3" type="checkbox" name="categorias[]"
                                            id="frontend" value="1">
                                        <label class="form-check-label" for="frontend"
                                            style="font-size:12px;">Front-End</label>
                                    </div>
                                </div>

                                <div class="col-3 form-check form-check-inline py-3" style="background-color:#ccc;">
                                    <div class="d-flex justify-content-center">
                                        <input class="form-check-input me-3" type="checkbox" name="categorias[]"
                                            id="backend" value="5">
                                        <label class="form-check-label" for="backend"
                                            style="font-size:12px;">Back-End</label>
                                    </div>
                                </div>
                                <div class="col-3 form-check form-check-inline py-3" style="background-color:#ccc;">
                                    <div class="d-flex justify-content-center">
                                        <input class="form-check-input me-3" type="checkbox" name="categorias[]"
                                            id="programas" value="8">
                                        <label class="form-check-label" for="programas"
                                            style="font-size:12px;">Programas</label>
                                    </div>
                                </div>
                                <div class="col-3 form-check form-check-inline py-3" style="background-color:#ccc;">
                                    <div class="d-flex justify-content-center">
                                        <input class="form-check-input me-3" type="checkbox" name="categorias[]"
                                            id="grafico" value="8">
                                        <label class="form-check-label" for="grafico"
                                            style="font-size:12px;">Gráfico</label>
                                    </div>
                                </div>

                            </div>
                            <div class="row justify-content-center">


                                <?php 
                                
                                    while ($categoria = $resultCategorias->fetch_assoc()) {
                                        echo '
                                        <div class="col-3 form-check form-check-inline py-3" style="background-color:#ccc;">
                                            <div class="d-flex justify-content-center">
                                            <input class="form-check-input me-3" type="checkbox" name="categorias[]" id="'.$categoria['nombreCategoria'].'"  value="'.$categoria['idCategoria'].'">
                                            <label class="form-check-label" for="'.$categoria['nombreCategoria'].'" style="font-size:12px;">'.$categoria['nombreCategoria'].'</label>
                                            </div>
                                            </div>
                                        ';
                                    }
                                
                                ?>
                            </div>
                                    <div>
                                        <select name="" id="" class="form-select w-100">
                                            <option value="front">Front-End</option>
                                            <option value="front">Back-End</option>
                                            <option value="front">Programas</option>
                                            <option value="front">Gráfico</option>
                                        </select>

                                        <select name="" id="" class="form-select w-100">
                                            <option value="front">HTML</option>
                                            <option value="front">CSS</option>
                                            <option value="front">JavaScript</option>
                                            <option value="front">Bootstrap</option>
                                        </select>
                                    </div>


                        </div>

                        <button type="submit" class="btn btn-success">Crear</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</main>



<!-- Editor de contenido -->
<script>
CKEDITOR.replace('editor');
</script>



<footer>
        <div class="redes-sociales">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            
        </div>
        <p>Juan Matías Besio. Copyright: 2023-24</p>
   </footer>

  
  

    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <div id="fb-root"></div>

   

    <script type="text/javascript" src="<?php echo RUTARAIZ ?>/js/bootstrap-multiselect.js"></script>



 
</body>
</html>