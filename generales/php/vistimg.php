<?php
if(!empty($_GET['id'])){
    require_once './conexion.php';

    $id = intval($_GET['id']);

    // Consulta correcta
    $result = $con->query("SELECT foto FROM generales WHERE id = $id");

    if($result && $result->num_rows > 0){

        $imgDatos = $result->fetch_assoc();

        // Mostrar imagen
        header("Content-type: image/jpeg"); 
        echo $imgDatos['foto'];

    } else{
        echo 'Imagen no existe...';
    }
}
?>