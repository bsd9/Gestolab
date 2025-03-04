
function ModalAprobar(id) {
    $('#idOrden').val(id)
    $('#NoCompraApr').html(id);
    $('#Aprobar').modal('open');
}




function Aprobar() {
    updateTokens();
    var datos = {
        'id': mod
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




function pintarDetalles(id) {
    updateTokens();
    var datos = {
        'id': id
    };
    datos[tokenName] = tokenHash;
    $.ajax({
        data: datos,
        url: urlDetalles,
        type: 'post',
        beforeSend: function () {
            $("#NoCompra").html(id);
            $('#detalles').modal('open');
            $("#ndetalles").html("Procesando, espere por favor...");
        },
        success: function (ans) {
            $("#ndetalles").html(ans);
            //$("#resultado").html(response);
        }
    });
}

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




$(document).ready(function () {
    $('#listaAcciones').html($('#listaAcciones').html() + AccionesHTML);

    $('#listaPedidos tfoot th').each(function () {
        var title = $(this).text();
        if (title != "Editar" && title != "Estado") {
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        } else {
            $(this).html('');
        }
    });
    var table = $('#listaPedidos').DataTable(
        {
            "lengthMenu": [[25, 50, -1], [25, 50, "Todo"]],
            "order": [[1, "desc"]],
            "bProcessing": true,
            "deferRender": true,
            "drawCallback": function () {
                $('.tooltipped').tooltip('remove');
                $('.tooltipped').tooltip({delay: 50});
            },
            data: dataSet,
            columns: [
                {title: "<div class='text-center'></div>", "orderable": false},
                {title: "<div class='text-center'>Orden de Servicio Nº</div>"},
                {title: "<div class='text-center'>Fecha Creacion</div>"},
                {title: "<div class='text-center'>Estado</div>"},
                {title: "<div class='text-center'>Fecha Aprobacion</div>", "orderable": false}
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
                    "first": "Primera",
                    "last": "Ultima",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        }
    );
    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });
    $('.tooltipped').tooltip({delay: 50});
    $('select').material_select();
});
