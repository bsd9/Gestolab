<div class="card-panel">
  <div class="card-panel" >
  <div class="table-responsive">


<table id="listaCliente" class="highlight bordered" border="0" cellpadding="0" style="border-collapse:collapse;width:100%;">

<thead>
<tr>
  <th ><div class="text-center">Nombre</div></th>
  <th ><div class="text-center">Familia</div></th>
  <th data-orderable="false"><div class="text-center">Aciones</div></th>
</tr>
</thead>
<tr>
  <th colspan="2">
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
<th>Familia</th>
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
  foreach ($clasificacion as $cli) {?>
  <?php

    $data[]= [
    $cli->getNombre(),
    $cli->getFamilia(),
  
      

      "<a href=". site_url('Clasificacion/editar')."/".$cli->getId()."><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></a></div>"
    ];?>
  <?php }?>


<script>
    var dataSet=<?=json_encode($data);?>;
    var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    function updateTokens(){
     tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
     tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    }

 var Acciones = new Array();
    Acciones[0] = '<li><a href="<?=site_url('Clasificacion/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
    var AccionesHTML = '';

    for (var i = 0; i < Acciones.length; i++) {
      AccionesHTML = AccionesHTML + Acciones[i];
    }
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Clasificacion/ListaClasificacion.js"></script>
