if(permiso != true){
  tableheadIncidencia =[
    { title: "<div class='text-center'>Fecha</div>" },
    { title: "<div class='text-center'>Descripcion</div>" }
  ]
}else{
  tableheadIncidencia =[
    { title: "<div class='text-center'>Fecha</div>" },
    { title: "<div class='text-center'>Descripcion</div>" },
    { title: "<div class='text-center'>Analisis preliminar</div>" }
  ]
}

tableheadSolicitudes =[
 
  { title: "<div class='text-center'>N Orden Trabajo</div>" },
  { title: "<div class='text-center'>Servicio</div>" },
  { title: "<div class='text-center'>Fecha Aprobacion</div>" },
  { title: "<div class='text-center'>Fecha Ejecucion</div>" },
  { title: "<div class='text-center'>Informe</div>" },
  { title: "<div class='text-center'>N Orden Servicio</div>" }
]

tableheadVariable =[
  { title: "<div class='text-center'>Variable</div>" },
  { title: "<div class='text-center'>Cantidad</div>" },
]



$(document).ready(function() {
  $('ul.tabs').tabs();
   $('.carousel').carousel();
   $('.carousel').carousel('next');
  $('#listaSolicitudes tfoot th').each( function () {
      var title = $(this).text();
      if(title!="Acciones" && title!="Estado"){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      }else{
        $(this).html('');
      }
    } );

    var table = $('#listaSolicitudes').DataTable(
      {
         "drawCallback":function(){
                      $('.tooltipped').tooltip('remove');
                      $('.tooltipped').tooltip({delay: 50});
                      },
        data: dataSetSolicitud,
         columns: tableheadSolicitudes,
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


  $('#listaIncidencia tfoot th').each( function () {
      var title = $(this).text();
      if(title!="Acciones" && title!="Estado"){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      }else{
        $(this).html('');
      }
    } );

  var table = $('#listaIncidencia').DataTable(
    {
       "drawCallback":function(){
                    $('.tooltipped').tooltip('remove');
                    $('.tooltipped').tooltip({delay: 50});
                    },
      data: dataSetIncidencia,
       columns: tableheadIncidencia,
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



 $('#listavariable tfoot th').each( function () {
      var title = $(this).text();
      if(title!="Acciones" && title!="Estado"){
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
      }else{
        $(this).html('');
      }
    } );



  var table = $('#listavariable').DataTable(
    {
       "drawCallback":function(){
                    $('.tooltipped').tooltip('remove');
                    $('.tooltipped').tooltip({delay: 50});
                    },
      data: dataSetVariable,
       columns: tableheadVariable,
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
