<?php
require_once('Connections/conn.php');
if (isset($_SESSION['activo']) && $_SESSION['activo'] == 'SI') {
    $continuar = true;
} else {
    $continuar = false;
    header('Location: cerrar_sesion.php');
}
require_once('utiles.php');
$continuarXRol = false;

if (rol(rolXusuario($_SESSION['usuario']), 'A')) {
    $continuarXRol = true;
} else {
    $continuarXRol = false;
}

$ScriptProcesado = false;

if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {

    require_once('utiles.php');

    $inputUsuario = strval($_POST['inputUsuario']);

    $ScriptProcesado = true;

    $inputUsuarioFila = strval($_POST['inputUsuario']);

    $accion_al_usuario = 0; //No hacer nada en la base de datos


    if (isset($_POST["inlineRadioOptions"]) && $_POST["inlineRadioOptions"] == 'B') {
        $accion_al_usuario = 1;
    }

    if (isset($_POST["inlineRadioOptions"]) && $_POST["inlineRadioOptions"] == 'SI') {
        $accion_al_usuario = 2;
        $estadoactivo = 'SI';
    }

    if (isset($_POST["inlineRadioOptions"]) && $_POST["inlineRadioOptions"] == 'NO') {
        $accion_al_usuario = 3;
        $estadoactivo = 'NO';
    }

    if ($accion_al_usuario == 1) {

        $ScriptProcesado = false;
        
        $inputUsuarioDB = FormatearValor($_POST['inputUsuario'], "mayusculas");

        $query_RsDelete = "DELETE FROM $db_database.[dbo].[mvfusuarios] WHERE upper(usuario) = " . $inputUsuarioDB;

        $RsUpdate = odbc_exec($db_connection, $query_RsDelete);
    }

    if ($accion_al_usuario > 1) {

        $inputUsuarioDB = FormatearValor($_POST['inputUsuario'], "mayusculas");

        $query_RsUpdate = "UPDATE $db_database.[dbo].[mvfusuarios] SET activo = '" . $estadoactivo . "' WHERE upper(usuario) = " . $inputUsuarioDB;

        $RsUpdate = odbc_exec($db_connection, $query_RsUpdate);
    }
}


$query_RsUsuarios = "SELECT * FROM $db_database.[dbo].[mvfusuarios]";
$RsUsuarios = odbc_exec($db_connection, $query_RsUsuarios) or trigger_error(mysql_error(), E_USER_ERROR);
$row_RsUsuarios = odbc_fetch_array($RsUsuarios);

$TituloSeccion =  "Borrar Usuarios";


?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center" >
            <div class="col-sm-7">
                <div class="text-center border border-primary rounded">                    
                    <?php require_once('menu.php'); ?>
                    <center>
                        <?php if ($continuarXRol) { ?>
                            <p class="lead">
                                Borre los Usuarios del Sistema que ya no lo Utilizan,<br>o Simplemente, Inactivelos.
                                <br>
                                <br>
                            </p>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">USUARIO</th>
                                        <th scope="col">ACCIONES</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php do { ?>
                                    <form class="form-horizontal form-outline w-75" name="formUsuarios-<?php echo $row_RsUsuarios['usuario']; ?>"  method="POST" role="form" action="usuariosborrar.php" onSubmit="return confirm('Quiere Continuar?')"/>
                                        <tr>
                                            <th scope="row"><div id="filaUsuario<?php echo $row_RsUsuarios['usuario']; ?>"><?php echo $row_RsUsuarios['usuario']; ?></div></th>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" id="borrarCheckbox-<?php echo $row_RsUsuarios['usuario']; ?>" name="inlineRadioOptions" value="B">
                                                    <label class="form-check-label" for="borrarCheckbox-<?php echo $row_RsUsuarios['usuario']; ?>">BORRAR USUARIO</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input 
                                                    <?php
                                                    if (estadousuario(estadoXusuario($row_RsUsuarios['usuario']), 'SI')) {
                                                        echo " checked ";
                                                    }
                                                    ?>                                                    
                                                        class="form-check-input" type="radio" id="activoCheckbox-<?php echo $row_RsUsuarios['usuario']; ?>" name="inlineRadioOptions" value="SI">
                                                    <label class="form-check-label" for="activoCheckbox-<?php echo $row_RsUsuarios['usuario']; ?>">ACTIVO</label>
                                                </div>                                            
                                                <div class="form-check form-check-inline">
                                                    <input <?php
                                            if (estadousuario(estadoXusuario($row_RsUsuarios['usuario']), 'NO')) {
                                                echo " checked ";
                                            }
                                                    ?>
                                                        class="form-check-input" type="radio" id="-<?php echo $row_RsUsuarios['usuario']; ?>inactivoCheckbox" name="inlineRadioOptions" value="NO">
                                                    <label class="form-check-label" for="inactivoCheckbox-<?php echo $row_RsUsuarios['usuario']; ?>">INACTIVO</label>
                                                </div>
                                            </td>
                                            <td><input type="hidden" name="inputUsuario" value="<?php echo $row_RsUsuarios['usuario']; ?>"><input type="hidden" name="okForm" value="Continuar"><button type="submit" class="btn btn-primary">Aplicar</button><br><br></td>
                                        </tr>
                                    </form>
                                <?php } while ($row_RsUsuarios = odbc_fetch_array($RsUsuarios)); ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p class="lead">
                                Borre los Usuarios del Sistema que ya no lo Utilizan,<br>o Simplemente, Inactivelos.
                                <br><br>
                                El usuario que tiene asignado,<br>no tiene permisos para utilizar esta funci&oacute;n
                                <br>
                                <br>
                            </p>
                        <?php } ?>
                    </center>
                </div>  
                <?php require_once('inc.reloj.php'); ?>
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
        <?php if ($ScriptProcesado) { ?>
            <script>
                document.getElementById('filaUsuario<?php echo $inputUsuario; ?>').scrollIntoView();
            </script>
        <?php } ?>
    </body>
</html>