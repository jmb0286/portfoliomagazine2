<?php 
// CONEXION A LA BASE DE DATOS.
include("../includes/conexion.php");

// CAPTURO LOS DATOS QUE ME ENVIA LA PETICION
$datos = json_decode($_POST['data']);
$bandera=true;

$resultado = '';

// echo implode(',',$datos->inmueble);


$estructura = "";


// CONSULTA BASE
$queryBase = "SELECT anio,mes,url_img,imagenes.idImagen FROM imagenes WHERE";

$queryFinal = "";

// VERIFICAMOS SI LOS FILTROS LLGAN CON ALGUN VALOR
// EL BASE AL FILTRO QUE LLEGUE REALIZAS LA CONSULTA FILTRANDO POR ESE DATO.

// PARA FILTRAR POR AÑO
if($datos->anio != ''){
    $queryFinal .= $queryBase . " anio = '$datos->anio'";
    $bandera=false;
}

// PARA FILTRAR POR MES
if($datos->mes != ''){
    if(!empty($queryFinal)){
        $queryFinal .= " AND mes = '$datos->mes'";
    }else{
        $queryFinal .= $queryBase . " mes = '$datos->mes'";
    }
    $bandera=false;
}

// PARA FILTRAR POR LUGARES
if($datos->lugar != ''){
    if(!empty($queryFinal)){
        $queryFinal .= " AND idLugar = '$datos->lugar'";
    }else{
        $queryFinal .= $queryBase . " idLugar = '$datos->lugar'";
    }
    $bandera=false;
}


// PARA FILTRAR POR VIAJES
if($datos->viaje != ''){
    if(!empty($queryFinal)){
        $queryFinal .= " AND idViaje = '$datos->viaje'";
    }else{
        $queryFinal .= $queryBase . " idViaje = '$datos->viaje'";
    }
    $bandera=false;
}



// SI NO SE APLICO NINGUN FILTRO, EJECUTO LA SIGUIENTE CONSULTA
if($bandera){
    $queryFinal = "SELECT  anio,mes,url_img,imagenes.idImagen FROM imagenes";
}

/* OBTENGO EL RESULTADO */
$resultViajes = $connection->query($queryFinal);

/* RECORRO EL RESULTADO PARA ARMAR LA ESTRUCTURA DE LAS IMAGENES. */
while($filtro = $resultViajes->fetch_assoc()){
    $estructura .= '
    <div class="col-md-3 my-3">
        <a href="../../imgs/magazine/imagenes/'.$filtro['anio'].'/'.$filtro['mes'].'/'.$filtro['url_img'].'" data-lightbox="grilla-imaganes">
            <img src="../../imgs/magazine/imagenes/'.$filtro['anio'].'/'.$filtro['mes'].'/'.$filtro['url_img'].'" alt="" class="img-grilla">
        </a>
        <span class="titulo">'.$filtro['anio'].'</span>
    </div>
';
}

//echo $queryFinal;
echo $estructura;

?>