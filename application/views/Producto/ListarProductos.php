<div class="card-panel">
  <div class="card-panel">
  <div class="table-responsive">
<table id="listaProductos" class="bordered highlight" border="0" cellpadding="0" cellspacing="0" style= "border collapse:collapse;width:100%" >
<thead>
<tr>
  <th></th>
<th><div class="text-center">Codigo Interno</div></th>
<th><div class="text-center">Codigo del Proveedor</div></th>
<th><div class="text-center">Producto o Servicio</div></th>
<th><div class="text-center">Formato de cotización</div></th>
<th><div class="text-center">Presentación del producto</div></th>
<th><div class="text-center">Disponiblidad</div></th>
<th><div class="text-center">Fecha Vencimiento</div></th>
<th><div class="text-center">Estado</div></th>
<th><div class="text-center">Descargar Documentos</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
</tr>
</thead>
<tr>
  <th colspan="11">
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
<th>Editar</th>
<th>Codigo Interno</th>
<th>Codigo del Proveedor</th>
<th>Producto o Servicio</th>
<th>Formato de cotización</th>
<th>Presentación del producto</th>
<th>Estado</th>
<th>Editar</th>
<th>Editar</th>
<th>Editar</th>
</tr>
</tfoot>
</table>

<!-- <div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 195px; right: 24px;">
      <a href="<?=site_url('Producto/nuevo')?>" class="btn-floating btn-large blue darken-5">
        <i class="material-icons">add</i>
      </a>
</div> -->
<?php foreach ($productos as $producto) {

    if($producto->getActivo()){
      $helper="<p hidden>1</p><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Activo'>check</i></div>";
    }else{
      $helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Inactivo'>clear</i></div>";
    }

      $data[]= [
        "<div class='center'><i style='color:green' onclick='pintarDetalles(\"". $producto->getId() . "\")' class='material-icons tooltipped' data-tooltip='Ver'>add</i></div>",
      $producto->getCodigoInterno(),
      $producto->getCodProveedor(),
      $producto->getNombre() ."<br> <span style='color: Red'>Marca:</span> " . $producto->getMarca(),
       $producto->getPresentacionSalida() . ' x ' . $producto->getCantidadSalida() . " " . $producto->getUnidadMedida() ,
      $producto->getPresentacionEntrada() . ' x ' . $producto->getCantidadEntrada() . " " . $producto->getUnidadMedida() ,
      $producto->getCantidadInventario() .' '. $producto->getPresentacionSalida(),
      $producto->fechaVencimiento,
      $helper,
      "<a id='FichaTecnica'" . $producto->getId() . " onclick='descargarFichaTecnica(" . $producto->getId() . ")' ><i style='color:green' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Descargar ficha tecnica'>play_for_work</i></a>
      <a id='HojaSeguridad'" . $producto->getId() . " onclick='descargarHojaSeguridad(" . $producto->getId() . ")' ><i style='color:blue' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Descargar hoja de seguridad'>play_for_work</i></a>",
      "<a href=". site_url('Producto/agregarPrecio')."/".$producto->getId()."><i style='color:green' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Cambiar precio'>edit</i></a>
        <a href=". site_url('Producto/editar')."/".$producto->getId()."><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar producto'>edit</i></a>"
      ];
 }?>

  </div>
  </div>
</div>


<div id="detalles" class="modal">
  <div class="modal-content-lg" >

        <div id='ndetalles'>

          </div>
          <div class="modal-footer">
                 <buttom onclick=refresh() class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>

                 <buttom id=AmpliarA target=_blank onclick=ampliar() class=" modal-action modal-close waves-effect waves-green btn-flat">Ver en tamaño completo</buttom>


            </div>

  </div>
</div>

<script>
var urlDescarga = '<?=site_url('Producto/descarga')?>'
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}

var urlDetalles = '<?=site_url('Producto/detalles')?>'
var dataSet=<?=json_encode($data);?>;
var Acciones = new Array();
Acciones[0] = '<li><a href="<?=site_url('Producto/nuevo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'
var AccionesHTML = '';
var urlAmpliar = "<?=site_url('Producto/productoDetallado').'/'?>";
var idAmpliar = 0;

for (var i = 0; i < Acciones.length; i++) {
  AccionesHTML = AccionesHTML + Acciones[i];
}

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Producto/ListarProductos.js"></script>
