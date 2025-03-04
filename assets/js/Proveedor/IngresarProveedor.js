
var idModificando;
var trNodeEditando;


  function ModificarFilaContacto(){
    nombre[idModificando] =$("#NombreE").val();
    apellido[idModificando] =$("#ApellidoE").val();
    cargo[idModificando] = $("#CargoE").val();
    telefono[idModificando] =$("#TelefonoE").val();
    extencion[idModificando] = $("#ExtencionE").val();
    celular[idModificando] =$("#CelularE").val();
    email1[idModificando] =$("#EmailE").val();
    email2[idModificando] =$("#Email2E").val();


    $("#nombreh").val(nombre);
    $("#apellidoh").val(apellido);
    $("#cargoh").val(cargo);
    $("#telefonoh").val(telefono);
    $("#extencionh").val(extencion);
    $("#celularh").val(celular);
    $("#email1h").val(email1);
    $("#email2h").val(email2);

    document.getElementById("contactos").deleteRow(idModificando+1);

    tabla = document.getElementById('contactos');
    tr = tabla.insertRow(idModificando+1);
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#NombreE").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#ApellidoE").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#CargoE").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#TelefonoE").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#ExtencionE").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#CelularE").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#EmailE").val();
    td = tr.insertCell(tr.cells.length);
    td.innerHTML = $("#Email2E").val();
    td = tr.insertCell(tr.cells.length);

    td.innerHTML = "<i style='color:red' class='small material-icons' onclick='BorrarContacto(this.parentNode.parentNode.rowIndex)'>delete</i>" +
    "<i style='color:orange' onclick='ModificarContacto(" + idModificando +" ,this.parentNode.parentNode.parentNode)' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i>";
        $('#EditarModal').modal('close');
  }


