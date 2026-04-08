<?php
session_start();
session_destroy();
$session_array = array_keys($_SESSION);
foreach ($session_array as $session_key) {
    unset($_SESSION[$session_key]);
}
$err = 'NO';


if (isset($_POST['okForm']) && $_POST['okForm'] == 'Continuar') {


    spl_autoload_register(function($class) {
        require_once "class/" . $class . ".class.php";
    });

    
    $Utilidades = new Utilidades();

    $inputUsuario = $Utilidades->limpiar_campos($_POST['inputUsuario']);

    $inputPassword = $Utilidades->limpiar_campos($_POST['inputPassword']);
    
    require_once('Connections/conn.php');

    $query_RsLogin = "SELECT * FROM usuarios WHERE upper(usuario) = " . $inputUsuario . " AND contrasena = " . $inputPassword;
    
    $RsLogin = $db->query($query_RsLogin);

    $totalRows_RsLogin = $RsLogin->num_rows;

    $row_RsLogin = $RsLogin->fetch_assoc();
    
    if ($totalRows_RsLogin == 1) {
        $err = 'NO';
        $_SESSION['usuario'] = $row_RsLogin["usuario"];
        $_SESSION['email'] = $row_RsLogin["email"];
        $_SESSION['nombres'] = $row_RsLogin["nombres"];
        $_SESSION['apellidos'] = $row_RsLogin["apellidos"];
        
        header('Location: frameppal.php');
    } else {
        $err = 'SI';
    }
}

$TituloSeccion = "Inicio de Sesi&oacute;n";
?>
<!doctype html>
<html lang="es">
    <head>
        <?php require_once('head.php'); ?>
    </head>
    <body>
        <div class="d-flex align-items-center justify-content-center" >
            <div class="shadow-lg p-3 col-sm-5 bg-white rounded">
                <div class="text-center border border-success rounded bg-light">
                    <?php if ($err == 'SI') { ?>
                        <div class="alert alert-danger" role="alert">
                            Usuario Inactivo &oacute Contrase&ntilde;a equivocada!
                        </div>
                    <?php } ?>
                    <br>
                    <img src="imgs/login.png?t=<?php echo time(); ?>" alt="ICONO">
                    <hr width="80%" class="bg-success border-2 border-top border-success" />
                    <h1>Inicio de Sesi&oacute;n</h1>
                    <center>
                        <form class="form-horizontal form-outline w-75" name="formLogin"  method="POST" role="form" action="index.php" autocomplete="off">
                            <div class="form-group">
                                <label for="inputUsuario">Usuario:</label>
                                <input type="text" class="form-control" id="inputUsuario" name="inputUsuario" aria-describedby="usuarioHelp" required autofocus>
                                <small id="usuarioHelp" class="form-text text-muted">No comparta sus credenciales con nadie.</small>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Contrase&ntilde;a</label>
                                <div class="input-group">
                                    <input type="password" id="inputPassword" name="inputPassword" class="form-control pwd" placeholder="Contrase&ntilde;a" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default reveal" type="button">
                                            <i class="alert alert-primary" role="alert"><img id="abrircerrar" src="imgs/open.png"></i></button>
                                    </span>   
                                </div>
                                <input type="hidden" name="okForm" value="Continuar">
                            </div>
                            <button type="button" id="btnNuevo"class="btn btn-success">Crear Nuevo Usuario</button>&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-success">Iniciar Sesi&oacuten</button><br><br>
                        </form>
                    </center>
                </div>  
            </div>
        </div>
        <?php require_once('scripts.php'); ?>
        <script>
            $(document).on('click', '#btnNuevo', function () {
                location.href = "usuariosadm.php";
            });

            $(".reveal").on('click', function () {
                var $pwd = $(".pwd");
                if ($pwd.attr('type') === 'password') {
                    $pwd.attr('type', 'text');
                    $("#abrircerrar").attr("src", "imgs/close.png");
                } else {
                    $pwd.attr('type', 'password');
                    $("#abrircerrar").attr("src", "imgs/open.png");
                }
            });
        </script>
    </body>
</html>