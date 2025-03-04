<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="material-icons">close</i></div>'); ?>
    </div>
</div>

<?php echo form_open_multipart('Clasificacion/actualizar/'. $editado[0]->getId(),array('id'=>'formulario')); ?>

<div class="container">
  <div class="row">
    <div class="col s12 m4 offset-m8">
      <div class="central" >
        <a href="<?=site_url('Cliente/index')?>">
          <button class="btn waves-effect waves-light blue darken-3">Ver Ultimos modificadores
          <i class="material-icons right">send</i>
          </button>
        </a>
      </div>
    </div>
      <div class="col s12 m4 offset-m2">


</div>
</div>
</div>


<div id="info" class="card-panel">
      <div class="card-panel">

          <div class="col s12 m6">
            <div class="row">
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="nombre">Nombre </label> <input type ="text" name="nombre"  class="validate" value="<?php echo $editado[0]->getNombre(); ?>"/> </div>

                    </div>
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="familia">Familia </label> <input type ="text" name="familia"  class="validate" value="<?php echo $editado[0]->getFamilia(); ?>"/> </div>

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
</script>
