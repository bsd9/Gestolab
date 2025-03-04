
<div class="card-panel">
<div class="row">
<div class="col s6">
  <div class="table-responsive">
  <table id="Informe" class="highlight bordered" border="1" cellpadding="3" style="table-layout:fixed" >
  <thead>
  <tr>
  <th><div class="text-center">Producto</div></th>
  <th><div class="text-center">Ventas</div></th>
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
  <th>Producto</th>
  <th>Ventas</th>
  </tr>
  </tfoot>

  <!-- <div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 195px; right: 24px;">
      <a href="<?=site_url('Empleado/nuevo')?>" class="btn-floating btn-large blue darken-5">
        <i class="material-icons">add</i>
      </a>
  </div> -->

  <?php
  $sumatoria = 0;
  $data=[];
  $label = [];
  $valor =[];
  $background =[];
  $backgroundborder =[];
  foreach ($items as $dato) {
  ?>
  <?php
  $label[] = $dato->Producto;
  $valor[] = $dato->totalVentas;
  $r=rand(0,255);
  $g=rand(0,255);
  $b=rand(0,255);
  $background[]= 'rgba('.$r.', '. $g.', '.$b.', 0.2)';
  $backgroundborder[]= 'rgba('.$r.', '. $g.', '.$b.', 1)';

  $data[]=[
  $dato->Producto,
  '$' . number_format($dato->totalVentas,0,',','.')
  ];
  $sumatoria +=$dato->totalVentas;
  ?>
  <?php }
  $data[] = ['Total','$' . number_format($sumatoria,0,',','.')];
   ?>

  </table>
  </div>
</div>
<div class="col s6">
<canvas id="VentasxAsesor" width="200" height="200"></canvas>
</div>
</div>


</div>



<script type="text/javascript" src="<?php echo base_url();?>assets/js/Chart.min.js"></script>

<script>
var valor=<?=json_encode($valor);?>;
var label=<?=json_encode($label);?>;
var background=<?=json_encode($background);?>;
var backgroundborder=<?=json_encode($backgroundborder);?>;
var ctx = document.getElementById("VentasxAsesor");
var myDoughnutChart = new Chart(ctx, {
    type: 'pie',
    data: {
    labels: label,
    datasets: [
        {
            data: valor,
            backgroundColor: background,
            hoverBackgroundColor: backgroundborder
        }]
},
animation:{
    animateScale:true
}
});
var dataSet=<?=json_encode($data);?>;
var Acciones = new Array();

var AccionesHTML = '';

for (var i = 0; i < Acciones.length; i++) {
AccionesHTML = AccionesHTML + Acciones[i];
}


</script>
<script type="text/javascript" src="<?php echo base_url();?>assets\js\Producto\InformeVentasUnidadNegocio.js"></script>

