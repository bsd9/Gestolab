<?php
 header('Content-Type: text/csv');
 header('Content-Disposition: attachment; filename="informeEquipos.csv"');
$fp = fopen('php://output', 'w');
fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
$line="NombreEquipo,Marca,Modelo,Serial,CodigoInterno,Dependencia,Estado,Servicio,FechaServicio,EstadoServicio,Imagen,Magnitud,OrdenDeTrabajo,OrdenDeServicio,Valor,Cantidad,ValorTotal,Familia";
$val = explode(",", $line);
fputcsv($fp, $val);
foreach ( $InformeEquipos as $line ) {
    $val = (array) $line;
    fputcsv($fp, $val);
}
fclose($fp);

?>