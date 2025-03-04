<div class="card-panel">
<div class="card-panel" >


<p>
  Cambiado accesos del usuario <?=$usuarios[0]->getNombre()?> <?=$usuarios[0]->getApellidos()?>
</p>
<div class="row">

<div class="col s10">
    <div class="input-field"><select type ="Select" name="idLaboratorio" id="idLaboratorio" >
      <option disabled selected>Elija una opción</option>
      <?php foreach($posibles as $laboratorio){ ?>
          <option value="<?=$laboratorio->getId();?>"><?=$laboratorio->getNombre();?></option>
        <?php } ?>
      </select>
      <label>Laboratorios</label>
    </div>
</div>
<div class="col s2">
  <button type="button" class="btn waves-effect waves-light blue darken-3" onclick="addInput()" name="button" style="margin-left: 50px">agregar</button>
</div>
</div>

<?php
echo form_open('Usuario/asignarResponsabilidades/' .$usuarios[0]->getId() ,array('id'=>'formulario'));
?>
<div class="center">
  <input type="submit" class="btn waves-effect waves-light blue darken-3" name="submit" value="Guardar " style="margin-bottom: 10px"></input>

</div>

<div class="card-panel">
<h5 class="text-center">Lista de laboratorios con permiso para el usuario</h5>

<table id="listaMetrica" class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse">
  <thead>
    <tr>
      <th>Nombre</th>
      <th>Acciones</th>
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
<th>Nombre</th>
<th>Acciones</th>
</tr>
</tfoot>
</table>
</div>

<div id='arrays' hidden>
    <?php  $data = []; $i=1; foreach ($laboratorios as $laboratorio): ?>
      <?php
        $data[]= [
        $laboratorio->getNombre(),
          "<a id='r".$i."' onclick=RemoveInput(".$i.") ><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Eliminar'>delete</i></div></a>"
        ];?>
<div id="array<?=$i?>" >
  <div class="row">
    <div class="col s10">
      <input type ="text" class="validate" name="idLaboratorio[]" id="idLaboratorio[]" value='<?=$laboratorio->getId() ?>' />
    </div>
    <div class="col s2">
      <i onclick="RemoveInput(<?=$i?>)" style="color:red"class="material-icons right">send</i>
    </div>
  </div>
</div>
      <?php $i++; ?>
  <?php endforeach; ?>
</div>
</div>

</div>
  <?php echo form_close();?>
<script type="text/javascript">
$(document).ready(function() {
$('select').material_select();
dataSet = <?=json_encode($data);?>;
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
    "drawCallback":function(){
                  $('.tooltipped').tooltip('remove');
                 $('.tooltipped').tooltip({delay: 50});
                 },
     columns: [
         { title: "<div class='text-center'>Nombre</div>" },
         { title: "<div class='text-center'>Acciones</div>", "orderable": false }
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




} );
length = parseInt('<?=$i?>');
function addInput(){

  laboratorio= $('#idLaboratorio :selected').val();
  laboratorioNombre= $('#idLaboratorio :selected').text();
  $('#arrays').append('<div id="array'+length+'" >' +
  '<div class="row">' +
      '<div class="col s10">' +
        '<input type ="text" class="validate" name="idLaboratorio[]" id="idLaboratorio[]" value='+laboratorio+' />'+
      '</div>' +
      '<div class="col s2">'+
        '<i onclick="RemoveInput('+length+')" class="material-icons right">send</i>'+
      '</div>' +
  '</div>'+
  '</div>'
  )
  table = $('#listaMetrica').DataTable()
  table.row.add([
    laboratorioNombre,
    "<a id='r"+ length +"' onclick=RemoveInput("+ length +") ><div class='text-center'><i style='color:red' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Eliminar'>delete</i></div></a>"
  ])
        table.draw();
length = length +1;
$('.tooltipped').tooltip('remove');
$('.tooltipped').tooltip({delay: 50});
}

function RemoveInput(id){
  table = $('#listaMetrica').DataTable()
  table
      .row( $('#r'+id).parents('tr') )
      .remove()
      .draw();
  $("#array"+id).remove()
  length = length -1;
  $('.tooltipped').tooltip('remove');
 $('.tooltipped').tooltip({delay: 50});

}

</script>
