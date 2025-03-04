

<div class="row">
  <div class="col s10 offset-s1">
    <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
  </div>
</div>
<?php
if ($mod) {
  echo form_open_multipart('Equipo/actualizarEquipo/'.$equipo->getId());
}else {
  echo form_open_multipart('Equipo/guardarEquipo/');
}
?>

<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s4"><a class="active" href="#info">Datos Del equipo</a></li>
      <?php if ($mod): ?>
        <li class="tab col s4"><a href="#imagenestab">Imagenes</a></li>
        <li class="tab col s4"><a href="#documentostab">Documentos</a></li>
      <?php endif; ?>
    </ul>
  </div>
</div>


<?php $imgid =[]; if ($mod): ?>
  <div id='imagenestab' class="card-panel">
    <div class="card-panel" >
      <div class="row">
        <?php  foreach ($imganes as $imagen): ?>
          <?php $imgid[] = $imagen->getId();?>
          <div id='img<?=$imagen->getId()?>' class="col s6">
            <div class="card">
              <div class="card-image">
                <img src="<?=base_url();?>uploads-old/imgs/equipos/<?=$imagen->getNombre();?>">
                <span class="card-title"></span>
              </div>
              <div class="card-content">
                <p>Fecha imagen: <?php echo $imagen->getFecha(); ?></p>
              </div>
              <div class="card-action">
                <a onclick="Eliminar(<?=$imagen->getId()?>)">Eliminar</a>
              </div>
            </div>

          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
<?php $docid =[]; if ($mod): ?>
  <div id='documentostab' class="card-panel">
    <div class="card-panel">
      <div class="row">
        <?php  foreach ($documentos as $documento): ?>
          <?php $docid[] = $documento->getId();?>
          <div id='doc<?=$documento->getId()?>' class="col s6">
            <div class="col s4">
              <a href="<?=base_url();?>uploads-old/docs/equipos/<?=$documento->getNombre();?>"><?=$documento->getNombre();?></a>
            </div>
            <div class="s2">
              <div class='text-center'><i onclick="EliminarDoc(<?=$documento->getId()?>)" style='color:red' class='glyphicon glyphicon-remove'></i></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
