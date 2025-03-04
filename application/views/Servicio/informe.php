<html>
<head>
  <!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/materialize.css"  media="screen,projection"/> -->
    <!-- <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/facturaImp.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/factura.css"/> -->
<!-- <body style="background-image:url(' echo base_url();?>assets/imgs/ echo $factura[0]->getLogoFactura();?>') !important;"> -->

</head>
<body>
<columns column-count="3"  column-gap="3">
<p><img src="<?=base_url()?>assets/img/1.png>"
  style="width: 70% !important; background-attachment: fixed;" /></p>
<columnbreak />
<h6 hidden>.</h6>
<h6  class="center" color="blue"><?php echo "INFORME TÉCNICO DE " .mb_strtoupper($servicio[0]->getServicio()); ?></h6>
<columnbreak class="top" />
<table style="border-collapse: collapse;">
<tr>
<td>CERTIFICADO</td>
<td>GM-D-0469  </td>
</tr>
<tr>
<td>FECHA      </td>
<td>2017-11-20</td>
</tr>
</table>
</columns>
<columns column-count="3"  column-gap="7">
  <p>Fecha de expedición: <?php echo $servicio[0]->getFechaSolicitud() ; ?></p>
<columnbreak />
  <p>Fecha de ejecución: <?php echo $servicio[0]->getFechaServicio(); ?></p>
<columnbreak />
  <p class="right-align"><?php// echo $servicio[0]->getCodigoservicio(); ?></p>
</columns>

<columns column-count="1"  column-gap="7">
<h5>Datos del cliente:</h5>
</columns>
<columns column-count="3"  column-gap="3">
<p>Cliente: <?php //echo $pedido[0]->getIdCliente(); ?></p>
<p>Contacto: <?php //echo $pedido[0]->getNombreCotizacion(); ?></p>
<p>Telefono: <?php //echo $pedido[0]->getTelefonoCotizacion(); ?></p>
</columns>
<columns column-count="1"  column-gap="7">
  <h5>Datos del equipo</h5>
</columns>
<columns column-count="3"  column-gap="3">
  <p>Instrumento <?php //echo $equipo[0]->getEquipo();?></p>
  <p>Marca/fabricante <?php// echo $equipo[0]->getMarca();?></p>
  <p>Modelo <?php //echo $equipo[0]->getModelo();?></p>
  <p>Serial <?php //echo $equipo[0]->getSerial();?></p>
  <p>Ubicacion/Proceso <?php //echo $equipo[0]->getUbicacion();?></p>
  <?php //foreach ($caracteristicas as $caracteristica): ?>
  <p><?php //echo $caracteristica->getNombre();?> <?php// echo $caracteristica->getValor();?></p>
  <?php //endforeach; ?>
</columns>



<columns column-count="1"  column-gap="7">
  <?php if (count($procedimientos) != 0): ?>
    <h5>Procedimientos</h5>
  <?php endif; ?>
  <ul>
    <?php foreach ($procedimientos as $procedimiento): ?>
      <li><?=$procedimiento->getTexto();?></li>
    <?php endforeach; ?>
  </ul>
<?php if (count($partes) != 0): ?>
  <h5>Partes reemplazadas (repuestos)</h5>
<?php endif; ?>
  <ul>
    <?php foreach ($partes as $parte): ?>
      <li><?=$parte->getNombre();?></li>
    <?php endforeach; ?>
  </ul>

<?php if (count($recomendaciones) != 0): ?>
  <h5>Observación y/o recomendaciones</h5>
<?php endif; ?>
  <ul>
    <?php foreach ($recomendaciones as $recomendacion): ?>
      <li><?=$recomendacion->getTexto();?></li>
    <?php endforeach; ?>
  </ul>

</columns>

<?php //foreach ($extras as $extra): ?>
  <columns column-count="2"  column-gap="5"> <p><?php //echo $extra->getNombre();?> <?php// echo $extra->getValor();?></p></columns>
<?php //endforeach; ?>
</body>
