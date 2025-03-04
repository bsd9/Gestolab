<div class ="container">

<div class="card-panel"><h5>Precio de: <?=$editado->getNombre(); ?></h5></div>
</div>
<?php echo form_open('Producto/guardarPrecio/'. $editado->getId() ,array('id'=>'formulario'));  ?>
  <div class="container">
  <div class="card-panel">

<div class="row">
  <div class="col s3">
  <h5>Usar Costo de proveedor: </h5>
<?php $prov=0; foreach ($costos as $c){ ?>
  <input name="costo" <?php if($prov === 0){echo "checked"; } ?> type="radio" value="<?=$c->getCosto();?>" id="<?=$prov?>"/>
  <label for="<?=$prov?>"><?=$c->getIdProveedor();?> : <?=$c->getCosto();?></label>
  <?php $prov= $prov + 1 ?>
<?php } ?>
  </div>
<div class="col s3">
<h5>Precio Piso</h5>
<div class="input-field"><label for="UtilidadP">Porcentaje de costeo (%)</label><input type ="number" onchange="UtilidadToValor(0)" step="any" name="UtilidadP" id="UtilidadP" /></div>
<div class="input-field"><label for="ValorP">Valor</label><input type ="number" onchange="ValorToUtilidad(0)" value=<?=$editado->getPrecioPiso();?> step="any" name="ValorP" id="ValorP" /></div>
</div>
<div class="col s3">
<h5>Precio Techo</h5>
<div class="input-field"><label for="UtilidadT">Procentaje de costeo (%)</label><input type ="number" onchange="UtilidadToValor(1)" step="any" name="UtilidadT" id="UtilidadT" /></div>
<div class="input-field"><label for="ValorT">Valor</label><input type ="number" onchange="ValorToUtilidad(1)" value=<?=$editado->getPrecioTecho();?> step="any" name="ValorT" id="ValorT" /></div>
</div>
</div>
</div>
</div>

<div class="center">
<button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Enviar
    <i class="material-icons right">send</i>
</button>
  </div>
<?php echo form_close();?>

<script type="text/javascript">
var cantidadsalida = '<?=$editado->getCantidadSalida();?>';
var cantidadentrada = '<?=$editado->getCantidadEntrada();?>';

if (cantidadsalida == 0) {
  cantidadsalida = 1
}
if (cantidadentrada == 0) {
  cantidadentrada = 1
}


</script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/Producto/DefinirPrecio.js"></script> 
