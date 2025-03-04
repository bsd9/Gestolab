<div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s2"><a class="active" href="#info">Datos Del equipo</a></li>
        <li class="tab col s2"><a href="#incidenciatab">Incidencias</a></li>
        <li class="tab col s2"><a href="#solicitudestab">Solicitudes Realizadas</a></li>
        <li class="tab col s3"><a href="#documentostab">Documentacion</a></li>
        <li class="tab col s3"><a href="#variablestab">Variables</a></li>
      </ul>
    </div>
</div>


    <div id='documentostab' class="col s12">
      <div class="card-panel">
        <div class="row">
          <?php  foreach ($documentos as $documento): ?>
                    <div class="col s6">
                      <a href="<?=base_url();?>uploads-old/docs/equipos/<?=$documento->getNombre();?>"><?=$documento->getNombre();?></a>
                    </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <div id="info" class="col s12">
      <div class="card-panel">
        <h4><?php echo $equipo->getNombre();?></h4>

        <?php if (count($imagenes) > 0): ?>
        <div class="carousel">

          <?php foreach ($imagenes as $imagen): ?>

            <a class="carousel-item"><img src="<?=base_url();?>uploads-old/imgs/equipos/<?=$imagen->getNombre();?>">
             </a>
          <?php endforeach; ?>

          </div>
        <?php endif; ?>

          <h5><?php echo $equipo->getMarca() . " " . $equipo->getModelo(); ?></h5>
          <p>Serial: <?php echo $equipo->getSerial(); ?></p>
          <p>Codigo: <?php echo $equipo->getCodigo();?></p>
          <p>Fecha de Compra: <?php echo $equipo->getFechaCompra();?></p>
          <p>Costo: <?php echo $equipo->getCosto();?></p>
          <p>Observaciones:</p>
          <p><?php echo $equipo->getObservacion();?></p>


      </div>
    </div>
    <div id="incidenciatab" class="col s12">
      <div class="card-panel">
        <table id="listaIncidencia" class="highlight bordered" border="1" cellpadding="3" style="border-collapse: collapse;" >
        <thead>
        <tr>
        <th><div class="text-center">Fecha</div></th>
        <th><div class="text-center">Descripcion</div></th>
		<?php if(in_array('Detalle Tecnico',$this->session->userdata('permisos'))){ ?>
        <th><div class="text-center">Acciones</div></th>
		<?php } ?>
        </tr>
        </thead>
        <tr>
          <th colspan="2">
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
          <th>Fecha</th>
          <th>Descripcion</th>

		 <?php  if(in_array('Detalle Tecnico',$this->session->userdata('permisos'))){ ?>

        <th>Acciones</th>
		<?php } ?>
        </tr>
        </tfoot>
        <?php
        $dataIncidencia=[];
        $permiso = "false";
        if(in_array('Detalle Tecnico',$this->session->userdata('permisos'))){
          $permiso= "true";
        foreach ($incidencias as $incidencia) {
             $dataIncidencia[]=[
             $incidencia->getFecha(),
             $incidencia->getDescripcion(),
            "<a href=".site_url('Equipo/detalletecnico')."/".$incidencia->getId()." >Detalle tecnico</a>"
             ];
           }
        ?>
        <?php }
        else{
          foreach ($incidencias as $incidencia) {
               $dataIncidencia[]=[
               $incidencia->getFecha(),
               $incidencia->getDescripcion()
               ];
             }
        } ?>
        </table>
      </div>
    </div>
    <div id="solicitudestab" class="col s12">
      <div class="card-panel">
        <table id="listaSolicitudes" class="highlight bordered" border="1" cellpadding="3" style="border-collapse: collapse;" >
        <thead>
        <tr>
        <th><div class="text-center">N Orden de Trabajo</div></th>
        <th><div class="text-center">Servicio</div></th>
        <th><div class="text-center">Fecha Inicio</div></th>
        <th><div class="text-center">Fecha Fin</div></th>
        <th><div class="text-center">Documento</div></th>
        <th><div class="text-center">N Orden de Servicio</div></th>
        </tr>
        </thead>
        <tr>
          <th colspan="4">
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
          <th>N Orden de Servicio</th>
          <th>Servicio</th>
          <th>solicitud</th>
          <th>servicio</th>
          <th>Documento</th>
          <th>N Orden de Servicio</th>
        </tr>
        </tfoot>
        <?php
        $datasolicitudes=[];
        foreach ($solicitudes as $solicitud) {

             $datasolicitudes[]=[
              
              $solicitud->Trabajo,
              $solicitud->getServicio(),
              $solicitud->getFechaSolicitud(),
              $solicitud->getFechaServicio(),
              $solicitud->getDescripcion(),
              $solicitud->Servicio
           ];
        ?>
        <?php } ?>
        </table>
      </div>
    </div>

        <div id="variablestab" class="col s12">
      <div class="card-panel">
        <table id="listavariable" class="highlight bordered" border="1" cellpadding="2" style="border-collapse: collapse;" >
        <thead>
        <tr>
        <th><div class="text-center">Variable</div></th>
        <th><div class="text-center">Cantidad</div></th>
        </tr>
        </thead>
        <tr>
          <th colspan="2">
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
          <th>Variable</th>
          <th>Cantidad</th>
        </tr>
        </tfoot>
        <?php
        $dataVariable=[];
        foreach ($variables as $var) {

             $dataVariable[]=[
             $var->nombre,
             $var->getCantidad(),
           ];
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

var dataSetIncidencia=<?=json_encode($dataIncidencia);?>;
var dataSetSolicitud=<?=json_encode($datasolicitudes);?>;
var dataSetVariable=<?=json_encode($dataVariable);?>;
var permiso=<?=$permiso?>;


</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Equipo/Imagenes.js"></script>
