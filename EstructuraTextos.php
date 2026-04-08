<?php
require_once('Connections/conn.php');

$inputCarnet = "";

$recorrerArbol = false;

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {

    spl_autoload_register(function($class) {
        require_once "class/" . $class . ".class.php";
    });



    $recorrerArbol = true;

    $inputCarnet = strval($_POST['inputCarnet']);

    if (!file_exists($inputCarnet)) {
        mkdir($inputCarnet);
    }

    $inputDocumentos = $inputCarnet . "/DOCUMENTOS";

    if (!file_exists($inputDocumentos)) {
        mkdir($inputDocumentos);
    }

    $inputTextos = $inputDocumentos . "/TEXTOS";

    if (!file_exists($inputTextos)) {
        mkdir($inputTextos);
    }



    $Utilidades = new Utilidades();
    // Inicio Insertar en LOG
    //$row_id = mysql_insert_id();
    $TABLA_LOG = "'generartextos'";
    $TIPO_CONSULTA_LOG = "'INSERT'";
    include 'inc_bitacora.php';
}


$TituloSeccion = "Crear Estructura de Textos";
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
                            Formulario para crear la estructura con comandos de<br>archivos y directorios de PHP
                            <br>
                        </p>
                        <form class="form-horizontal form-outline col-sm-5" name="formUsuarios" id="formUsuarios" method="POST" role="form" action="EstructuraTextos.php" autocomplete="off">
                            <div class="row">
                                <div class="col">
                                    <label for="inputCarnet">Carnet:</label>
                                    <input type="text" class="form-control" id="inputCarnet" value="<?php echo $inputCarnet; ?>" name="inputCarnet" aria-describedby="inputCarnet" required autofocus minlength="4"  maxlength="12">
                                    <input type="hidden" name="okForm" value="Continuar">
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Crear Estructura</button><br><br>
                            </div>
                        </form>
                    </center>
                    <div class="text-left border-primary rounded">
                        <?php
                        if ($recorrerArbol) {
                            $nombreDirectorio = __DIR__ . "/" . $inputCarnet;
                            $directorio = new Directorio($nombreDirectorio);
                        }
                        ?>
                    </div>  
                </div>  
            </div>
        </div>

        <?php require_once('scripts.php'); ?>
        <br>
    </body>
</html>