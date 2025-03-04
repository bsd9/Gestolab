
<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open_multipart('GrupoEmpresarial/actualizar/'.$editado[0]->getId());
?>
<div class="card-panel" >
    <div class="card-panel">
      <div class="row">
    <div class="col s12 m3 offset-m1">
      <h5>Activar</h5>
      <div class="switch ">
        <label>
          No
          <input type="checkbox" <?php if($editado[0]->getEstado()){echo " checked ";} ?> name="estado">
          <span class="lever blue darken-3"></span>
          Si
        </label>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="col s12 m6">
<div class="input-field"> <label for="razonSocial">Razon social</label> <input type ="text" name="razonSocial" value="<?php echo $editado[0]->getRazonSocial(); ?>"/> </div>
</div>
<div class="col s12 m6">
<div class="input-field"> <label for="NIT">NIT</label> <input type ="text" name="NIT" value="<?php echo $editado[0]->getNIT(); ?>"/> </div>
</div>
<div class="col s12 m6">
<div class="input-field"> <label for="telefono">telefono</label> <input type ="text" name="telefono" value="<?php echo $editado[0]->getTelefono(); ?>"/> </div>
</div>
<div class="col s12 m6">
<div class="input-field"> <label for="direccion">direccion</label> <input type ="text" name="direccion" value="<?php echo $editado[0]->getDireccion(); ?>"/> </div>
</div>
<div class="col s12 m6">
<div class="input-field"> <label for="fax">fax</label> <input type ="text" name="fax" value="<?php echo $editado[0]->getFax(); ?>"/> </div>
</div>
<div class="col s12 m6">
<div class="input-field"> <label for="correo">correo</label> <input type ="text" name="correo" value="<?php echo $editado[0]->getCorreo(); ?>"/> </div>
</div>
<div class="col s12 m6">
<div class="input-field"> <label for="web">web</label> <input type ="text" name="web" value="<?php echo $editado[0]->getWeb(); ?>"/> </div>
</div>
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
