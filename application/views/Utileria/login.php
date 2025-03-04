
<?php
echo form_open('Inicio/login',array('id'=>'formulario'));
?>
<div class="row">
	<div class="col m6 offset-m3 s12">
		<div class="card blue darken-3">
			<div class="card-content black-text">
				<div class="center">
					<span class="card-title white-text">Login</span>
				</div>
				<div class="row white">
					<div class="input-field col s12" id="div-nombre">
						<i class="material-icons prefix">perm_identity</i>
						<input id="nombre" type="text" class="validate" name="usuario" value="<?=set_value('usuario');?>">
						<label for="nombre" id="label-nombre">Usuario</label>
					</div>
				</div>
				<div class="row white">
					<div class="input-field col s12" id="div-nombre">
						<i class="material-icons prefix">lock_outline</i>
						<input id="contrasena" type="password" class="validate" name="password" value="">
						<label for="contrasena" id="label-nombre">Contraseña</label>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row">

			

		<div class="col m3 s12">
			<div class="hide-on-med-and-up">
				<br>
			</div>
      <div class="center">
      <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Ingresar
          <i class="material-icons right">send</i>
      </button>
        </div>
		</div>
		  <?php echo form_close();?>
</div>
	</div>
</div>
