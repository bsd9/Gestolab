
<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open_multipart('Mediciones/actualizarPatron/'.$editado[0]->getId());
?>
<div class="container">
  <h5>Activar</h5>
  <div class="switch ">
    <label>
      No
      <input type="checkbox" <?php if($editado[0]->getActivo()){echo " checked ";} ?> name="activo">
      <span class="lever blue darken-3"></span>
      Si
    </label>
  </div>
    <div class="card-panel">

      <div class="row">
      <div class="col s12 m6">
        <div class="input-field"> <label for="nombre">Nombre</label> <input type ="text" name="nombre" value="<?php echo $editado[0]->getNombre()?>"/> </div>
        <div class="input-field"> <label for="codigo">Codigo</label> <input type ="text" name="codigo" value="<?php echo $editado[0]->getCodigo() ?>"/> </div>
        <div class="input-field"> <label for="valor">Valor total del patron</label> <input type ="number" step=any name="valor" value="<?php echo $editado[0]->getValor() ?>"/> </div>
        <div class="input-field"> <label for="incertidumbre">incertidumbre</label> <input type ="number" step=any name="incertidumbre" value="<?php echo $editado[0]->getIncertidumbre() ?>"/> </div>
    </div>
    <div class="col s12 m6">
      <div class="row">
        <div class="col s7 m7">
          <div class="input-field"> <label for="fecha">fecha</label> <input type ="date" class="datepicker"  name="fecha" value="<?php echo $editado[0]->getFecha() ?>"/> </div>
        </div>
        <div class="col s5 m5">
          <h5>Vence</h5>
          <div class="switch ">
            <label>
              No
              <input type="checkbox" <?php if($editado[0]->getVence()){echo " checked ";} ?> name="vence" value ='1'>
              <span class="lever blue darken-3"></span>
              Si
            </label>
          </div>
        </div>
      </div>


            <div class="input-field"> <label for="lote">lote</label> <input type ="text" name="lote" value="<?php echo $editado[0]->getLote() ?>"/> </div>
            <div class="input-field"><select type ="Select" name="idMagnitud" id="idMagnitud" >
              <option  disabled selected>Elija una opción</option>
              <?php foreach($magnitudes as $metrica){ ?>
                <?php if ($metrica->getActivo() == '1'){?>
                  <option <?php if($editado[0]->getIdMagnitud() == $metrica->getId()){echo " Selected ";} ?> value="<?=$metrica->getId();?>"><?=$metrica->getNombre();?></option>
                <?php } ?>
              <?php } ?>
              </select>
              <label>Magnitud</label>
            </div>
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
  campos = $('.datepicker').pickadate({
   labelMonthNext: 'Siguiente mes',
   labelMonthPrev: 'Mes anterior',
   labelMonthSelect: 'Elija un mes',
   labelYearSelect: 'Elija un año',
   monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
   monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
   weekdaysFull: [ 'Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado' ],
   weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
   weekdaysLetter: [ 'D', 'L', 'M', 'W', 'J', 'V', 'S' ],
   today: 'Hoy',
   clear: 'Limpiar',
   close: 'Cerrar',
   format: 'yyyy-mm-dd',
   selectMonths: true, // Creates a dropdown to control month
   selectYears: 15 // Creates a dropdown of 15 years to control year
   });
  } );

  </script>
