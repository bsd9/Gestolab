<div class="card-panel">
  <div class="card-panel">
    <div class="table-responsive">
      <table id="listaCargo" class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse;width:100%" >

<thead>
  <tr>
    <th><div class="text-center">Nombre</div></th>
    <th><div class="text-center">Estado</div></th>
    <th data-orderable="false"><div class="text-center">Acciones</div></th>
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
    <th>Nombre</th>
    <th>Estado</th>
    <th>Acciones</th>
  </tr>
</tfoot>

<tbody>
  <?php foreach ($cargos as $cargo) {?>
    <?php
      if($cargo->getActivo()){
        $helper="<p hidden>1</p><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Activo'>check</i></div>";
      }else{
        $helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Inactivo'>clear</i></div>";
      }
      $data[]= [
      $cargo->getNombre(),
      $helper,
        "<a href=". site_url('Cargo/editar')."/".$cargo->getId()."><div class='text-center'><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></div></a>"
      ];?>
    <?php }?>
</tbody>

</table>
  </div>
  </div>
</div>
</div>

<!-- <div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 195px; right: 24px;">
      <a href="<?=site_url('Cargo/nuevo')?>" class="btn-floating btn-large blue darken-5">
        <i class="material-icons">add</i> </a> </div> -->


<script >
  var dataSet=<?=json_encode($data);?>;
  var Acciones = new Array();
  var nuevo = '<li><a href="<?=site_url('Cargo/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>';
  Acciones[0] = nuevo;
  var AccionesHTML = '';

  for (var i = 0; i < Acciones.length; i++) {
    AccionesHTML = AccionesHTML + Acciones[i];
  }

 </script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/Cargo/ListaCargo.js"></script>
