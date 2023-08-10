<?php
session_start();

// CONEXION A LA BASE DE DATOS.
include("includes/conexion.php");   

// CARGA DE LECCIONES HTML
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 2"; 
$listadoHTML = $connection->query($query);

// CARGA DE LECCIONES CSS
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 3"; 
$listadoCSS = $connection->query($query);  

// CARGA DE LECCIONES JS
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 4"; 
$listadoJS = $connection->query($query);

// CARGA DE LECCIONES BUENAS PRACTICAS FRONT-END
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 5"; 
$listadoBPFrontEnd= $connection->query($query);

// CARGA DE LECCIONES PHP
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 6"; 
$listadoPHP= $connection->query($query);

// CARGA DE LECCIONES SQL
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 7"; 
$listadoSQL= $connection->query($query);
 
// CARGA DE LECCIONES BASE DE DATOS
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 8"; 
$listadoBaseDatos= $connection->query($query);

// CARGA DE LECCIONES BUENAS PRACTICAS BACK-END
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 9";
$listadoBPBackEnd = $connection->query($query);

// CARGA DE LECCIONES ILLUSTRATOR
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 11"; 
$listadoIllustrator= $connection->query($query);

// CARGA DE LECCIONES INDESIGN
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 12"; 
$listadoIndesign= $connection->query($query);

// CARGA DE LECCIONES PHOTOSHOP
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 13"; 
$listadoPhotoshop= $connection->query($query);

// CARGA DE LECCIONES BUENAS PRÁCTICAS DISEÑO
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 14"; 
$listadoBPdiseno= $connection->query($query);

// CARGA DE LECCIONES FIGMA
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 22"; 
$listadoFigma = $connection->query($query);

// CARGA DE LECCIONES VISUAL STUDIO CODE
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 23"; 
$listadoVisualStudio = $connection->query($query);

// CARGA DE LECCIONES XAMPP
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 24"; 
$listadoXampp = $connection->query($query);

// CARGA DE LECCIONES BUENAS PRACTICAS PROGRAMAS
$query = "SELECT * FROM lecciones INNER JOIN detalle_categoria_leccion AS dc ON dc.idLeccion = lecciones.idLeccion WHERE dc.idCategoria = 25"; 
$listadoBPProgramas = $connection->query($query);

include("includes/header.php");

?>

<main class="pagina-index">
    <div class="container">
        <section class="front-end" title="Front-End">
            <div class="container">
                <div class="titulo-seccion">
                    <a href="paginas/portfolio/frontend.php">Front-End:</a>
                    <div class="redesociales">
                        <a href="" style="margin-right:8px;"> <i class="fa-brands fa-github"></i></a>   
                        <a href=""><i class="fa-brands fa-youtube"></i></a>
                    </div>
            </div>

        <select class="select-frontend frontend html" name="html" id="selectHTML">  
            <option value="0">HTML</option>  
                <?php
                    while($leccion = $listadoHTML->fetch_assoc()){
                        echo '
                        <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>  
                        
                        ';
                    }
                ?>                  
        </select>
        <select class="select-frontend frontend css" name="css" id="selectCSS">
            <option value="css">CSS</option>
                <?php
                    while($leccion = $listadoCSS->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>  
                        ';
                    }   
                ?>
        </select>
        <select class="select-frontend frontend js" name="js" id="js">
            <option value="0">JavaScript</option>
                <?php
                    while($leccion = $listadoJS->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>         
                        ';
                    }    
                ?>
        </select>
        <select class="select-frontend frontend bp" name="bp" id="bp">
            <option value="bp">Buenas Prácticas</option>
                <?php
                    while($leccion = $listadoBPFrontEnd->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>    
                            ';
                    }
                ?>
        </select>
    </section>
</div>


