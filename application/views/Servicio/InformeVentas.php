<?php
 header('Content-Type: text/csv');
 header('Content-Disposition: attachment; filename="informeOT.csv"');
$fp = fopen('php://output', 'w');
fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
$line="orden_trabajo,tecnico,fecha,cod_estado_solicitud,descripcion,orden_servicio,fecha_inicio,tercero,equipo,serial,servicio,fecha_fin";
$val = explode(",", $line);
fputcsv($fp, $val);
foreach ( $InformeVentas as $line ) {
    $val = (array) $line;
    fputcsv($fp, $val);
}
fclose($fp);

?>