$(document).ready(function() {
$('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );

  $('#Informe tfoot th').each( function () {
      var title = $(this).text();
      if(title!="Editar" && title!="Estado"){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      }else{
        $(this).html('');
      }
    } );

  var table = $('#Informe').DataTable(
    {
       "drawCallback":function(){
                       $('.tooltipped').tooltip('remove');
                    $('.tooltipped').tooltip({delay: 50});
                    },
      data: dataSet,
       columns: [
           { title: "<div class='text-center'>Empleado</div>" },
           { title: "<div class='text-center'>Ventas</div>" }
         ],
    "pagingType": "simple",
     "language": {
             "lengthMenu": "Mostrar  _MENU_ filas por pagina",
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