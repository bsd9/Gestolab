
<p>
 
</p>
<br/>
<table class="grayborder grayborderall">
  <tr>
    <td width="120" style='border: 0px !important;'>
Telefono:	<?= $grupo[0]->getTelefono();?>
    </td>
    <td width="100" style='border: 0px !important;'>
Fax: <?= $grupo[0]->getFax();?>
    </td>
    <td width="10" style='border: 0px !important;'>
<?= $grupo[0]->getWeb();?>
    </td>
    <td width="10" style='border: 0px !important;'>
<?= $grupo[0]->getCorreo();?>
    </td>
  </tr>
  <tr>
    <td width="120" style='border: 0px !important;'>
			<?=$grupo[0]->getRazonSocial();?>
    </td>
    <td width="100" style='border: 0px !important;'>
			<?=$grupo[0]->getNIT();?>
    </td>
    <td width="300" colspan="2" style='border: 0px !important;'>
			<?=$grupo[0]->getDireccion();?>
    </td>
  </tr>
<tr>
	<td colspan="3">


	</td>
</tr>
</table>
<p class="right-align">
  Cotizó: <?=$asesor[0]->getUsuario();?>
</p>
