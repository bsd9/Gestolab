<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>

<?php echo form_open_multipart('Cliente/actualizar/'. $editado[0]->getId(),array('id'=>'formulario')); ?>

<div class="container">
  <div class="row">
    <div class="col s12 m4 offset-m8">
    </div>
      <div class="col s12 m4 offset-m2">
        <h5>Activar</h5>
<div class="switch ">
  <label>
    No
    <input type="checkbox" <?php if($editado[0]->getEstado()){echo " checked ";} ?> name="Activo">
    <span class="lever blue darken-3"></span>
    Si
  </label>
</div>
</div>
</div>
</div>


<div id="info" class="card-panel">
      <div class="card-panel">

          <div class="col s12 m6">
            <div class="row">
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="razonSocial">Razón Social </label> <input type ="text" name="razonSocial"  class="validate" value="<?php echo $editado[0]->getRazonSocial(); ?>"/> </div>

                      <div class="input-field"> <label for="NIT">NIT </label> <input type ="text" name="NIT"  class="validate" value="<?php echo $editado[0]->getNIT(); ?>"/> </div>
                    </div>
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="telefono">Telefono </label> <input type ="text" name="telefono"  class="validate" value="<?php echo $editado[0]->getTelefono(); ?>"/> </div>

                      <div class="input-field"> <label for="direccion">Dirección </label> <input type ="text" name="direccion"  class="validate" value="<?php echo $editado[0]->getDireccion(); ?>"/> </div>
                    </div>


                    </div>

                    <div class="row">
                      <div class="col s12 m4">
                        <div class="input-field"><select type ="Select" name="pais" id="pais" >
                          <option  disabled selected>Elija una opción</option>
                          <?php foreach($paises as $pais){ ?>
                            <option  <?php if ($editado[0]->getPais() == $pais->getId()){echo 'selected' ;  }?>  value="<?=$pais->getId() ;?>"><?=$pais->getNombre();?></option>
                            <?php } ?>
                          </select>
                          <label>Pais</label>
                        </div>
                      </div>
                      <div class="col s12 m4">
                        <div class="input-field"><select type ="Select" name="departamento" id="departamento" >
                          <option  disabled selected>Elija una opción</option>
                          <?php foreach($departamentos as $departamento){ ?>
                            <option <?php if ($editado[0]->getDepartamento() == $departamento->getId()){echo 'selected' ;  }?>  value="<?=$departamento->getId();?>"><?=$departamento->getNombre();?></option>
                            <?php } ?>
                          </select>
                          <label>Departamento</label>
                        </div>
                      </div>  
                      <div class="col s12 m4">
                        <div class="input-field"> <select type ="Select" name="ciudad" id="ciudad"/>
                          <option  disabled selected>Elija una opción</option>
                          <?php foreach($ciudades as $ciu){ ?>
                            <option  <?php if ($editado[0]->getCiudad() == $ciu->getId()){echo 'selected' ;  }?>  value="<?=$ciu->getId();?>"><?=$ciu->getNombre();?></option>
                            <?php } ?>
                          </select>
                          <label>Ciudad</label>
                        </div>
                      </div>

                      <input type ="text" name="ciudadh" id="ciudadh" hidden />
                    </div>
            </div>
          </div>
        </div>











<div class="center">
  <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar" style="bottom:5px">Enviar
    <i class="material-icons right">send</i>
  </button>
</div>



  <?php echo form_close();?>

<!-- ################################################################################################################################ -->

  <?php
  $iddeptscs =[];
$idciudads =[];
$nombreciudads =[];
  foreach($ciudades as $ciud){
  $iddeptscs[]=$ciud->getIdDepartamento();
  $idciudads[]=$ciud->getId();
  $nombreciudads[]=$ciud->getNombre();
  }
  ?>
  <?php
  $idpais=[];
$iddepts=[];
$nombredept=[];
  foreach($departamentos as $depart){
  $idpais[]=$depart->getIdPais();
  $iddepts[]=$depart->getId();
  $nombredept[]=$depart->getNombre();
  }
  ?>
<script>
    




    var idpais = <?=json_encode($idpais)?>;
    var iddepto = <?=json_encode($iddepts)?>;
    var nombredepto = <?=json_encode($nombredept)?>;

    var datos2=new Array();
    for(i=0;i<idpais.length;i++){
      datos2[i]=new Array(idpais[i],iddepto[i],nombredepto[i])
    }

     var iddeptc = <?=json_encode($iddeptscs)?>;
     var idciudad = <?=json_encode($idciudads)?>;
     var nombrec = <?=json_encode($nombreciudads)?>;

     var datos=new Array();
     for(i=0;i<iddeptc.length;i++){
       datos[i]=new Array(iddeptc[i],idciudad[i],nombrec[i])
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


</script>
<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/Cliente/EditarCliente.js"></script>-->
