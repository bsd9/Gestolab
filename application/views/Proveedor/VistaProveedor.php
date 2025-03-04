<?php if ($visible): ?>
  <div class="container">
<?php endif; ?>


<div class="row">

   <div class="col s12">
     <ul class="tabs">
       <li class="tab col s6"><a class="active blue-text" href="#info" >Información General</a></li>
       <li class="tab col s6"><a class="blue-text" href="#historial">Facturas</a></li>

       <div class="indicator blue" style="z-index:1"></div>
     </ul>
   </div>
 </div> 
   <div id="info" class="col s12">
     <div class="card-panel">
       <div class="center">
       <?php if ($proveedor->getLogo() != '') {?>
         <img id="img" src="<?=base_url();?>/uploads/logo/<?php echo $proveedor->getLogo(); ?>" widht="200" height="200">
       <?php } else{ ?>
       <img id="img" src="<?=base_url();?>/assets/imgs/logosid.png" widht="200" height="200">
       <?php } ?>

       <h5><?=$proveedor->getRazonSocial();?>
         <?php if($proveedor->getEstado()){ ?>
         <i style='color:green' class='material-icons tooltipped'>check</i>
       <?php }else{ ?>
         <i style='color:red' class='material-icons tooltipped'>remove</i>
      <?php  } ?>
      </h5>
    </div>
       <div class="row">
         <div class="col s6">
           <p>NIT: <?=$proveedor->getNIT();?></p>

           <p>Fax: <?=$proveedor->getFax();?></p>
           <p>Notas:</p><p> <?=$proveedor->getNotas();?></p>
         </div>
         <div class="col s6">
           <p>Fecha Ingreso: <?=$proveedor->getFechaIngreso();?></p>
           <p>Paginas Web:</p>
           <?php $paginas = explode('#',$proveedor->getPaginaWeb());
           foreach ($paginas as $pagina) { ?>
              <p><?=$pagina?></p>
            <?php } ?>

         </div>
       </div>



       <?php if (count($ultimoModificador) > 0): ?>
         Ultimo Modificador <?=$ultimoModificador[0]->getNombre() . " " . $ultimoModificador[0]->getApellido()?>, fecha y hora: <?=$ultimoModificador[0]->fechamodificacion?>
       <?php endif; ?>
     </div>

   </div>
   <div id="historial" class="col s12">
     <div class="card-panel">
     <p>
       Preguntar correctamente como debe ser el formato de la tabla
    </p>
    </div>
   </div>
</div>


  <?php if ($visible): ?>
</div>
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function(){
$('ul.tabs').tabs();
});
</script>
