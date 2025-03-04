<html>
<head>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/materialize.css"  media="screen,projection"/>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/ordenCompra.css"/>
</head>
<body>
  <columns column-count="1" vAlign="J" column-gap="10" >
<table>
  <tr>
		<th>Codigo</th>
		<th>Producto</th>
		<th>Presentación</th>
    <th>Cantidad</th>
    <th>Costo Unitario</th>
    <th>Costo Total</th>
  <?php if ($orden[0]->getDivisa() == 'COP') { 	?>  <th>Iva</th> <?php  } ?>
 </tr>
<?php  $total =0;
$Totaliva=0; foreach ($detalles as $deta) {
	  $total += $deta->getCostoCalculado(); $Totaliva += round($deta->getCostoCalculado() * $deta->getIvaProducto() / 100, 0, PHP_ROUND_HALF_UP);?>
  <tr>
	<td><?=$deta->getCodigoProducto();?></td>
  <td> <?=$deta->getNombreProducto();?> </td>
  <td> <?=$deta->getPresentacionEntrada() . " x " . $deta->getCantidadEntrada() ." ". $deta->getUnidadMedida() ;?> </td>
  <td class='center-align'> <?=$deta->getCantidad();?> </td>
  <td class='right-align'> $<?=number_format($deta->getPrecioUnitario(),0,',','.');?> <?php if($orden[0]->getDivisa() != 'COP'){ echo $orden[0]->getDivisa();}?></td>
  <td class='right-align'> $<?=number_format($deta->getCostoCalculado(),0,',','.');?> <?php if($orden[0]->getDivisa() != 'COP'){ echo $orden[0]->getDivisa();}?> </td>

<?php if ($orden[0]->getDivisa() == 'COP') { 	?>
	<td class='right-align'> $<?= number_format(round($deta->getCostoCalculado() * $deta->getIvaProducto() / 100, 0, PHP_ROUND_HALF_UP),0,',','.');?> <?php if($orden[0]->getDivisa() != 'COP'){ echo $orden[0]->getDivisa();}?></td>
	<?php  } ?>

  </tr>
<?php  } ?>
</table>
  </columns>
  <columns column-count="3" vAlign="J" column-gap="10" >
  <p>
    Observaciones:
  </p>
  <columnbreak />
    <table >
      <tr>
        <td style="border: 1px block">
					<?=$orden[0]->getObservacionesCompra();?>
        </td>
      </tr>
    </table>
      <columnbreak />
      <table class="grayborder grayborderall">
        <tr>
          <td >
          <?php if ($orden[0]->getDivisa() == 'COP') { 	?>  Sub total <?php  }else{ ?> Total<?php } ?>
          </td>
          <td class='right-align'>
            $<?=number_format($total,0,',','.')?> <?php if($orden[0]->getDivisa() != 'COP'){ echo $orden[0]->getDivisa();}?>
          </td>
        </tr>
				<?php if ($orden[0]->getDivisa() == 'COP') { 	?>
        <tr>
          <td>
            Total iva
          </td>
          <td class='right-align'>
            $<?=number_format($Totaliva,0,',','.')?> <?php if($orden[0]->getDivisa() != 'COP'){ echo $orden[0]->getDivisa();}?>
          </td>
        </tr>

        <tr>
          <td>
            Total a pagar
          </td>
          <td class='right-align'>
            $<?=number_format($total + $Totaliva,0,',','.')?> <?php if($orden[0]->getDivisa() != 'COP'){ echo $orden[0]->getDivisa();}?>
          </td>
        </tr>
				<?php  } ?>
      </table>
    </columns>
		<columns column-count="3" vAlign="J" column-gap="10" >
<p>

</p>
			<columnbreak />
			<p>

			</p>
			<columnbreak />
	  </columns>


  <columns column-count="1" vAlign="J" column-gap="10" >
    <p>
      Nota: <br/>
    </p>
  </columns>

</body>
</html>
