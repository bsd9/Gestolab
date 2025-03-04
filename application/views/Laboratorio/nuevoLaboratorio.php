<div class="row">
    <div class="col s10 offset-s1">
      <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
if ($mod) {
  echo form_open_multipart('Laboratorio/actualizar/'.$laboratorio->getId());
}else {
  echo form_open_multipart('Laboratorio/guardar/');
}
?>
<div class="card-panel">
<div class="card-panel">
<div class="row">
  <div class="col s6">
    <div class="input-field"><label for="nombre">nombre</label>   <input type ="text" name="nombre" class="validate" value="<?php if($mod){echo $laboratorio->getNombre();}else{echo set_value('nombre'); }  ?>" /> <br/></div>
  </div>
  <div class="col s6">
  </div>
</div>
  <div class="center">
  <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Guardar
      <i class="material-icons right">send</i>
  </button>
    </div>

    </div>
    </div>
  <?php echo form_close();?>

<script type="text/javascript">
$(document).ready(function() {
  $('select').material_select();
  $('.chips').material_chip();

});

</script>
