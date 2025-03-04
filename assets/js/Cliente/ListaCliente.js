function ampliar(){
    window.location.href = urlAmpliar + idAmpliar;
}




    function pintarDetallesCliente(id){
      updateTokens();
      var datos = {
        'id' : id
      };
      idAmpliar = id;
      datos[tokenName] = tokenHash;
            $.ajax({
                    data:  datos,
                    url:   urlDetallesCliente,
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

               { title: "<div class='text-center'>Razón Social</div>" },
               { title: "<div class='text-center'>NIT</div>" },
               { title: "<div class='text-center'>Telefono</div>" },
               { title: "<div class='text-center'>Direccion</div>" },
               { title: "<div class='text-center'>Ciudad</div>" },
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
