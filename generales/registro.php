<html>
<?php
if (!empty($_POST)) {

    require_once './php/conexion.php';

    $imagen = addslashes(file_get_contents($_FILES['adjunto']['tmp_name']));


    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $carnet = $_POST["carnet"];
    $cum = $_POST["cum"];

    $sql = "";

    $query = $con->query($sql);

    header("Location: ver.php");
}

$TituloSeccion = "Registro del Alumno";
?>

<head>
    <?php require_once('../head.php'); ?>
</head>

<body>
    <div class="container" style="max-width: 900px; padding: 0; margin: 0 auto;">
        <?php include "navbar.php"; ?>
        <div class="border border-dark bg-white shadow-sm" style="border-top: none; min-height: 500px;">
            <div class="p-3">
                <div class="p-3">
                    <form role="form" name="registro" action="registro.php" method="post" enctype="multipart/form-data" class="mx-auto" style="max-width: 80%;">

                        <div class="form-group text-left mb-2">
                            <label for="username" class="font-weight-bold small">Nombre del Alumno</label>
                            <input type="text" class="form-control form-control-sm" id="username" name="nombre" placeholder="Nombre">
                        </div>

                        <div class="form-group text-left mb-2">
                            <label for="email" class="font-weight-bold small">Correo Electrónico</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Correo">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group text-left mb-2">
                                    <label for="fullname" class="font-weight-bold small">Carnet</label>
                                    <input type="text" class="form-control form-control-sm" id="fullname" name="carnet" placeholder="Carnet">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-left mb-2">
                                    <label for="cum" class="font-weight-bold small">CUM</label>
                                    <input type="number" class="form-control form-control-sm" id="cum" name="cum" step="0.01">
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-left mb-3">
                            <label for="adjunto" class="font-weight-bold small">Fotografía:</label>
                            <input type="file" name="adjunto" id="adjunto" class="form-control-file small" style="font-size: 0.75rem;">
                        </div>

                        <div class="text-center border-top pt-3">
                            <button type="submit" class="btn btn-success btn-sm px-5">Guardar Registro</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('../scripts.php'); ?>
    <br>
</body>

</html>