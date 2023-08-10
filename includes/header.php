<?php
    include_once('config.php');

   
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Juan Matías Besio">
    <title>Portfolio-Magazine</title>
    <link rel="icon" type="image/x-icon" href="/imgs/favicon.ico">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- LIGHTBOX -->
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/lightbox.css"/>
    <!-- FANCY -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Editor -->
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>

    <!-- MULTIPLE SELECT -->
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/bootstrap-multiselect.css" />

    <!-- ESTILOS PERSONALIZADOS -->
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/dropdown.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/estilos.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/formularios.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/grid.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/filtros.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/imagenes.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/lecciones.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/musica.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/modoscuro.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/panel.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/responsive.css" />
    <link rel="stylesheet" href="<?php echo RUTARAIZ ?>/css/recetas.css" />

    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <!-- FUENTES PERSONALIZADOS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">
    
    <!-- ICONOS PERSONALIZADOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
    
    <header>
        <div class="container">
            <div class="logocuenta" style="width:100%!important">
                <a href="<?php echo RUTARAIZ ?>">Portfolio-Magazine</a>
                
                <!-- PREGUNTAR SI EXISTE LA VARIABLE DE SESSION idUsuario, si existe es porque hay un usuario logeado navegando, caso contrario no hay nadie logeado. -->
                <?php if(isset($_SESSION['idUsuario'])) : ?>
            <div class="dropdown">
                <button class="dropbtn">Mi Cuenta</button>
                <div class="dropdown-content">
                    <?php if(isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
                    <a href="<?php echo RUTARAIZ; ?>/adm/panel.php">Panel</a>
                    <?php endif; ?>
                    <a href="<?php echo RUTARAIZ; ?>/cerrar_sesion.php">Cerrar sesión</a>
                </div>
            </div>
            <?php else: ?>
            <a href="<?php echo RUTARAIZ; ?>/procesos/iniciar_sesion.php">Mi Cuenta</a>
            <?php endif; ?>
                </div>     
                
                
            <div class="topnav p-0">
           
            <nav class="navbar navbar-expand-md p-0 justify-content-end justify-content-md-start">
                <div class="w-100 text-center">
                 
                    <button class="navbar-toggler d-block ms-auto d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a class="nav-link text-black" aria-current="page" href="<?php echo RUTARAIZ; ?>/paginas/magazine/imagenes.php">Imágenes</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-black" href="<?php echo RUTARAIZ; ?>/paginas/magazine/musica.php">Música</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-black" href="<?php echo RUTARAIZ; ?>/paginas/magazine/recetas.php">Recetas</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-black" href="<?php echo RUTARAIZ; ?>/paginas/magazine/videos.php">Videos</a>
                        </li>
                    
            </div>
                
        </div>
            
    </header>

  