<section class="back-end" title="Back-End">
    <div class="container">                  
        <div class="titulo-seccion">
            <a href="paginas/portfolio/backend.php">Back-End:</a>
            <div class="redesociales">
                <a href="" style="margin-right:8px;"> <i class="fa-brands fa-github"></i></a>   
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div> 

        <select class="select-backend backend sql" name="sql" id="sql">
            <option value="0">SQL</option> 
                        
        </select>     

        <select class="select-backend backend php" name="php" id="php">
            <option value="0">PHP</option>                
                <?php
                    while($leccion = $listadoPHP->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>             
                        ';
                    }      
                ?>
        </select>

        <select class="select-backend backend bd" name="php" id="php">
        <option value="bd">Base De Datos</option>

        </select>

        <select class="select-backend backend bp" name="bp" id="bp">
            <option value="bp">Buenas Prácticas</option>
                <?php                
                    while($leccion = $listadoBPBackEnd->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>        
                        ';
                    }
                ?>
        </select>     
    </div>
</section>

<section class="programas" title="Programas">
    <div class="container">                 
        <div class="titulo-seccion">
            <a href="paginas/portfolio/programas.php">Programas:</a>
            <div class="redesociales">
                <a href="" style="margin-right:8px;"> <i class="fa-brands fa-github"></i></a>   
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>              
        </div> 

        <select class="select-programas programas" name="figma" id="selectFigma">        
            <option value="0">Figma</option>  
            <?php
                while($leccion = $listadoFigma->fetch_assoc()){
                    echo '
                        <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>      
                    ';
                }
            ?>                      
        </select>

        <select class="select-programas programas vsc" name="vsc" id="selectVSC">
            <option value="0">Visual Studio Code</option>
                <?php
                    while($leccion = $listadoVisualStudio->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>                  
                        ';
                    }
                ?>
        </select>

        <select class="select-programas frontend js" name="js" id="js">
            <option value="0">Xampp</option>
                <?php
                    while($leccion = $listadoXampp->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>                       
                        ';
                    }
                ?>
            </select>

            <select class="select-programas frontend bp" name="bp" id="bp">
                <option value="bp">Buenas Prácticas de Programas</option>
                    <?php
                        while($leccion = $listadoBPProgramas->fetch_assoc()){
                            echo '
                                <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>      
                            ';
                        }
                    ?>
            </select>
        </div>
</section>

<section title="Diseño Gráfico">
    <div class="container">
        <div class="titulo-seccion">
            <a href="paginas/portfolio/dgrafico.php">Diseño Gráfico:</a>
            <div class="redesociales">
                <a href="" style="margin-right:8px;"> <i class="fa-brands fa-github"></i></a>   
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>        

        <select class="select-grafico grafico illustrator" name="illustrator" id="illustrator">
            <option value="ill">Illustrator</option>   
                <?php                    
                    while($leccion = $listadoIllustrator->fetch_assoc()){
                        echo '
                           <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>  
                        ';
                    }
                ?>          
        </select>
        
        <select class="select-grafico grafico indesign" name="illustrator" id="illustrator">
            <option value="InD">InDesign</option>
                <?php        
                    while($leccion = $listadoIndesign->fetch_assoc()){
                        echo '
                            <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>  
                        ';
                    }
                ?>   
        </select>

        <select class="select-grafico grafico photoshop" name="photoshop" id="photoshop">
            <option value="photoshop">Photoshop</option>
                <?php            
                    while($leccion = $listadoPhotoshop->fetch_assoc()){
                        echo '
                           <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>  
                        ';
                    }
                ?>   
        </select>
        
        <select class="select-grafico grafico bp" name="bp" id="bp">
            <option value="bp">Buenas Prácticas</option>
                <?php                    
                    while($leccion = $listadoBPdiseno->fetch_assoc()){
                        echo '
                           <option value="'.$leccion['idLeccion'].'">'.$leccion['titulo'].'</option>    
                        ';
                    }
                ?>   
        </select>
    </div>
</section>
       
<?php if(!isset($_SESSION['idUsuario'])) :?>
   
   <div class="bottomnav">
       
           <a href="../../procesos/registro.php">Regístrate</a>
           <a href="../../procesos/iniciar_sesion.php">Iniciar Sesión</a>
   
    </div>

    <?php endif; ?>
</main>
    

<script src="js/app.js"></script>     

    
<?php include("includes/footer.php"); ?>