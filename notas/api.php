<?php
header("Content-Type:application/json");

if (isset($_GET['opc']) && $_GET['opc'] != "") {
    switch ($_GET['opc']) {
        case "listar":
            include('db.php');
            $row = obtenerTodos($con);
            responseAll($row);
            break;
        case "insertar":
            include('db.php');
            $data = json_decode(file_get_contents("php://input"));

            echo insertar($con, $data->carnet, $data->materia, $data->nota1, $data->nota2, $data->nota3);

            break;
        case "obtener":
            if (isset($_GET['id_notas']) && $_GET['id_notas'] != "") {
                include('db.php');
                $id_notas = $_GET['id_notas'];
                $row = obtenerUsuario($con, $id_notas);
                if (sizeof($row) > 0) {
                    $id_notas = $row['id_notas'];
                    $carnet = $row['carnet'];
                    $materia = $row['materia'];
                    $nota1 = $row['nota1'];
                    $nota2 = $row['nota2'];
                    $nota3 = $row['nota3'];
                    response($id_notas, $carnet, $materia, $nota1, $nota2, $nota3);
                } else {
                    response(NULL, NULL, NULL, NULL, 200, "No se encontraron registros");
                }
            } else {
                response(NULL, NULL, NULL, NULL, 400, "Peticion invalidad");
            }
            break;
        case "editar":
            include('db.php');
            $data = json_decode(file_get_contents("php://input"));
           
            echo editar($con, $data->carnet, $data->materia, $data->nota1, $data->nota2, $data->nota3, $data->id_notas);

            break;
        case "eliminar":
            if (isset($_GET['id_notas']) && $_GET['id_notas'] != "") {
                include('db.php');
                $id_notas = $_GET['id_notas'];
                echo eliminar($con, $id_notas);
            } else {
                echo "ERROR";
            }
            break;
    }
}

function response($id_notas, $carnet, $materia, $nota1, $nota2, $nota3) {
    $response['id_notas'] = $id_notas;
    $response['carnet'] = $carnet;
    $response['materia'] = $materia;
    $response['nota1'] = $nota1;
    $response['nota2'] = $nota2;
    $response['nota3'] = $nota3;

    $json_response = json_encode($response);
    
    echo $json_response;
}

function responseAll($array) {
    $json_response = json_encode($array);
    echo $json_response;
}

?>
