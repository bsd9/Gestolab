<div class="card-panel">
<div class="card-panel">
<div class="table-responsive">
<table id="listaresolucion" class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse;width: 100%" >
<thead>
<tr>
<th><div class="text-center">Resolucion</div></th>
<th><div class="text-center">Fecha de Expedicion</div></th>
<th><div class="text-center">Fecha de Vencimiento</div></th>
<th><div class="text-center">Tipo</div></th>
<th><div class="text-center">Prefijo</div></th>
<th><div class="text-center">Desde</div></th>
<th><div class="text-center">Hasta</div></th>
<th><div class="text-center">Ultimo</div></th>
<th><div class="text-center">Establecimiento</div></th>
<th><div class="text-center">Estado</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
</tr>
</thead>
<tr>
<th colspan="11">
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
  <th>Resolucion</th>
  <th>Fecha de Expedicion</th>
  <th>Fecha de Vencimiento</th>
  <th>Tipo</th>
  <th>Prefijo</th>
  <th>Desde</th>
  <th>Hasta</th>
  <th>Ultimo</th>
  <th>Establecimiento</th>
  <th>Estado</th>
  <th>Acciones</th>
</tr>
</tfoot>
<tbody>

<?php foreach ($Resoluciones as $resolucion) {?>
<?php
  if($resolucion->getEstado()){
    $helper="<p hidden>1</p><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Activo'>check</i></div>";
  }else{
    $helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Inactivo'>clear</i></div>";
  }
  $data[]= [
  $resolucion->getResolucion(),
  $resolucion->getFechaExpedicion(),
  $resolucion->getFechaVencimiento(),
  $resolucion->getTipo(),
  $resolucion->getPrefijo(),
  $resolucion->getDesde(),
  $resolucion->getHasta(),
  $resolucion->getUltimo(),
  $resolucion->Establecimiento,
  $helper,
    "<a href=". site_url('Resolucion/editar')."/".$resolucion->getId()."><div class='text-center'><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></div></a>"
  ];?>
<?php }?>
</tbody>
</table>
</div>
</div>
</div>


<script>
var dataSet=<?=json_encode($data);?>;
var Acciones = new Array();
Acciones[0] = '<li><a href="<?=site_url('Resolucion/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>';
var AccionesHTML = '';

for (var i = 0; i < Acciones.length; i++) {
AccionesHTML = AccionesHTML + Acciones[i];
}

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets\js\Resolucion\ListaResolucion.js"></script>
