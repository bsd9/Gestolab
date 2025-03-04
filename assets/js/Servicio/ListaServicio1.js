
  function ModalDatos(id){
        updateTokens();
        var datos = {
        };
    iddata = id
      datos[tokenName] = tokenHash;
          $.ajax({
                  data:  datos,
                  url:   urlPreDatos,
                  type:  'post',
                  beforeSend: function () {
                  },
                  success:  function (ans) {
                    $('#datos').modal('open');
                    $('#data').html(ans);
                  }
          });
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
                    $('#NoCompra').html(id);
                    $('#detalles').modal('open');
                    $('#ndetalles').html(ans);

                    //Materialize.toast(ans, 3000, 'rounded');
                  }
          });
  }

   function ModalEquipo(id){
        updateTokens();
    var datos = {
      'id' : id
    };
      datos[tokenName] = tokenHash;
          $.ajax({
                  data:  datos,
                  url:   urlEquipoinfo,
                  type:  'post',
                  beforeSend: function () {
                  },
                  success:  function (ans) {
                    $('#detallesE').modal('open');
                    $('#ndetallesE').html(ans);

                    //Materialize.toast(ans, 3000, 'rounded');
                  }
          });
  }

  function ModalSubir(id){

    $('#idServicio').val(id)
    $('#subir').modal('open');
    }
  
  
  
    function EnviarMediciones(){
      $( "#idServicio" ).val(iddata);
      $( "#PostDatos" ).submit();
    }
  
  
    function EnviarDatosEquipo(){
      $( "#idServicio" ).val(iddata);
      $( "#DatosEquipo" ).submit();
    }

  function arrastrarData(){
        updateTokens();
      datos[tokenName] = tokenHash;
          $.ajax({
                  data:  datos,
                  url:   urlTraerInfo,
                  type:  'post',
                  beforeSend: function () {
                  },
                  success:  function (ans) {
                    Materialize.toast(ans, 3000, 'rounded');
                  }
          });
  }

  function ModalComenzar(id){
    mod=id;
    est = 1;
    $('#titlemodal').html('Comenzar el proceso de prestacion de servicio');
    $('#desc').hide();
    $('#labeldesc').hide();
    $('#modal').modal('open');
    }
  
    function ModalIniciar(id){
    mod=id;
    est = 2;
    $('#titlemodal').html('Iniciar de nuevo el servicio');
    $('#desc').hide();
    $('#labeldesc').hide();
    $('#modal').modal('open');
    }
  
    function ModalPausar(id){
    mod=id;
    est = 3;
    $('#titlemodal').html('Pausar el servicio en ejecucion');
    $('#desc').show();
    $('#labeldesc').show();
    $('#modal').modal('open');
    }
  
    function ModalDetener(id){
    mod=id;
    est = 4;
    $('#titlemodal').html('Detener totalmente el servicio');
    $('#desc').show();
    $('#labeldesc').show();
    $('#modal').modal('open');
    }
  
    function ModalFinalizar(id){
    mod=id;
    est = 5;
    $('#titlemodal').html('El servicio se ha finalizado');
    $('#desc').show();
    $('#labeldesc').show();
    $('#modal').modal('open');
    }

    function ModalNoFinalizar(id){
      mod=id;
      est = 6;
      $('#titlemodal').html('El servicio no fue finalizado');
      $('#desc').show();
      $('#labeldesc').show();
      $('#modal').modal('open');
      }
  
  
  
  function Enviar(){
    switch (est) {
      case 1:
      Comenzar();
      break;
      case 2:
      Iniciar();
      break;
      case 3:
      Pausar();
      break;
      case 4:
      Detener();
      break;
      case 5:
      Finalizar();
      break;
      case 6:
      NoFinalizar();
      break;
      case 7:
      EnviarDocumento();
      break;
      default: Materialize.toast('El cambio de estado no es posible', 3000, 'rounded')
  
    }
  }


  function Comenzar(){
    updateTokens();
var datos = {
  'id' : mod,
  'desc' : $('#desc').val()
};
  datos[tokenName] = tokenHash;
      $.ajax({
              data:  datos,
              url:   urlComenzar,
              type:  'post',
              beforeSend: function () {
              },
              success:  function (ans) {
                Materialize.toast(ans, 3000, 'rounded');
              }
      });
}

  function Iniciar(){
    updateTokens();
var datos = {
  'id' : mod,
  'desc' : $('#desc').val()
};
  datos[tokenName] = tokenHash;
      $.ajax({
              data:  datos,
              url:   urlIniciar,
              type:  'post',
              beforeSend: function () {
              },
              success:  function (ans) {
                Materialize.toast(ans, 3000, 'rounded');
              }
      });
}

