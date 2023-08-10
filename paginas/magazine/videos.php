<?php

session_start();
$pagina = 'videos';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");



$query = "SELECT * FROM categoria_videos";
$resultCategorias = $connection->query($query);


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && !empty($_GET['id'])){
  $idCategoria = $_GET['id'];
  $query = "SELECT * FROM videos WHERE idCategoriaVideo = '$idCategoria'";
  $resultVideos = $connection->query($query);
}else{
  // CARGA DE VIDEOS
  $query = "SELECT * FROM videos";
  $resultVideos = $connection->query($query);
}



/* FUNCION ARREGLO RANDOM */
function randomArray($arreglo){
    $arregloAleatorio = [];
    while ($fila = $arreglo->fetch_assoc()){
      array_push($arregloAleatorio,$fila);
    }
    shuffle($arregloAleatorio);
    return $arregloAleatorio;
  }
  /* ARREGLO PARA PODER DAR UN ORDEN ALEATORIO A LAS CONSULTAS*/
  $listadoVideos = [];
  
  $listadoVideos = randomArray($resultVideos);



include("../../includes/header.php");

?>

<section class="videos">
  <div class="container">

  <select id="selectVideos" class="w-100">
        <option value="">Todos</option>
        <?php
            while ($fila = $resultCategorias->fetch_assoc()){
           
              if(isset($idCategoria) && $idCategoria == $fila['idCategoriaVideo']){
                echo '
                <option value="'.$fila['idCategoriaVideo'].'" selected>'.$fila['nombre'].'</option>
            ';
              }else{
                echo '
                <option value="'.$fila['idCategoriaVideo'].'">'.$fila['nombre'].'</option>
            ';
              }
              
            }
        ?>

    </select>

    <div class="row">
      
      <?php
              if(count($listadoVideos) > 0){
                $cantVideos = (count($listadoVideos) >= 8) ? 8 : count($listadoVideos);
                for ($i=0; $i < $cantVideos; $i++) { 
                  echo '
                      <div class="col-md-3 my-3">
                            <a data-fancybox href="https://www.youtube.com/watch?v='.$listadoVideos[$i]['url'].'&amp;autoplay=1&amp;rel=0&amp;controls=0&amp;showinfo=0">
                            <img class="card-img-top img-fluid" src="http://img.youtube.com/vi/'.$listadoVideos[$i]['url'].'/mqdefault.jpg" />
                          </a>
                          <span class="titulo">'.$listadoVideos[$i]['titulo'].'</span>
                      </div>
                  ';
                }

              }

      ?>
    </div>

  </div>
</section>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.4.slim.js" integrity="sha256-dWvV84T6BhzO4vG6gWhsWVKVoa4lVmLnpBOZh/CAHU4=" crossorigin="anonymous"></script>

<!-- FANCY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha512-j7/1CJweOskkQiS5RD9W8zhEG9D9vpgByNGxPIqkO5KrXrwyDAroM9aQ9w8J7oRqwxGyz429hPVk/zR6IOMtSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- LIGHTBOX JS -->
<script src="../../js/lightbox-plus-jquery.min.js"></script>

<script>
     let selectFiltro = document.querySelector('#selectVideos');
    // APLICO UN COMPORTAMIENTO SOBRE EL EVENTO CHANGE (CUANDO CAMBIA EL VALOR DE SELECT) 
    selectFiltro.addEventListener('change',() => {
        // CAPTURO EL ID DE LA CATEGORIA
        let idCategoria = selectFiltro.value;
        // RE-CARGO LA PAGINA ENVIANDO POR METODO GET EL VALOR DE LA CATEGORIA POR LA CUAL QUIERO FILTRAR
        window.location.href = 'https://portfoliomagazine.info/paginas/magazine/videos.php?id='+idCategoria;
        
    });
</script>
    

<?php if(!isset($_SESSION['idUsuario'])) :?>
   
   <div class="bottomnav">
       
           <a href="../../procesos/registro.php">Regístrate</a>
           <a href="../../procesos/iniciar_sesion.php">Iniciar Sesión</a>
   
    </div>

    <?php endif; ?>
<?php
    include("../../includes/footer.php");
   
?>