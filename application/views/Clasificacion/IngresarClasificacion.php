
<div class="row">
  <div class="col s10 offset-s1">
    <?php echo validation_errors('<div class="chip blue col s6">', '<i class="material-icons">close</i></div>'); ?>
  </div>
</div>
<?php
echo form_open_multipart('Clasificacion/guardar',array('id'=>'formulario'));
?>


    <div id="info" class="card-panel">
      <div class="card-panel" >

          <div class="col s12 m6">
            <div class="row">
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="nombre">Nombre </label> <input type ="text" name="nombre"  class="validate" value="<?php echo set_value('nombre'); ?>"/> </div>

                    </div>
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="familia">Familia </label> <input type ="text" name="familia"  class="validate" value="<?php echo set_value('familia'); ?>"/> </div>

                    </div>



                    </div>
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



<script>

     $('.chips').material_chip();
</script>
