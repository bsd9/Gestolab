<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="material-icons">close</i></div>'); ?>
    </div>
</div>

<?php echo form_open_multipart('Variable/actualizar/'. $editado[0]->getId(),array('id'=>'formulario')); ?>

<div class="container">
  <div class="row">
    <div class="col s12 m4 offset-m8">
      <div class="central" >
        <a href="<?=site_url('Variable/index')?>">
          <button class="btn waves-effect waves-light blue darken-3">Ver Ultimos modificadores
          <i class="material-icons right">send</i>
          </button>
        </a>
      </div>
    </div>

</div>
</div>


<div id="info" class="card-panel">
      <div class="card-panel">

          <div class="col s12 m6">
            <div class="row">
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="titulo">Nombre </label> <input type ="text" name="titulo"  class="validate" value="<?php echo $editado[0]->getTitulo(); ?>"/> </div>

                      
                    </div>
                    <div class="col s12 m6">
                      <div class="input-field"> <label for="precioPiso">Precio Piso </label> <input type ="text" name="precioPiso"  class="validate" value="<?php echo $editado[0]->getPrecioPiso(); ?>"/> </div>
                     <div class="input-field"> <label for="precioPublico"> Precio Publico</label> <input type ="text" name="precioPublico"  class="validate" value="<?php echo $editado[0]->getPrecioPublico(); ?>"/> </div>
                      
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


<script type="text/javascript" src="<?php echo base_url();?>assets/js/Variable/EditarVariable.js"></script>
