<?php
//consumiendo nuestro webservice para obtener el conjunto de datos

$url_base = dirname((isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]");
$url = $url_base . "/api/listar";


$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);

$result = json_decode($response);


?>
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
            <div class="p-3">
                <?php
                if ($result) { ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">CARNET</th>
                                <th class="text-center">MATERIA</th>
                                <th class="text-center">NOTA 1</th>
                                <th class="text-center">NOTA 2</th>
                                <th class="text-center">NOTA 3</th>
                                <th class="text-center">OPERACIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tabla = "";
                            if ($result) {
                                foreach ($result as $row) {
                                    $tabla .= sprintf(
                                        '<tr>
        <td class="text-center">%s</td>
        <td class="text-center">%s</td>
        <td class="text-center">%s</td>
        <td class="text-center">%s</td>
        <td class="text-center">%s</td>
        <td class="text-center">%s</td>
        <td class="text-center">
            <a href="editar.php?id_notas=%s" class="btn btn-success" title="Modificar">
    <i class="fas fa-edit"></i>
</a>

<a href="eliminar.php?id_notas=%s" class="btn btn-danger" title="Eliminar">
    <i class="fas fa-trash-alt"></i>
</a>
        </td>
    </tr>',
                                        $row[0],
                                        $row[1],
                                        $row[2],
                                        $row[3],
                                        $row[4],
                                        $row[5],
                                        $row[0],
                                        $row[0]
                                    );
                                }
                                echo $tabla;
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else { ?>
                    <div class="text-center p-5 border rounded bg-light mt-4">
                        <i class="mdi mdi-database-off-outline d-block mb-3 text-muted" style="font-size: 64px;"></i>
                        <h4 class="text-secondary">No se encontraron registros</h4>
                        <p class="text-muted">Parece que aún no has agregado ninguna nota al sistema.</p>
                        <a href="registrar.php" class="btn btn-success mt-2">
                            <i class="mdi mdi-plus me-1"></i> Agregar mi primer nota
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php require_once('../scripts.php'); ?>
</body>

</html>