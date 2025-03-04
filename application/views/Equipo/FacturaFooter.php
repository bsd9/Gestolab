<?=$factura[0]->getFooterFactura() ?>
<?php if (!$preforma){ ?>
  <?=$factura[0]->getObservacionesFactura() ?>
<?php }else { ?>
  <?=$factura[0]->getObservacionesPreforma() ?>
<?php } ?>
<br/>
<?php if ($imprimir){ ?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<?php } ?>
<?php if ($imprimir){ ?>
	<?php } else {?>
		<p style="font-size: 0.8em !important;"> Impreso por <?=$factura[0]->getRazonSocialEmpresa();?> NIT: <?=$factura[0]->getNITEmpresa();?> Tel: <?=$factura[0]->getTelefonoEmpresa();?> E-mail: <?=$factura[0]->getCorreoEmpresa();?></p>
	<?php } ?>

  <table>
<tr>
  <td style='border-bottom: 0px !important'>
<p>Fecha cotizacion: <?=$cotizacion[0]->getFecha();?></p>
  </td>
  <td style='border-bottom: 0px !important'>
    <p>ID: <?=$factura[0]->getIdOrden();?></p>
  </td>
</tr>
  </table>
