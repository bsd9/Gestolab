<html>
<head>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/cotizacion.css"/>

</head>
<body style="background-image:url('<?php echo base_url();?>assets/img/2.png') !important; " >

    <columns column-count="1"  column-gap="7">

<table class="grayborder">
    <thead>
    <tr>
        <th class="center"> <font size ="1"> Item</th>
        <th class="center"> <font size ="1"> Equipo</th>
        <th class="center"> <font size ="1"> Serial</th>
        <th class="center"> <font size ="1"> Codigo Interno</th>
        <th class="center"> <font size ="1"> Dependencia</th>
        <th class="center"> <font size ="1"> Servicio a realizar</th>
        <th class="center"> <font size ="1"> Unidad de medida x Servicio</th>
        <th class="center"> <font size ="1"> Cantidad de servicios</th>
        <th class="center"> <font size ="1"> Precio Unitario</th>
        <th class="center"> <font size ="1"> Precio Total</th>
        <th class="center"> <font size ="1"> Iva</th>

 </tr>
</thead>
<tbody>

<?php $i=1; $total = 0; $Totaliva = 0; foreach ($equiposPrecio as $deta) { $Totaliva+=round($deta->valor * $deta->cantidad * $deta->iva / 100,0, PHP_ROUND_HALF_UP);
$total+=$deta->valor * $deta->cantidad; ?>
  <tr>
    <td class="center"> <font size ="2"> <?=$i; $i++;?> </td>
    <td><font size ="1"> <?=$deta->nombre." ".$deta->marca . " - " . $deta->modelo;?> </td>
    <td><font size ="1">  <?=$deta->serial;?> </td>
    <td><font size ="1">  <?=$deta->codigo;?> </td>
    <td><font size ="1">  <?=$deta->laboratorio;?> </td>
    <td><font size ="1">  <?=$deta->servicio;?> </td>
    <td class='center-align'><font size ="1">  <?=$deta->Medida;?></td>
    <td  class="center-align"><font size ="1">  <?=$deta->cantidad;?></td>
    <td  class='right-align'><font size ="1">  $<?=number_format($deta->valor,0,',','.');?> </td>
    <td  class='right-align'><font size ="1">  $<?=number_format($deta->valor * $deta->cantidad,0,',','.');?></td>
    <td class='center-align'><font size ="1">  <?=round($deta->iva,0,PHP_ROUND_HALF_UP);?>% </td>
  </tr>
<?php  } ?>


</tbody>
</table>
</columns>
<columns column-count="2"  column-gap="30%">
    <table>
        <tr>
            <td valign="top" style='border: 0px !important; height="65%" '>
                <p>
                    Notas
                </p>
            </td>
            <td style ='background-color: #E4E4E4;'>
            <?php foreach($Notas as $orden){
 echo $orden->getNotas();
} ?>
            </td>
        </tr>
    </table>
    <columnbreak />


    <table class='grayborder' >
        <tr>
            <td class='letrazul'>
Subtotal:
            </td>
            <td class='right-align'>
  $ <?=number_format($total,0,',','.');?>
            </td>
        </tr>
        <tr>
            <td class='letrazul'>
    Total iva
            </td>
            <td  class='right-align'>
    $ <?=number_format($Totaliva,0,',','.');?>
            </td>
        </tr>
        <tr>
            <td class='letrazul'>
    Total a pagar
            </td>
            <td  class='right-align'>
    $ <?=number_format($total + $Totaliva,0,',','.');?>
            </td>
        </tr>
    </table>

</columns>



</body>
