
<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open_multipart('EstablecimientoComercial/actualizar/'.$editado[0]->getId());
?>
<div class="container">
    <div class="card-panel">
      <h5>Activar</h5>
      <div class="switch ">
        <label>
          No
          <input type="checkbox" <?php if($editado[0]->getEstado()){echo " checked ";} ?> name="activo">
          <span class="lever blue darken-3"></span>
          Si
        </label>
      </div>
  <div class="row">
  <div class="col s12 m6">
<div class="input-field"> <label for="nombre">Nombre</label> <input type ="text" name="nombre" value="<?php echo $editado[0]->getNombre(); ?>"/> </div>
</div>
<div class="col s12 m6">
  <div class="input-field"><select type ="Select" name="idGrupoEmpresarial" id="idGrupoEmpresarial" >
    <option  disabled selected>Elija una opción</option>
    <?php  foreach($gruposempresariales as $dependencia){ ?>
      <?php if ($dependencia->getEstado()){?>
        <option   <?php if ($editado[0]->getIdGrupoEmpresarial() == $dependencia->getId()){echo 'selected' ;  }?> value="<?=$dependencia->getId();?>"><?=$dependencia->getRazonSocial();?></option>
      <?php  } ?>
    <?php } ?>
    </select>
    <label>Grupo Empresarial</label>
  </div>
</div>
</div>
  <div class="row">
    <div class="col s12 m12 l8">
      <div class="card-image">
      <div class="card hoverable">
        <div class="center">
        <img id="imgFacturacion" src="<?=base_url();?>/assets/img/<?=$editado[0]->getLogoFacturacion();?>" width="200" height="200">
        </div>
      </div>
      </div>
      <div class="file-field input-field">
          <div class="btn blue darken-3">
            <span>Fondo Factura</span>
            <input type="file" id="logoFacturacion" name="logoFacturacion"  >
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" onchange="previewFile('Facturacion')" type="text">
      </div>
      </div>
    </div>
    <div class="col s12 m12 l4">
      <div class="card-image">
      <div class="card hoverable" >
        <div class="center">
        <img id="imgCotizacion" src="<?=base_url();?>/assets/img/<?=$editado[0]->getLogoCotizacion();?>" width="150" height="150">
        </div>
      </div>
      </div>
      <div class="file-field input-field">
          <div class="btn blue darken-3">
            <span>Logo Cotizacion</span>
            <input type="file" id="logoCotizacion" name="logoCotizacion"  >
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" onchange="previewFile('Cotizacion')" type="text">
      </div>
      </div>
    </div>
  </div>

  <div class="card-image">
  <div class="card hoverable" >
    <div class="center">
    <img id="imgFondoCotizacion" src="<?=base_url();?>/assets/img/<?=$editado[0]->getFondoCotizacion();?>" width="336" height="210">
    </div>
  </div>
  </div>
  <div class="file-field input-field">
      <div class="btn blue darken-3">
        <span>Fondo Cotizacion</span>
        <input type="file" id="logoFondoCotizacion" name="fondoCotizacion"  >
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" onchange="previewFile('FondoCotizacion')" type="text">
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
  <script type="text/javascript">

    function previewFile(from) {
        var preview = document.querySelector('#img'+from); //selects the query named img
        var file = document.querySelector('#logo'+from).files[0]; //sames as here
        var reader = new FileReader();
        reader.onloadend = function() {
            preview.src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file); //reads the data as a URL
        } else {
            preview.src = "";
        }
    }

    $(document).ready(function() {
    $('select').material_select();
    } );
  </script>
