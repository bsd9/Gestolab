<div class="card-panel">
<div class="card-panel">
<div class="table-responsive">
<?php
echo form_open('Cotizacion/actualizar/' . $id ,array('id'=>'formulario'));
?>


<table id="listaEmpleado" class="highlight bordered" border="1" cellpadding="3" style="table-layout:fixed" >
<thead>
<tr>
<th><div class="text-center">Equipo</div></th>
<th><div class="text-center">Servicio</div></th>
<th><div class="text-center">Cantidad Equipos</div></th>
<th><div class="text-center">Cantidad</div></th>
<th><div class="text-center">Precio Unitario</div></th>
<th><div class="text-center">Precio Total</div></th>
<th><div class="text-center">Iva (%)</div></th>
</tr>
</thead>
<tr>
  <th colspan="4">
<div class="center">
<div class="preloader-wrapper big active">
<div class="spinner-layer spinner-blue-only">
 <div class="circle-clipper left">
   <div class="circle"></div>
 </div><div class="gap-patch">
   <div class="circle"></div>
 </div><div class="circle-clipper right">
   <div class="circle"></div>
 </div>
</div>
</div>
</div>
</th>
</tr>
<tfoot>
<tr>
<th>Equipo</th>
<th>Servicio</th>
<th>Cantidad</th>
<th>Cantidad Equipos</th>
<th>Precio</th>
<th>Unitario</th>
<th>Estado</th>
</tr>
</tfoot>


<div id='modaldetail' class="modal">
<div class="modal-content">
  <div class="card-panel">
    <div id='fotosequipo'></div>
    <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
    </div>
  </div>
</div>
</div>



<?php
$data=[];
foreach ($equipos as $equipo) {

   $data[]=[
   $equipo->nombre,
   $equipo->servicio,
   $equipo->cantidadEquipos,
   '<div class="input-field">
   <input type="number" name="data['.$equipo->idNombre.']['.str_replace(' ', '', $equipo->servicio).'][cantidad]" id="cantidad-'.$equipo->idNombre.'-'.str_replace(' ', '', $equipo->servicio).'" value="'.$equipo->cantidadTotal.'"/>
<label for="cantidad-'.$equipo->idNombre.'-'.str_replace(' ', '', $equipo->servicio).'">'.$equipo->Medida.'</label>
   </div>',
   '<div class="input-field">
   <input type="number" onchange=\'precioUnitario('.$equipo->idNombre.',"'.str_replace(' ', '', $equipo->servicio).'" )\' name="data['.$equipo->idNombre.']['.str_replace(' ', '', $equipo->servicio).'][valor]" id="valor-'.$equipo->idNombre.'-'.str_replace(' ', '', $equipo->servicio).'"
   value="'.$equipo->valor.'" min="'.$equipo->piso.'" id ="preciounitario"/>
   <label for="valor-'.$equipo->idNombre.'-'.str_replace(' ', '', $equipo->servicio).'">Valor</label>
   <input hidden type="text" name="data['.$equipo->idNombre.']['.str_replace(' ', '', $equipo->servicio).'][cantidadEquipos]" value='.$equipo->cantidadEquipos.'/>
   </div>',
   '<div id="total-'.$equipo->idNombre.'-'.str_replace(' ', '', $equipo->servicio).'">'.$equipo->valor * $equipo->cantidadTotal.' </div>',
   '<div class="input-field">
   <input type="number" name="data['.$equipo->idNombre.']['.str_replace(' ', '', $equipo->servicio).'][iva]"  value="19" />
   <label for="iva['.$equipo->idNombre.']['.str_replace(' ', '', $equipo->servicio).']">Valor</label>
   </div>'

   ];


?>
<?php } ?>
</table>

<div class="container">

<div class="input-field">
          <textarea id="notas" name='notas' class="materialize-textarea" rows= "4" cols="60"><?php foreach($ordenes as $orden){
 echo $orden->getNotas();
} ?></textarea>
          <label for="notas">Notas</label>
        </div>
<div class="row">
  <div class="col s6">
    <div class="center">
    <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Guardar
        <i class="material-icons right">send</i>
    </button>
      </div>
  </div>
  <div class="col s6">
    <div class="center">
    <a class="btn waves-effect waves-light blue darken-3" target="_blank"  href='<?= site_url('Cotizacion/cotizacionPreviewPDF') .'/' . $id ?>' name="Enviar" value="Enviar">Ver PDF</a>
      </div>
  </div>
  <div class="col s6">
    <div class="center">
    <a class="btn waves-effect waves-light blue darken-3"  href='<?= site_url('Cotizacion/aprobar') .'/' . $id ?>' name="Enviar" value="Enviar">Aprobar
        <i class="material-icons right">send</i>
    </a>
      </div>
  </div>
  <div class="col s6">
    <div class="center">
    <a class="btn waves-effect waves-light blue darken-3"  href='<?= site_url('Cotizacion/borrarSuave') .'/' . $id ?>' name="Limpiar" value="Limpiar">Limpiar
        <i class="material-icons right">send</i>
    </a>
      </div>
  </div>
</div>


</div>



<?php echo form_close();?>
</div>
</div>
</div>
<script>
var urlImagenes = '<?=site_url('Equipo/imagenes')?>'
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';



function updateTokens(){
tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}

var dataSet=<?=json_encode($data);?>;

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Equipo/GenerarCotizacion.js"></script>

