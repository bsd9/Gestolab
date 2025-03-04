/*function updateTokens(){
 tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
 tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
}


function ModalEnviarAprobar(id){
mod=id;
$('#NoCompraEnv').html(id);
$('#EnviarAprobar').modal('open');
}

function ModalAprobar(id){
mod=id;
$('#NoCompraApr').html(id);
$('#Aprobar').modal('open');
}

function ModalCancelar(id){
mod=id;
$('#NoCompraCan').html(id);
$('#Cancelar').modal('open');
}


function EnviarAprobar(){
  updateTokens();
  var datos = {
    'id' : mod
  };
      datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlEnviarAprobar,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  Materialize.toast(ans, 3000, 'rounded');
                }
        });
}

function Aprobar(){
  updateTokens();
  var datos = {
    'id' : mod
  };
    datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlAprobar,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  Materialize.toast(ans, 3000, 'rounded');
                }
        });
}

function Cancelar(){
updateTokens();
  var datos = {
    'id' : mod
  };
      datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlCancelar,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  Materialize.toast(ans, 3000, 'rounded');
                }
        });
}

***/




function Modalautorizar(id){
mod=id;
$('#NoCompraEnv').html(id);
$('#autorizar').modal('open')();
}

function ModalllegoBodega(id){
mod=id;
$('#NoCompraApr').html(id);
$('#llegoBodega').modal('open')();
}

function Modalverificar(id){
mod=id;
$('#NoCompraCan').html(id);
$('#verificar').modal('open')();
}

function nuevo(){
$('#Nuevo').modal('open')();
}

function redirectNew(){
  updateTokens();
  var datos = {
    'nombre' : $("#proveedor").val()
  };
      datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlObtenerID,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  if(ans != '-1'){
                    window.location.href = urlNuevo +'/'+ ans
                  }else{
                    Materialize.toast('Nombre no valido', 3000, 'rounded');
                  }
                }
        });
}

function autorizar(){
  updateTokens();
  var datos = {
    'id' : mod
  };
      datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlautorizar,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  Materialize.toast(ans, 3000, 'rounded');
                }
        });
}

function llegoBodega(){
  updateTokens();
  var datos = {
    'id' : mod
  };
    datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlllegoBodega,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  Materialize.toast(ans, 3000, 'rounded');
                }
        });
}

function verificar(){
updateTokens();
  var datos = {
    'id' : mod
  };
      datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlverificar,
                type:  'post',
                beforeSend: function () {
                },
                success:  function (ans) {
                  Materialize.toast(ans, 3000, 'rounded');
                }
        });
}


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
                   $("#NoCompra").html(id);
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
    $('.tooltipped').tooltip({delay: 50});
      $('#listaCompras tfoot th').each( function () {
          var title = $(this).text();
          if(title!="Acciones" ){
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
          }else{
            $(this).html('');
          }
        } );
        
      var table = $('#listaCompras').DataTable(
        {
          "lengthMenu": [[25, 50, -1], [25, 50, "Todo"]],
          "order": [[ 1, "desc" ]],
          "bProcessing": true,
          "deferRender": true,
          "drawCallback":function(){
             $('.tooltipped').tooltip('remove');
          $('.tooltipped').tooltip({delay: 50});
          },
        data: dataSet,
         columns: [
            { title: "<div class='text-center'>Detalles</div>" , "orderable": false},
           { title: "<div class='text-center'>N°</div>" , "width": "5%"},
             { title: "<div class='text-center'>Fecha Creacion</div>" },
             { title: "<div class='text-center'>Proveedor</div>" , "width": "30%"},
             { title: "<div class='text-center'>Estado</div>" },
             { title: "<div class='text-center'>Acciones</div>", "orderable": false, "width": "15%" }
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