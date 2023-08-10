
<?php
session_start();

$pagina = 'front-end';

// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");

include("../../includes/header.php");

$query = "SELECT * FROM categorias WHERE nombreCategoria IN ('progrmas','figma','visual studio code','xampp','buenas practicas programas')";
$resultCategorias = $connection->query($query);

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
  $idCategoria = $_GET['id'];

  $query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE idCategoria = '$idCategoria'";
  $leccionesProgramasResult = $connection->query($query);

}else{
// LISTADO DE CURSOS FRONT-END
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE idCategoria = 21";
$leccionesProgramasResult = $connection->query($query);
}


/* ARREGLO PARA PODER DAR UN ORDEN ALEATORIO A LAS CONSULTAS*/
$leccionesProgramas = [];

$leccionesProgramas = randomArray($leccionesProgramasResult);

$query = "SELECT * FROM codigo_ejemplo WHERE categoria = 'programas'";
$codigoprogramas = $connection->query($query);

$codigoejemplo = [];

$codigoejemplo = randomArray($codigoprogramas);


?>


<section class="programas" title="Programas">
    <div class="container">    
      
        <form id="formFiltroLecciones">
            <select class="w-100" name="frontend" id="selectCategoria">

              <?php
                while ($fila = $resultCategorias->fetch_assoc()) {
                  if(isset($idCategoria) && $idCategoria == $fila['idCategoria']){
                    echo '<option value="'.$fila['idCategoria'].'" selected>'.ucfirst($fila['nombreCategoria']).'</option>';
                  }else{
                    echo '<option value="'.$fila['idCategoria'].'">'.ucfirst($fila['nombreCategoria']).'</option>';
                  }
                  
                }
              ?>

            </select>
        </form>
              <div class="row pb-3" class="contenedorLecciones">
                <?php
                $contador = 0; 
                  foreach ($leccionesProgramas as $leccion) {
                    $contador++;
                    $contadorCodigo = 0;
                    if($contador == 7){
                        echo '
                        <div class="col-lg-6 col-codigo">
                          <div>
                            <p>'.$codigoejemplo[$contadorCodigo]['codigo'].'</p>
                          </div>
                        </div>

                        <div class="col-lg-6 col-codigo">
                          <div>
                            <p>'.$codigoejemplo[$contadorCodigo+1]['codigo'].'</p>
                          </div>
                        </div>
                        ';
                        $contadorCodigo +=2;
                        $contador = 0; 
                    }else{
                      echo '
                      <div class="col-lg-2 my-3">
                        <div class="card">
                          <p>'.$leccion['portadaLeccion'].'</p>
                          <a href="ver-leccion.php?id='.$leccion['idLeccion'].'">  '.$leccion['titulo'].'</a>
                        </div>
                      </div>
                      ';
                    }
                   
                  }
                ?>
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