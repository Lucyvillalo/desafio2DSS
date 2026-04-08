<?php
ini_set('memory_limit', -1);
@ob_start('ob_gzhandler');
date_default_timezone_set('America/El_Salvador');
setlocale(LC_ALL, 'es_SV.UTF-8', 'esp');
setlocale(LC_TIME, 'es_SV.UTF-8', 'esp');
session_start();

define("MODULO", "EVALUACION 02 PHPSERVER");
// Uso de la clase
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DBDATA", "ev02");


spl_autoload_register(function($class) {
    require_once "class/" . $class . ".class.php";
});


$database = new Database(DBHOST, DBUSER, DBPASS, DBDATA);
$db = $database->db; // Accede a la conexión MySQLi
