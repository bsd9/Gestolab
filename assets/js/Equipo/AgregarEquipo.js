function Eliminar(id){
  temp= [];
  for (var i = 0; i < imgs.length; i++) {
    if(imgs[i] != id){
      temp.push(imgs[i]);
    }
  }
  imgs = temp;
  $("#imagenes").val(imgs)
  $("#img"+id).remove()
}

function EliminarDoc(id){
  temp= [];
  for (var i = 0; i < imgs.length; i++) {
    if(docs[i] != id){
      temp.push(docs[i]);
    }
  }
  docs = temp;
  $("#docs").val(docs)
  $("#doc"+id).remove()
}

function agregarVariable() {
  var tr, td, tabla;
  if( $("#cantidadSelect").val()=='' || $("#idVariableSelect").val()==''){
    Materialize.toast('No se pudo añadir la variable', 1000);
  }else {
    tabla = document.getElementById('variables');
    tr = tabla.insertRow(tabla.rows.length);
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#idVariableSelect :selected").text();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#cantidadSelect").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = "<div class='center'><i style='color:red' class='small material-icons' onclick='Borrar(this.parentNode.parentNode.parentNode.rowIndex)'>delete</i>" +
    "</div>";


    idVariables.push($("#idVariableSelect").val());
    cantidades.push($("#cantidadSelect").val());



  }
  $("#idVariable").val(idVariables);
  $("#cantidad").val(cantidades);

}

function Borrar(id) {
  document.getElementById("variables").deleteRow(id);
  var idVariablestemp = idVariables;
  var cantidadestemp = cantidades;
  idVariables = [];
  cantidades= [];
  var h=0;
  for(j=0;j<equipostemp.length;j++){
    if(j!=(id-1)){
      idVariables[h]=idVariablestemp[j]
      cantidades[h]=cantidadestemp[j]
      h++;
    }
  }
  $("#idVariable").val(idVariables);
  $("#cantidad").val(cantidades);
}
