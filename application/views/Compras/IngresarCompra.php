<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open_multipart('Compras/guardar/'.$proveedor->getId(),array('id'=>'formulario'));
?>

<div class="row">

   <div class="col s12">
     <ul class="tabs">
       <li class="tab col s6"><a class="active blue-text" href="#proveedor" >Proveedor</a></li>

       <li class="tab col s6"><a class="blue-text" href="#pago">Pago</a></li>
       <div class="indicator blue" style="z-index:1"></div>
     </ul>
   </div>
 </div>
</div>

 <div id="proveedor" class="col s12 m6">
   <div class="card-panel">
     <div class="card-panel">
       <p>Proveedor <?=$proveedor->getRazonSocial();?></p>
       <p>Creado por: <?=$this->session->userdata("nombre");?></p>
    </div>
  </div>
 </div>

 <div id="pago" class="col s12 m6">
   <div class="card-panel">
     <div class="card-panel">
       <div class="row">
         <div class="col s4">
       <h5>forma de pago</h5>
       <input name="modopago" type="radio" value="Crédito" id="test1" onchange="creditoDebito('0');"/>
       <label for="test1">Crédito</label>
       <input name="modopago" type="radio" value="Débito" id="test2" checked onchange="creditoDebito('1');"/>
       <label for="test2">Débito</label>
        </div>
        <div class="col s4">
       <div class="input-field"><label for="fechapago">Fecha de Pago</label> <input type ="date" class="datepicker" name="fechapago" id="fechapago"></div>
       <div class="input-field"><label for="diaspago">dias para pago</label> <input type ="number"  name="diaspago" id="diaspago" disabled></div>
        </div>
        <div class="col s4">
          <div class="input-field"> <select type ="Select" name="divisa" onchange="getval(this);">
              <option  disabled selected>Elija una opción</option>
              <option value="COP">Pesos</option>
              <option value="USD">Dolar</option>
              <option value="EUR">Euro</option>
            </select>
          <label>Divisa</label>
          </div>
          <div id=Cambio>
          </div>
        </div>

     </div>
    </div>
  </div>
 </div>
</div>

    <div class="card-panel">
    <div class="card-panel">
      <div class="col s12 m10 offset-m1">
       <table id="productost" class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse" >
         <thead>
           <tr>
             <th>Cod. Producto</th>
             <th>Producto</th>
             <th>Cantidad</th>
             <th>Costo Unitario</th>
             <th>Costo Total</th>
             <th>Quitar</th>
           </tr>
         </thead>
        </table>
      </div>
      <div class="row">
        <div class="col s2 m2">
        <div class="input-field"><label for="codproductos">Codprod</label><input type ="text" list="listacodproductos" onkeyup="nameByCodProducto(this.value)" onchange="nameByCodProducto(this.value)" class="validate" name="codproductos" id="codproductos" /> </div>
        <datalist id="listacodproductos">
            <?php
            $codprod=[];
            foreach($productos as $prod){
              ?>
              <?php if($prod->getActivo()){
                  $codprod[]=$prod->getCodProveedor();
                  ?>
              <option  value="<?=$prod->getCodProveedor();?>"><?=$prod->getCodProveedor();?></option>
            <?php } ?>
            <?php } ?>
        </datalist>
      </div>
        <div class="col s5 m5">
       <div class="input-field"><label for="productos">Producto</label><input type ="text" list="listaproductos" onkeyup="codByNameProducto(this.value)" onchange="codByNameProducto(this.value)" class="validate" name="productos" id="productos" /> </div>
       <datalist id="listaproductos">
           <?php
           $nomprod=[];
           $costo=[];
           $cant=[];
           foreach($productos as $prod){

             ?>
             <?php if($prod->getActivo()){
                          $nomprod[]=$prod->getNombre();
                          $costo[]= $prod->costo;
                          $cant[]= $prod->getCantidadEntrada();
                          ?>
             <option  value="<?=$prod->getNombre();?>"><?=$prod->getNombre();?></option>
           <?php } ?>
           <?php } ?>
       </datalist>
      </div>
      <div class="col s2 m2">
       <div class="input-field"><label for="cantidad">Cantidad</label><input type ="number" class="validate" name="cantidad" id="cantidad" onkeyup="if(event.keyCode == 13){agregarProducto();}" /> </div>
      </div>
      <div class="col s2 m1">
       <div class="input-field"><label for="descuento">Descuento</label><input type ="number" class="validate" min=0 value=0 name="descuento" id="descuento" onkeyup="if(event.keyCode == 13){agregarProducto();}" /> </div>
      </div>
      <div class="col s12 m2">
      </br>
          <div class="center">
      <button class="btn waves-effect waves-light blue darken-3" type="button" name="Agregar" value="Agregar" onclick='agregarProducto();' >Agregar
        <i class="material-icons right">contact_phone</i>
      </button>
          </div>
       </div>
       <input type ="text" class="validate" name="cantidadesh" id="cantidadesh"  hidden />
       <input type ="text" class="validate" name="productosh" id="productosh"  hidden />
       <input type ="text" class="validate" name="descuentosh" id="descuentosh"  hidden />
    </div>
    <div class="row">
      <div class="col s2 m2">
    <h5>total : <div id="total"></div> </h5>
      </div>
      <div class="col s2 m2">
        <h5>total de items : <div id="itemtotal"></div> </h5>
      </div>
    </div>
  </div>
</div>
</div>
  <div class="center">
  <button class="btn waves-effect waves-light blue darken-3" type="button" onclick="doSumit($(this).val())" onkeypress ="return pulsar(event)" name="Guardar" value="Guardar" style="bottom: 5px">Guardar
      <i class="material-icons right">send</i>
  </button>
      <button class="btn waves-effect waves-light blue darken-3" type="button" onclick="doSumit($(this).val())" onkeypress ="return pulsar(event);" name="Enviar" value="Enviar" style="bottom: 5px">Guardar y Enviar para aprobación
          <i class="material-icons right">send</i>
      </button>
    </div>
    <input hidden type="text" name="button" id=button value="">
  <?php echo form_close();?>

<script>
var nomprod =<?=json_encode($nomprod)?>;
var costos =<?=json_encode($costo)?>;
var codprod =<?=json_encode($codprod)?>;
var cant =<?=json_encode($cant)?>;
  var urlDivisa = '<?=site_url('Compras/cambiarDivisa')?>'
var  products = [];
var cantidades = [];
var descuentos =[];
var total=0;
var itemtotal=0;
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Compras/IngresarCompra.js"></script>
