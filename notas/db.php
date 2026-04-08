<?php

$con = mysqli_connect("localhost", "root", "", "ev02");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

function obtenerTodos($con) {
    $result = mysqli_query($con, "SELECT * FROM `notas`");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_all($result);

        mysqli_close($con);

        return $row;
    }
}

function obtenerUsuario($con, $id_notas) {
    $result = mysqli_query($con, "SELECT * FROM `notas` WHERE id_notas=$id_notas");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        mysqli_close($con);

        return $row;
    }
}

function insertar($con, $carnet, $materia, $nota1, $nota2, $nota3) {
    $stm = $con->prepare("insert into notas (carnet,materia,nota1,nota2,nota3) values (?,?,?,?,?)");
    $stm->bind_param('ssddd', $carnet, $materia, $nota1, $nota2, $nota3);
    $stm->execute();

    return "Exito";
}

function editar($con, $carnet, $materia, $nota1, $nota2, $nota3, $id_notas) {

    $stm = $con->prepare("update notas set carnet=?,materia=?,nota1=?,nota2=?,nota3=? where id_notas=?");
    $stm->bind_param('ssdddi', $carnet, $materia, $nota1, $nota2, $nota3, $id_notas);
    $stm->execute();

    return "Exito";
}

function eliminar($con, $id_notas) {
    $stm = $con->prepare("delete from notas where id_notas=?");
    $stm->bind_param('i', $id_notas);
    $stm->execute();

    return "Exito";
}

?>
