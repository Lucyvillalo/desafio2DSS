<?php
if (!empty($_GET)) {

    $id_notas = $_GET['id_notas'];

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
$TituloSeccion = "Eliminar Notas";
?>

<head>
    <?php require_once('../head.php'); ?>
</head>

<body>
    <div class="container" style="max-width: 900px; padding: 0; margin: 0 auto;">
        <?php include "navbar.php"; ?>
        <div class="border border-dark bg-white shadow-sm" style="border-top: none; min-height: 500px;">
            <div class="p-4">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-warning border-0 shadow-sm mb-4 d-flex align-items-center">
                            <div>
                                <h5 class="mb-0 fw-bold">¿Estás seguro de eliminar este registro?</h5>
                                <small>Esta acción no se puede deshacer.</small>
                            </div>
                        </div>

                        <form action="eliminar.php?id_notas=<?php echo $result->id_notas; ?>" method="POST">
                            <input type="hidden" name="id_notas" value="<?php echo $result->id_notas; ?>" />

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold text-muted mb-2">Materia</label>
                                        <input readonly type="text" value="<?php echo $result->materia; ?>" class="form-control bg-light" name="materia" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold text-muted mb-2">Desglose de Calificaciones</label>
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <label class="small text-uppercase">Nota 1</label>
                                            <input readonly type="text" value="<?php echo $result->nota1; ?>" class="form-control text-center bg-light" />
                                        </div>
                                        <div class="col-4">
                                            <label class="small text-uppercase">Nota 2</label>
                                            <input readonly type="text" value="<?php echo $result->nota2; ?>" class="form-control text-center bg-light" />
                                        </div>
                                        <div class="col-4">
                                            <label class="small text-uppercase">Nota 3</label>
                                            <input readonly type="text" value="<?php echo $result->nota3; ?>" class="form-control text-center bg-light" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5">

                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-danger btn-lg px-5 shadow">
                                    Confirmar Eliminación
                                </button>
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
                        <h2 class="fw-bold">¡Eliminación Exitosa!</h2>
                        <p class="text-muted">La nota ha sido eliminada correctamente del sistema.</p>
                        <div class="mt-4">
                            <a href="ver.php" class="btn btn-success btn-lg w-100 shadow-sm">Ir al Listado de Notas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if (!empty($_POST)) {

    $id_notas = $_POST['id_notas'];

    $url_base = dirname((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]");
    $url = $url_base . "/api/eliminar/" . $id_notas;

    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);

    if ($response == "Exito") {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('modalConfirmacion'));
                myModal.show();
            });
        </script>";
    } else {
        echo "Error, No se pudo eliminar el registro";
    }
}
?>