function Pausar(){
    updateTokens();
var datos = {
  'id' : mod,
  'desc' : $('#desc').val()
};
  datos[tokenName] = tokenHash;
      $.ajax({
              data:  datos,
              url:   urlPausar,
              type:  'post',
              beforeSend: function () {
              },
              success:  function (ans) {
                Materialize.toast(ans, 3000, 'rounded');
              }
      });
}

function Detener(){
    updateTokens();
var datos = {
  'id' : mod,
  'desc' : $('#desc').val()
};
  datos[tokenName] = tokenHash;
      $.ajax({
              data:  datos,
              url:   urlDetener,
              type:  'post',
              beforeSend: function () {
              },
              success:  function (ans) {
                Materialize.toast(ans, 3000, 'rounded');
              }
      });
}

function Finalizar(){
    updateTokens();
var datos = {
  'id' : mod,
  'desc' : $('#desc').val()
};
  datos[tokenName] = tokenHash;
      $.ajax({
              data:  datos,
              url:   urlFinalizar,
              type:  'post',
              beforeSend: function () {
              },
              success:  function (ans) {
                Materialize.toast(ans, 3000, 'rounded');
              }
      });
}


function NoFinalizar(){
  updateTokens();
var datos = {
'id' : mod,
'desc' : $('#desc').val()
};
datos[tokenName] = tokenHash;
    $.ajax({
            data:  datos,
            url:   urlNoFinalizar,
            type:  'post',
            beforeSend: function () {
            },
            success:  function (ans) {
              Materialize.toast(ans, 3000, 'rounded');
            }
    });
}

$(document).ready(function() {
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
    $('#Pendiente tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Editar" && title!="Estado"){
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }else{
          $(this).html('');
        }
      } );
    var table = $('#Pendiente').DataTable(
      {
        data: dataSet,
        "drawCallback":function(){

        $('.tooltipped').tooltip({delay: 50});
        },
         columns: [
            { title: "<div class='text-center'></div>" },
            { title: "<div class='text-center'>Orden de trabajo Nº</div>" },
            { title: "<div class='text-center'>Orden de Servicio Nº</div>" },
            { title: "<div class='text-center'>Fecha Inicio</div>" },
            { title: "<div class='text-center'>Equipo</div>" },
            { title: "<div class='text-center'>Serial</div>" },
            { title: "<div class='text-center'>Codigo Interno</div>" },
            { title: "<div class='text-center'>Cliente</div>" },
            { title: "<div class='text-center'>Servicio</div>" },
            { title: "<div class='text-center'>Fecha Fin</div>" },
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

$(document).ready(function() {
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
    $('#Finalizado tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Editar" && title!="Estado"){
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }else{
          $(this).html('');
        }
      } );
    var table = $('#Finalizado').DataTable(
      {
        data: dataSetF,
        "drawCallback":function(){

        $('.tooltipped').tooltip({delay: 50});
        },
         columns: [
            { title: "<div class='text-center'></div>" },
            { title: "<div class='text-center'>Orden de trabajo Nº</div>" },
            { title: "<div class='text-center'>Orden de Servicio Nº</div>" },
            { title: "<div class='text-center'>Fecha Inicio</div>" },
            { title: "<div class='text-center'>Equipo</div>" },
            { title: "<div class='text-center'>Serial</div>" },
            { title: "<div class='text-center'>Codigo Interno</div>" },
            { title: "<div class='text-center'>Cliente</div>" },
            { title: "<div class='text-center'>Tecnico Asignado</div>" },
            { title: "<div class='text-center'>Servicio</div>" },
            { title: "<div class='text-center'>Fecha Fin</div>" },
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

$(document).ready(function() {
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );
    $('#Ejecucion tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Editar" && title!="Estado"){
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }else{
          $(this).html('');
        }
      } );
    var table = $('#Ejecucion').DataTable(
      {
        data: dataSetE,
        "drawCallback":function(){

        $('.tooltipped').tooltip({delay: 50});
        },
         columns: [
            { title: "<div class='text-center'></div>" },
            { title: "<div class='text-center'>Orden de trabajo Nº</div>" },
            { title: "<div class='text-center'>Orden de Servicio Nº</div>" },
            { title: "<div class='text-center'>Fecha Inicio</div>" },
            { title: "<div class='text-center'>Equipo</div>" },
            { title: "<div class='text-center'>Serial</div>" },
            { title: "<div class='text-center'>Codigo Interno</div>" },
            { title: "<div class='text-center'>Cliente</div>" },
            { title: "<div class='text-center'>Tecnico Asignado</div>" },
            { title: "<div class='text-center'>Servicio</div>" },
            { title: "<div class='text-center'>Fecha Fin</div>" },
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


