function pintarDivisa(divisa){
    updateTokens();
  var datos = {
    'divisa' : divisa
  };
    datos[tokenName] = tokenHash;
        $.ajax({
                data:  datos,
                url:   urlDivisa,
                type:  'post',
                beforeSend: function () {
                        $("#Cambio").html("Procesando, espere por favor...");
                },
                success:  function (ans) {
                  $("#Cambio").html(ans);
                        //$("#resultado").html(response);
                }
        });
}

function getval(sel) {
   pintarDivisa(sel.value);
}

  function pulsar(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    return (tecla != 13);
  }

  function doSumit(val){
  $("#button").val(val);
    $("#formulario").submit();
  }


  function creditoDebito(val){
    if(val==1){
      $('#diaspago').prop( "disabled", true );
    }
    if(val==0){
      $('#diaspago').prop( "disabled", false );
    }
  }

   $(document).ready(function(){

        $('select').material_select();
  });
        var $input = $('.datepicker').pickadate({
          labelMonthNext: 'Siguiente mes',
          labelMonthPrev: 'Mes anterior',
          labelMonthSelect: 'Elija un mes',
          labelYearSelect: 'Elija un año',
          monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
          monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
          weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado' ],
          weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
          weekdaysLetter: [ 'D', 'L', 'M', 'W', 'J', 'V', 'S' ],
          today: 'Hoy',
          clear: 'Limpiar',
          close: 'Cerrar',
          format: 'yyyy-mm-dd',
          selectMonths: true, // Creates a dropdown to control month
          selectYears: 15 // Creates a dropdown of 15 years to control year
          });

  $("#cantidadesh").val(cantidades);
  $("#productosh").val(products);
  $("#descuentosh").val(descuentos);
  $("#total").text(total);
  $("#itemtotal").text(itemtotal);

  function foundOldProducto(nomb){
    for (var i = 0; i < oldnomprod.length; i++) {
      if(oldnomprod[i] == nomb){
        return oldcostos[i];
      }
    }
    return -1;
  }

  function getOldCantPres(nomb){
    for (var i = 0; i < oldnomprod.length; i++) {
      if(oldnomprod[i] == nomb){
        return oldcant[i];
      }
    }
    return -1;
  }


  function foundProducto(nomb){
    for (var i = 0; i < nomprod.length; i++) {
      if(nomprod[i] == nomb){
        return costos[i];
      }
    }
    return -1;
  }



  function foundCodProducto(nomb){
    for (var i = 0; i < codprod.length; i++) {
      if(codprod[i] == nomb){
        return costos[i];
      }
    }
    return -1;
  }

  function nameByCodProducto(nomb){
    for (var i = 0; i < codprod.length; i++) {
      if(codprod[i] == nomb){
        $("#productos").val(nomprod[i]);
        Materialize.updateTextFields();
        return nomprod[i];
      }
    }

      $("#productos").val("error");
    Materialize.updateTextFields();
    return -1;
  }

  function codByNameProducto(nomb){
    for (var i = 0; i < nomprod.length; i++) {
      if(nomprod[i] == nomb){
        $("#codproductos").val(codprod[i]);
        Materialize.updateTextFields();
        return codprod[i];
      }
    }
    $("#codproductos").val("error");
    Materialize.updateTextFields();
    return -1;
  }



  function getCantPres(nomb){
    for (var i = 0; i < nomprod.length; i++) {
      if(nomprod[i] == nomb){
        return cant[i];
      }
    }
    return -1;
  }

  function agregarProducto() {
    var tr, td, tabla;
    if($("#productos").val()=='' && $("#codproductos").val()==''){
     Materialize.toast('elije un producto', 1000);
    }else {
      costo = foundProducto($("#productos").val());
      codcosto = foundCodProducto($("#codproductos").val())
      if(costo == -1 && codcosto == -1){
        Materialize.toast('producto invalido', 1000);
      }else{
        if(costo == -1){
          costo = codcosto;
          $("#productos").val(nameByCodProducto($("#codproductos").val()));
        }

      tabla = document.getElementById('productost');
      tr = tabla.insertRow(tabla.rows.length);
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = $("#codproductos").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = $("#productos").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = $("#cantidad").val();
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = '$' + costo;
      td = tr.insertCell(tr.cells.length);
          valor = costo * $("#cantidad").val() - (costo * $("#cantidad").val() * ($("#descuento").val() / 100));
      td.innerHTML = '$' + valor;
      td = tr.insertCell(tr.cells.length);
      td.innerHTML = "<div class='center'><i style='color:red' class='small material-icons' onclick='BorrarProducto(this.parentNode.parentNode.parentNode.rowIndex)'>delete</i></div>";
      products.push($("#productos").val());
      cantidades.push($("#cantidad").val());
      descuentos.push($("#descuento").val())
      total= total + (costo * $("#cantidad").val());
      items= getCantPres($("#productos").val());
      itemtotal=itemtotal + (items * $("#cantidad").val());
    }
  }
    $("#cantidadesh").val(cantidades);
    $("#productosh").val(products);
    $("#descuentosh").val(descuentos);
    $("#total").text(total);
    $("#itemtotal").text(itemtotal);
    $("#productos").val('');
    $("#codproductos").val("");
    $("#cantidad").val("");
    $("#descuento").val(0);
    }
  function BorrarProducto(id) {
    document.getElementById("productost").deleteRow(id);
    var cantidadestemp = cantidades;
    var productstemp = products;
    var descuentostemp = descuentos;
    descuentos= [];
    cantidades= [];
    products= [];
    var h=0;
    for(j=0;j<productstemp.length;j++){
      if(j!=(id-1)){
        cantidades[h]=cantidadestemp[j]
        products[h]=productstemp[j]
        descuentos[h] = descuentostemp[j]
        h++;
      }else{
        costo=foundProducto(productstemp[h])
        total = total - (cantidadestemp[h] * costo - (costo * cantidadestemp[h] * descuentostemp[h]));
        items=getCantPres(productstemp[h]);
        itemtotal=itemtotal - (items * cantidadestemp[h] );
      }
    }
    $("#cantidadesh").val(cantidades);
    $("#productosh").val(products);
    $("#descuentosh").val(descuentos);
    $("#itemtotal").text(itemtotal);
    $("#total").text(total);
  }
