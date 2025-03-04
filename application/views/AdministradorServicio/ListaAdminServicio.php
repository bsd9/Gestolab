<div class="card-panel">
  <div class="card-panel" >
  <div class="table-responsive">


<table id="listaCliente" class="highlight bordered" border="0" cellpadding="0" style="border-collapse:collapse;width:100%;">

<thead>
<tr>
  <th ><div> </div></th>
  <th ><div class="text-center">Nombre </div></th>
  <th ><div class="text-center">Medida </div></th>
  <th ><div class="text-center">Variables </div></th>
  <th ><div class="text-center">Estado </div></th>
  <th data-orderable="false"><div class="text-center">Aciones</div></th>
</tr>
</thead>
<tr>
  <th colspan="6">
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
<th>Editar</th>
<th>Nombre</th>
<th>Medida</th>
<th>Editar</th>
<th>Editar</th>
<th>Editar</th>
</tr>
</tfoot>

<tbody>
</tbody>
</table>
  </div>
  </div>
</div>



<?php
  $data=[];
  foreach ($AdministradorServicio as $admin) {?>
  <?php
     if($admin->getVariable()){
      $helper="<p hidden>1</p><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Activo'>check</i></div>";
    }else{
      $helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Inactivo'>clear</i></div>";
    }
     if($admin->getEstado()){
      $helper2="<p hidden>1</p><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Activo'>check</i></div>";
    }else{
      $helper2="<p hidden>0</p><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Inactivo'>clear</i></div>";
    }

    $data[]= [
     "<i style='color:green' onclick='ModalHistorial(\"". $admin->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Ver Precios'>assignment</i>",
    $admin->getNombre(),
    $admin->getUnidadMedida(),
    $helper,
    $helper2,
      "<div class='center'><a href=". site_url('AdministradorServicio/editar')."/".$admin->getId()."><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></a></div>"
    ];?>
  <?php }?>

  <div id="detalles" class="modal bottom-sheet">
  <div class="modal-content">
    <div class="card-panel">
      <h4 class="truncate">Precios</h4>
      <h5>Detalles</h5>
        <div id='ndetalles'></div>
      <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
          </div>
          </div>
  </div>
</div>

<script>
    var dataSet=<?=json_encode($data);?>;

    var urlHistorial = '<?=site_url('AdministradorServicio/historial')?>';
    var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    function updateTokens(){
     tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    }
    var idCliente;
    var idAmpliar = 0

 var Acciones = new Array();
    Acciones[0] = '<li><a href="<?=site_url('AdministradorServicio/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
    var AccionesHTML = '';

    for (var i = 0; i < Acciones.length; i++) {
      AccionesHTML = AccionesHTML + Acciones[i];
    }

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/AdminServicio/ListaAdminServicio.js"></script>
