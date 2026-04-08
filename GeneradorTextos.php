<?php
require_once('Connections/conn.php');

$inputCarnet = "";
$recorrerArbol = false;
// Definimos las rutas de los archivos para usarlas en los botones
$urlArchivo01 = "";
$urlArchivo02 = "";

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {

    $inputCarnet = $_POST['inputCarnet'];
    $inputDocumentos = $inputCarnet . "/DOCUMENTOS";
    $inputTextos = $inputDocumentos . "/TEXTOS";

    if (!file_exists($inputTextos)) {
        mkdir($inputTextos, 0777, true);
    }

    $Textarea01 = $_POST['Textarea01'];
    $array = explode('...', $Textarea01);

    $contenidoArchivo01 = $array[0];
    $nombreArchivo01 = $inputTextos . "/LOREMIPSUM01.TXT";
    $archivo01 = fopen($nombreArchivo01, "w");
    fwrite($archivo01, $contenidoArchivo01);
    fclose($archivo01);

    $contenidoArchivo02 = isset($array[1]) ? $array[1] : "";
    $nombreArchivo02 = $inputTextos . "/LOREMIPSUM02.TXT";
    $archivo02 = fopen($nombreArchivo02, "w");
    fwrite($archivo02, $contenidoArchivo02);
    fclose($archivo02);

    // Guardamos las rutas relativas para los botones Ver
    $urlArchivo01 = $nombreArchivo01;
    $urlArchivo02 = $nombreArchivo02;
    
    $recorrerArbol = true;

    $Utilidades = new Utilidades();
    $TABLA_LOG = "'generartextos'";
    $TIPO_CONSULTA_LOG = "'INSERT'";
    include 'inc_bitacora.php';
}

$TituloSeccion = "Procesar Textos";
?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 80vh;">
            <div class="col-sm-8">
                <div class="card border-dark shadow-sm">
                    <div class="card-body text-center">
                        <?php require_once('menu.php'); ?>
                        
                        <h2 class="mt-3"><?php echo $TituloSeccion; ?></h2>
                        <p class="text-muted">
                            Ruta: C:\wamp64\www\...\<b><?php echo ($inputCarnet ?: 'SU_CARNET'); ?></b>\DOCUMENTOS\TEXTOS
                        </p>

                        <?php if ($recorrerArbol): ?>
                            <div class="alert alert-success alert-dismissible fade show mx-auto col-sm-10" role="alert">
                                <h4 class="alert-heading">¡Archivos Creados con Éxito!</h4>
                                <p>Se han generado los documentos para el carnet: <strong><?php echo htmlspecialchars($inputCarnet); ?></strong>.</p>
                                <hr>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo $urlArchivo01; ?>" target="_blank" class="btn btn-outline-success btn-sm">
                                         Ver Texto 01
                                    </a>
                                    <a href="<?php echo $urlArchivo02; ?>" target="_blank" class="btn btn-outline-success btn-sm">
                                         Ver Texto 02
                                    </a>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <center>
                            <p class="lead small mt-3">
                                <b>LOREMIPSUM01.TXT</b>: Contenido antes de los puntos. <br>
                                <b>LOREMIPSUM02.TXT</b>: Segundo párrafo después de los "...".
                            </p>
                            
                            <form class="form-horizontal col-sm-10" name="formUsuarios" id="formUsuarios" method="POST" action="GeneradorTextos.php" autocomplete="off">
                                <div class="mb-3 text-start">
                                    <label for="inputCarnet" class="form-label font-weight-bold fw-bold">Carnet:</label>
                                    <input type="text" class="form-control border-success" id="inputCarnet" value="<?php echo htmlspecialchars($inputCarnet); ?>" name="inputCarnet" required autofocus minlength="4" maxlength="12">
                                    <input type="hidden" name="okForm" value="Continuar">
                                </div>

                                <div class="mb-3 text-start">
                                    <label for="Textarea01" class="form-label fw-bold">Contenido Lorem Ipsum:</label>
                                    <textarea class="form-control" id="Textarea01" name="Textarea01" rows="8" required>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum imperdiet nibh, ut auctor dolor molestie sed. Duis quis interdum nisi, a posuere odio. Pellentesque id ultricies diam. Fusce venenatis iaculis ex, sit amet aliquam nunc cursus vitae. Vestibulum eu accumsan arcu, sit amet sodales ex. Vestibulum aliquam, neque feugiat finibus posuere, neque est vehicula sem, ac eleifend orci elit non dui. Quisque aliquet congue risus, eu tempus nulla venenatis sit amet. Ut ultricies, diam a placerat scelerisque, velit mauris volutpat orci, ac laoreet libero risus sit amet diam. Ut vitae semper erat. Curabitur lobortis felis euismod fringilla sagittis. Vivamus velit orci, mattis eu nisl posuere, euismod rhoncus felis...Curabitur sed fringilla arcu. Etiam interdum ut lectus id consequat. Sed ullamcorper tincidunt felis nec convallis. Donec vitae dui ac purus gravida volutpat. Nunc eu suscipit leo, a facilisis sapien. Mauris condimentum neque nunc, porttitor ultrices sapien pulvinar quis. Pellentesque vel orci scelerisque velit sodales fermentum. Nunc ullamcorper diam id massa rhoncus ornare...</textarea>
                                </div>

                                <div class="py-3">
                                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">Generar Archivos</button>
                                </div>
                            </form>

                            <div class="text-start mt-4">
                                <?php
                                if ($recorrerArbol) {
                                    $nombreDirectorio = __DIR__  . "/" . $inputCarnet;
                                    if(class_exists('Directorio')) {
                                        $directorio = new Directorio($nombreDirectorio);
                                    }
                                }
                                ?>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>