<html>
<head>
  <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/materialize.css"  media="screen,projection"/>
  <?php if ($imprimir){ ?>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/facturaImp.css"/>
  <?php } else { ?>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/factura.css"/>
<body style="background-image:url('<?php echo base_url();?>assets/img/<?php echo $factura[0]->getLogoFactura();?>') !important;">
  <?php } ?>
</head>

<columns column-count="1"  column-gap="7">

<table class ="striped" style="margin:0;" >
<thead>
<tr>
	<th <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="40"';    } ?> ></th>
	<th  <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="100"';    } ?> ></th>
  <th <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="70"';    } ?> ></th>
  <th <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="150"';    } ?> ></th>
  <th <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="100"';    } ?> ></th>
  <th  <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="100"';    } ?> ></th>
  <th  <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="60"';    } ?>  ></th>
  <th <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="60"';    } ?> ></th>
  <th  <?php if ($imprimir){ echo 'width="100"'; } else {  echo 'width="0"';    } ?> > </th>
</tr>
</thead>
<tbody>

<?php $i=1; $total = 0; $Totaliva = 0; foreach ($equiposPrecio as $deta) { $Totaliva+=round($deta->valor * $deta->cantidad * $deta->iva / 100,0, PHP_ROUND_HALF_UP);
$total+=$deta->valor * $deta->cantidad; ?>

  <tr >
    <td > <?=$i; $i++;?> </td>
    <td > <?=$deta->nombre;?> </td>
    <td style=" align-content: center"> <?=$deta->cantidadEquipos;?> </td>
    <td> <?=$deta->servicio;?> </td>
    <td> <?=$deta->Medida;?></td>
    <td> <?=$deta->cantidad;?></td>
    <td> $<?=number_format($deta->valor,0,',','.');?> </td>
    <td><?=number_format($deta->valor * $deta->cantidad,0,',','.');?></td>
    <td> <?=round($deta->iva,0,PHP_ROUND_HALF_UP);?>% </td>
  </tr>
<?php  } ?>

</tbody>
</table>

</columns>
<table>
<tr>
<th></th>
</tr>
<tr>
<td class="center"></td>
</tr>
<tr>
<td class="center"></td>
</tr>
<tr>
<td class="center"></td>
</tr>
<tr>
<td class="center"></td>
</tr>
<tr>
<td class="center"></td>
</tr>
<tr>
<td class="center"></td>
</tr>
</table>
<columns column-count="4" vAlign="J" column-gap="0" >
  <p></p>
  <p></p>
  <p></p>
  <p>
    ____________________________
  </p>
  <p>
    Firma y sello autorizado
  </p>
<columnbreak />
<p>
</p>
<p>
</p>
<p>
  ____________________________
</p>
<p>
  Recibido
</p>
<columnbreak />
<p>Retefuente : $ <?=number_format($factura[0]->getRetefuente(),0,',','.');?></p>
<columnbreak />

<table class='tablacompleta'>
<tbody>
  <tr>
    <td>
  SubTotal
    </td>
    <td class="right-align">
  $ <?=number_format($total,0,',','.');?>
    </td>
  </tr>
    <tr>
      <td>
    Envio
    </td>
    <td class="right-align">
    $ <?=number_format(0,0,',','.');?>
    </td>
  </tr>

  <tr>
    <td>
    Total iva
    </td>
    <td class="right-align">
    $ <?=number_format($Totaliva,0,',','.');?>
    </td>
  </tr>

  <tr>
    <td>
    Total a pagar
    </td>
    <td class="right-align">
      $ <?=number_format($total + $Totaliva,0,',','.');?>
    </td>
  </tr>

</tbody>
</table>

</columns>





<columns column-count="1" vAlign="J" column-gap="7" >
  <p> NOTAS:
  </p>
<p><?=$factura[0]->getNota();?></p>
<p><?=$factura[0]->getOrigenPedido();?></p>

</columns>


</body>
