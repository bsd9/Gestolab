<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php echo form_open_multipart('Usuario/actualizar/' . $editado[0]->getId(),array('id'=>'formulario')); ?>




    <div class="card-panel">
        <div class="card-panel">
            <div class="row">

                   <div class="col s12 m4">
                            <div class="input-field"><label for="nombre">Nombres </label>
                               <input type="text" name="nombre" class="validate" value="<?php echo $editado[0]->getNombre() ?>"/>
                            </div>
                            <div class="input-field"><label for="apellidos">Apellidos</label>
                              <input type="text"   name="apellidos" class="validate"   value="<?php echo $editado[0]->getApellidos() ?>"/>
                            </div>
                            <div class="input-field"><label for="email">Email</label>
                                 <input type="email"  class="validate"  name="email"  value="<?php echo $editado[0]->getEmail() ?>"/>
                            </div>
                            <div class="input-field"><label for="fijo">Telefono</label>
                              <input type="text" class="validate" name="fijo" value="<?php echo $editado[0]->getFijo() ?>"/>
                            </div>
                     </div>

                     <div class="col s12 m4">
                       <div class="input-field"><label for="celular">Celular</label>
                         <input type="text"   name="celular" class="validate" value="<?php echo $editado[0]->getCelular()?>"/>
                       </div>
                       <div class="input-field"><label for="usuario">Nombre Usuario</label>
                         <input type="text"   name="usuario" class="validate" value="<?php echo $editado[0]->getUsuario()?>"/>
                       </div>


                       <select  name='cargo'>
                                <?php foreach ($cargos as $cargo) { ?>
                                    <?php if ($cargo->getActivo()) { ?>
                                        <option <?php if ($editado[0]->getidCargo() == $cargo->getId()) {
                                            echo " selected ";
                                        } ?> value="<?= $cargo->getId(); ?>"><?= $cargo->getNombre(); ?></option>
                                    <?php } ?>
                                <?php } ?>
                          </select>


        <div class="col s3">
          <h5>Estado</h5>
          <div class="switch ">
          <label>
            Activo
            <input type="checkbox" <?php if($mod){if ($editado[0]->getActivo()){echo "checked";}}else {echo "checked";} ?> name="activo" value="1">
            <span class="lever blue darken-3"></span>
            Inactivo
          </label>
            </div>
        </div>


                      </div>


                    </div>

            </div>
</div>



<div class="center">
    <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar" Style="bottom:5px">Enviar
        <i class="material-icons right">send</i>
    </button>
</div>

<?php echo form_close(); ?>


<!-- ################################################################################################################################ -->


<script>
</script>
<script type="text/javascript" >

 $(document).ready(function() {
    $('select').material_select();
      } );
  $('.chosen').chosen();
</script>
