
<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open('Inicio/guardarContrasena' ,array('id'=>'formulario'));
?>
<div class="container">
    <div class="card-panel">
      <div class="row">
      <div class="col s12 m6 offset-m3">
<div class="input-field"> <label for="contrasena">Contraseña Actual</label> <input type ="password" name="contrasena" value="<?php echo set_value('contrasena'); ?>"/> </div>
<div class="input-field"> <label for="newcontrasena">Nueva Contraseña</label> <input type ="password" name="newcontrasena" value="<?php echo set_value('newcontrasena'); ?>"/> </div>
<div class="input-field"> <label for="newrepcontrasena">Repetir Nueva Contraseña</label> <input type ="password" name="newrepcontrasena" value="<?php echo set_value('newrepcontrasena'); ?>"/> </div>

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
