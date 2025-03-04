<columns column-count="3" vAlign="J" column-gap="7" >
<p>

</p>
  <columnbreak />
  <p>

  </p>

  <columnbreak />

      <table class="number">
      <tr>
        <td>
          <p class="right-align" style="font-weight: bold !important;">
          COTG-<?=$ordenes;?> 
          </p>
        </td>
        <td>
            <p class="right-align" style="font-weight: bold !important;" >
          <p></p>
            </p>
        </td>
      </tr>
    </table>

  </columns>


<columns column-count="3" vAlign="J" column-gap="7" >
<div class="center">
  <p>
  
  </p>
  <p class='center-align' style="font-size: 0.8em !important;">
  </p>
</div>
<columnbreak />
<columnbreak />
<table class="grayborder grayborderall">
  <tr>
    <td>
Cliente:
    </td>
    <td class='letrazul'>
  <p><?=$cliente[0]->getRazonSocial();?></p>
    </td>
  </tr>
  <tr>
    <td>
NIT:
    </td>
    <td class='letragris'>
   <p><?=$cliente[0]->getNIT();?></p>
    </td>
  </tr>
  <tr>
    <td>
      Telefono:
    </td>
    <td class='letragris'>
        <p><?=$cliente[0]->getTelefono();?></p>
    </td>
  </tr>
  <tr>
    <td>
Direccion:
    </td>
    <td class='letragris'>
  <p><?=$cliente[0]->getDireccion();?></p>
    </td>
  </tr>
    <tr>
      <td>
  Asesor:
      </td>
      <td>
        <p><?=$asesor[0]->getNombre()?> <?=$asesor[0]->getApellidos()?> </p>
      </td>
    </tr>
    <tr>
      <td>
  Fecha:
      </td>
      <td>
        <p><?=$fecha;?> </p>
      </td>
    </tr>
</table>




</columns>
