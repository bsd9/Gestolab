<div class="card-panel">
<div class="card-panel">
<table id="listaMetrica" class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse">
  <thead>
    <tr>
      <th>Ver equipos</th>
      <th>Nombre</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tr>
  <th colspan="3">
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
<th>Acciones</th>
<th>Nombre</th>
<th>Acciones</th>
</tr>
</tfoot>
</table>
<?php
$data = [];
foreach ($laboratorios as $lab) {?>
  <?php
    $data[]= [
      "<a href=". site_url('Equipo/listaLaboratorio')."/".$lab->getId()."><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Lista Equipos'>add</i></div></a>",
    $lab->getNombre(),
      "<a href=". site_url('Laboratorio/editar')."/".$lab->getId()."><div class='text-center'><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></div></a>"
    ];?>
  <?php }?>
<!-- <div class="text-center">
<h5>Bienvenido: <?=$this->session->userdata("nombre");?></h5>
<p>Recuerda tu tipo de usuario es <?=$this->session->userdata("tipo");?></p>
</div> -->

</div>
</div>
<script>
  var dataSet=<?=json_encode($data);?>;

  var Acciones = new Array();

if("<?=$this->session->userdata("tipo")?>" == "General"){
  Acciones[0] = '<li><a href="<?=site_url('Laboratorio/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
}

  var AccionesHTML = '';
  for (var i = 0; i < Acciones.length; i++) {
    AccionesHTML = AccionesHTML + Acciones[i];
  }

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Laboratorio/Laboratorio.js"></script>
