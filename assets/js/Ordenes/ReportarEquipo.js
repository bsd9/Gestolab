tablehead =[
  { title: "<div class='text-center'>Equipo</div>" },
  { title: "<div class='text-center'>Marca-Modelo</div>" },
  { title: "<div class='text-center'>Serial</div>" },
  { title: "<div class='text-center'>Servicio</div>" },
  { title: "<div class='text-center'>Editar</div>", "orderable": false }
]


$(document).ready(function() {
  $('select').material_select();
  $('.chips').material_chip();
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


  $('.tooltipped').tooltip({delay: 50});
} );


var equipoencontrado = -1
function nameByCodProducto(nomb){
  for (var i = 0; i < codequ.length; i++) {
    if(codequ[i] == nomb){
      $("#nombre").val(equiname[i]);
      $("#Marca-Modelo").val(marcaname[i]);


      Materialize.updateTextFields();

      equipoencontrado = equipoid[i]
      return codequ[i];
    }
  }
  equipoencontrado = -1
  $("#nombre").val('');
  $("#Marca-Modelo").val('');
  Materialize.updateTextFields();

  return -1;

}

function agregarOrdenes() {
  var tr, td, tabla;
  if( $("#serial").val()==''){
    Materialize.toast('elije un equipo', 1000);
  }else {
    if (equipoencontrado != -1){
      tabla = document.getElementById('productost');
      tr = tabla.insertRow(tabla.rows.length);
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = $("#nombre").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = $("#Marca-Modelo").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML =  $("#serial").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML =  $("#servicio").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = "<div class='center'><i style='color:red' class='small material-icons' onclick='BorrarProducto(this.parentNode.parentNode.parentNode.rowIndex)'>delete</i>" +
      "<i style='color:orange' onclick='ModificarProducto(" + equipos.length +" ,this.parentNode.parentNode.parentNode)' class='small material-icons' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></div>";


      equipos.push(equipoencontrado);
      servicios.push($("#servicio").val());

    }

  }
  $("#equiposh").val(equipos);
  $("#serviciosh").val(servicios);

}


function BorrarProducto(id) {
  document.getElementById("productost").deleteRow(id);
  var equipostemp = equipos;
  var serviciostemp = servicios;
  equipos = [];
  servicios= [];
  var h=0;
  for(j=0;j<equipostemp.length;j++){
    if(j!=(id-1)){
      equipos[h]=equipostemp[j]
      servicios[h]=serviciostemp[j]
      h++;
    }
  }
  $("#equiposh").val(equipos);
  $("#serviciosh").val(servicios);
}

function ModificarFila(){

  equipos [idModificando] = equipoencontrado;
  servicios [idModificando] = $("#servicioE").val();

  $("#equiposh").val(equipos);
  $("#serviciosh").val(servicios);

  document.getElementById("productost").deleteRow(idModificando+1);

  tabla = document.getElementById('productost');
  tr = tabla.insertRow(tabla.rows.length);
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = $("#nombreE").val();
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = $("#Marca-ModeloE").val();
  td = tr.insertCell(tr.cells.length);
  td.innerHTML =  $("#serialE").val();
  td = tr.insertCell(tr.cells.length);
  td.innerHTML =  $("#servicioE").val();
  td = tr.insertCell(tr.cells.length);
  td.innerHTML = "<div class='center'><i style='color:red' class='small material-icons' onclick='BorrarProducto(this.parentNode.parentNode.parentNode.rowIndex)'>delete</i>" +
  "<i style='color:orange' onclick='ModificarProducto(" + idModificando +" ,this.parentNode.parentNode.parentNode)' class='small material-icons' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i></div>";

  $('#EditarModal').modal('close');
}


function codByNameProductoE(nomb){
  for (var i = 0; i < codequ.length; i++) {
    if(equipoid[i] == nomb){
      $("#nombreE").val(equiname[i]);
      $("#serialE").val(codequ[i]);
      $("#Marca-ModeloE").val(marcaname[i]);

      Materialize.updateTextFields();

      equipoencontrado = equipoid[i]
      return codequ[i];
    }
  }
  $("#nombreE").val('');
  $("#Marca-ModeloE").val('');
  Materialize.updateTextFields();

  return -1;

}



function nameByCodProductoE(nomb){
  for (var i = 0; i < codequ.length; i++) {
    if(codequ[i] == nomb){
      $("#nombreE").val(equiname[i]);
      $("#Marca-ModeloE").val(marcaname[i]);


      Materialize.updateTextFields();

      equipoencontrado = equipoid[i]
      return codequ[i];
    }
  }
  equipoencontrado = -1
  $("#nombre").val('');
  $("#Marca-Modelo").val('');
  Materialize.updateTextFields();

  return -1;

}

function pulsar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  return (tecla != 13);
}


function doSumit(val){
  $("#button").val(val);
  $("#formulario").submit();
}




function ModificarProducto(id,trnode){
  //$("#codproductosE").val(precio);

  codByNameProductoE(equipos[id]);
  $("#servicioE").val(servicios[id]).change();
  idModificando = id;
  trNodeEditando = trnode;
  $('#EditarModal').modal('open');
  Materialize.updateTextFields();

}
