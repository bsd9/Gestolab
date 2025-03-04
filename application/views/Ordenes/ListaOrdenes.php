<div class="card-panel">
<div class="card-panel">
    <div class="table-responsive">

        <table id="listaPedidos" class="highlight bordered" border="0" cellpadding="0" style= "border collapse:collapse;width:100%">
            <thead>
            <tr>
                <th>
                    <div class="text-center"></div>
                </th>
                <th>
                    <div class="text-center">Orden de Servicio Nº</div>
                </th>
                <th>
                    <div class="text-center">Fecha Creacion</div>
                </th>
                <th>
                    <div class="text-center">Cliente</div>
                </th>
                <th>
                    <div class="text-center">Estado</div>
                </th>
                <th>
                    <div class="text-center">Acciones</div>
                </th>
            </tr>
            </thead>
            <tr>
                <th colspan="5">
                    <div class="center">
                        <div class="preloader-wrapper big active">
                            <div class="spinner-layer spinner-blue-only">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="gap-patch">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
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
                <th>N°</th>
                <th>Fecha creacion</th>
                <th>Cliente</th>
                <th>estado</th>
                <th>Estado</th>
            </tr>
            </tfoot>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- <div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 195px; right: 24px;">
      <a onclick="ModalEstablecimiento()" class="btn-floating btn-large blue darken-5">
        <i class="material-icons">add</i>
      </a>
</div> -->



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





<div id="Aprobar" class="modal">
    <div class="modal-content">
        <?php echo form_open_multipart('Ordenes/Aprobar') ?> 
        <input  type ="text" hidden name='idOrden' id='idOrden'  />    
        <h4 class="truncate">Aprobar Orden numero <span id="NoCompraApr"></span></h4>
        <h5>Desea Aprobar la orden</h5>
        <div class="card-panel">
        <h6>Señor cliente recuerde que al darle click al "BOTÓN ACEPTAR", usted esta aceptando todas las condiciones comerciales establecidas por el ejecutivo de venta a cargo de su proceso. </h6>
        <h6>Esta opción no tiene vuelta atrás y por consiguiente se realizara la ejecución de los servicios y la facturación de los mismos.
        </h6>
        </br>        
        <h6>ATT:</h6>
        <h6>Departamento administrativo y financiero IASOTECG</h6>
        </div>
    </div>
    <div class="modal-footer">
         <buttom onclick=refresh() class=" modal-action modal-close waves-effect waves-green btn-flat">Volver</buttom>
        <button  class=" modal-action modal-close waves-effect waves-green btn-flat">Aceptar</button>
    </div>
       <?php echo form_close();?>  
</div>



<?php
$data = [];
foreach ($ordenes as $orden) { ?>
    <?php

    if ($orden->getEstado() == 1) {
        $helper = "<p hidden>1</p><div class='text-center'>Nueva</div>";
    }
    if ($orden->getEstado() == 2) {
        $helper = "<p hidden>0</p><div class='text-center'>Aprobada</div>";
    }
    if ($orden->getEstado() == 0) {
        $helper = "<p hidden>0</p><div class='text-center'>Anulado</div>";
    }

    $data[] = [
        "<div class='center'><i style='color:green' onclick='pintarDetalles(\"" . $orden->getId() . "\")' class='material-icons tooltipped' data-tooltip='Detalles'>add</i></div>",
        "<div class='text-center'>" . $orden->getId() . "</div>",
        $orden->getFechaCreacion(),
        $orden->getRazonSocialCliente(),
        $helper,
        "
       <i style='color:blue' onclick='ModalAprobar(\"" . $orden->getId() . "\")' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Aprobar'>thumb_up</i>
       <a  href=" . site_url('Ordenes/editar') . "/" . $orden->getId() . "><i style='color:orange' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></a>"

    ];
    ?>
<?php } ?>


<script>

    var dataSet =<?=json_encode($data);?>;
    var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    function updateTokens() {
        tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    }
    var urlEnviarAprobar = '<?=site_url('Ordenes/EnviarAprobar')?>';
    var urlAprobar = '<?=site_url('Ordenes/Aprobar')?>';
    var urlEnviar = '<?=site_url('Ordenes/Enviar')?>';
    var urlPreEnviar = '<?=site_url('Ordenes/PreEnviar')?>';
    var urlDetalles = '<?=site_url('Ordenes/detalles')?>'
    var urlNuevo = "<?=site_url('Ordenes/nuevo') . '/a'?>"
    var urlAnulacion = "<?=site_url('Ordenes/Anular')?>"

    var Acciones = new Array();

 var Acciones = new Array();
    Acciones[0] = '<li><a href="<?=site_url('Ordenes/solicitarServiciosPorCliente')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'

    var AccionesHTML = '';

    for (var i = 0; i < Acciones.length; i++) {
        AccionesHTML = AccionesHTML + Acciones[i];
    }


</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/Ordenes/ListaOrdenes1.js"></script>
