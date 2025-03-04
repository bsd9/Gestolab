$(document).ready(function () {
  $('select').material_select();

});

function MostrarMenu() {
  $('.button-collapse').sideNav('show');
}
function OcultarMenu() {
  $(".button-collapse").sideNav("hide");
}
$(document).ready(function () {
  $('.modal').modal();
  $('.chips').material_chip();
  $(".button-collapse").sideNav({
    closeOnClick: true,
    menuWidth: 360
  });
  //		Ocultar();
  $('.collapsible').collapsible();
  $(".dropdown-button").dropdown();
});




function AbrirModalInforme(nombreInforme) {
  $('#NombreInforme').html(nombreInforme)
  InformeGenerar = nombreInforme
  $('#LimiteFechas').modal('open');

}

function AbrirModalInformeParcial(nombreInforme) {
  $('#NombreInformeParcial').html(nombreInforme)
  campos = $('.datepicker').pickadate({
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
    fechafinal = $('#FechaFinalParcial').pickadate()
    picker = fechafinal.pickadate('picker')
    picker.set('select',new Date())
    Materialize.updateTextFields();
  InformeGenerar = nombreInforme
  $('#LimiteFechasParcial').modal('open');
}


function irInforme() {
  if ("Informe de Equipos" == InformeGenerar) {
   window.location.href = urlInformeEquipos + '/' + $('#razonSocialid').val();  
  }
}

function irInformeParcial() {
  if ("Informe de Ventas" == InformeGenerar) {
    window.location.href = urlInformeVentas + '/' + $("#FechaInicialParcial").val() + '/' +  $("#FechaFinalParcial").val();
  }
}