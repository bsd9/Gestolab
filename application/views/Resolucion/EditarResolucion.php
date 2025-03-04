<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open('Resolucion/actualizar/' . $editado[0]->getId(),array('id'=>'formulario'));
?>
<div class="container">
    <div class="card-panel">
      <div class="row">
        <div class="col s6">
          <h5>Usar</h5>
          <div class="switch ">
            <label>
              No
              <input type="checkbox" <?php if ($editado[0]->getEstado()) {echo 'checked';} ?> name="estado">
              <span class="lever blue darken-3"></span>
              Si
            </label>
          </div>
          <div class="input-field"> <label for="resolucion">Resolucion</label> <input type ="text" name="resolucion" value="<?php echo $editado[0]->getResolucion(); ?>"/> </div>
          <div class="input-field"> <label for="fechaExpedicion">Fecha Expedicion</label> <input type ="text" name="fechaExpedicion" value="<?php echo $editado[0]->getFechaExpedicion(); ?>"/> </div>
          <div class="input-field"> <label for="fechaVencimiento">Fecha Vencimiento</label> <input type ="text" name="fechaVencimiento" value="<?php echo $editado[0]->getFechaVencimiento(); ?>"/> </div>
          <div class="input-field"> <label for="tipo">Tipo</label> <input type ="text" name="tipo" value="<?php echo $editado[0]->getTipo(); ?>"/> </div>
        </div>
        <div class="col s6">

          <div class="input-field">
            <select type ="Select" name="idEstablecimiento" id="idEstablecimiento" >
            <option  disabled selected>Elija una opción</option>
            <?php foreach($establecimientos as $esta){ ?>
              <option <?php if ($editado[0]->getIdEstablecimiento() == $esta->getId()) {echo 'selected';} ?> value="<?=$esta->getId();?>"><?=$esta->getNombre();?></option>
              <?php } ?>
            </select>
            <label>Establecimiento</label>
          </div>
          <div class="input-field"> <label for="prefijo">Resolucion</label> <input type ="text" name="prefijo" value="<?php echo $editado[0]->getPrefijo(); ?>"/> </div>
          <div class="input-field"> <label for="desde">Fecha Expedicion</label> <input type ="text" name="desde" value="<?php echo $editado[0]->getDesde(); ?>"/> </div>
          <div class="input-field"> <label for="hasta">Fecha Vencimiento</label> <input type ="text" name="hasta" value="<?php echo $editado[0]->getHasta(); ?>"/> </div>
          <div class="input-field"> <label for="ultimo">Tipo</label> <input type ="text" name="ultimo" value="<?php echo $editado[0]->getUltimo(); ?>"/> </div>
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
var $input = $('.datepicker').pickadate({
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
  $(document).ready(function(){
       $('select').material_select();
     });
</script>