<div id=info class="card-panel">
  <div class="card-panel">
    <div class="row">
      <div class="input-field col s9">
          <input type="text" id="nombre" name='nombre' class="autocomplete" value="<?php if($mod){echo $equipo->getNombre();}else{echo set_value('nombre'); }  ?>">
          <label for="nombre">Nombre</label>
        </div>
      <div class="input-field col s9">
        <table id=variables class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse" >
          <thead>
            <tr>
              <th>Variable</th>
              <th>Cantidad</th>
              <th>Borrar</th>
            </tr>
          </thead>
          <?php   $idVariables = [];
            $cantidades = [];
            if($mod){ ?>
            <tbody>
              <?php



              foreach ($equipoVariables as $idVariable) {
                $idVariables[]= $idVariable->getIdVariable();
                $cantidades[]=$idVariable->getCantidad();
                ?>
                <tr>
                  <td><?=$idVariable->nombre; ?></td>
                  <td><?=$idVariable->getCantidad(); ?></td>
                  <td>
                    <div class='center'>
                      <i style='color:red' class='small material-icons' onclick='Borrar(this.parentNode.parentNode.parentNode.rowIndex)'>delete</i>
                   </div>
                  </td>
                  <tr>
                  <?php } ?>

                </tbody>

              <?php  } ?>

            </table>

            <input type="text" hidden id="idVariable" name='idVariable'>
            <input type="text" hidden id="cantidad" name='cantidad'>

          </div>


          <div class="col s3">
            <h5>Estado</h5>
            <div class="switch ">
              <label>
                No funcional
                <input type="checkbox" <?php if($mod){if ($equipo->getFuncional()){echo "checked";}}else {echo "checked";} ?> name="funcional" value="1">
                <span class="lever blue darken-3"></span>
                Funcional
              </label>
            </div>
            <br/>
            <div class="input-field">
              <select name="idVariableSelect" id='idVariableSelect' >
                <option value="">Elija una opción</option>
                <?php foreach($variables as $variable){ ?>
                  <option value="<?=$variable->getId();?>"><?=$variable->getTitulo();?></option>
                <?php } ?>
              </select>
              <label>Variable</label>
            </div>
            <div class="input-field"><label for="cantidadSelect">cantidad</label>   <input type ="number" name="cantidadSelect" id=cantidadSelect  /> </div>
            <div class="center">
              <button class="btn waves-effect waves-light blue darken-3" type="button" name="Agregar" value="Agregar" onclick='agregarVariable()' >Agregar
          <i class="material-icons right">contact_phone</i>
        </button>
            </div>
          </div>

          <div class="col s6">
            <div class="input-field"><label for="codigo">codigo</label>   <input type ="text" name="codigo" class="validate" value="<?php if($mod){echo $equipo->getCodigo();}else{echo set_value('codigo'); }  ?>"/> <br/></div>
            <div class="input-field"><label for="fechaCompra">fecha compra</label>   <input type ="date" class='datepicker' name="fechaCompra" class="validate" value="<?php if($mod){echo $equipo->getFechaCompra();}else{echo set_value('fechaCompra'); }  ?>"/> <br/></div>
            <div class="input-field"><label for="marca">marca</label>   <input type ="text" name="marca" class="validate" value="<?php if($mod){echo $equipo->getMarca();}else{echo set_value('marca'); }  ?>" /> <br/></div>
            <div class="input-field"><label for="modelo">modelo</label>   <input type ="text" name="modelo" class="validate" value="<?php if($mod){echo $equipo->getModelo();}else{echo set_value('modelo'); }  ?>"/> <br/></div>

            <input  type ="text" hidden name="imgs" id='imagenes' class="validate" />
            <div class="file-field input-field">
              <div class="btn">
                <span>Imagen</span>
                <input type="file"  name="imagenes">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Sube una imagen">
              </div>
            </div>
          </div>
          <div class="col s6">
            <div class="input-field"><label for="costo">costo</label>   <input type ="number" name="costo" class="validate" value="<?php if($mod){echo $equipo->getCosto();}else{echo set_value('costo'); }  ?>"/> <br/></div>

            <div class="input-field">
              <select name="idLaboratorioSelect" id='idLaboratorioSelect' >
                <?php foreach($laboratorios as $lab){ ?>
                  <option <?php if($equipo->getIdLaboratorio()==$lab->getId() and $mod == 1){echo " selected ";} ?>
                    value="<?=$lab->getId();?>"><?=$lab->getNombre();?>
                  </option>
                <?php } ?>
              </select>
              <label>Dependencia</label>
            </div>
            <input value="<?php if($mod){echo $equipo->getIdLaboratorio();}else{echo set_value('idLaboratorio'); }  ?>" type ="text" hidden name="idLaboratorio" id='idLaboratorio' class="validate" />

            <div class="input-field"><label for="serial">serial</label>   <input type ="text" name="serial" class="validate" value="<?php if($mod){echo $equipo->getSerial();}else{echo set_value('serial'); }  ?>"/> <br/></div>
            <input  type ="text" hidden name="docs" id='docs' class="validate" />
            <div class="file-field input-field">
              <div class="btn">
                <span>Archivo</span>
                <input type="file"  name="archivos">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Sube un adjunto">
              </div>

            </div>
          </div>
        </div>

        <div class="input-field">
          <textarea id="observacion" name='observacion' class="materialize-textarea"><?php if($mod){echo $equipo->getObservacion();}else{echo set_value('observacion'); }  ?></textarea>
          <label for="observacion">observacion</label>
        </div>

      </div>
    </div>
  </div>

  <div class="center">
    <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar" style="bottom:5px">Guardar
      <i class="material-icons right">send</i>
    </button>
  </div>

</div>


<?php $data=[]; foreach($clasificacion as $clase){
  $data[] =[
    $clase->getNombre()
  ];
} ?>


<?php echo form_close();?>

<script type="text/javascript">
var idVariables= <?=json_encode($idVariables)?>;
var cantidades= <?=json_encode($cantidades)?>;
$(document).ready(function() {

  $("#idVariable").val(idVariables);
  $("#cantidad").val(cantidades);
  $('select').material_select();
  $('#idLaboratorioSelect').change( function() {
    $('#idLaboratorio').val($('#idLaboratorioSelect').val());
  });


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

  $('#observacion').trigger('autoresize');
  $('.chips').material_chip();

  imgs = <?=json_encode($imgid)?>;
  $("#imagenes").val(imgs)

  docs = <?=json_encode($docid)?>;
  $("#docs").val(docs)
  datos = <?=json_encode($data)?>;
  datosCompletar = {};
  for (var i = 0; i < datos.length; i++) {
    datosCompletar[datos[i]] = null;
  }
  $('#nombre').autocomplete({
    data: datosCompletar,
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
  });
});

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Equipo/AgregarEquipo.js"></script>
