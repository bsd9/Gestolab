function AbrirModal(id){
    updateTokens();
  var datos = {
    'id' : id
    };
  datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlTelefonos,
                type:  'post',
                beforeSend: function () {

                        $("#n"+id).html("Procesando, espere por favor...");
                },
                success:  function (ans) {
                  $("#n"+id).html(ans);
                      $('#'+id).modal('open');
                        //$("#resultado").html(response);
                }
        });
}

$(document).ready(function() {
     $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
     $('select').material_select();
    $('#listaEmpleado tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Acciones" && title!="Estado" && title!="Info"){
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
         columns: [

             { title: "<div class='text-center'>Nombre</div>" },
             { title: "<div class='text-center'>Apellido</div>" },
             { title: "<div class='text-center'>Email</div>" },
             { title: "<div class='text-center'>Usuario</div>" },
             { title: "<div class='text-center'>Tipo</div>" },
             { title: "<div class='text-center'>Telefono</div>" },
             { title: "<div class='text-center'>Activo</div>" },
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

$('select').material_select();
      $('.tooltipped').tooltip({delay: 50});
} );
