<?php

$FECHA_HORA_LOG = $Utilidades->limpiar_campos(date('d-m-Y h:i:s A'));
$PAGINA_LOG = $Utilidades->limpiar_campos($_SERVER["PHP_SELF"]);

$BitacoraSQL= sprintf("INSERT INTO bitacora (FECHA_HORA,"
        . "PAGINA,"
        . "TABLA,"
        . "TIPO_CONSULTA) "
        . "VALUES (%s,"
        . "%s,%s,"
        . "%s)", $FECHA_HORA_LOG, $PAGINA_LOG, $TABLA_LOG, $TIPO_CONSULTA_LOG);

$RsInsertBitacora = $db->query($BitacoraSQL);


// FIN Insertar en LOG
?>