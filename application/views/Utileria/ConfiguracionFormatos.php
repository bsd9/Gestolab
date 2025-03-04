<div class="card-panel">
  <div class="card-panel">

  <?php
  echo form_open_multipart('Inicio/editarConfiguracionFormatos/',array('id'=>'formulario'));
  ?>

    <div class="input-field col s12">
      <textarea name="footerFactura" id="FacturaFooter" class="materialize-textarea"><?=$config->getFooterFactura()?></textarea>
      <label for="FacturaFooter">Informacion al final de la factura</label>
    </div>

    <div class="input-field col s12">
      <textarea name="observacionesCompra" id="ObservacionesCompra" class="materialize-textarea"><?=$config->getObservacionesCompra()?></textarea>
      <label for="ObservacionesCompra">Observaciones de la orden de Compra</label>
    </div>

    <div class="input-field col s12">
      <textarea name="observacionesCotizacion" id="ObservacionesCotizacion" class="materialize-textarea"><?=$config->getObservacionesCotizacion()?></textarea>
      <label for="ObservacionesCotizacion">Observaciones de la cotizacion</label>
    </div>

    <div class="input-field col s12">
      <textarea name="footerCotizacion" id="CotizacionFooter" class="materialize-textarea"><?=$config->getFooterCotizacion()?></textarea>
      <label for="CotizacionFooter">Informacion al final de la cotizacion</label>
    </div>

    <div class="input-field col s12">
      <textarea name="observacionesFactura" id="observacionesFactura" class="materialize-textarea"><?=$config->getObservacionesFactura()?></textarea>
      <label for="observacionesFactura">Observaciones de Factura</label>
    </div>

    <div class="input-field col s12">
      <textarea name="observacionesPreforma" id="observacionesPreforma" class="materialize-textarea"><?=$config->getObservacionesPreforma()?></textarea>
      <label for="observacionesPreforma">Observaciones de Preforma</label>
    </div>


    <div class="center">
    <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Enviar
        <i class="material-icons right">send</i>
    </button>
      </div>
     <?php echo form_close();?>
  </div>
</div>
