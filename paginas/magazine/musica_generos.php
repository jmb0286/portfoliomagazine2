<?php

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


if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idGenero = $_GET['id'];

        $query = "SELECT * FROM musica INNER JOIN genero_musica ON genero_musica.idGenero = musica.idGenero WHERE musica.idGenero = '$idGenero'";
        $musica= $connection->query($query);

        $listasSpotify = [];
            
        $listasSpotify = randomArray($musica);
}




  





include("../../includes/header.php");

?>


<section class="categorias-blog">
    <div class="titulo-seccion">
        <a href="">Música: <?= $listasSpotify[0]['genero']; ?></a>
    </div>


</section>

<section class="musica">
    <div class="container">
        <div class="row">

        <?php 
            if(isset($listasSpotify) && count($listasSpotify) > 0){
                for ($i=0; $i < count($listasSpotify); $i++) { 
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

          


          

        </div>
    </div>
</section>


    
<div class="bottomnav">
        
            <a href="procesos/registro.php">Regístrate</a>
            <a href="procesos/iniciar_sesion.php">Iniciar Sesión</a>
    
     </div>

<?php

    include("../../includes/footer.php");
   
?>