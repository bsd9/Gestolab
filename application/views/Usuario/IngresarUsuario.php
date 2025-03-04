<div class="row">
  <div class="col s10 offset-s1">
<?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>

    </div>
</div>
<?php echo form_open_multipart('Usuario/guardar/'. $idCliente , array('id' => 'formulario'));?>

    <div class="card-panel">
        <div class="card-panel" >
            <div class="row">
              <div class="col s12 m4">
                <div class="input-field"> <label for="nombre">Nombres </label>
                  <input type="text" name="nombre" class="validate" value="<?php echo set_value('nombre'); ?>"/>
                </div>
                <div class="input-field"> <label for="apellidos">Apellidos</label>
                  <input type="text" name="apellidos" class="validate"   value="<?php echo set_value('apellidos'); ?>"/>
                </div>
                <div class="input-field"><label for="email">Email</label>
                  <input type="email"  class="validate"  name="email"  value="<?php echo set_value('email'); ?>"/>
                </div>
                <div class="input-field"><label for="fijo">Telefono</label>
                    <input type="text" class="validate" name="fijo" value="<?php echo set_value('fijo'); ?>"/>
                </div>
              </div>
              <div class="col s12 m4">
                <div class="input-field"><label for="celular">Celular</label>
                  <input type="text"   name="celular" class="validate" value="<?php echo set_value('celular'); ?>"/>
                </div>
                <div class="input-field"><label for="usuario">Nombre Usuario</label>
                  <input type="text"   name="usuario" class="validate" value="<?php echo set_value('usuario'); ?>"/>
                </div>
                <div class="input-field"><label for="pass">Contraseña</label>
                  <input type="password"   name="password" class="validate"/>
                </div>
                  <div class="input-field">
                                <select data-placeholder="Choose an option please" name='cargo'>
                                    <option disabled selected>Elija un Cargo</option>
                                    <?php foreach ($cargos as $cargo) { ?>
                                        <?php if ($cargo->getActivo()) { ?>
                                            <option <?php if (set_value('idCargo') == $cargo->getId()) {
                                                echo "selected";
                                            } ?> value="<?= $cargo->getId(); ?>"><?= $cargo->getNombre(); ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
              </div>
            </div>
       </div>
    </div>

<div class="center">
 <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar" style ="margin-bottom:20px; margin-top:10px" >Enviar  <i class="material-icons right">send</i> </button>
</div>

<?php echo form_close(); ?>

<script type="text/javascript">
$(document).ready(function() {
  $('select').material_select();
});
  $('.chosen').chosen();
  $("#password").password('toggle');
</script>
