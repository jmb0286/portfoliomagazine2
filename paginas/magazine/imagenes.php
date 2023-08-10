<?php
$pagina = 'imagenes';
// CONEXION A LA BASE DE DATOS.
include("../../includes/conexion.php");


// CARGAR FILTROS DINÁMICAMENTE


// FILTROS POR LUGAR
$query = "SELECT * FROM lugares";
$resultLugar = $connection->query($query);

// FILTROS por VIAJES
$query = "SELECT * FROM viajes";
$resultViajes = $connection->query($query);


$anio="";
// CONSULTO SI ME LLEGA UNA VARIABLE A TRAVÉS DEL METOOD GET
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['anio'])){
    $anio = $_GET['anio'];
    // EJECUTO LA CONSULTA PARA FILTRAR POR CATEGORIA
    if(!empty($anio)){
        $query = "SELECT * FROM imagenes WHERE fecha = '$anio'";
        $resultImagenes = $connection->query($query);
    }else{
        $query = "SELECT * FROM imagenes";
        $resultImagenes = $connection->query($query);
    }
   
} else{
    $query = "SELECT * FROM imagenes";
    $resultImagenes = $connection->query($query);
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
  $imagenes = [];
  
  $imagenes = randomArray($resultImagenes);

session_start();


if(!isset($_SESSION['idUsuario'])){
    $limite = 16;
}


?>

<?php include_once('../../includes/header.php') ?>

<section class="imagenes">

   
    <div class="container">

        <div class="row"> 
            <div class="col-12">
                <select name="" id="selectAnio" class="w-100">
                    <option value="">Año</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
            </div>
     
    
  
        <div class="col-12 col-md-4">
            <select class="w-100" name="" id="selectMes">
                <option value="">Mes</option>
                <option value="enero">Enero</option>
                <option value="febrero">Febrero</option>
                <option value="marzo" >Marzo</option>
                <option value="abril">Abril</option>
                <option value="mayo">Mayo</option>
                <option value="junio">Junio</option>
                <option value="julio">Julio</option>
                <option value="agosto">Agosto</option>
                <option value="setiembre">Setiembre</option>
                <option value="octubre">Octubre</option>
                <option value="noviembre">Nomviembre</option>
                <option value="diciembre">Diciembre</option>  
                
            </select>
        </div>
        <div class="col-12 col-md-4">
            <select class="w-100" name="" id="selectLugares">
                <option value="">Lugares</option>
                <?php 
                while($lugar = $resultLugar->fetch_assoc()){
                    echo '
                    <option value="'.$lugar['idLugar'].'">'.$lugar['lugar'].'</option>
                    ';
                }
                ?>
               
            </select>
        </div>
        <div class="col-12 col-md-4">
            <select class="w-100" name="" id="selectViajes">
                <option value="">Viajes</option>    
                <?php 
                while($viaje = $resultViajes->fetch_assoc()){
                    echo '
                    <option value="'.$viaje['idViaje'].'">'.$viaje['viaje'].'</option>
                    ';
                }
                ?>
            </select>
        </div>

        </div>


        <div class="row" id="contenedorImagenes">
            <?php 
            $i = 0;
                foreach ($imagenes as $imagen) {
                    if(isset($limite)){
                        if($i < $limite){
                            echo '
                            <div class="col-12 col-md-3  my-3">
                                <a href="../../imgs/magazine/imagenes/'.$imagen['anio'].'/'.$imagen['mes'].'/'.$imagen['url_img'].'" data-lightbox="grilla-imaganes">
                                    <img src="../../imgs/magazine/imagenes/'.$imagen['anio'].'/'.$imagen['mes'].'/'.$imagen['url_img'].'" alt="" class="img-grilla">
                                </a>
                                <span class="titulo">'.$imagen['anio'].'</span>
                            </div>
                            ';
                            $i++;
                        }
                    }else{
                        echo '
                        <div class="col-12 col-md-3  my-3">
                            <a href="../../imgs/magazine/imagenes/'.$imagen['anio'].'/'.$imagen['mes'].'/'.$imagen['url_img'].'" data-lightbox="grilla-imaganes">
                                <img src="../../imgs/magazine/imagenes/'.$imagen['anio'].'/'.$imagen['mes'].'/'.$imagen['url_img'].'" alt="" class="img-grilla">
                            </a>
                            <span class="titulo">'.$imagen['anio'].'</span>
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

<!-- LIGHTBOX JS -->
<script src="../../js/lightbox-plus-jquery.min.js"></script>

<script>
    /* SELECCIONO TODOS LOS ELEMENTOS, PARA PODER APLICAR LOS FILTROS */
    let selectAnio = document.querySelector('#selectAnio');
    let selectMes = document.querySelector('#selectMes');
    let selectLugares = document.querySelector('#selectLugares');
    let selectViajes = document.querySelector('#selectViajes');
    const contenedorImagenes = document.querySelector('#contenedorImagenes');
    /* Creamos un objetos para almacenar el valor por el cual filtrar */
    let filtros = {
        anio:"",
        mes:"",
        lugar:"",
        viaje:""
    };

        // FUNCION PARA EJECUTAR LA FUNCION AJAX
        function procesarFiltrosAjax(dataFiltros){
        $.ajax({
                //INDICAR URL DEL ARCHIVO AJAX
                url: '../../ajax/filtrar-imagenes.php',
                // TIPO DE PETICION
                type: 'POST',
                // LA INFORMACIÓN A ENVIAR
                data: {data:dataFiltros} ,
                // EL TIPO DE DATO
 
                // FUNCION EJECUTADA CUANDO SE CUMPLE TODO CORRECTAMENTE
                success: function (response) {
                //   console.log(response);
                    contenedorImagenes.innerHTML = '';
                    contenedorImagenes.innerHTML = response;
                },
                // FUNCION SE EJECUTA CUANDO HA OCURRIDO UN ERROR
                error: function () {
                    alert("error");
                }
            }); 
    }

    // FUNCION PARA MOSTRAR MESES DISPONIBLES
    function procesarMeses(anio){
        $.ajax({
                //INDICAR URL DEL ARCHIVO AJAX
                url: '../../ajax/filtrar-meses.php',
                // TIPO DE PETICION
                type: 'POST',
                // LA INFORMACIÓN A ENVIAR
                data: {anio:anio} ,
                // EL TIPO DE DATO
 
                // FUNCION EJECUTADA CUANDO SE CUMPLE TODO CORRECTAMENTE
                success: function (response) {
                    console.log(response);
                    selectMes.innerHTML = '';
                    selectMes.innerHTML = response;
                  /*  contenedorImagenes.innerHTML = '';
                    contenedorImagenes.innerHTML = response; */
                },
                // FUNCION SE EJECUTA CUANDO HA OCURRIDO UN ERROR
                error: function () {
                    alert("error");
                }
            }); 
    }

    /* PROGRAMAMOS EL EVENTO CHANGE, PARA DESENCADNEAR UNA FUNCION */
    selectAnio.addEventListener('change', (e) =>{
        filtros.anio = e.target.value;

        let filtrosData = JSON.stringify(filtros);
            // PETICION CONFIG MES
            procesarMeses(e.target.value);
       
        // PETICION AJAX - CONFIGURACIÓN.
        procesarFiltrosAjax(filtrosData);
     
    });

    selectMes.addEventListener('change', (e) =>{
        filtros.mes = e.target.value;
        let filtrosData = JSON.stringify(filtros);
        // PETICION AJAX - CONFIGURACIÓN.
        procesarFiltrosAjax(filtrosData);
    });
    
    selectLugares.addEventListener('change', (e) =>{
        filtros.lugar = e.target.value;
        let filtrosData = JSON.stringify(filtros);
        // PETICION AJAX - CONFIGURACIÓN.
        procesarFiltrosAjax(filtrosData);
    });

    selectViajes.addEventListener('change', (e) =>{
        filtros.viaje = e.target.value;
        let filtrosData = JSON.stringify(filtros);
        // PETICION AJAX - CONFIGURACIÓN.
        procesarFiltrosAjax(filtrosData);
    });



</script>


<?php include("../../includes/footer.php") ?>