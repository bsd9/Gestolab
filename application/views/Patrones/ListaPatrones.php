<div class="card-panel">
  <div class="card-panel">
  <div class="table-responsive">
<table id="listaMetrica" class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse" >
<thead>
<tr>
  <th><div class="text-center">Magnitud</div></th>
  <th><div class="text-center">Nombre</div></th>
  <th><div class="text-center">Valor</div></th>
  <th><div class="text-center">Incertidumbre</div></th>
  <th><div class="text-center">Estado</div></th>
<th data-orderable="false"><div class="text-center">Acciones</div></th>
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
<th>Magnitud</th>
<th>Nombre</th>
<th>Estado</th>
<th>Acciones</th>
<th>Estado</th>
<th>Acciones</th>
</tr>
</tfoot>
<tbody>
<?php
$data = [];
 foreach ($patrones as $patron) {?>
  <?php
    if($patron->getActivo()){
      $helper="<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
    }else{
      $helper="<p hidden>0</p><div class='text-center'><i style='color:red' class='glyphicon glyphicon-remove'></i></div>";
    }
    $data[]= [
      $patron->magnitudNombre,
    $patron->getNombre(),
    $patron->getValor(),
    $patron->getIncertidumbre(),
    $helper,
      "<a href=". site_url('Mediciones/editarPatron')."/".$patron->getId()."><div class='text-center'><i style='color:orange' class='glyphicon glyphicon-pencil tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'></i></div></a>"
    ];?>
  <?php }?>
</tbody>
</table>
  </div>
  </div>
</div>

<!-- <div class="fixed-action-btn horizontal click-to-toggle" style="bottom: 195px; right: 24px;">
      <a href="<?=site_url('Cargo/nuevo')?>" class="btn-floating btn-large blue darken-5">
        <i class="material-icons">add</i>
      </a>
</div> -->
<script>
  var dataSet=<?=json_encode($data);?>;

  var Acciones = new Array();
  Acciones[0] = '<li><a href="<?=site_url('Mediciones/nuevoPatron')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'

  var AccionesHTML = '';

  for (var i = 0; i < Acciones.length; i++) {
    AccionesHTML = AccionesHTML + Acciones[i];
  }
$(document).ready(function() {
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
    $('#listaMetrica tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Acciones" && title!="Estado"){
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }else{
          $(this).html('');
        }
      } );
    var table = $('#listaMetrica').DataTable(
      {
        data: dataSet,
         columns: [
             { title: "<div class='text-center'>Magnitud</div>" },
             { title: "<div class='text-center'>Nombre</div>" },
             { title: "<div class='text-center'>Valor</div>" },
             { title: "<div class='text-center'>Incertidumbre</div>" },
             { title: "<div class='text-center'>Estado</div>" },
             { title: "<div class='text-center'>Editar</div>", "orderable": false }
           ],
      "pagingType": "simple",
       "language": {
                "lengthMenu": "Cantidad de filas por pagina _MENU_",
               "zeroRecords": "No se encontro",
               "info": "Pagina _PAGE_ de _PAGES_",
               "infoEmpty": "No se encontro",
               "infoFiltered": "(de _MAX_ registros)",
               "search": "<label for='search'>Buscar:</label>",
               "paginate": {
                   "first":      "Primera",
                   "last":       "Ultima",
                   "next":       "Siguiente",
                   "previous":   "Anterior"
               }
           }
      }
    );
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

  $('.tooltipped').tooltip({delay: 50});
  $('select').material_select();
} );

</script>
<!--			<script type="text/javascript" src="<?php echo base_url();?>assets/js/Cargo/listaCargo.js"></script>
-->
