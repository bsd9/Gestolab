<div class="card-panel">
  <div class="card-panel">
  <div class="table-responsive" style="width:auto">

<table id="listaCompras" class="highlight bordered"  style= "border collapse:collapse;width:100%" >
<thead>
<tr>
  <th><div class="text-center">Detalles</div></th>
  <th><div class="text-center">N°</div></th>
  <th><div class="text-center">Fecha Creacion</div></th>
  <th><div class="text-center">Proveedor</div></th>
  <th><div class="text-center">Estado</div></th>
  <th><div class="text-center">Acciones</div></th>
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
<th>Acciones</th>
<th>N°</th>
<th>Fecha Creacion</th>
<th>Proveedor</th>
<th>Estado</th>
<th>Acciones</th>
</tr>
</tfoot>
<tbody>
</tbody>
</table>
  </div>
  </div>
  </div>

  <!-- <div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 195px; right: 24px;">
        <button onclick="nuevo()" class="btn-floating btn-large blue darken-5">
          <i class="material-icons">add</i>
        </button>
  </div> -->

  <div id="Nuevo" class="modal">
    <div class="modal-content">
      <div class="input-field"><label for="cliente">Razon social del Proveedor</label><input type ="text" list="proveedores"  class="validate" name="proveedor" id="proveedor" /> </div>
      <datalist id="proveedores">
          <?php
          foreach($proveedores as $prove){
            ?>
            <?php if($prove->getEstado()){ ?>
            <option  value="<?=$prove->getRazonSocial();?>"><?=$prove->getRazonSocial();?></option>
          <?php } ?>
          <?php } ?>
      </datalist>

    </div>
    <div class="modal-footer">
      <buttom onclick=refresh() class="modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
      <button onclick='redirectNew()' class="modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
    </div>
  </div>

<div id="detalles" class="modal bottom-sheet">
  <div class="modal-content">
    <div class="card-panel">
      <h4 class="truncate">Orden de Compra numero <span id="NoCompra"></span></h4>
      <h5>Detalles</h5>
        <div id='ndetalles'></div>
      <div class="modal-footer">

      <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
          </div>
          </div>
  </div>
</div>

<div id="autorizar" class="modal">
  <div class="modal-content">
    <h4>Autorizar</h4>
    <p>desea que se autorize la entrada de la mercancia segun la orden de compra <span id="NoCompraEnv"></span>?</p>
  </div>
  <div class="modal-footer">
     <buttom onclick=refresh() class="modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
    <button onclick='autorizar()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
  </div>
</div>

<div id="llegoBodega" class="modal">
  <div class="modal-content">
    <h4>Registro de ingreso</h4>
    <p>Se Observa que la mercancia ya llego a la bodega y queda pediente ingresar la informacion de la orden de compra <span id="NoCompraApr"></span></p>
  </div>
  <div class="modal-footer">
     <buttom onclick=refresh() class="modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
    <button onclick='llegoBodega()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
  </div>
</div>

<div id="verificar" class="modal">
  <div class="modal-content">
    <h4>Registro de ingreso</h4>
    <p>Se Verifico que los items de la orden de compra <span id="NoCompraApr"></span> llegaron de forma adecuada para ser ingresados al sistema</p>
  </div>
  <div class="modal-footer">
     <buttom onclick=refresh() class="modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
    <button onclick='verificar()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
  </div>
</div>


<?php
  $data=[];
  foreach ($ordenes as $orden) {?>
<?php

    if($orden->getEstado()==1){
      $helper="<p hidden>1</p><div class='text-center'>Nueva</div>";
    }
    if($orden->getEstado()==2){
      $helper="<p hidden>0</p><div class='text-center'>Autorizada</div>";
    }
    if($orden->getEstado()==3){
      $helper="<p hidden>0</p><div class='text-center'>Llego a Bodega</div>";
    }
    if($orden->getEstado()==4){
      $helper="<p hidden>0</p><div class='text-center'>Verificada</div>";
    }
    if($orden->getEstado()==5){
      $helper="<p hidden>0</p><div class='text-center'>Ingresada</div>";
    }
    $data[]= [
      "<div class='center'><i style='color:green' onclick='pintarDetalles(\"". $orden->getId() . "\")' class='material-icons tooltipped' data-tooltip='Detalles'>add</i></div>",
      $orden->getId(),
      $orden->getFechaCreacion(),
      $orden->getRazonSocialProveedor(),
      $helper,
      "<div class='center'><i style='color:red' onclick='Modalautorizar(\"". $orden->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Autorizar'>open_in_browser</i>
       <i style='color:blue' onclick='ModalllegoBodega(\"". $orden->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='llega a Bodega'>thumb_up</i>
       <i style='color:green' onclick='Modalverificar(\"". $orden->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Verificar'>loyalty</i>
       <a href=". site_url('Inventario/nuevo')."/".$orden->getId()."><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Agregar a inventario'>input</i></a>
       <a href=". site_url('Compras/editar')."/".$orden->getId()."><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></a>
       <a  target='_blank' href=". site_url('Compras/generarPDF')."/".$orden->getId()."><i style='color:gray' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Imprimir orden de compra'>print</i></a></div>"
    ];

    ?>
  <?php }?>


<script>
var dataSet=<?=json_encode($data);?>;
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}


var urlObtenerID = '<?=site_url('Compras/obtenerID')?>'
var urlautorizar = '<?=site_url('Compras/autorizar')?>'
var urlllegoBodega = '<?=site_url('Compras/llegoBodega')?>'
var urlverificar = '<?=site_url('Compras/verificar')?>'
var urlDetalles = '<?=site_url('Compras/detalles')?>'
var urlNuevo = '<?=site_url('Compras/Nuevo')?>'

var Acciones = new Array();
Acciones[0] = '<li><a onclick="nuevo()"  class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
var AccionesHTML = '';

for (var i = 0; i < Acciones.length; i++) {
  AccionesHTML = AccionesHTML + Acciones[i];
}
var mod;
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Compras/ListarCompra.js"></script>

