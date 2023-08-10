<?php

$pagina = 'blog';

session_start();
include("../../includes/config.php");   


// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php"); 

// CONSULTO SI ME LLEGA UNA VARIABLE A TRAVÉS DEL METOOD GET
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['idCat'])){
    $idCategoria = $_GET['idCat'];
    // EJECUTO LA CONSULTA PARA FILTRAR POR CATEGORIA
    $query = "SELECT * FROM recetas WHERE idCategoriaReceta = '$idCategoria'";
    $resultRecetas = $connection->query($query);
    
}  else{
    // SINO EJECUTO LA CONSULTA BASICA.
    $query = "SELECT * FROM recetas";
    $resultRecetas = $connection->query($query);
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
  $listadoRecetas = [];
  
  $listadoRecetas = randomArray($resultRecetas);
  

include("../../includes/header.php"); 

?>


<section class="categorias-recetas">
   
    <select name="recetas" id="selectCategoria">
        <option value="1" <?= (isset($idCategoria) && $idCategoria==1) ? 'selected' :''; ?>>Comidas</option>
        <option value="2" <?= (isset($idCategoria) && $idCategoria==2) ? 'selected' :''; ?>>Postres</option>

    </select>

</section>

<section class="recetas">
    <div class="container">
        <div class="portadareceta">
            
        </div>
        <div class="grilla">

            <?php
                $i = 1;
                foreach ($listadoRecetas as $receta) {
                    if($i == 3){
                        echo '
                        <div class="col-principal">
                            <a class="enlace-receta" href="recetapost.php?id='.$receta['idReceta'].'">
                                <img src="../../imgs/magazine/recetas/'.$receta['portada'].'" class="img-fluid" alt="">
                                <h2>'.$receta['titulo'].'</h2>
                            </a>
                        </div>
                        ';
                    }else if($i == 4){
                        echo '
                        <div class="col-principal2">
                            <a class="enlace-receta" href="recetapost.php?id='.$receta['idReceta'].'">
                                <img src="../../imgs/magazine/recetas/'.$receta['portada'].'" class="img-fluid" alt="">
                                <h2>'.$receta['titulo'].'</h2>
                            </a>
                        </div>
                        ';
                    }
                    else{
                        echo '
                        <div class="col-secundaria">
                            <a class="enlace-receta" href="recetapost.php?id='.$receta['idReceta'].'">
                                <img src="../../imgs/magazine/recetas/'.$receta['portada'].'" class="img-fluid" alt="">
                                <h2>'.$receta['titulo'].'</h2>
                            </a>
                        </div>
                        ';
                    }

                    if($i == 6){
                        $i = 0;
                    }
                   

                    $i++;
                }


            ?>
          
        </div>
    </div>
    
</section>


<script>
     let selectFiltro = document.querySelector('#selectCategoria');
    // APLICO UN COMPORTAMIENTO SOBRE EL EVENTO CHANGE (CUANDO CAMBIA EL VALOR DE SELECT) 
    selectFiltro.addEventListener('change',() => {
        // CAPTURO EL ID DE LA CATEGORIA
        let idFiltro = selectFiltro.value;
        // RE-CARGO LA PAGINA ENVIANDO POR METODO GET EL VALOR DE LA CATEGORIA POR LA CUAL QUIERO FILTRAR
        window.location.href = 'https://portfoliomagazine.info/paginas/magazine/recetas.php?idCat='+idFiltro;
        
    });
</script>


<?php if(!isset($_SESSION['idUsuario'])) :?>
   
    <div class="bottomnav">
        
            <a href="procesos/registro.php">Regístrate</a>
            <a href="procesos/iniciar_sesion.php">Iniciar Sesión</a>
    
     </div>

     <?php endif; ?>
<?php

    include("../../includes/footer.php");
   
?>