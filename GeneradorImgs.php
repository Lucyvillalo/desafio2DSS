<?php
require_once('Connections/conn.php');

$inputCarnet = "";
$recorrerArbol = false;
$archivosSubidos = []; // Array para guardar qué se subió con éxito

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {

    spl_autoload_register(function($class) {
        require_once "class/" . $class . ".class.php";
    });

    $inputCarnet = $_POST['inputCarnet'];
    $inputImgs = $inputCarnet . "/DOCUMENTOS/IMAGENES/";

    // Crear directorio si no existe
    if (!file_exists($inputImgs)) {
        mkdir($inputImgs, 0777, true);
    }

    // Procesar los dos archivos
    $filesToUpload = ['adjunto01' => 'img01.jpg', 'adjunto02' => 'img02.jpg'];

    foreach ($filesToUpload as $key => $newName) {
        if (!empty($_FILES[$key]['name'])) {
            $target_path = $inputImgs . $newName;
            if (move_uploaded_file($_FILES[$key]['tmp_name'], $target_path)) {
                $archivosSubidos[$newName] = $target_path;
            }
        }
    }

    $recorrerArbol = true;
    $Utilidades = new Utilidades();
    $TABLA_LOG = "'generaroimgs'";
    $TIPO_CONSULTA_LOG = "'INSERT'";
    include 'inc_bitacora.php';
}

$TituloSeccion = "Procesar Imágenes";
?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="container-fluid d-flex align-items-center justify-content-center mt-4">
            <div class="col-sm-8 col-md-7">
                <div class="card border-dark shadow-sm">
                    <div class="card-body text-center">
                        <?php require_once('menu.php'); ?>
                        
                       
                        <p class="text-muted small">
                            Ruta: C:\wamp64\www\...\<b><?php echo ($inputCarnet ?: 'SU_CARNET'); ?></b>\DOCUMENTOS\IMAGENES
                        </p>

                        <?php if (!empty($archivosSubidos)): ?>
                            <div class="alert alert-success alert-dismissible fade show mx-auto col-sm-11" role="alert">
                                <h5 class="alert-heading">✅ ¡Proceso Completado!</h5>
                                <p class="small">Se han guardado las imágenes correctamente.</p>
                                <hr>
                                <div class="d-flex justify-content-center gap-2">
                                    <?php foreach ($archivosSubidos as $nombre => $ruta): ?>
                                        <a href="<?php echo $ruta; ?>" target="_blank" class="btn btn-success btn-sm">
                                             Ver <?php echo $nombre; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <form class="form-horizontal col-sm-10 mx-auto" method="POST" action="GeneradorImgs.php" enctype="multipart/form-data">
                            <div class="mb-3 text-start">
                                <label class="form-label fw-bold">Carnet:</label>
                                <input type="text" class="form-control" name="inputCarnet" value="<?php echo $inputCarnet; ?>" required>
                                <input type="hidden" name="okForm" value="Continuar">
                            </div>

                            <div class="row text-start">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Imagen 01 :</label>
                                    <input type="file" class="form-control" name="adjunto01" accept="image/jpeg" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold small">Imagen 02 :</label>
                                    <input type="file" class="form-control" name="adjunto02" accept="image/jpeg" required>
                                </div>
                            </div>

                            <div class="py-3">
                                <button type="submit" class="btn btn-primary px-5 shadow-sm">Subir Ambas Imágenes</button>
                            </div>
                        </form>

                        <div class="text-start mt-4 border-top pt-3">
                            <?php
                            if ($recorrerArbol) {
                                $nombreDirectorio = __DIR__ . "/" . $inputCarnet;
                                if(class_exists('Directorio')) {
                                    $directorio = new Directorio($nombreDirectorio);
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>