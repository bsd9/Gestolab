<?php
 header('Content-Type: text/csv');
 header('Content-Disposition: attachment; filename="sample.csv"');
$fp = fopen('php://output', 'w');
$line = "hoy,IDProducto,nombre,codigoInterno,presentacionVenta,cantidadAComprar,PedidoRelacionado,FechaEnvioFacturar,EjecutivoVentas,Correo";
$val = explode(",", $line);
fputcsv($fp, $val);
foreach ( $InformeCompras as $line ) {
    $val = (array) $line;
    fputcsv($fp, $val);
}
fclose($fp);
