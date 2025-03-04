
<?php if (!$preforma){ ?>
  <?php if ($imprimir){ ?>
<p class="right-align">
<?=$factura[0]->prefijo .'-' . $factura[0]->getNumero();?>
</p>
<?php } else { ?>
<p class="right-align">
<?=$factura[0]->prefijo .'-' . $factura[0]->getNumero();?>
</p>
<p>
</p>
    <?php } ?>
<?php }else {  ?>
<p class="right-align">
  -------

</p>
<p>
</p>
<?php } ?>
<columns column-count="2" vAlign="J" column-gap="40" >

  <?php if ($imprimir){ ?>
    <p class='right-align' style="font-size: 0.8em !important;">
      <?=$factura[0]->getRazonSocialEmpresa();?>
      <?=$factura[0]->getNITEmpresa();?>
      Resolucion Dian No<?=$factura[0]->resolucion .' '. $factura[0]->fechaResolucion;?> del <?=$factura[0]->desdeResolucion;?> al <?=$factura[0]->hastaResolucion;?>
      <?=$factura[0]->getDireccionEmpresa();?>
      PBX: <?=$factura[0]->getTelefonoEmpresa();?>
      FAX: <?=$factura[0]->getFaxEmpresa();?>
       <?=$factura[0]->getWebEmpresa();?>
       <?=$factura[0]->getCorreoEmpresa();?>

    </p>
<br>
  <table>
<tr>
  <td class="center-align">
    <?=$factura[0]->getFecha()?>
  </td>
</tr>
<tr>
  <td class="center-align">
<?=$factura[0]->getFechaPago();?>
  </td>
</tr>
  </table>
  <?php } else { ?>
<br>
    <table>
    <tr>
      <td width="60">

      </td>
      <td class='right-align' style="font-size: 0.7em !important;">
        <?=$factura[0]->getRazonSocialEmpresa();?>
        <?=$factura[0]->getNITEmpresa();?>
     Resolucion Dian No <?=$factura[0]->resolucion .' expedida'. $factura[0]->fechaResolucion;?> hasta <?=$factura[0]->fechaVencimiento ?> del <?=$factura[0]->desdeResolucion;?> al <?=$factura[0]->hastaResolucion;?>
        <?=$factura[0]->getDireccionEmpresa();?>
        PBX: <?=$factura[0]->getTelefonoEmpresa();?>
        FAX: <?=$factura[0]->getFaxEmpresa();?>
         <?=$factura[0]->getWebEmpresa();?>
         <?=$factura[0]->getCorreoEmpresa();?><p>
          Factura impresa por computador Autoriza <?=$factura[0]->desdeResolucion;?> a <?=$factura[0]->hastaResolucion;?>
        </p>
      </td>
    </tr>
    </table>
<br>


  <table>
<tr>
  <td class="center-align">
    <?=$factura[0]->getFecha()?>
  </td>
</tr>
<tr>
  <td class="center-align">
<?=$factura[0]->getFechaPago();?>
  </td>
</tr>
  </table>
    <?php } ?>


<columnbreak />
  <?php if ($imprimir){ ?>
    <p>
</p>
<?php } ?>
<p><?=$factura[0]->RazonSocial?></p>
<p> </p>
<p><?=$factura[0]->getNIT();?></p>
<table>
  <tr>
    <td style='border-bottom: 0px !important;'>
      <p><?=$factura[0]->getDireccion();?></p>
    </td>
    <td style='border-bottom: 0px !important; text-align: right;'>
      <p><?=$factura[0]->getCiudad();?></p>
    </td>
  </tr>
  <tr>
  </tr>
  <tr>
  <td style='border-bottom: 0px !important;'>
      <p>  <?=$factura[0]->getTelefono();?></p>
  </td>
</tr>
</table>
