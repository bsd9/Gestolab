<div class="card-panel">
  <div class="card-panel">
  <div class="table-responsive">
<table id="listaEmpleado" class="highlight bordered" border="1" cellpadding="3" style="border-collapse: collapse;width:100%;" >
<thead>
<tr>
<th><div class="text-center">Nombre</div></th>
<th><div class="text-center">Apellido</div></th>
<th><div class="text-center">Email</div></th>
<th><div class="text-center">Usuario</div></th>
<th><div class="text-center">Tipo</div></th>
<th><div class="text-center">Telefono</div></th>
<th><div class="text-center">Estado</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
</tr>
</thead>
<tr>
  <th colspan="7">
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
<th>Apellido</th>
<th>Email</th>
<th>Usuario</th>
<th>Tipo</th>
<th>Telefono</th>
<th>Estado</th>
<th>Acciones</th>
</tr>
</tfoot>




<?php
$data=[];
foreach ($usuarios as $usu) {
if($usu->getActivo()){
$helper="<p hidden>1</p><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Activo'>check</i></div>";
}
else{
$helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Inactivo'>clear</i></div>";
}
$data[]=[
  $usu->getNombre(),
  $usu->getApellidos(),
  "<p class='tooltipped truncate' data-delay='150' data-tooltip=\"".$usu->getEmail()."\" >" . $usu->getEmail()."</p>",
  "<p class='tooltipped truncate' data-delay='150' data-tooltip=\"".$usu->getUsuario()."\" >" . $usu->getUsuario()."</p>",
  "<p class='tooltipped truncate' data-delay='150' data-tooltip=\"".$usu->getTipo()."\" >" . $usu->getTipo()."</p>",

  "<p class='tooltipped truncate' data-delay='150' data-tooltip=\"".$usu->getCelular()." - ".$usu->getFijo() ."\" >" . $usu->getCelular()." - ". $usu->getFijo()."</p>",
  $helper,
  "<div class='text-center'><a href=".site_url('Usuario/responsabilidades')."/".$usu->getId()."><i style='color:green' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Permisos'>edit</i></a>
    <a href=".site_url('Usuario/editar')."/".$usu->getId()."><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></a></div>"
    ] ;
?>
  <?php } ?>



</table>
  </div>
  </div>
  </div>
<script>
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}

var Acciones = new Array();
  //  Acciones[0] = '<?php if ($this->session->userdata('id') == 2 && $this->session->userdata('id') == 85) { ?><li><a href="<?=site_url('Usuario/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li><?php } ?>'
   Acciones[0] = '<li><a href="<?=site_url('Usuario/nuevo')."/".$clienteId;?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
   var AccionesHTML = '';

   for (var i = 0; i < Acciones.length; i++) {
     AccionesHTML = AccionesHTML + Acciones[i];
   }

var dataSet=<?=json_encode($data);?>;


</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Usuarios/ListaUsuario.js"></script>

