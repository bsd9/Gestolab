
<div class="row">
  <div class="col s10 offset-s1">
    <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
  </div>
</div>
<?php
echo form_open_multipart('AdministradorServicio/guardar',array('id'=>'formulario'));
?>

<div id="info" class="card-panel">
    <div class="card-panel" >
        <div class="col s12 m6">
            <div class="row">
              <div class="col s12 m6">
                <div class="input-field"> <label for="nombre">Nombre </label> <input type ="text" name="nombre"  class="validate" value="<?php echo set_value('nombre'); ?>"/> </div>
                 <div class="input-field">
                          <select data-placeholder="Choose an option please" name='unidadMedida'>
                              <option disabled selected>Elija una Unidad de medida</option>
                              <option  value = "Servicio">Servicio</option>
                              <option  value = "Hora Ingeniero">Hora Ingeniero</option>
                              <option  value = "Unidad">Unidad</option>
                          </select>
                      </div>
                <div class="col s12 m3">
                <p>Variables:</p>
                  <div class="switch ">
                      <label>
                        No
                        <input type="checkbox" value='1' name='variable' id='variable'>
                        <span class="lever blue darken-3"></span>
                        Si
                      </label>
                  </div>
                </div>
                    </div>
                    <div class="col s12 m6" id="precios" >
                      <div class="input-field"> <label for="precioPiso">Precio Piso </label>
                      <input type ="text" name="precioPiso"  class="validate" value="<?php echo set_value('precioPiso'); ?>"/> </div>
                      <div class="input-field"> <label for="precioPublico">Precio Publico </label>
                      <input type ="text" name="precioPublico"  class="validate" value="<?php echo set_value('precioPublico'); ?>"/> </div>
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

s$('.chips').material_chip();
$(document).ready(function(){
  $('#variable').on('change',function(){
    if (this.checked) {
     $("#precios").hide();

    } else {
      $("#precios").show();
    }
  })
});


</script>
