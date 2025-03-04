<div class="card-panel">
  <div class="card-panel" >
  <div class="table-responsive">


<table id="listaCliente" class="highlight bordered" border="0" cellpadding="0" style="border-collapse:collapse;width:100%;">

<thead>

<tr>
  <th ><div class="text-center">Razón Social</div></th>
  <th ><div class="text-center">NIT</div></th>
  <th data-orderable="false"><div class="text-center">Aciones</div></th>
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
<th>Razón Social</th>
<th>NIT</th>
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
  foreach ($clientes as $cli) {?>
  <?php

    $data[]= [
    $cli->getRazonSocial(),
    $cli->getNIT(),
      "<div class='center'><a href=". site_url('Servicios/ListaEquipo')."/".$cli->getId()."><i style='color:Green' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Equipos'>assignment</i></a>"
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
    var idCliente;
    var urlAmpliar = "<?=site_url('Cliente/ClienteDetallado').'/'?>"
    var urlDetallesCliente = '<?=site_url('Cliente/detalles')?>'
    var idAmpliar = 0

 var Acciones = new Array();
    Acciones[0] = '<li><a href="<?=site_url('Cliente/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
    var AccionesHTML = '';

    for (var i = 0; i < Acciones.length; i++) {
      AccionesHTML = AccionesHTML + Acciones[i];
    }
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Cliente/ListaClienteServicio.js"></script>
