

<div class="row">
    <div class="col s10 offset-s1">
      <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
  echo form_open_multipart('Equipo/guardardetalletecnico/'.$incidente);
?>
      <div class="card-panel">

        <div class="input-field">
          <textarea id="descripcion" name='descripcion' class="materialize-textarea">
          </textarea>
          <label for="descripcion">Descripcion</label>
        </div>

      </div>

  <div class="center">
  <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar" style="bottom:5px">Guardar
      <i class="material-icons right">send</i>
  </button>
    </div>


  <?php echo form_close();?>

<script type="text/javascript">
$(document).ready(function() {

  $('#descripcion').trigger('autoresize');
  $('.chips').material_chip();

});
</script>
