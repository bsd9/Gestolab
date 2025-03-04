<div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s4"><a class="blue-text" href="#listaServicioP">Nuevos</a></li>
        <li class="tab col s4"><a class="blue-text" href="#listaServicioE">En Ejecucion</a></li>
        <li class="tab col s4"><a class="blue-text" href="#listaServicioF">Finalizados</a></li>
        <div class="indicator blue" style="z-index:3"></div>
      </ul>
    </div>
</div>


<div id="listaServicioP" class ="card-panel" >
<div class="card-panel" >
<div class="row">
<div class="col s6">
<div class="table-responsive">
  <h5 class="center">Listado de Servicios Nuevos</h5>
<table id="Pendiente" class="highlight bordered" border="1" cellpadding="5" style= "border-collapse:collapse; width:100%" >
<thead>
<tr>
<th><div class="text-center"></div></th>
<th><div class="text-center">Orden de trabajo Nº</div></th>
<th><div class="text-center">Orden de Servicio Nº</div></th>
<th><div class="text-center">Fecha Inicio</div></th>
<th><div class="text-center">Equipo</div></th>
<th><div class="text-center">Serial</div></th>
<th><div class="text-center">Codigo Interno</div></th>
<th><div class="text-center">Cliente</div></th>
<th><div class="text-center">Servicio</div></th>
<th><div class="text-center">Fecha Fin</div></th>
<th><div class="text-center">Estado</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
</tr>
</thead>
<tr>
<th colspan="9">
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
<th>N </th>
<th>Fecha Inicio</th>
<th>Equipo</th>
<th>Serial</th>
<th>Codigo</th>
<th>Cliente</th>
<th>Servicio</th>
<th>Fecha Fin</th>
<th>Estado</th>
<th>Estado</th>
</tr>
</tfoot>
<tbody>
<?php
$data = [];
foreach ($pendientes as $pen) {?>
<?php
if($pen->getEstado() == 0){
$helper1='Solicitado';
}
if($pen->getEstado() == 1){
$helper1='Solicitado';
}
if($pen->getEstado() == 2){
$helper1='Iniciado';
}
if($pen->getEstado() == 3){
$helper1='Pausado';
}
if($pen->getEstado() == 4){
$helper1='Detenido';
}
if($pen->getEstado() == 5){
$helper1='Finalizado';
}
if($pen->getEstado() == 6){
$helper1='No Finalizado';
}

$data[]= [
 "<div class='center'><i style='color:green' onclick='ModalEquipo(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Información Equipos'>info</i></div>",
"<div class='center'>". $pen->getId() ."</div>",
$pen->idOrden,
$pen->getFechaSolicitud(),
$pen->equipo,
$pen->serial,
$pen->codigo,
$pen->Cliente,
$pen->getServicio(),
$pen->getFechaServicio(),
$helper1,
"<i style='color:purple' onclick='ModalHistorial(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Historial Tecnicos'>assignment_ind</i>
<i style='color:yellow' onclick='if(". $pen->getEstado() . " == 0)
{ModalComenzar(\"". $pen->getId() . "\")}
else{ ModalIniciar(\"". $pen->getId() . "\")}'
class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Comenzar'>play_arrow</i>
<i style='color:blue' onclick='ModalPausar(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Pausar'>pause</i>
<i style='color:red' onclick='ModalDetener(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Detener'>stop</i>
<i style='color:green' onclick='ModalFinalizar(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Finalizar'>check</i>
<i style='color:red' onclick='ModalNoFinalizar(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='No Finalizado'>cancel</i>
<a hidden href=".site_url('Servicios/generarInforme')."/".$pen->getId()."><i style='color:purple' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Generar Informe'>assignment</i></a>
<i style='color:blue' onclick='ModalSubir(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Subir Informe'>assignment_returned</i>
"

];?>
<?php }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>


<div id="listaServicioE" class ="card-panel" >
<div class="card-panel" >
<div class="row">
<div class="col s6">
<div class="table-responsive">
  <h5 class="center">Listado de Servicios En Ejecucion</h5>
<table id="Ejecucion" class="highlight bordered" border="1" cellpadding="5" style= "border-collapse:collapse; width:100%" >
<thead>
<tr>
<th><div class="text-center"></div></th>
<th><div class="text-center">Orden de trabajo Nº</div></th>
<th><div class="text-center">Orden de Servicio Nº</div></th>
<th><div class="text-center">Fecha Inicio</div></th>
<th><div class="text-center">Equipo</div></th>
<th><div class="text-center">Serial</div></th>
<th><div class="text-center">Codigo Interno</div></th>
<th><div class="text-center">Cliente</div></th>
<th><div class="text-center">Tecnico Asignado</div></th>
<th><div class="text-center">Servicio</div></th>
<th><div class="text-center">Fecha Fin</div></th>
<th><div class="text-center">Estado</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
</tr>
</thead>
<tr>
<th colspan="9">
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
<th>N </th>
<th>Fecha Inicio</th>
<th>Equipo</th>
<th>Serial</th>
<th>Codigo</th>
<th>Cliente</th>
<th>Tecnico</th>
<th>Servicio</th>
<th>Fecha Fin</th>
<th>Estado</th>
<th>Estado</th>
</tr>
</tfoot>
<tbody>
<?php
$data2 = [];
foreach ($ejecucion as $eje) {?>
<?php
if($eje->getEstado() == 0){
$helper1='Solicitado';
}
if($eje->getEstado() == 1){
$helper1='Solicitado';
}
if($eje->getEstado() == 2){
$helper1='Iniciado';
}
if($eje->getEstado() == 3){
$helper1='Pausado';
}
if($eje->getEstado() == 4){
$helper1='Detenido';
}
if($eje->getEstado() == 5){
$helper1='Finalizado';
}
if($eje->getEstado() == 6){
$helper1='No Finalizado';
}

$data2[]= [
 "<div class='center'><i style='color:green' onclick='ModalEquipo(\"". $eje->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Información Equipos'>info</i></div>",
"<div class='center'>". $eje->getId() ."</div>",
$eje->idOrden,
$eje->getFechaSolicitud(),
$eje->equipo,
$eje->serial,
$eje->codigo,
$eje->Cliente,
$eje->Tecnico,
$eje->getServicio(),
$eje->getFechaServicio(),
$helper1,
"<i style='color:purple' onclick='ModalHistorial(\"". $eje->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Historial Tecnicos'>assignment_ind</i>
<i style='color:yellow' onclick='if(". $eje->getEstado() . " == 0)
{ModalComenzar(\"". $eje->getId() . "\")}
else{ ModalIniciar(\"". $eje->getId() . "\")}'
class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Comenzar'>play_arrow</i>
<i style='color:blue' onclick='ModalPausar(\"". $eje->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Pausar'>pause</i>
<i style='color:red' onclick='ModalDetener(\"". $eje->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Detener'>stop</i>
<i style='color:green' onclick='ModalFinalizar(\"". $eje->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Finalizar'>check</i>
<i style='color:red' onclick='ModalNoFinalizar(\"". $eje->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='No Finalizado'>cancel</i>
<a hidden href=".site_url('Servicios/generarInforme')."/".$eje->getId()."><i style='color:purple' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Generar Informe'>assignment</i></a>
<i style='color:blue' onclick='ModalSubir(\"". $eje->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Subir Informe'>assignment_returned</i>
"

];?>
<?php }?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>






<div  id="listaServicioF" class ="card-panel" >
<div class="card-panel" >
<div class="row">
  <div class="col s6">
<div class="table-responsive">
<h5 class="center">Listado de Servicios Finalizados</h5>
<table id="Finalizado" class="highlight bordered" border="1" cellpadding="5" style= "border-collapse:collapse; width:100%" >
<thead>
<tr>
<th><div class="text-center"></div></th>
<th><div class="text-center">Orden de trabajo Nº</div></th>
<th><div class="text-center">Orden de Servicio Nº</div></th>
<th><div class="text-center">Fecha Inicio</div></th>
<th><div class="text-center">Equipo</div></th>
<th><div class="text-center">Serial</div></th>
<th><div class="text-center">Codigo Interno</div></th>
<th><div class="text-center">Cliente</div></th>
<th><div class="text-center">Tecnico Asignado</div></th>
<th><div class="text-center">Servicio</div></th>
<th><div class="text-center">Fecha Fin</div></th>
<th><div class="text-center">Estado</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
</tr>
</thead>
<tr>
<th colspan="9">
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
<th>N </th>
<th>Fecha Inicio</th>
<th>Equipo</th>
<th>Serial</th>
<th>Codigo Interno</th>
<th>Cliente</th>
<th>Tecnico</th>
<th>Servicio</th>
<th>Fecha Fin</th>
<th>Estado</th>
<th>Estado</th>
</tr>
</tfoot>
<tbody>
<?php
$data1 = [];
foreach ($finalizados as $servi) {?>
<?php
if($servi->getEstado() == 5){
$helper2='Finalizado';
}
if($servi->getEstado() == 6){
$helper2='No Finalizado';
}

$data1[]= [
"<div class='center'><i style='color:green' onclick='ModalEquipo(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Información Equipos'>info</i></div>",
"<div class='center'>". $servi->getId() ."</div>",
$servi->idOrden,
$servi->getFechaSolicitud(),
$servi->equipo,
$servi->serial,
$servi->codigo,
$servi->Cliente,
$servi->Tecnico,
$servi->getServicio(),
$servi->getFechaServicio(),
$helper2,
"<i style='color:purple' onclick='ModalHistorial(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Historial Tecnicos'>assignment_ind</i>
<i style='color:yellow' onclick='if(". $servi->getEstado() . " == 0)
{ModalComenzar(\"". $servi->getId() . "\")}
else{ ModalIniciar(\"". $servi->getId() . "\")}'
class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Comenzar'>play_arrow</i>
<i style='color:blue' onclick='ModalPausar(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Pausar'>pause</i>
<i style='color:red' onclick='ModalDetener(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Detener'>stop</i>
<i style='color:green' onclick='ModalFinalizar(\"". $servi->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Finalizar'>check</i>
<i style='color:red' onclick='ModalNoFinalizar(\"". $pen->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='No Finalizado'>cancel</i>
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
</div>
</div>


<div id="modal" class="modal">
  <div class="modal-content">
    <h4>
      <div id="titlemodal"></div>
    </h4>
    <div class="container">
      <div class="input-field col s12">
        <!-- Aquí se muestra el datalist solo si es necesario -->
        <textarea id="desc" class="materialize-textarea" list="comentarios"></textarea>
        <label id="labeldesc" for="desc">Descripción</label>

        <!-- Datalist con opciones Pausar y Detener -->
        <datalist id="comentarios">
          <option value="RecepcionEquipo">
          <option value="Ejecucion">
          <option value="Informe">
        </datalist>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button onclick="Enviar()" class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
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
var dataSetF=<?=json_encode($data1);?>;
var dataSetE=<?=json_encode($data2);?>;
var urlHistorial = '<?=site_url('Servicios/historial')?>';
var urlEquipoinfo = '<?=site_url('Servicios/Equipoinfo')?>';
var urlComenzar = '<?=site_url('Servicios/comenzar')?>';
var urlIniciar = '<?=site_url('Servicios/iniciar')?>';
var urlPausar = '<?=site_url('Servicios/pausar')?>';
var urlDetener = '<?=site_url('Servicios/detener')?>';
var urlFinalizar = '<?=site_url('Servicios/finalizar')?>';
var urlNoFinalizar = '<?=site_url('Servicios/Nofinalizar')?>';
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

$(document).ready(function(){
  $('ul.tabs').tabs({responsiveThreshold : Infinity});

});


</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Servicio/ListaServicio1.js"></script>
