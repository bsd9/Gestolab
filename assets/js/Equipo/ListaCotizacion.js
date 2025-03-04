var $input = $('.datepicker').pickadate({
    labelMonthNext: 'Siguiente mes',
    labelMonthPrev: 'Mes anterior',
    labelMonthSelect: 'Elija un mes',
    labelYearSelect: 'Elija un año',
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'],
    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    weekdaysLetter: ['D', 'L', 'M', 'W', 'J', 'V', 'S'],
    today: 'Hoy',
    clear: 'Limpiar',
    close: 'Cerrar',
    format: 'yyyy-mm-dd',
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
});

function ModalEnviarAprobar(id) {
    mod = id;
    $('#NoCompraEnv').html(id);
    $('#EnviarAprobar').modal('open');
}

function ModalAprobar(id) {
    mod = id;
    $('#NoCompraApr').html(id);
    $('#Aprobar').modal('open');
}

function ModalDatos(id) {
    mod = id;
    $('#Datos').modal('open');
}

function ModalAnular(id) {
    mod = id;
    $('#NoCompraAnu').html(id);
    $('#Anular').modal('open');
}


function EnviarAprobar() {
    updateTokens();
    var datos = {
        'id': mod
    };

    datos['tipoOrigenPedido'] = 'Precencial'
    datos['origenPedido'] = '';
    if ($('#listadesplegable :selected').val() == "Correo Electronico") {
        datos['tipoOrigenPedido'] = "Correo Electronico";
        datos['origenPedido'] = $('#TfechaCorreo').val();
    }
    if ($('#listadesplegable :selected').val() == "Telefono") {
        datos['tipoOrigenPedido'] = "Telefono";
        datos['origenPedido'] = $('#TpersonaContacto').val();
    }
    if ($('#listadesplegable :selected').val() == "Documento fisico") {
        datos['tipoOrigenPedido'] = "Documento fisico";
        datos['origenPedido'] = $('#TDocumento').val();
    }
    datos[tokenName] = tokenHash;
    $.ajax({
        data: datos,
        url: urlEnviarAprobar,
        type: 'post',
        beforeSend: function () {
        },
        success: function (ans) {
            Materialize.toast(ans, 3000, 'rounded');
        }
    });
}

function Anular() {
    updateTokens();
    var datos = {
        'id': mod,
        'razonAnula': $('#razonAnula').val()
    };
    datos[tokenName] = tokenHash;
    $.ajax({
        data: datos,
        url: urlAnulacion,
        type: 'post',
        beforeSend: function () {
        },
        success: function (ans) {
            Materialize.toast(ans, 3000, 'rounded');
        }
    });
}


function AprobarFactura() {
    updateTokens();
    var datos = {
        'id': mod,
        'fechapago': $('#tfechapago').val(),
        'flete': $('#tflete').val(),
        'retefuente': $('#datosPago').val(),
        'notasfactura': $('#notasfactura').val(),
        'tipopago': $('#tipopago').val()

    };
    datos[tokenName] = tokenHash;
    $.ajax({
        data: datos,
        url: urlAprobar,
        type: 'post',
        beforeSend: function () {
        },
        success: function (ans) {
            Materialize.toast(ans, 3000, 'rounded');
        }
    });
}


function inputs() {
    if ($('#listadesplegable :selected').val() == "Correo Electronico") {
        $('#fechaCorreo').attr("hidden" , false);
        $('#personaContacto').hide();
        $('#Documento').hide();
    }
    if ($('#listadesplegable :selected').val() == "Telefono") {
        $('#fechaCorreo').hide();
        $('#personaContacto').attr("hidden" , false);
        $('#Documento').hide();
    }
    if ($('#listadesplegable :selected').val() == "Documento fisico") {
        $('#fechaCorreo').hide();
        $('#personaContacto').hide();
        $('#Documento').attr("hidden" , false);
    }
    if ($('#listadesplegable :selected').val() == "Presencial") {
        $('#fechaCorreo').hide();
        $('#personaContacto').hide();
        $('#Documento').hide();
    }

}

function redirection(url){
    id = $('#clientes :selected').val();
    window.location.href = url +id ;
}

function generarCotizacion() {
    $('#modalR').modal('open');
}

$(document).ready(function() {
  var Acciones = new Array();

  Acciones[0] = '';
  var AccionesHTML = '';

  for (var i = 0; i < Acciones.length; i++) {
    AccionesHTML = AccionesHTML + Acciones[i];
  }
  $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML );

    $('#listaEmpleado tfoot th').each( function () {
        var title = $(this).text();
        if(title!="Acciones"){
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        }else{
            $(this).html('');
        }
    } );

    var table = $('#listaEmpleado').DataTable(
        {
          "order": [[0, "desc"]],
            "drawCallback":function(){
                $('.tooltipped').tooltip('remove');
                $('.tooltipped').tooltip({delay: 50});
            },
            data: dataSet,
            columns: [
                { title: "<div class='text-center'>Numero</div>" },
                { title: "<div class='text-center'>Cliente</div>" },
                { title: "<div class='text-center'>Fecha</div>" },
                { title: "<div class='text-center'>Estado</div>" },
                { title: "<div class='text-center'>Fecha Factura</div>" },
                { title: "<div class='text-center'>Numero Factura</div>" },
                { title: "<div class='text-center'>Acciones</div>" , "orderable": false }
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
