

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
