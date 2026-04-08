<?php
require_once('Connections/conn.php');

$TituloSeccion =  "Bienvenido!";
?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center" >
            <div class="col-sm-7">
                <div class="text-center border border-dark rounded">
                    <?php require_once('menu.php'); ?>
                    <center>
                        <p class="lead">
                            Tu solución integral para administrar tu informaci&oacute;n.
                            <br>
                            Explora, gestiona y optimiza, todo en un solo lugar.
                            <br>
                            <br>
                            <img src="imgs/inicio.png?time=15" border="0">
                        </p>
                    </center>
                </div>  
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>