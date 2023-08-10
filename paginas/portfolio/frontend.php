
<?php
session_start();
$pagina = 'front-end';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

include("../../includes/header.php");


/* FUNCION ARREGLO RANDOM */
function randomArray($arreglo){
  $arregloAleatorio = [];
  while ($fila = $arreglo->fetch_assoc()){
    array_push($arregloAleatorio,$fila);
  }
  shuffle($arregloAleatorio);
  return $arregloAleatorio;
}

// LISTADO DE LECCIONES HTML
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE idCategoria = 1";
$leccionesHTMLResult= $connection->query($query);

// LISTADO DE LECCIONES CSS
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE idCategoria = 3";
$leccionesCSSResult= $connection->query($query);

// LISTADO DE LECCIONES JS
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE idCategoria = 4";
$leccionesJSResult= $connection->query($query);

/* ARREGLO PARA PODER DAR UN ORDEN ALEATORIO A LAS CONSULTAS*/
$leccionesHTML = [];
$leccionesHTML = randomArray($leccionesHTMLResult);

$leccionesCSS = [];
$leccionesCSS = randomArray($leccionesCSSResult);

$leccionesJS = [];
$leccionesJS = randomArray($leccionesJSResult);



$query = "SELECT * FROM codigo_ejemplo WHERE categoria = 'html'";
$codigosHTMLResult = $connection->query($query);

$codigoejemploHTML = [];
$codigoejemploHTML = randomArray($codigosHTMLResult);

$query = "SELECT * FROM codigo_ejemplo WHERE categoria = 'css'";
$codigoejemploCSSResult = $connection->query($query);

$codigoejemploCSS = [];

$codigoejemploCSS = randomArray($codigoejemploCSSResult);

$query = "SELECT * FROM codigo_ejemplo WHERE categoria = 'javascript'";
$codigoejemploJSResult = $connection->query($query);

$codigoejemploJS = [];

$codigoejemploJS = randomArray($codigoejemploJSResult);



?>


<section class="frontend seccion-front" title="Front-End">
    

            <div class="container">
            
       

              <h3 class="borde-html titulo-leccion-front">Html: Lecciones de HTML </h3>

              <div class="row pb-3" class="contenedorLecciones">
                <?php
                $contador = 0; 
                  foreach ($leccionesHTML as $leccion) {
                    $contador++;
                    $contadorCodigo = 0;
                    echo '
                    <div class="col-lg-2 my-3">
                      <div class="card borde-html text-center">
                        <a href="ver-leccion.php?id='.$leccion['idLeccion'].'">  '.$leccion['titulo'].'</a>
                      </div>
                    </div>
                    ';
                   
                   
                  }

                  echo '<div class="row">';
                  for ($i=0; $i < 4; $i= $i+2) { 
                    echo '
                    <div class="col-lg-6 col-codigo d-flex">
                      <div class="borde-html w-100">
                        <p>'.$codigoejemploHTML[$i]['codigo'].'</p>
                      </div>
                    </div>

                    <div class="col-lg-6 col-codigo d-flex">
                      <div class="borde-html w-100">
                        <p>'.$codigoejemploHTML[$i+1]['codigo'].'</p>
                      </div>
                    </div>
                    ';
                  }
                  echo '</div>';
                ?>
              </div>

              
              <h3 class="borde-css titulo-leccion-front">CSS: Lecciones de CSS </h3>

              <div class="row pb-3" class="contenedorLecciones">
                <?php
                $contador = 0; 
                  foreach ($leccionesCSS as $leccion) {
                    $contador++;
                    $contadorCodigo = 0;
                    echo '
                    <div class="col-lg-2 my-3">
                      <div class="card borde-css text-center">
                        <a href="ver-leccion.php?id='.$leccion['idLeccion'].'">  '.$leccion['titulo'].'</a>
                      </div>
                    </div>
                    ';
                  }

                  echo '<div class="row">';

                  for ($i=0; $i < 4; $i= $i+2) { 
                    echo '
                    <div class="col-lg-6 col-codigo d-flex">
                      <div class="borde-css w-100">
                        <p>'.$codigoejemploCSS[$i]['codigo'].'</p>
                      </div>
                    </div>

                    <div class="col-lg-6 col-codigo d-flex">
                      <div class="borde-css w-100">
                        <p>'.$codigoejemploCSS[$i+1]['codigo'].'</p>
                      </div>
                    </div>
                    ';
                  }
                  echo '</div>';
                ?>
              </div>


              <h2 class="borde-js titulo-leccion-front">JS: Lecciones de JS </h2>

              <div class="row pb-3" class="contenedorLecciones">
                <?php
                $contador = 0; 
                  foreach ($leccionesJS as $leccion) {
                    $contador++;
                    $contadorCodigo = 0;
                    echo '
                    <div class="col-lg-2 my-3">
                      <div class="card borde-js text-center">
                        <a href="ver-leccion.php?id='.$leccion['idLeccion'].'">  '.$leccion['titulo'].'</a>
                      </div>
                    </div>
                    ';
                  }

                  echo '<div class="row">';

                  for ($i=0; $i < 4; $i= $i+2) { 
                    echo '
                    <div class="col-lg-6 col-codigo d-flex">
                      <div class="borde-js w-100">
                        <p>'.$codigoejemploJS[$i]['codigo'].'</p>
                      </div>
                    </div>

                    <div class="col-lg-6 col-codigo d-flex">
                      <div class="borde-js w-100">
                        <p>'.$codigoejemploJS[$i+1]['codigo'].'</p>
                      </div>
                    </div>
                    ';
                  }
                  echo '</div>';
                ?>
              </div>
            </div>
            </div>
</section>


    


<script>

  let contenedorLecciones = document.querySelector('#contenedorLecciones');

  let selectFiltro = document.querySelector('#selectCategoria');

  selectFiltro.addEventListener('change', () => {
    let idCategoria = selectFiltro.value;
        // RE-CARGO LA PAGINA ENVIANDO POR METODO GET EL VALOR DE LA CATEGORIA POR LA CUAL QUIERO FILTRAR
        window.location.href = 'https://portfoliomagazine.info/paginas/portfolio/frontend.php?id='+idCategoria;

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