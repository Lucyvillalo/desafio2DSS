<?php
require_once('Connections/conn.php');

//IMPLMENTAR MECANISMO DE AUTENTICACION POR SESIONES

//NO OLVIDE LA BITACORA

// Número de resultados por página
$resultados_por_pagina = 5;

// Obtener la página actual (si no se especifica, la página es 1)
if (isset($_GET["pagina"])) {
    $pagina_actual = $_GET["pagina"];
} else {
    $pagina_actual = 1;
}

// Calcular el índice de inicio para la consulta SQL
$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

$queryBitacora = "SELECT * FROM bitacora LIMIT $resultados_por_pagina OFFSET $indice_inicio";

$RsBitacora = $db->query($queryBitacora);

$totalRows_RsBitacora = $RsBitacora->num_rows;

$TituloSeccion = "Bitácora de Usuarios";
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
                <?php require_once('menu.php'); ?>
                <center>
                    <table class="table table-sm table-striped table-hover align-middle shadow-sm" style="font-size: 0.85rem;">
                        <thead class="table-dark text-uppercase">
                            <tr>
                                <th scope="col" class="px-3" style="width: 180px;">Fecha y Hora</th>
                                <th scope="col">Página</th>
                                <th scope="col">Opción</th>
                                <th scope="col" class="text-center">Operación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_RsBitacora = $RsBitacora->fetch_assoc()) {
                                // Lógica para el color del badge según el tipo de consulta
                                $tipo = strtoupper($row_RsBitacora['TIPO_CONSULTA']);
                                $badgeColor = match ($tipo) {
                                    'INSERT' => 'bg-success',
                                    'UPDATE' => 'bg-info text-dark',
                                    'DELETE' => 'bg-danger',
                                    default  => 'bg-secondary'
                                };
                            ?>
                                <tr>
                                    <td class="px-3 text-muted">
                                        <i class="mdi mdi-calendar-clock me-1"></i>
                                        <?php echo $row_RsBitacora['FECHA_HORA']; ?>
                                    </td>
                                    <td class="fw-bold">
                                        <i class="mdi mdi-file-outline me-1"></i>
                                        <?php echo $row_RsBitacora['PAGINA']; ?>
                                    </td>
                                    <td>
                                        <code class="text-primary"><?php echo $row_RsBitacora['TABLA']; ?></code>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill <?php echo $badgeColor; ?> px-2 py-1" style="min-width: 70px;">
                                            <?php echo $tipo; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    // Calcular el número total de páginas
                    $sql_total = "SELECT COUNT(*) AS total FROM bitacora";
                    $result_total = $db->query($sql_total);
                    $row_total = $result_total->fetch_assoc();
                    $total_resultados = $row_total["total"];
                    $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                    $paginas_a_mostrar = 5;
                    $mitad_paginas = floor($paginas_a_mostrar / 2);

                    $inicio_paginacion = max(1, $pagina_actual - $mitad_paginas);
                    $fin_paginacion = min($total_paginas, $inicio_paginacion + $paginas_a_mostrar - 1);

                    if ($fin_paginacion - $inicio_paginacion + 1 < $paginas_a_mostrar) {
                        $inicio_paginacion = max(1, $fin_paginacion - $paginas_a_mostrar + 1);
                    }

                    // Cambiamos pagination-lg por pagination-sm y quitamos mt-4 por mt-2
                    echo '<nav aria-label="Navegación" class="mt-2 text-center">';
                    echo '  <ul class="pagination pagination-sm justify-content-center">';

                    if ($pagina_actual > 1) {
                        echo '<li class="page-item"><a class="page-link text-success" href="bitacora.php?pagina=1"><i class="mdi mdi-chevron-double-left"></i></a></li>';
                    }

                    for ($i = $inicio_paginacion; $i <= $fin_paginacion; $i++) {
                        if ($i == $pagina_actual) {
                            echo '<li class="page-item active" aria-current="page">';
                            echo '  <a class="page-link bg-success border-success text-white" href="#">' . $i . '</a>';
                            echo '</li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link text-success" href="bitacora.php?pagina=' . $i . '">' . $i . '</a></li>';
                        }
                    }

                    if ($pagina_actual < $total_paginas) {
                        echo '<li class="page-item"><a class="page-link text-success" href="bitacora.php?pagina=' . $total_paginas . '"><i class="mdi mdi-chevron-double-right"></i></a></li>';
                    }

                    echo '  </ul>';
                    echo '</nav>';
                    ?>

                </center>
            </div>
        </div>
    </div>
    <?php require_once('scripts.php'); ?>
</body>

</html>