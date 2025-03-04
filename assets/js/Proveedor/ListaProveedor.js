function pintarDetalles(id){
  updateTokens();
  var datos = {
    'id' : id
  };
  datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlDetalles,
                type:  'post',
                beforeSend: function () {
                   $('#detalles').modal('open');
                   $("#ndetalles").html("Procesando, espere por favor...");
                },
                success:  function (ans) {

                  $("#ndetalles").html(ans);
                        //$("#resultado").html(response);
                }
        });
}

function pintarContactos(id){
          updateTokens();
  var datos = {
    'id' : id
  };
      datos[tokenName] = tokenHash;
  $('#c'+id).modal('open');
        $.ajax({
                url:   urlContactos,
                type:  'POST',
                data:   datos,
                beforeSend: function () {
                        $("#cd"+id).html("Procesando, espere por favor...");
                },
                success:  function (ans) {
                //  alert(ans);
                        $("#cd"+id).html(ans);
                        //$("#resultado").html(response);
                }
        });
}
function pintarDirecciones(id){
          updateTokens();
  var datos = {
    'id' : id
    };
        datos[tokenName] = tokenHash;
  $('#d'+id).modal('open');
        $.ajax({
                data:  datos,
                url:   urlDirecciones,
                type:  'post',
                beforeSend: function () {
                        $("#dd"+id).html("Procesando, espere por favor...");
                },
                success:  function (ans) {
                  $("#dd"+id).html(ans);
                        //$("#resultado").html(response);
                }
        });
}
$(document).ready(function() {
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
        $('.tooltipped').tooltip({delay: 50});
  $('.modal-trigger').modal();
    $('#listaProveedor tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Editar" && title!="Estado"){
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }else{
          $(this).html('');
        }
      } );
    var table = $('#listaProveedor').DataTable(
      {
        data: dataSet,
        "drawCallback":function(){
           $('.tooltipped').tooltip('remove');
        $('.tooltipped').tooltip({delay: 50});
        },
       columns: [
         { title: "<div class='text-center'></div>" , "orderable": false },
           { title: "<div class='text-center'>Razón Social</div>" },
           { title: "<div class='text-center'>NIT</div>" },
           { title: "<div class='text-center'>Localizacion</div>" , "orderable": false},
           { title: "<div class='text-center'>Contactos</div>", "orderable": false },
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
    $('select').material_select();
} );
