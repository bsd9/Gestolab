<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>

<?php echo form_open('Cargo/guardar',array('id'=>'formulario')); ?>

<div class="card-panel">
  <div class="card-panel">
    <div class="row">
      <div class="col s12 m6">
        <div class="input-field"> <label for="nombre">Nombre</label> <input type ="text" name="nombre" value="<?php echo set_value('nombre'); ?>"/> </div>
      </div>
    <div class="col s12 m6">
      <div class="input-field"><select type ="Select" name="idDependencia" id="idDependencia" >
        <option  disabled selected>Elija una opción</option>
          <?php foreach($dependencias as $dependencia){ ?>
            <?php if ($dependencia->getEstado()){?>
              <option  value="<?=$dependencia->getId();?>"><?=$dependencia->getNombre();?></option>
            <?php } ?>
          <?php } ?>
        </select>
        <label>Dependencia</label>
      </div>
    </div>
    </div>
        <h5>Permisos</h5>
      <div class="divider"></div>
        <div class="row">
          <?php foreach ($permisos as $permiso){ ?>
            <div class="col s12 m3">
                <p>Permiso para: <?=$permiso->getNombre()?></p>
                  <div class="switch ">
                      <label>
                        Off
                        <input type="checkbox" value='<?=$permiso->getId()?>' name='<?=$permiso->getNombre()?>'>
                        <span class="lever blue darken-3"></span>
                        On
                      </label>
                  </div>
            </div>
          <?php } ?>
        </div>
      <div class="center">
        <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Enviar
            <i class="material-icons right">send</i>
        </button>
      </div>
  </div>
</div>

<?php echo form_close();?>

<script>
  $(document).ready(function() {
   $('select').material_select();
    } );
</script>




<!-- ################################################################################################################################ -->
