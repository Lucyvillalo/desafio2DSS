<!DOCTYPE html>
<html lang="es">
<?php
$TituloSeccion = "Registrar Notas";
?>

<head>
    <?php require_once('../head.php'); ?>
</head>

<body>
    <div class="container" style="max-width: 900px; padding: 0; margin: 0 auto;">
        <?php include "navbar.php"; ?>
        <div class="border border-dark bg-white shadow-sm" style="border-top: none; min-height: 500px;">
            <div class="container p-4">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="registrar.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="carnet" class="form-label font-weight-bold">Carnet</label>
                                        <input type="text" class="form-control" placeholder="Ej: mf220973" name="carnet" id="carnet" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="materia" class="form-label font-weight-bold">Materia</label>
                                        <input type="text" class="form-control" placeholder="Nombre de la materia" name="materia" id="materia" />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nota1">Nota 1</label>
                                        <input type="number" step="0.1" class="form-control" placeholder="0.0" name="nota1" id="nota1" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nota2">Nota 2</label>
                                        <input type="number" step="0.1" class="form-control" placeholder="0.0" name="nota2" id="nota2" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nota3">Nota 3</label>
                                        <input type="number" step="0.1" class="form-control" placeholder="0.0" name="nota3" id="nota3" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success px-4">Registrar Notas</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('../scripts.php'); ?>
    <div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0">
            <div class="p-4 text-center">
                <div class="mb-3">
                    <i class="mdi mdi-check-circle-outline text-success" style="font-size: 80px;"></i>
                </div>
                <h2 class="fw-bold">¡Registro Exitoso!</h2>
                <p class="text-muted">La nota ha sido guardada correctamente en el sistema.</p>
                
                <div class="mt-4">
                    <a href="ver.php" class="btn btn-success btn-lg w-100 shadow-sm">
                        <i class="mdi mdi-arrow-right me-2"></i>Ir al Listado de Notas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
<?php

if (!empty($_POST)) {
    //consumiendo nuestro webservice para enviar el conjunto de datos

    $url_base = dirname((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]");
    $url = $url_base . "/api/insertar";


    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $carnet = $_POST['carnet'];
    $materia = $_POST['materia'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];


    $data = sprintf(
        '{"carnet": "%s",
        "materia": "%s",
        "nota1": "%s",
        "nota2": "%s",
        "nota3": "%s"
    }',
        $carnet,
        
    );

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    $resp = curl_exec($curl);
    curl_close($curl);
    if ($resp == "Exito") {
?>
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('modalConfirmacion'));
                myModal.show();
            });
        </script>";
<?php
    } else {
        echo "Error, No se pudo agregar el registro";
    }
}
?>