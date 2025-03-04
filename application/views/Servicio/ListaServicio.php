<div class="card-panel">
<div class="card-panel">
<div class="table-responsive">
<table id="listaServicio" class="highlight bordered" border="1" cellpadding="5" style= "border-collapse:collapse" >
<thead>
<tr>
<th><div class="text-center"></div></th>
<th><div class="text-center">Orden Nº</div></th>
<th><div class="text-center">Fecha Inicio</div></th>
<th><div class="text-center">Equipo</div></th>
<th><div class="text-center">Serial</div></th>
<th><div class="text-center">Codigo Serial</div></th>
<th><div class="text-center">Servicio</div></th>
<th><div class="text-center">Fecha Fin</div></th>
<th><div class="text-center">Estado</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
</tr>
</thead>
<tr>
<th colspan="8">
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
<th>Estado</th>
<th>N </th>
<th>Fecha Inicio</th>
<th>Equipo</th>
<th>Serial</th>
<th>Codigo Interno</th>
<th>Servicio</th>
<th>Fecha Fin</th>
<th>Estado</th>
<th>Estado</th>
</tr>
</tfoot>
<tbody>
<?php
$data = [];
foreach ($servicios as $servi) {?>
<?php
if($servi->getEstado() == 0){
  $helper='Solicitado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
}
if($servi->getEstado() == 1){
  $helper='Solicitado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
}
if($servi->getEstado() == 2){
  $helper='Iniciado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
}
if($servi->getEstado() == 3){
  $helper='Pausado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
}
if($servi->getEstado() == 4){
  $helper='Detenido';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
}
if($servi->getEstado() == 5){
  $helper='Finalizado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
}
  //  else{
  //   $helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='glyphicon glyphicon-remove'></i></div>";

  $data[]= [
     "<div class='center'><i style='color:green' onclick='ModalEquipo(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Información Equipos'>info</i></div>",
  $servi->getId() ,
  $servi->getFechaSolicitud(),
  $servi->equipo,
  $servi->serial,
  $servi->codigo,
  $servi->getServicio(),
  $servi->getFechaServicio(),
  $helper,
  "<i style='color:purple' onclick='ModalHistorial(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Historial Tecnicos'>assignment_ind</i>
   <a hidden href=".site_url('Servicios/generarInforme')."/".$servi->getId()."><i style='color:purple' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Generar Informe'>assignment</i></a>
   <i style='color:blue' onclick='ModalSubir(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Subir Informe'>assignment_returned</i>
   "

  ];?>
<?php }?>
</tbody>
</table>
</div>
</div>
</div>


<div id="modal" class="modal">
<div class="modal-content">
  <h4>
    <div id='titlemodal'>
    </div>
  </h4>
<div class="container">
  <div class="input-field col s12">
  <textarea id="desc" class="materialize-textarea"></textarea>
  <label id=labeldesc for="desc">Descripcion</label>
  </div>
</div>
</div>
<div class="modal-footer">
  <button onclick='Enviar()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
</div>

</div>


<div id="detalles" class="modal bottom-sheet">
<div class="modal-content">
  <div class="card-panel">
    <h4 class="truncate">Orden numero <span id="NoCompra"></span></h4>
    <h5>Detalles</h5>
      <div id='ndetalles'></div>
    <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
        </div>
        </div>
</div>
</div>




<div id="detallesE" class="modal bottom-sheet">
<div class="modal-content">
  <div class="card-panel">
    <h4 class="truncate">Equipo </span></h4>
    <h5>Detalles</h5>
      <div id='ndetallesE'></div>
    <div class="modal-footer">
    <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
        </div>
        </div>
</div>
</div>


<div id="subir" class="modal">
<div class="modal-content">
  <div class="center"><h4>Informe del servicio</h4></div>
  <div class="card-panel">
    <h5>Subir archivo</h5>
  <?php echo form_open_multipart('Servicios/subirdocs') ?>
  <input  type ="text" hidden name='idServicio' id='idServicio'  />
  <input  type ="text" hidden name="docs" id='docs' class="validate" />
    <div class="file-field input-field">
  <div class="btn">
    <span>Archivo</span>
    <input type="file"  name="Documentos">
  </div>
<div class="file-path-wrapper">
    <input class="file-path validate"  type="text" placeholder="Sube un adjunto">
  </div>
  </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
  </div>

  <?php echo form_close();?>
</div>

</div>

<script>
var dataSet=<?=json_encode($data);?>;


var urlComenzar = '<?=site_url('Servicios/comenzar')?>';
var urlIniciar = '<?=site_url('Servicios/iniciar')?>';
var urlPausar = '<?=site_url('Servicios/pausar')?>';
var urlDetener = '<?=site_url('Servicios/detener')?>';
var urlFinalizar = '<?=site_url('Servicios/finalizar')?>';
var urlHistorial = '<?=site_url('Servicios/historial')?>';
var urlEquipoinfo = '<?=site_url('Servicios/Equipoinfo')?>';
var urlDocumentos = '<?=site_url('Servicios/subirdocs')?>';

var iddata
var mod;
var est;
var ids;

var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}

var Acciones = new Array();
Acciones[0] = '<li><a href="<?=site_url('Servicios/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
Acciones[0] = '<li><a onclick="arrastrarData()" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Actualizar informacion equipos"><i class="material-icons">add</i></a></li>'
var AccionesHTML = '';

for (var i = 0; i < Acciones.length; i++) {
  AccionesHTML = AccionesHTML + Acciones[i];
}

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Servicio/ListaServicio.js"></script>
