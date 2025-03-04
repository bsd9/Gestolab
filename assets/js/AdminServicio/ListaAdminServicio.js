function ampliar(){
window.location.href = urlAmpliar + idAmpliar;
}


function ModalHistorial(id){
    updateTokens();
var datos = {
  'id' : id
};
  datos[tokenName] = tokenHash;
      $.ajax({
              data:  datos,
              url:   urlHistorial,
              type:  'post',
              beforeSend: function () {
              },
              success:  function (ans) {

                $('#detalles').modal('open');
                $('#ndetalles').html(ans);

                //Materialize.toast(ans, 3000, 'rounded');
              }
      });
}


$(document).ready(function() {
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
  $('select').material_select();
  $('.modal-trigger').modal();

    $('#listaCliente tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Editar" && title!="Estado"){
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }else{
          $(this).html('');
        }
      } );
    var table = $('#listaCliente').DataTable(
      { "drawCallback":function(){
                        $('.tooltipped').tooltip('remove');
                     $('.tooltipped').tooltip({delay: 50});
                     },

      data: dataSet,
       columns: [
           { title: "<div class='text-center'></div>", width:50 },
           { title: "<div class='text-center'>Nombre</div>" },
           { title: "<div class='text-center'>Unidad Medida</div>" },
           { title: "<div class='text-center'>Variables</div>" },
           { title: "<div class='text-center'>Estado</div>" },
           { title: "<div class='text-center'>Acciones</div>", "orderable": false }
         ],
         "order": [[ 0, "desc" ]],
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
