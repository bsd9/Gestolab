<?php if ($visible): ?>
  <div class="container">
<?php endif; ?>


<div class="row">

   <div class="col s10">
     <ul class="tabs">
       <li class="tab col s4"><a class="active blue-text" href="#info" >Información General</a></li>
       <li class="tab col s4"><a class="blue-text" href="#historial">Facturas</a></li>
       <li class="tab col s4"><a class="blue-text" href="#cotizacion">Cotizaciones</a></li>

       <div class="indicator blue" style="z-index:1"></div>
     </ul>
   </div>
 </div>

   <div id="cotizacion" class="card-panel">
     <div class="card-panel">

       <table id="listaCotizacion" class="highlight bordered"  >
       <thead>
       <tr>
         <th><div class="text-center">Pedido</div></th>
         <th><div class="text-center">Cliente</div></th>
         <th><div class="text-center">Fecha Creacion</div></th>
         <th><div class="text-center">Cantidad Vendida</div></th>
         <th><div class="text-center">Precio Unitario</div></th>
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
       <th>Pedido</th>
       <th>Cliente</th>
       <th>Fecha creacion</th>
       <th>Cantidad Vendida</th>
       <th>Precio Unitario</th>
       </tr>
       </tfoot>
       <tbody>
       </tbody>
       </table>
       <?php
         $data2=[];
         foreach ($pedidos as $orden) {?>
       <?php

           $data2[]= [
             $orden->codigoPedido,
             $orden->razonSocial,
             $orden->fecha,
             $orden->getCantidad(),
             '$' . number_format($orden->getPrecio(),0,',','.')
             ];
           ?>
         <?php }?>
    </div>
   </div>
   <div id="info" class="card-panel">
     <div class="card-panel">

       <h5><?=$producto->getNombre();?></h5>
       <div class="row">
         <div class="col s6">
           <p>Codigo Interno: <?=$producto->getCodigoInterno();?></p>
           <p>Marca: <?=$producto->getMarca();?></p>
           <p>Unidad de negocio: <?=$producto->unidadNegocioT;?></p>
           <p>
             Tipo de producto: <?=$producto->getTipo();?>
           </p>
         </div>
         <div class="col s6">
           <p>Precio Techo: $<?=number_format($producto->getPrecioTecho(),0,',','.');?></p>
           <p>Precio Piso: $<?=number_format($producto->getPrecioPiso(),0,',','.');?></p>
         </div>
       </div>
       <div class="row">
         <div class="col s6">
             <table>
               <thead>
                 <tr>
                   <th>Proveedores</th>
                   <th>Costos</th>
                   <th>Divisa</th>
                   <th>Codigo</th>
                 </tr>
               </thead>
               <tbody>
                 <?php for ($i=0; $i < count($producto->razonSocials); $i++) { ?>
                   <tr>
                     <td><?= $producto->razonSocials[$i] ?></td>
                     <td><?= '$' . number_format($producto->costos[$i],0,',','.') ?></td>
                     <td><?= $producto->divisas[$i] ?></td>
                     <td><?= $producto->CodsProd[$i] ?></td>
                   </tr>

                 <?php  } ?>
               </tbody>
             </table>
       </div>

         <div class="col s6">
           <p style="font-weight: bold">Presentacion  minima de Venta:</p>
           <p>  <?= $producto->getCantidadSalida() . " " . $producto->unidadMedidaT . " x " . $producto->presentacionSalidaT; ?></p>
           <p style="font-weight: bold">Presentacion  minima de Compra:</p>
           <p>  <?= $producto->getCantidadEntrada() . " " . $producto->unidadMedidaT . " x " . $producto->presentacionEntradaT; ?></p>

         </div>
       </div>
       <?php if (count($ultimoModificador) > 0): ?>
         Ultimo Modificador <?=$ultimoModificador[0]->getNombre() . " " . $ultimoModificador[0]->getApellido()?>, fecha y hora: <?=$ultimoModificador[0]->fechamodificacion?>
       <?php endif; ?>
     </div>
   </div>
   <div id="historial" class="card-panel">
     <div class="card-panel">

       <table id="listaFactura" class="highlight bordered"  >
       <thead>
       <tr>
           <th><div class="text-center">Pedido</div></th>
           <th><div class="text-center">Cliente</div></th>
           <th><div class="text-center">Fecha Factura</div></th>
           <th><div class="text-center">Cantidad Vendida</div></th>
           <th><div class="text-center">Precio Unitario</div></th>
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
       <th>Pedido</th>
       <th>Cliente</th>
       <th>Fecha Factura</th>
       <th>Cantidad Vendida</th>
       <th>Precio Unitario</th>
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
  foreach ($pedidosF as $orden) {?>
<?php

    $data[]= [
      $orden->codigoPedido,
      $orden->razonSocial,
      $orden->fecha,
      $orden->getCantidad(),
      '$' . number_format($orden->getPrecio(),0,',','.')
      ];
    ?>
  <?php }?>


  <?php if ($visible): ?>
</div>
<?php endif; ?>

<script type="text/javascript">
var dataSet=<?=json_encode($data);?>;
var dataSet2=<?=json_encode($data2);?>;
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Producto/VistaProducto.js"></script>
