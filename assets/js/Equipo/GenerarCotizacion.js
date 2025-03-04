tablehead =[  { title: "<div class='text-center'>Equipo</div>" },
{ title: "<div class='text-center'>Servicio</div>" },
{ title: "<div class='text-center'>Cantidad Equipos</div>" },
{ title: "<div class='text-center'>Cantidad</div>" },
{ title: "<div class='text-center'>Precio Unitario</div>" },
{ title: "<div class='text-center'>Precio Total</div>" },
{ title: "<div class='text-center'>IVA(%)</div>" }
]


function dibujar(){
tabla = $('#listaEmpleado').DataTable()
tabla.search('');
tabla.draw();

}
function precioUnitario(idequipo,servicio){
var cantidad = $("#cantidad-"+idequipo+"-"+servicio).val();
var subptotal = $("#valor-"+idequipo+"-"+servicio).val() * cantidad
$("#total-"+idequipo+"-"+servicio).html(subptotal)
}
$(document).ready(function() {


$('.modal').modal();
$('#listaEmpleado tfoot th').each( function () {
    var title = $(this).text();
    if(title!="Acciones" && title!="Estado"){
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    }else{
      $(this).html('');
    }
  } );

var table = $('#listaEmpleado').DataTable(
  {
    "lengthMenu": [[25, 50, -1], [25, 50, "Todo"]],
     "drawCallback":function(){
                  $('.tooltipped').tooltip('remove');
                  $('.tooltipped').tooltip({delay: 50});
                  },
    data: dataSet,
     columns: tablehead,
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
