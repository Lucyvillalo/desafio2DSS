<?php
//consumiendo nuestro webservice para obtener el conjunto de datos
if (!empty($_GET)) {


    $url_base = dirname((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]");
    $url = $url_base . "/api/obtener/" . $id_notas;


    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);

    $result = json_decode($response);
}
?>
<!DOCTYPE html>
<html lang="es">
<?php
$TituloSeccion = "Editar Notas";
?>

<head>
    <?php require_once('../head.php'); ?>
</head>

<body>
    <div class="container" style="max-width: 900px; padding: 0; margin: 0 auto;">
        <?php include "navbar.php"; ?>
        <div class="border border-dark bg-white shadow-sm" style="border-top: none; min-height: 500px;">
            <div class="p-4">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="mb-4">Editar Registro</h3>

                        <form action="editar.php?id_notas=<?php echo $result->id_notas; ?>" method="POST">
                            <input type="hidden" name="id_notas" value="<?php echo $result->id_notas; ?>" />

                            <div class="row">
                                <div class="col-md-6 border-end">
                                    <div class="form-group mb-3">
                                        <label for="carnet" class="fw-bold">Carnet</label>
                                        <input type="text" value="<?php echo $result->carnet; ?>" class="form-control" name="carnet" id="carnet" />
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="materia" class="fw-bold">Materia</label>
                                        <input type="text" value="<?php echo $result->materia; ?>" class="form-control" name="materia" id="materia" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="nota1">Nota 1</label>
                                                <input type="text" value="<?php echo $result->nota1; ?>" class="form-control" name="nota1" id="nota1" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="nota2">Nota 2</label>
                                                <input type="text" value="<?php echo $result->nota2; ?>" class="form-control" name="nota2" id="nota2" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="nota3">Nota 3</label>
                                                <input type="text" value="<?php echo $result->nota3; ?>" class="form-control" name="nota3" id="nota3" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success px-5">
                                        <i class="fas fa-save me-2"></i> Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
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
                <h2 class="fw-bold">¡Edición Exitosa!</h2>
                <p class="text-muted">La nota ha sido editada correctamente en el sistema.</p>
                
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
    $url = $url_base . "/api/editar";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $id_notas = $_POST['id_notas'];
    $carnet = $_POST['carnet'];
    $materia = $_POST['materia'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];

    $data = <<<DATA
    {
      "id_notas": "$id_notas",
      "carnet": "$carnet",
      "materia": "$materia",
      "nota1": "$nota1",
      "nota2": "$nota2",
      "nota3": "$nota3"
    }
    DATA;

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
        echo "Error, No se pudo editar el registro";
    }
} ?>