
<div class="row">
  <div class="col s10 offset-s1">
    <?php echo validation_errors('<div class="chip blue col s6">', '<i class="material-icons">close</i></div>'); ?>
  </div>
</div>
<?php
echo form_open_multipart('Variable/guardar',array('id'=>'formulario'));
?>


    <div id="info" class="card-panel">
      <div class="card-panel" >

          <div class="col s12 m6">
            <div class="row">
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="titulo">Nombre </label> <input type ="text" name="titulo"  class="validate" value="<?php echo set_value('titulo'); ?>"/> </div>
                      
                    </div>
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="precioPiso">Precio Piso </label> <input type ="text" name="precioPiso"  class="validate" value="<?php echo set_value('precioPiso'); ?>"/> </div>
                      <div class="input-field"> <label for="precioPublico">Precio Publico </label> <input type ="text" name="precioPublico"  class="validate" value="<?php echo set_value('precioPublico'); ?>"/> </div>
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
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Variable/IngresarVariable.js"></script>
