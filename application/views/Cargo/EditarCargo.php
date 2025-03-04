<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>

<?php echo form_open_multipart('Cargo/actualizar/'.$editado[0]->getId());?>

<div class="card-panel">
  <div class="card-panel">
    <div class="row">
      <div class="col s12 m4">
        <div class="input-field"><label for="nombre">Nombre</label>  <input type ="text" name="nombre" class="validate"  value="<?php echo $editado[0]->getNombre(); ?>"/> <br/></div>
      </div>
  
    <div class="col s12 m3 offset-m1">
      <h5>Activar</h5>
        <div class="switch ">
          <label>
            No
            <input type="checkbox" <?php if($editado[0]->getActivo()){echo " checked ";} ?> name="activo">
            <span class="lever blue darken-3"></span>
            Si
          </label>
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
                      <input type="checkbox" <?php if($permiso->permitido == 1){echo 'checked';} ?> value='<?=$permiso->getId()?>' name="<?=$permiso->getNombre()?>">
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
