$(document).ready(function() {
      $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
  $('#listaresolucion tfoot th').each( function () {
      var title = $(this).text();
      if(title!="Acciones" && title!="Estado"){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      }else{
        $(this).html('');
      }
    } );

  var table = $('#listaresolucion').DataTable(
    {  data: dataSet,
      "drawCallback":function(){
         $('.tooltipped').tooltip('remove');
      $('.tooltipped').tooltip({delay: 50});
      },
       columns: [
           { title: "<div class='text-center'>Resolucion</div>"},
           { title:"<div class='text-center'>Fecha de Expedicion</div>"},
           { title: "<div class='text-center'>Fecha de Vencimiento</div>"},
           { title: "<div class='text-center'>Tipo</div>"},
           { title: "<div class='text-center'>Prefijo</div>"},
           { title: "<div class='text-center'>Desde</div>"},
           { title: "<div class='text-center'>Hasta</div>"},
           { title: "<div class='text-center'>Ultimo</div>"},
           { title: "<div class='text-center'>Establecimiento</div>"},
           { title: "<div class='text-center'>Estado</div>" },
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
   $('select').material_select();
} );
