<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="cerrar_sesion.php">Salir</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkOPE" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Directorios y Archivos</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkOPE">
                    <a class="dropdown-item" href="indicacionesEstructuraTextos.php">Indicaciones Estructura de Texto</a>
                    <a class="dropdown-item" href="EstructuraTextos.php">Crear Estructura de Texto</a>
                    <a class="dropdown-item" href="GeneradorTextos.php">Procesar Textos</a>
                    <a class="dropdown-item" href="indicacionesEstructuraImgs.php">Indicaciones Estructura de Im&aacute;genes</a>
                    <a class="dropdown-item" href="EstructuraImgs.php">Crear Estructura de Im&aacute;genes</a>
                    <a class="dropdown-item" href="GeneradorImgs.php">Procesar Im&aacute;genes</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkMAN" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Formularios, CRUD y MVC</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkMAN">
                    <a class="dropdown-item" href="generales/registro.php">Generales del Alumno</a>
                    <a class="dropdown-item" href="notas/registrar.php">Notas del Alumno (CRUD)</a>
                    <a class="dropdown-item" href="mvc02/">Paradigma (MVC)</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkREP" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Reportes</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkREP">
                    <a class="dropdown-item" href="arbol.php">Vista de Arbol</a>
                    <a class="dropdown-item" href="cookies.php">Cookies</a>
                    <a class="dropdown-item" href="sesiones.php">Sesiones</a>
                    <a class="dropdown-item" href="bitacora.php">Bitacora (LOG)</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<hr width="80%" class="bg-dark border-2 border-top border-dark" />    
<h3><?php echo $TituloSeccion;?></h3>
