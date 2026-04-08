<?php
require_once('Connections/conn.php');

$inputCarnet = "";
$recorrerArbol = false;

// FUNCIÓN DE LISTADO RECURSIVA
function listarEstructuraReal($dir) {
    if (!is_dir($dir)) return;
    
    $items = scandir($dir);
    echo "<ul style='list-style: none; text-align: left; padding-left: 25px;'>";
    foreach($items as $item) {
        if($item == "." || $item == "..") continue;
        
        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        
        if(is_dir($fullPath)) {
            echo "<li class='mb-1'><i class='fas fa-folder' style='color: #ffca28; margin-right: 8px;'></i><b>$item</b>";
            listarEstructuraReal($fullPath); 
            echo "</li>";
        } else {
            echo "<li class='mb-1'><i class='fas fa-file-alt' style='color: #42a5f5; margin-right: 8px;'></i>$item</li>";
        }
    }
    echo "</ul>";
}

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {
    
    $recorrerArbol = true;
    $inputCarnet = trim($_POST['inputCarnet']);

    // --- CORRECCIÓN DE BITÁCORA ---
    // Definimos las variables PRIMERO
    $TABLA_LOG = "'arbol'"; 
    $TIPO_CONSULTA_LOG = "'SELECT'"; 
    
    // Ahora cargamos las clases e incluimos la bitácora
    spl_autoload_register(function($class) {
        $file = "class/" . $class . ".class.php";
        if (file_exists($file)) require_once $file;
    });

    $Utilidades = new Utilidades();
    
    // El archivo inc_bitacora.php ahora sí encontrará las variables definidas arriba
    include 'inc_bitacora.php'; 
}

$TituloSeccion = "Recorrer Árbol";
?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body>
        <div class="container-fluid d-flex align-items-center justify-content-center mt-5">
            <div class="col-sm-8 col-md-7">
                <div class="card border-dark shadow-sm">                    
                    <div class="card-body text-center">
                        <?php require_once('menu.php'); ?>
                        
                       
                        <p class="lead">Estructura de archivos del aplicativo</p>

                        <form method="POST" action="arbol.php" class="col-sm-8 mx-auto">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Ingrese su Carnet:</label>
                                <input type="text" class="form-control text-center shadow-sm" name="inputCarnet" value="<?php echo htmlspecialchars($inputCarnet); ?>" required autofocus>
                                <input type="hidden" name="okForm" value="Continuar">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                                <i class="fas fa-search"></i> Recorrer Estructura
                            </button>
                        </form>

                        <hr class="my-4">

                        <div class="text-start p-4 bg-white rounded border border-primary shadow-sm" style="min-height: 150px;">
                            <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">
                                <i class="fas fa-sitemap"></i> Directorios y Archivos:
                            </h6>
                            
                            <div class="tree-display">
                                <?php
                                if ($recorrerArbol && !empty($inputCarnet)) {
                                    $pathBase = __DIR__ . DIRECTORY_SEPARATOR . $inputCarnet;

                                    if(file_exists($pathBase) && is_dir($pathBase)){
                                        listarEstructuraReal($pathBase);
                                    } else {
                                        echo "<div class='alert alert-warning text-center'>
                                                <i class='fas fa-exclamation-triangle'></i> No se encontró la carpeta <b>$inputCarnet</b>.<br>
                                                <small class='text-muted'>Verifique que la carpeta exista en: $pathBase</small>
                                              </div>";
                                    }
                                } else {
                                    echo "<p class='text-muted small text-center'>Ingrese carnet para explorar.</p>";
                                }
                                ?>
                            </div>
                        </div>  
                    </div>
                </div>  
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>