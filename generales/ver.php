<?php
include "./php/conexion.php";
$sql1 = "SELECT * FROM generales";
$query = $con->query($sql1);

$TituloSeccion = "Generales del Alumno";
?>
<html>

<head>
    <?php require_once('../head.php'); ?>
</head>

<body>
    <div class="container" style="max-width: 900px; padding: 0; margin: 0 auto;">
        <?php include "navbar.php"; ?>
        <div class="border border-dark bg-white shadow-sm" style="border-top: none; min-height: 500px;">
            <div class="p-3">
                <?php
                if ($query->num_rows > 0) {
                    while ($r = $query->fetch_array()) { ?>
                        <div class="container">
                            <div class="row border rounded p-3 shadow-sm bg-light align-items-center mx-0">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="fw-bold mb-0">Nombre del Alumno:</label>
                                            <p class="text-muted mb-2"><?php echo $r["nombre"]; ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="fw-bold mb-0">Correo Electrónico:</label>
                                            <p class="text-muted mb-2"><?php echo $r["correo"]; ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="fw-bold mb-0">Carnet:</label>
                                            <p class="text-muted mb-2"><?php echo $r["carnet"]; ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="fw-bold mb-0">CUM Acumulado:</label>
                                            <p class="text-muted mb-2"><?php echo $r["cum"]; ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="fw-bold mb-0">Fecha de Creación:</label>
                                            <p class="text-muted mb-0"><small>
                                                    <?php
                                                    $fecha_original = $r["fechacreacion"];
                                                    $date = new DateTime($fecha_original);
                                                    // Formato común: 26/02/2026 08:57 AM
                                                    echo $date->format('d/m/Y h:i A');
                                                    ?></small></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <img src='php/vistimg.php?id=<?php echo $r["id"]; ?>'
                                            alt='Foto Alumno'
                                            class="img-thumbnail shadow-sm"
                                            style="max-width: 130px; height: auto; border: 2px solid #343a40;">
                                        <p class="mt-2 mb-0"><small class="text-muted">Fotografía Oficial</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <div class="text-center p-5 border rounded bg-light mt-4">
                        <i class="mdi mdi-database-off-outline d-block mb-3 text-muted" style="font-size: 64px;"></i>
                        <h4 class="text-secondary">No se encontraron registros</h4>
                        <p class="text-muted">Parece que aún no has agregado ningun alumno al sistema.</p>
                        <a href="registro.php" class="btn btn-success mt-2">
                            <i class="mdi mdi-plus me-1"></i> Agregar mi primer alumno
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php require_once('../scripts.php'); ?>
    <br>
</body>

</html>