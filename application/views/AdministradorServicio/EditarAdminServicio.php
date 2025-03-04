<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="material-icons">close</i></div>'); ?>
    </div>
</div>

<?php echo form_open_multipart('AdministradorServicio/actualizar/'. $editado[0]->getId(),array('id'=>'formulario')); ?>

<div class="container">
  <div class="row">
    <div class="col s12 m4 offset-m8">
      <div class="central" >
        <a href="<?=site_url('Variable/index')?>">
          <button class="btn waves-effect waves-light blue darken-3">Ver Ultimos modificadores
          <i class="material-icons right">send</i>
          </button>
        </a>
      </div>
    </div>
</div>
</div>


<div id="info" class="card-panel">
      <div class="card-panel">

          <div class="col s12 m6">
            <div class="row">
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="nombre">Nombre </label> <input type ="text" name="nombre"  class="validate" value="<?php echo $editado[0]->getNombre(); ?>"/> </div>
                           <div class="input-field">
                                <select type ="Select" id="unidadMedida" name='unidadMedida'>
            <option  disabled selected>Elija una opción</option>
            <option <?php if($editado[0]->getUnidadMedida() == "Servicio"){echo "selected" ;}  ?> value="Servicio">Servicio</option>
            <option <?php if($editado[0]->getUnidadMedida() == "Hora Ingenierio"){echo "selected";}?> value="Hora Ingenierio">Hora Ingeniero</option>
            <option <?php if($editado[0]->getUnidadMedida() == "Unidad"){echo "selected";} ?> value="Unidad">Unidad</option>
          </select>
                            </div>

                <div class="col s12 m3">
                <p>Variables:</p>
                  <div class="switch ">
                      <label>
                        No
        <input type="checkbox" <?php if($editado[0]->getVariable()){echo " checked ";} ?> name='variable' value= '1' id="variable">
                        <span class="lever blue darken-3"></span>
                        Si
                      </label>
                  </div>
                </div>

                    </div>
                    <div class="col s12 m6" id="precios" <?php if($editado[0]->getVariable()){echo " hidden ";} ?> >
                      <div class="input-field"> <label for="precioPiso">Precio Piso </label> <input type ="text" name="precioPiso"  class="validate" value="<?php echo $editado[0]->getPrecioPiso(); ?>"/> </div>
                     <div class="input-field"> <label for="precioPublico"> Precio Publico</label> <input type ="text" name="precioPublico"  class="validate" value="<?php echo $editado[0]->getPrecioPublico(); ?>"/> </div>
                     </div>
                    <div class="col s12 m3">

                <p>Estado:</p>
                  <div class="switch ">
                      <label>
                      Inactivo
        <input type="checkbox" <?php if($editado[0]->getEstado()){echo " checked ";} ?> name='estado' value= '1'>
                <span class="lever blue darken-3"></span>
                      Activo
                      </label>
                  </div>
                </div>
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



<script>

     $('.chips').material_chip();
$(document).ready(function(){

  $('#variable').on('change',function(){
    if (this.checked) {
     $("#precios").attr("hidden", true)
    } else {
      $("#precios").attr("hidden", false)
    }
  })
});

</script>
