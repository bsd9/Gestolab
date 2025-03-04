  <div id="detalles" class="modal">
  <div class="modal-content">

        <div id='ndetalles'>
      <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
          </div>
          </div>
  </div>
</div>

<div class="card-panel">
  <div class="card-panel">
  <div class="table-responsive">

<table id="listaProveedor" class="highlight bordered" border="1" cellpadding="3" style= "border collapse:collapse; width:100%;" >
<thead>
<tr>
  <th></th>
  <th><div class="text-center">Razón Social</div></th>
  <th><div class="text-center">NIT</div></th>
  <th><div class="text-center">Localizacion</div></th>
  <th><div class="text-center">Contactos</div></th>
  <th><div class="text-center">Estado</div></th>
  <th><div class="text-center">Acciones</div></th>
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
  <th>Editar</th>
<th>Razón Social</th>
<th>NIT</th>
<th>Estado</th>
<th>Estado</th>
<th>Estado</th>
<th>Editar</th>
</tr>
</tfoot>
<tbody>
<?php foreach ($proveedores as $prov) {?>

  <div id='<?php echo "c".$prov->getId();?>' class="modal bottom-sheet" >
    <div class="modal-content">
      <div class="card-panel" style ="width:100%">
        <h4 class="truncate">Contactos de: <?php echo $prov->getRazonSocial();?></h4>
        <div id='<?php echo "cd".$prov->getId();?>'></div>
        <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
        </div>
      </div>
      </div>
    </div>

</div>
  <div id='<?php echo "d".$prov->getId();?>' class="modal bottom-sheet">
    <div class="modal-content">
      <div class="card-panel" style="width:100%">
        <h4 class="truncate">Direcciones de: <?php echo $prov->getRazonSocial();?></h4>
        <div id='<?php echo "dd".$prov->getId();?>'></div>
        <div class="modal-footer">
        <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
        </div>
      </div>
    </div>
  </div>

  <?php
    if($prov->getEstado()){
      $helper="<p hidden>1</p><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Activo'>check</i></div>";
    }else{
      $helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Inactivo'>clear</i></div>";
    }
    $data[]= [
      "<div class='center'><i style='color:green' onclick='pintarDetalles(\"". $prov->getId() . "\")' class='material-icons tooltipped' data-tooltip='Detalles'>add</i></div>",

    $prov->getRazonSocial(),
    $prov->getNIT(),
    "<div class='center'><button data-target='d".$prov->getId()."' onclick='pintarDirecciones(".$prov->getId().");' class='btn modal-trigger blue darken-3'><i class='material-icons'>info_outline</i></button></div>",
    "<div class='center'><button data-target='c".$prov->getId()."' onclick='pintarContactos(".$prov->getId().");' class='btn modal-trigger blue darken-3'><i class='material-icons'>contact_phone</i></button></div>",
      $helper,
      "<div class='text-center'><a href=". site_url('Compras/nuevo')."/".$prov->getId()."><i stype='color:blue' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Comprar'>shopping_cart</i></a>".
      "<a href=". site_url('Proveedor/editar')."/".$prov->getId()."><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></a></div>"
    ];?>

  <?php }?>
</tbody>
</table>
  </div>
  </div>
  </div>

<script>
      var dataSet=<?=json_encode($data);?>;
var urlContactos = '<?=site_url('Proveedor/contactos')?>'
var urlDirecciones = '<?=site_url('Proveedor/direcciones')?>'
var urlDetalles = '<?=site_url('Proveedor/detalles')?>'

var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}

var Acciones = new Array();
Acciones[0] = '<li><a href="<?=site_url('Proveedor/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
var AccionesHTML = '';

for (var i = 0; i < Acciones.length; i++) {
  AccionesHTML = AccionesHTML + Acciones[i];
}

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Proveedor/ListaProveedor.js"></script>
