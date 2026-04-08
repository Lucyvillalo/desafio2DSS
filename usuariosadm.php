<?php
require_once('Connections/conn.php');

$ExisteUsuario = false;

$ScriptProcesado = false;



$contra_aleatoria = "";

$inputUsuario = "";

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {

    spl_autoload_register(function ($class) {
        require_once "class/" . $class . ".class.php";
    });


    $Utilidades = new Utilidades();

    $inputUsuario = $Utilidades->limpiar_campos($_POST['inputUsuario']);

    require_once('Connections/conn.php');

    $query_RsLogin = "SELECT * FROM usuarios WHERE usuario = " . $inputUsuario;

    $RsLogin = $db->query($query_RsLogin);

    $totalRows_RsLogin = $RsLogin->num_rows;


    if ($totalRows_RsLogin > 0) {
        $ExisteUsuario = true;
    } else {

        $ExisteUsuario = false;

        $inputUsuarioDB = $Utilidades->limpiar_campos($_POST['inputUsuario']);

        $inputNombres = $Utilidades->limpiar_campos($_POST['inputNombres']);

        $inputApellidos = $Utilidades->limpiar_campos($_POST['inputApellidos']);

        $inputEmail = $Utilidades->limpiar_campos($_POST['inputEmail']);

        $contrasena = $Utilidades->limpiar_campos($_POST['inputContrasena']);

        $query_RsINSERT = "INSERT INTO usuarios 
           (usuario
           ,contrasena
           ,nombres
           ,apellidos, email) VALUES
           ($inputUsuarioDB, $contrasena, $inputNombres,$inputApellidos,$inputEmail)";

        $RsUpdate = $db->query($query_RsINSERT);

        $ScriptProcesado = true;

        // Inicio Insertar en LOG
        //$row_id = mysql_insert_id();
        $TABLA_LOG = "'usuarios'";
        $TIPO_CONSULTA_LOG = "'INSERT'";
        include 'inc_bitacora.php';
    }
}

$TituloSeccion = "Crear Usuario";
?>
<!doctype html>
<html lang="es">

<head>
    <?php require_once('head.php'); ?>
</head>

<body>
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-sm-7">
            <div class="text-center border border-dark rounded">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="index.php">Iniciar Sesión</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
                <h1>Bienvenido!</h1>
                <hr width="80%" class="bg-dark border-2 border-top border-dark" />
                <center>
                    <p class="lead">
                        <?php if ($ExisteUsuario) { ?>
                    <div class="alert alert-warning" role="alert">
                        El Usuario <?php echo trim($inputUsuario, "'"); ?> ya existe en el Sistema!
                    </div>
                <?php } else if ($ScriptProcesado) { ?>
                    <div class="alert alert-success" role="alert">
                        Ya puede Inciar Sesión con la Contrase&ntilde;a creada!
                    </div>
                <?php } ?>
                <br>
                </p>
                <form class="form-horizontal form-outline w-75" name="formUsuarios" id="formUsuarios" method="POST" role="form" action="usuariosadm.php" autocomplete="off">
                    <div class="row">
                        <div class="col">
                            <label for="inputUsuario">Usuario:</label>
                            <input type="text" class="form-control" id="inputUsuario" value="" name="inputUsuario" aria-describedby="usuarioHelp" required autofocus minlength="4" maxlength="12">
                            <input type="hidden" name="okForm" value="Continuar">
                        </div>
                        <div class="col">
                            <label for="inputContrasena">Contrase&ntilde;a:</label>
                            <input type="password" class="form-control" id="inputContrasena" value="" name="inputContrasena" aria-describedby="usuarioHelp" required autofocus minlength="4" maxlength="12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputNombres">Nombres:</label>
                            <input type="text" class="form-control" id="inputNombres" value="" name="inputNombres" aria-describedby="usuarioHelp" required autofocus minlength="3" maxlength="24">
                        </div>
                        <div class="col">
                            <label for="inputApellidos">Apellidos:</label>
                            <input type="text" class="form-control" id="inputApellidos" value="" name="inputApellidos" aria-describedby="usuarioHelp" required autofocus minlength="3" maxlength="24">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="inputNombres">Correo Elect&oacute;nico:</label>
                            <input type="text" class="form-control" id="inputEmail" value="" name="inputEmail" aria-describedby="usuarioHelp" required autofocus minlength="3" maxlength="24">
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crear Usuario</button>
                    </div>
                </form>
                <?php if ($ScriptProcesado) { ?>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">USUARIO</th>
                                <th scope="col">CONTRASE&Ntilde;A</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo trim($inputUsuario, "'"); ?></th>
                                <td><?php echo trim($contrasena, "'"); ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
                </center>
            </div>
        </div>
    </div>
    <?php require_once('scripts.php'); ?>
    <?php if ($ScriptProcesado) { ?>
        <script>
            window.scrollTo(0, document.body.scrollHeight);
        </script>
    <?php } ?>
</body>

</html>