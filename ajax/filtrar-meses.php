<?php 
// CONEXION A LA BASE DE DATOS.
include("../includes/conexion.php");

$anio = $_POST['anio'];
$estructura = '<option value="">Mes</option>';
/*$arrayMeses = ['enero', 'febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre', 'noviembre','diciembre'];
$sqlMeses = [];*/
if($anio != ''){
    $query = "SELECT mes, count(*) as cantidadFotos FROM imagenes WHERE anio='$anio' GROUP BY mes";
    $resultMeses = $connection->query($query);
    
    
    while($mes = $resultMeses->fetch_assoc()){
     
        
        
        $estructura .= '
        <option value="'.$mes['mes'].'">'.$mes['mes'].' ('.$mes['cantidadFotos'].')</option>
        ';
    }
  

}else{
    
    $estructura .= '          
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
    <option value="diciembre">Diciembre</option>';
    
}
/*

foreach ($arrayMeses as $mes) {
    $bandera = false;
    $contador = 0;
    for ($i = 0; $i < count($sqlMeses); $i++) { 
        if($mes == $sqlMeses[$i]['mes']){
            $bandera == true;
            $pos = $i;
        }
       
    }

    if($bandera){
        $estructura .= '<option value="'.$sqlMeses[$pos]['mes'].'">('.$sqlMeses[$pos]['cantidadFotos'].')</option>';          
    }else{
        $estructura .= '<option value="'.$mes.'">'.$mes.'</option>';          
    }
    
}
*/




echo $estructura;
?>