<?php

session_start();

$pagina = 'musica';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");



/* FUNCION ARREGLO RANDOM */
function randomArray($arreglo){
    $arregloAleatorio = [];
    while ($fila = $arreglo->fetch_assoc()){
      array_push($arregloAleatorio,$fila);
    }
    shuffle($arregloAleatorio);
    return $arregloAleatorio;
  }



// CONSULTO SI ME LLEGA UNA VARIABLE A TRAVÉS DEL METOOD GET
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['filtro'])){
    $filtro = $_GET['filtro'];

    if($filtro == 'listas'){
        // CARGA DE MÚSICA
        $query = "SELECT * FROM musica INNER JOIN genero_musica ON genero_musica.idGenero = musica.idGenero";
        $musica = $connection->query($query);

        $listasSpotify = [];
            
        $listasSpotify = randomArray($musica);
    }else if($filtro == 'generos'){
        $query = "SELECT * FROM genero_musica";
        $resultGeneros = $connection->query($query);
          /* ARREGLO PARA PODER DAR UN ORDEN ALEATORIO A LAS CONSULTAS*/
        $listadoGeneros = [];
        
        $listadoGeneros = randomArray($resultGeneros);
    }else{
        $query = "SELECT * FROM genero_musica";
        $resultGeneros = $connection->query($query);
          /* ARREGLO PARA PODER DAR UN ORDEN ALEATORIO A LAS CONSULTAS*/
        $listadoGeneros = [];
        
        $listadoGeneros = randomArray($resultGeneros);
                // CARGA DE MÚSICA
        $query = "SELECT * FROM musica INNER JOIN genero_musica ON genero_musica.idGenero = musica.idGenero";
        $musica = $connection->query($query);
    
        $listasSpotify = [];
            
        $listasSpotify = randomArray($musica);
    }

    
}  else{
  
    $query = "SELECT * FROM genero_musica";
    $resultGeneros = $connection->query($query);
      /* ARREGLO PARA PODER DAR UN ORDEN ALEATORIO A LAS CONSULTAS*/
    $listadoGeneros = [];
    
    $listadoGeneros = randomArray($resultGeneros);
            // CARGA DE MÚSICA
    $query = "SELECT * FROM musica INNER JOIN genero_musica ON genero_musica.idGenero = musica.idGenero";
    $musica = $connection->query($query);

    $listasSpotify = [];
        
    $listasSpotify = randomArray($musica);

}



include("../../includes/header.php");

?>
    
    <?php if(!isset($_SESSION['idUsuario'])) :?>
   
   <div class="bottomnav">
       
           <a href="../../procesos/registro.php">Regístrate</a>
           <a href="../../procesos/iniciar_sesion.php">Iniciar Sesión</a>
   
    </div>

    <?php endif; ?>

<section class="categorias-blog">
   

   

</section>

<section class="musica">
    <div class="container">

    <div class="titulo-seccion">
        <a href="">Música</a>
    </div>

    <select class="w-100" name="musica" id="selectMusica">

        <option value="musica" <?= (isset($filtro) && $filtro=='musica') ? 'selected' :'';?>>Música</option>
        <option value="generos"  <?= (isset($filtro) && $filtro=='generos') ? 'selected' :'';?> >Generos</option>
        <option value="listas"  <?= (isset($filtro) && $filtro=='listas') ? 'selected' :'';?> >Listas</option>
    </select>

        <div class="row">

        <?php 
            if(isset($listasSpotify) && count($listasSpotify) > 0){
                for ($i=0; $i < 4; $i++) { 
                    echo '
                        <div class="col-md-3 my-3">
                            <a href="detalle_lista.php?id='.$listasSpotify[$i]['idMusica'].'" class="enlace-lista">
                                <div class="lista-info d-flex flex-column text-center">
                                    <i class="fa-brands fa-spotify"></i>
        
                                    <span class="text-center">'.$listasSpotify[$i]['titulo'].'</span>
                                </div>
                            </a>
                        </div>
                    ';
                    }
        
            }


        ?>

          


            <?php 
                 if(isset($listadoGeneros) && count($listadoGeneros) > 0){
                    for ($i=0; $i < 4; $i++) { 
                        echo '
                          <div class="col-md-3 my-3">
                              <a href="musica_generos.php?id='.$listadoGeneros[$i]['idGenero'].'" class="enlace-lista">
                                  <div class="lista-info d-flex flex-column text-center">
                                      <i class="fa-brands fa-spotify"></i>
              
                                      <span class="text-center">'.$listadoGeneros[$i]['genero'].'</span>
                                  </div>
                              </a>
                          </div>
                        ';
                      }
                 }
             
            
            ?>

          

        </div>
    </div>
</section>


<script>
     let selectFiltro = document.querySelector('#selectMusica');
    // APLICO UN COMPORTAMIENTO SOBRE EL EVENTO CHANGE (CUANDO CAMBIA EL VALOR DE SELECT) 
    selectFiltro.addEventListener('change',() => {
        // CAPTURO EL ID DE LA CATEGORIA
        let idFiltro = selectFiltro.value;
        // RE-CARGO LA PAGINA ENVIANDO POR METODO GET EL VALOR DE LA CATEGORIA POR LA CUAL QUIERO FILTRAR
        window.location.href = 'https://portfoliomagazine.info/paginas/magazine/musica.php?filtro='+idFiltro;
        
    });
</script>

<?php

    include("../../includes/footer.php");
   
?>