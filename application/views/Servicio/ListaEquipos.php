<p></p>
<div class="card-panel">
<div class="card-panel">
<div class="table-responsive">


  <?php
  echo form_open('Inicio/login',array('id'=>'formulario'));
  ?>
<table id="listaEmpleado" class="highlight bordered" border="1" cellpadding="3" style="border-collapse: collapse; width:100%" >
<thead>
<tr>
<th><div class="text-center">Equipo</div></th>
<th><div class="text-center">Marca - Modelo</div></th>
<th><div class="text-center">Serial</div></th>
<th><div class="text-center">Estado del Equipo</div></th>
<th><div class="text-center">Estado del Servicio</div></th>
<th data-orderable="false"><div class="text-center">Servicios</div></th>
</tr>
</thead>
<tr>
  <?php $col=6;
    ?>
  <th colspan="<?=$col?>">

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
  <th>Equipo</th>
  <th>Marca - Modelo</th>
  <th>Serial</th>
  <th>Estado</th>
  <th>Estado</th>
<th>Estado</th>
</tr>
</tfoot>
<div id='incidencia' class="modal">
  <div class="modal-content">
    <div class="card-panel">
      <h5>Reportar Incidencia</h5>
      <div class="row">
        <div class="col s6">
          <div class="input-field"><label for="fecha">fecha de ocurrencia</label><input id="fecha" name="fecha" class=datepicker type="date" /></div>
        </div>
        <div class="col s6">
          <div class="input-field"><label for="descripcion">descripcion</label><input type ="text" id=descripcion name="descripcion" class="validate"  /> <br/></div>
          </div>
        </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col s6">
            <a onclick ='enviarReporte()'  class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Aceptar</a>
          </div>
          <div class="col s6">
            <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div id='modaldetail' class="modal">
  <div class="modal-content">
    <div class="card-panel">
      <div id='fotosequipo'></div>
      <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</a>
      <buttom id=AmpliarA target=_blank onclick=ampliar() class=" modal-action modal-close btn waves-effect waves-light blue darken-3" style="left:20px">Ver en tamaño completo</buttom>
      </div>
    </div>
  </div>
</div>

<?php
$data=[];
foreach ($equipos as $equipo) {
  if ($equipo->getFuncional() == 0){
      $helper="<div class='text-center'><i style='color:red' class='material-icons tooltipped' data-tooltip='Dado de Baja'>clear</i></div>";
    }if ($equipo->getFuncional() == 1){
      $helper="<div class='text-center'><i style='color:green' class='material-icons tooltipped' data-tooltip='Funcional'>check</i></div>";
    }if ($equipo->getFuncional() == 3){
      $helper="<div class='text-center'><i style='color:yellow;' class='material-icons tooltipped' data-tooltip='Incidente'>report_problem</i></div>";
    }if ($equipo->getFuncional() == 4){
      $helper="<div class='text-center'><i style='color:yellow;' class='material-icons tooltipped' data-tooltip='En proceso tecnico'><img src='http://10.1.10.14/GESTOLAB/assets/img/iconoiasotecg.jpg' width='36px' height='36px'></i></div>";
    }

    $row = [
     $equipo->getNombre(),
     $equipo->getMarca() . " - " . $equipo->getModelo(),
     $equipo->getSerial()];


    $row = array_merge($row ,[$helper,
     $equipo->estado(),
     "<a href=". site_url('Servicios/servicioEquipo')."/".$equipo->getId()."><div class='text-center'><i style='color:blue' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Lista Equipos'>add</i></div></a>"

     ]);
   $data[]= $row;
?>
<?php } ?>
</table>

  <?php echo form_close();?>
</div>
</div>
</div>
<script>
 var urlImagenes = '<?=site_url('Equipo/imagenes')?>'
  var urlIncidencia = '<?=site_url('Equipo/reportarIncidencia')?>'
var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';

function updateTokens(){
  tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}
var urlAmpliar ='<?=site_url('Equipo/detallesequipo').'/'?>';
var idAmpliar = 0;
var dataSet=<?=json_encode($data);?>;

function ampliar(){
    window.location.href = urlAmpliar + idAmpliar;
}




tablehead =[
  { title: "<div class='text-center'>Equipo</div>" },
  { title: "<div class='text-center'>Marca - Modelo</div>" },
  { title: "<div class='text-center'>Serial</div>" }]




tablehead = tablehead.concat([
  { title: "<div class='text-center'>Estado del Equipo</div>" },
  { title: "<div class='text-center'>Estado del Servicio</div>" },
  { title: "<div class='text-center'>Equipos</div>", "orderable": false }
]);


var solicitado = -1;
function reportarIncidencia(id){
solicitado = id;
   $('#incidencia').modal('open');
}

function enviarReporte(){
      updateTokens();
  var datos = {
    'id' : solicitado,
    'fecha' : $('#fecha').val(),
    'descripcion' : $('#descripcion').val()
    };
    datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlIncidencia,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  Materialize.toast(ans, 3000, 'rounded');
                }
        });
}


function AbrirModal(id){
   updateTokens();
 var datos = {
   'id' : id
   };
   idAmpliar = id;
 datos[tokenName] = tokenHash;
       $.ajax({
               data:  datos,
               url:   urlImagenes,
               type:  'post',
               beforeSend: function () {
                       $("#fotosequipo").html("Procesando, espere por favor...");
               },
               success:  function (ans) {
                 $("#fotosequipo").html(ans);
                    $('#modaldetail').modal('open');
                       //$("#resultado").html(response);
               }
       });
}


  var Acciones = new Array();

if (parseInt('<?=$showcustomer?>') != 1) {
 Acciones[0] = '<li><a href="<?=site_url('Equipo/agregarEquipo')?>" class="btn-floating btn-large blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Nuevo"><i class="material-icons">add</i></a></li>'

}

  var AccionesHTML = '';

  for (var i = 0; i < Acciones.length; i++) {
    AccionesHTML = AccionesHTML + Acciones[i];
  }

$(document).ready(function() {
  var $input = $('.datepicker').pickadate({
  labelMonthNext: 'Siguiente mes',
  labelMonthPrev: 'Mes anterior',
  labelMonthSelect: 'Elija un mes',
  labelYearSelect: 'Elija un año',
  monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
  monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
  weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado' ],
  weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
  weekdaysLetter: [ 'D', 'L', 'M', 'W', 'J', 'V', 'S' ],
  today: 'Hoy',
  clear: 'Limpiar',
  close: 'Cerrar',
  format: 'yyyy-mm-dd',
  selectMonths: true, // Creates a dropdown to control month
  selectYears: 15 // Creates a dropdown of 15 years to control year
  });
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
  $('.modal').modal();
  $('#listaEmpleado tfoot th').each( function () {
      var title = $(this).text();
      if(title!="Acciones" && title!="Estado"){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      }else{
        $(this).html('');
      }
    } );

  var table = $('#listaEmpleado').DataTable(
    {
       "drawCallback":function(){
                       $('.tooltipped').tooltip('remove');
                    $('.tooltipped').tooltip({delay: 50});
                    },
      data: dataSet,
       columns: tablehead,
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

$('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
} );

</script>
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/Empleado/ListarEmpleado.js"></script>
-->
