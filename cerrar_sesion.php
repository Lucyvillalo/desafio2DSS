<?php
session_start();
session_unset();
session_destroy();
session_write_close();

function borrar_arreglo($arreglo) {
    foreach ($arreglo as $key => $value) {
        unset($arreglo[$key]);
    }
}

borrar_arreglo(get_defined_constants());
borrar_arreglo(get_defined_functions());
borrar_arreglo(get_declared_classes());
borrar_arreglo($_POST);
borrar_arreglo($_GET);
borrar_arreglo($_SERVER);

$TituloSeccion = "Cerrar Sesi&oacute;n";
?>
<!doctype html>
<html lang="es">
    <head>
<?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center" >
            <div class="shadow-lg p-3 col-sm-5 bg-white rounded">
                <div class="text-center border border-success rounded bg-light">
                    <div class="alert alert-success" role="alert">
                        Sesi&oacute;n Cerrada con &Eacute;xito!
                    </div>
                    <br>
                    <img src="imgs/login.png" alt="">
                    <hr width="80%" class="bg-success border-2 border-top border-success" />
                    <h1>Cierre de Sesi&oacute;n</h1>
                    <center>
                        <a href="index.php" class="btn btn-success btn-lg active" role="button" aria-pressed="true">&nbsp;&nbsp;&nbsp;Salir&nbsp;&nbsp;&nbsp;</a>
                    </center>
                    <br>
                </div>  
            </div>
        </div>        
<?php require_once('scripts.php'); ?>
    </body>
</html>