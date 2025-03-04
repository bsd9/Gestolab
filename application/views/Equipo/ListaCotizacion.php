<div class="card-panel">


<div class="card-panel" >
    <div class="table-responsive">
        <table id="listaEmpleado" class="highlight bordered" border="1" cellpadding="3" style="table-layout:fixed" >
            <thead>
            <tr>

                <th><div class="text-center">Numero</div></th>
                <th><div class="text-center">Cliente</div></th>
                <th><div class="text-center">Fecha</div></th>
                <th><div class="text-center">Estado</div></th>
                <th><div class="text-center">Fecha Factura</div></th>
                <th><div class="text-center">Numero</div></th>
                <th><div class="text-center">Acciones</div></th>
            </tr>
            </thead>
            <tr>
                <th colspan="5">
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
                <th>numero</th>
                <th>fecha</th>
                <th>cliente</th>
                <th>Estado</th>
                <th>Fecha Factura</th>
                <th>Numero Factura</th>
                <th>Estado</th>
            </tr>
            </tfoot>


            <?php
            $data=[];


            foreach ($cotizaciones as $usu) {
              if ($usu->getEstado() == 0){
                  $helper="<div class='text-center'>Anulado</div>";
                }if ($usu->getEstado() == 1){
                  $helper="<div class='text-center'>No Facturado</div>";
                }if ($usu->getEstado() == 2){
                  $helper="<div class='text-center'>Enviado a Facturar</div>";
                }if ($usu->getEstado() == 3){
                  $helper="<div class='text-center'>Facturado</div>";
                }if ($usu->getEstado() == 4) {
                    $helper = "<p hidden>0</p><div class='text-center'>Enviado</div>";
                }



                $data[]=[
                      $usu->getId(),

                    $usu->cliente,
                    $usu->getFecha(),
                    $helper,
                    $usu->fechaFactura,
                    "<div class='text-center'>" . $usu->numeroFactura . "</div>",
                    "<a target='_blank' href=".site_url('Cotizacion/cotizacionPDF')."/".$usu->getId()." /><div class='text-center'><i style='color:green' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Ver Y Descargar Cotizacion'>description</i></a>
                    
                    
                    
                    <i  style='color:green'  onclick='ModalEnviar(\"" . $usu->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Aceptada'>loyalty</i>
                    
                    <i  style='color:gray' onclick='ModalAnular(\"" . $usu->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Anulada'>loyalty</i>
                    
                    "
                    ];
                ?>
            <?php } ?>
        </table>
    </div>
</div>
</div>


<div id="EnviarAprobar" class="modal">
    <div class="modal-content">
        <h4>Enviar para ser Facturado</h4>
        <p>Desea enviar para facturar la orden <span id="NoCompraEnv"></span>?</p>
        <p><select name=formaPedido id=listadesplegable onchange="inputs()">
                <option disabled selected>Elija una opción</option>
                <option value="Correo Electronico">Correo Electronico</option>
                <option value="Telefono">Telefono</option>
                <option value="Documento fisico">Documento fisico</option>
                <option value="Presencial">Presencial</option>
            </select>
        <div hidden id="fechaCorreo" class="input-field"><label for="fechaCorreo">fecha del correo</label><input
                id="TfechaCorreo" name="fechaCorreo" class=datepicker type="date"/></div>
        <div hidden id="personaContacto" class="input-field"><label for="personaContacto">Persona de
                contacto</label><input id="TpersonaContacto" name="personaContacto" type="text"/></div>
        <div hidden id="Documento" class="input-field"><label for="Documento">numero de documento</label><input
                id="TDocumento" name="Documento" type="text"/></div>
        </p>
    </div>
    <div class="modal-footer">
         <buttom onclick=refresh() class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
        <button onclick='EnviarAprobar()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar
        </button>

    </div>
</div>

<div id="Anular" class="modal bottom-sheet">
    <div class="modal-content">
        <div class="container">
        <div class="card-panel">
            <h4 class="truncate">Anular Pedido <span id="NoCompraAnu"></span></h4>
            <div class="input-field"><label for="razonAnula">Razon de anulacion</label><textarea id="razonAnula"
                                                                                                 name="razonAnula"
                                                                                                 type="text"/></textarea>
            </div>

            <div class="modal-footer">
                 <buttom onclick=refresh() class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
                <button onclick='Anular()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar
                </button>
            </div>
        </div>
        </div>
    </div>
</div>

<div id="Aprobar" class="modal">
    <div class="modal-content">
        <h4>Facturar</h4>
        <p>Desea Faturar la orden <span id="NoCompraApr"></span> ?</p>
        <div class="input-field"><label for="fechapago">fecha de pago</label><input id="tfechapago" name="tfechapago"
                                                                                    class=datepicker type="date"/></div>
        <div class="input-field"><label for="flete">flete</label><input id="tflete" name="tflete" type="text"/></div>
       
        <div class="input-field"><label for="notasfactura">Notas Factura</label> <textarea class="materialize-textarea" name="notasfactura" id="notasfactura"></textarea></div>
      
    </div>
    <div class="modal-footer">
         <buttom onclick=refresh() class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
        <button onclick='AprobarFactura()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
    </div>
</div>


<div id="Datos" class="modal">
  <div class="col s12">
  <div class="card-panel">
    <h4>Datos para factura</h4>
    <div class="row">
      <div class="col s3">
        <div class="input-field"> <select type ="Select" name="tipopago">
            <option  disabled selected>Elija una opción</option>
            <option value="Contado">Contado</option>
            <option value="Credito">Credito</option>
          </select>
        <label>tipo pago</label>
        </div>
      </div>
      <div class="col s9">
        <div class="input-field"><label for="datospago">Informacion extra de pago</label> <input type ="text"  name="datospago" id="datospago"></div>
      </div>
    </div>
       <div class="input-field"><label for="validez">Validez (dias)</label> <input type ="number"  name="validez" id="validez"></div>
       <div class="input-field"><label for="notas">Notas</label> <textarea class="materialize-textarea" name="notas" id="notas"></textarea></div>
       <div class="input-field"><label for="notasfactura">Notas Factura</label> <textarea class="materialize-textarea" name="notasfactura" id="notasfactura"></textarea></div>
  </div>

</div>
<div class="modal-footer">
       <buttom onclick=refresh() class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
      <button onclick='AprobarFactura()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>

</div>
</div>

<div id="Anular" class="modal bottom-sheet">
    <div class="modal-content">
        <div class="container">
        <div class="card-panel">
            <h4 class="truncate">Anular Pedido <span id="NoCompraAnu"></span></h4>
            <div class="input-field"><label for="razonAnula">Razon de anulacion</label><textarea id="razonAnula"
                                                                                                 name="razonAnula"
                                                                                                 type="text"/></textarea>
            </div>

            <div class="modal-footer">
                 <buttom onclick=refresh() class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
                <button onclick='Anular()' class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar
                </button>
            </div>
        </div>
        </div>
    </div>
</div>




<script>
var dataSet =<?=json_encode($data);?>;
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens() {
    tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}
    var dataSet=<?=json_encode($data);?>;
    var urlAprobar = '<?=site_url('Cotizacion/AprobarFactura')?>';
    var urlAnulacion = '<?=site_url('Cotizacion/Anular')?>';
    var urlEnviarAprobar = '<?=site_url('Cotizacion/EnviarAprobar')?>';

</script>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/Equipo/ListaCotizacion.js"></script>
