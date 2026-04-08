<?php
require_once('Connections/conn.php');

spl_autoload_register(function($class) {
    $file = "class/" . $class . ".class.php";
    if (file_exists($file)) {
        require_once $file;
    }
});

$Utilidades = new Utilidades();

$TituloSeccion = "Cookies del Sistema";
?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="container-fluid d-flex align-items-center justify-content-center mt-5">
            <div class="col-sm-8 col-md-7">
                <div class="card border-dark shadow-sm">
                    <div class="card-body text-center">
                        <?php require_once('menu.php'); ?>
                        
                        
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-secondary">
                                    <tr>
                                        <th colspan="2" class="text-start px-3">Cookies del Sistema</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Verificamos si existen cookies
                                    if (count($_COOKIE) > 0) {
                                        foreach ($_COOKIE as $nombre => $valor) {
                                            echo "<tr>";
                                            echo "<td class='text-start fw-bold bg-light' style='width: 30%;'>" . htmlspecialchars($nombre) . "</td>";
                                            echo "<td class='text-start text-break'>" . htmlspecialchars($valor) . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='2' class='text-muted'>No se detectaron cookies activas.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        
                       
                    </div>
                </div>  
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
    </body>
</html>