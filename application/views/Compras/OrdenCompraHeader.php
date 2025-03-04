<columns column-count="3" vAlign="J" column-gap="7" >
<p>
</p>
  <columnbreak />
  <p class="right-align">
    ORDEN DE COMPRA
  </p>
  <columnbreak />
      <table class="number">
      <tr>
        <td>
            <p class="right-align" style="font-weight: bold !important;" >
        OC  <?=$orden[0]->getId();?>
            </p>
        </td>
      </tr>
    </table>
  </columns>


<columns column-count="3" vAlign="J" column-gap="2" >
  <p>
    <img src="<?=base_url()?>assets/imgs/logoordendecompra.png" />
  </p>
<columnbreak />
<table>
  <tr>
    <td class="letrazul">
Razon Social:
    </td>
    <td>
<?=$datosempresa[0]->getRazonSocial();?>
    </td>
  </tr>
  <tr>
    <td>
NIT:
    </td>
    <td>
  <?=$datosempresa[0]->getNit();?>
    </td>
  </tr>
  <tr>
    <td>
  Direccion:
    </td>
    <td>
  <?=$datosempresa[0]->getDireccion();?>
    </td>
  </tr>
  <tr>
    <td>
  PBX:
    </td>
    <td>
     <?=$datosempresa[0]->getTelefono();?>
    </td>
  </tr>
  <tr>
    <td>
FAX:
    </td>
    <td>
          <?=$datosempresa[0]->getFax();?>
    </td>
  </tr>
  <tr>
    <td>
  Web:
    </td>
    <td>
           <?=$datosempresa[0]->getWeb();?>
    </td>
  </tr>
  <tr>
    <td>
  Correo:
    </td>
    <td>
       <?=$datosempresa[0]->getCorreo();?>
    </td>
  </tr>
</table>

<columnbreak />
      <p>Proveedor: <?=$orden[0]->getRazonSocialProveedor();?><br/>
      Fecha Pedido: <?=$orden[0]->getFechaExpedicion();?><br/>
      Fecha Entrega: <br/>
      Modo de Pago: <?=$orden[0]->getModopago();?>  <?php if($orden[0]->getModopago() == 'Credito'){echo $orden[0]->getDiaspago() . 'Días'; } ?><br/></p>
  </columns>
