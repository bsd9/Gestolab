
<div class="row">
  <div class="col s10 offset-s1">
    <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
  </div>
</div>
<?php
echo form_open_multipart('Cliente/guardar',array('id'=>'formulario'));
?>


    <div id="info" class="card-panel">
      <div class="card-panel" >

          <div class="col s12 m6">
            <div class="row">
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="razonSocial">Razón Social </label> <input type ="text" name="razonSocial"  class="validate" value="<?php echo set_value('razonSocial'); ?>"/> </div>
                      <div class="input-field"> <label for="NIT">NIT </label> <input type ="text" name="NIT"  class="validate" value="<?php echo set_value('NIT'); ?>"/> </div>

                    </div>
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="telefono">Telefono </label> <input type ="text" name="telefono"  class="validate" value="<?php echo set_value('telefono'); ?>"/> </div>
                      <div class="input-field"> <label for="direccion">Dirección </label> <input type ="text" name="direccion"  class="validate" value="<?php echo set_value('direccion'); ?>"/> </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col s12 m4">
                        <div class="input-field"><select type ="Select" name="pais" id="pais" >
                          <option  disabled selected>Elija una opción</option>
                          <?php foreach($paises as $pais){ ?>
                            <option  value="<?=$pais->getId();?>"><?=$pais->getNombre();?></option>
                            <?php } ?>
                          </select>
                          <label>Pais</label>
                        </div>
                      </div>
                      <div class="col s12 m4">
                        <div class="input-field"><select type ="Select" name="departamento" id="departamento" >
                          <option  disabled selected>Elija una opción</option>
                          <?php foreach($departamentos as $departamento){ ?>
                            <option  value="<?=$departamento->getId();?>"><?=$departamento->getNombre();?></option>
                            <?php } ?>
                          </select>
                          <label>Departamento</label>
                        </div>
                      </div>
                      <div class="col s12 m4">
                        <div class="input-field"> <select type ="Select" name="ciudad" id="ciudad"/>
                          <option  disabled selected>Elija una opción</option>
                          <?php foreach($ciudades as $ciudad){ ?>
                            <option  value="<?=$ciudad->getId();?>"><?=$ciudad->getNombre();?></option>
                            <?php } ?>
                          </select>
                          <label>Ciudad</label>
                        </div>
                      </div>
                
                    </div>
                    <div class
            </div>
          </div>
        </div>



<div class="center" style ="margin-bottom:10px">
  <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Enviar
    <i class="material-icons right">send</i>
  </button>
</div>



<?php echo form_close();?>





<!-- ################################################################################################################################ -->

<?php
foreach($ciudades as $ciudad){
  $iddeptsc[]=$ciudad->getIdDepartamento();
  $idciudad[]=$ciudad->getId();
  $nombreciudad[]=$ciudad->getNombre();
}
?>
<?php
foreach($departamentos as $depart){
  $idpais[]=$depart->getIdPais();
  $iddepts[]=$depart->getId();
  $nombredept[]=$depart->getNombre();
}
?>

<script>


    var idpais = <?=json_encode($idpais)?>;
    var iddepts = <?=json_encode($iddepts)?>;
    var nombredept = <?=json_encode($nombredept)?>;

    var datos=new Array();
    for(i=0;i<idpais.length;i++){
      datos[i]=new Array(idpais[i],iddepts[i],nombredept[i])
    }
    var iddeptc = <?=json_encode($iddeptsc)?>;
    var idciudad = <?=json_encode($idciudad)?>;
    var nombrec = <?=json_encode($nombreciudad)?>;

    var datos2=new Array();
    for(i=0;i<iddeptc.length;i++){
      datos2[i]=new Array(iddeptc[i],idciudad[i],nombrec[i])
    }

$( document ).ready(function() {
  $('select').material_select();
     $('.chips').material_chip();
   });
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Cliente/IngresarCliente.js"></script>