function ModificarContacto(id,trnode){
  //$("#codproductosE").val(precio);
  $("#NombreE").val(nombre[id]);
  $("#Email2E").val(email2[id]);
  $("#ApellidoE").val(apellido[id]);

  $("#CargoE").val(cargo[id]);
  $("#CelularE").val(celular[id]);
  $("#TelefonoE").val(telefono[id]);

  $("#ExtencionE").val(extencion[id]);

  $("#EmailE").val(email1[id]);

idModificando = id;
trNodeEditando = trnode;
      $('#EditarModal').modal('open');
        Materialize.updateTextFields();

}

      var ciudades = [];
      var direcciones = [];
      function agregarDireccion() {
        var tr, td, tabla;
        if($("#direccion").val()==""){
         Materialize.toast('Ingresa una dirección', 1000);
       }else if($("#pais").val()==null){
         Materialize.toast('Elija un pais', 1000);
       }else if($("#departamento").val()==null){
         Materialize.toast('Elija un departamento', 1000);
       }else if($("#ciudad").val()==null){
         Materialize.toast('Elija un ciudad', 1000);
        }else {
          tabla = document.getElementById('direcciones');
          tr = tabla.insertRow(tabla.rows.length);
          td = tr.insertCell(tr.cells.length);
          td.innerHTML = "<p class='tooltipped truncate' data-delay='150' data-tooltip='"+$("#direccion").val()+"' >" + $("#direccion").val() + "</p>";
          td = tr.insertCell(tr.cells.length);
          td.innerHTML =  $("#pais option:selected").html();
          td = tr.insertCell(tr.cells.length);
          td.innerHTML =  $("#departamento option:selected").html();
          td = tr.insertCell(tr.cells.length);
          td.innerHTML =  $("#ciudad option:selected").html();
          td = tr.insertCell(tr.cells.length);
          td.innerHTML = "<i style='color:red' class='small material-icons' onclick='BorrarDireccion(this.parentNode.parentNode.rowIndex)'>delete</i>";
          ciudades.push($("#ciudad").val());
          direcciones.push($("#direccion").val());
        }

        $("#direccionh").val(direcciones);
        $("#ciudadh").val(ciudades);

        }
      function BorrarDireccion(id) {
        document.getElementById("direcciones").deleteRow(id);
        var ciudadestemp = ciudades;
        var direccionestemp = direcciones;
        ciudades=[];
        direcciones=[];
        var h=0;
        for(j=0;j<direccionestemp.length;j++){
          if(j!=(id-1)){
            ciudades[h]=ciudadestemp[j]
            direcciones[h]=direccionestemp[j]
            h++;
          }
        }
        $("#direccionh").val(direcciones);
        $("#ciudadh").val(ciudades);
      }

    var nombre = [];
    var apellido = [];
    var cargo = [];
    var telefono = [];
    var extencion = [];
    var celular = [];
    var email1 = [];
    var email2 = [];
   
    function agregarContacto() {
      var tr, td, tabla;
      if($("#Nombre").val()==''){
       Materialize.toast('Ingresa un nombre para el contacto', 1000);
      }else {
        tabla = document.getElementById('contactos');
        tr = tabla.insertRow(tabla.rows.length);
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Nombre").val();
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Apellido").val();
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Cargo").val();
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Telefono").val();
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Extencion").val();
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Celular").val();
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Email").val();
        td = tr.insertCell(tr.cells.length);
        td.innerHTML = $("#Email2").val();
        td = tr.insertCell(tr.cells.length);

        td.innerHTML = "<i style='color:red' class='small material-icons' onclick='BorrarContacto(this.parentNode.parentNode.rowIndex)'>delete</i>" +
        "<i style='color:orange' onclick='ModificarContacto(" + nombre.length +" ,this.parentNode.parentNode.parentNode)' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i>";
        nombre.push($("#Nombre").val());
        apellido.push($("#Apellido").val());
        cargo.push($("#Cargo").val());
        telefono.push($("#Telefono").val());
        extencion.push($("#Extencion").val());
        celular.push($("#Celular").val());
        email1.push($("#Email").val());
        email2.push($("#Email2").val());

      }

      $("#nombreh").val(nombre);
      $("#apellidoh").val(apellido);
      $("#cargoh").val(cargo);
      $("#telefonoh").val(telefono);
      $("#extencionh").val(extencion);
      $("#celularh").val(celular);
      $("#email1h").val(email1);
      $("#email2h").val(email2);

      }

      function BorrarContacto(id) {
        document.getElementById("contactos").deleteRow(id);
        var nombretemp = nombre;
        var apellidotemp = apellido;
        var cargotemp = cargo;
        var telefonotemp = telefono;
        var extenciontemp = extencion;
        var celulartemp = celular;
        var email1temp = email1;
        var email2temp = email2;
    
        nombre=[]
        apellido=[]
        cargo=[]
        telefono=[]
        extencion=[]
        celular=[]
        email1=[]
        email2=[]
       
        var h=0;
        for(j=0;j<nombretemp.length;j++){
          if(j!=(id-1)){
            nombre[h]=nombretemp[j]
            apellido[h]=apellidotemp[j]
            cargo[h]=cargotemp[j]
            telefono[h]=telefonotemp[j]
            extencion[h]=extenciontemp[j]
            celular[h]=celulartemp[j]
            email1[h]=email1temp[j]
            email2[h]=email2temp[j]

            h++;
          }
        }
        $("#nombreh").val(nombre);
        $("#apellidoh").val(apellido);
        $("#cargoh").val(cargo);
        $("#telefonoh").val(telefono);
        $("#extencionh").val(extencion);
        $("#celularh").val(celular);
        $("#email1h").val(email1);
        $("#email2h").val(email2);

      }


  var nombreComercial = [];
  function agregarNombreComercial() {
    var tr, td, tabla;
    if($("#NombreComercial").val()==''){
     Materialize.toast('Ingresa un nombre comercial', 1000);
    }else {
      tabla = document.getElementById('NombreComercialT');
      tr = tabla.insertRow(tabla.rows.length);
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = $("#NombreComercial").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = "<i style='color:red' class='small material-icons' onclick='BorrarNombreComercial(this.parentNode.parentNode.rowIndex)'>delete</i>";
      nombreComercial.push($("#NombreComercial").val());
    }
    $("#NombreComercialh").val(nombreComercial);
    }

    function BorrarNombreComercial(id) {
      document.getElementById("NombreComercialT").deleteRow(id);
      var NombreComercialtemp = nombreComercial;
      nombreComercial=[];
      var h=0;
      for(j=0;j<NombreComercialtemp.length;j++){
        if(j!=(id-1)){
          nombreComercial[h]=NombreComercialtemp[j]
          h++;
        }
      }
      $("#NombreComercialh").val(nombreComercial);
    }

$('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
  });

  function previewFile() {
      var preview = document.querySelector('#img'); //selects the query named img
      var file = document.querySelector('input[type=file]').files[0]; //sames as here
      var reader = new FileReader();
      reader.onloadend = function() {
          preview.src = reader.result;
      }
      if (file) {
          reader.readAsDataURL(file); //reads the data as a URL
      } else {
          preview.src = "";
      }
  }

  $(document).ready(function(){
    $('select').material_select();
    $("#pais").change(function(){
      valor = $("#pais").val();
      document.getElementById("departamento").options.length=0;
      for(i=0;i<datos.length;i++)
      {
        if(datos[i][0]==valor)
        {
          document.getElementById("departamento").options[document.getElementById("departamento").options.length]=new Option(datos[i][2], datos[i][1]);
        }
      }
      $('select').material_select('destroy');
      $('select').material_select();
    });
    $("#departamento").change(function(){
      valor = $("#departamento").val();
      document.getElementById("ciudad").options.length=0;
      for(i=0;i<datos2.length;i++)
      {
        if(datos2[i][0]==valor)
        {
          document.getElementById("ciudad").options[document.getElementById("ciudad").options.length]=new Option(datos2[i][2], datos2[i][1]);
        }
      }
      $('select').material_select('destroy');
      $('select').material_select();
    });
  });
