
var idModificando;
var trNodeEditando;


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
                        for(i=0;i<datos2.length;i++)
                        {
           if(datos2[i][0]==valor)
           {
               document.getElementById("departamento").options[document.getElementById("departamento").options.length]=new Option(datos2[i][2], datos2[i][1]);
           }
       }
       $('select').material_select('destroy');
       $('select').material_select();
      });






        $("#departamento").change(function(){
                    valor = $("#departamento").val();


                        document.getElementById("ciudad").options.length=0;
                         for(i=0;i<datos.length;i++)
                         {
            if(datos[i][0]==valor)
            {
                document.getElementById("ciudad").options[document.getElementById("ciudad").options.length]=new Option(datos[i][2], datos[i][1]);
            }
        }
        $('select').material_select('destroy');
        $('select').material_select();
       });
  });
