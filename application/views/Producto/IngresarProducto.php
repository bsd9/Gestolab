<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open_multipart('Producto/guardar/',array('id'=>'formulario'));
?>
<div class="row">

   <div class="col s12">
     <ul class="tabs">
       <li class="tab col s3"><a class="active blue-text" href="#info" >Información General</a></li>

       <li class="tab col s3"><a class="blue-text" href="#fichatecnica">Ficha tecnica</a></li>

       <li hidden=true id="tabCompuesto" class="tab col s3"><a class="blue-text" href="#compuesto">Compuesto</a></li>
       <li class="tab col s3"><a class="blue-text" href="#aranceles">Aranceles</a></li>

       <div class="indicator blue" style="z-index:1"></div>
     </ul>
   </div>
  </div>
   <div id="aranceles" class="card-panel">
     <div class="card-panel">
       <h5>Información Arancelaria</h5>
       <div class="row">
          <div class="col s12 m6">
            <div class="input-field"> <label for="posicion">Posicion Arancelaria</label> <input type ="text" name="posicion" class="validate" /> </div>
            <div class="input-field"> <label for="gravamenArancelario">Gravamen Arancelario</label> <input type ="text" name="gravamenArancelario" class="validate" /> </div>
            <div class="input-field"> <label for="gravamenIva">Gravamen Iva</label> <input type ="text" name="gravamenIva" class="validate" /> </div>
          </div>
          <div class="col s12 m6">
            <div class="input-field"> <label for="	notasInteres">Notas de interes importación</label> <textarea type ="text" name="notasInteres" class="materialize-textarea" /></textarea> </div>
          </div>
       </div>
     </div>
        </div>
   <div id="info" class="card-panel">

       <div class="card-panel">
     <table id="TProveedores" class="highlight bordered" border="1" cellpadding="3" style="table-layout:fixed">
       <thead>
         <tr>
           <th>Nombre Proveedor</th>
           <th>Costo de mercancia</th>
           <th>Divisa</th>
           <th>Codigo Producto</th>
           <th>Borrar</th>
         </tr>
       </thead>
     </table>
     <input type ="text" name="proveedorh" id="proveedorh" hidden />
     <input type ="text" name="costoh" id="costoh" hidden />
     <input type ="text" name="divisah" id="divisah" hidden />
     <input type ="text" name="codigoh" id="codigoh" hidden />

     <div class="row">
     <div class="col s3 m3">
     <div class="input-field"> <label for="proveedor">Proveedor</label> <input type ="text" list="listaProveedores" name="proveedor" id="proveedor"></div>
     <datalist id="listaProveedores">
         <?php foreach($proveedores as $prov){ ?>
           <?php if($prov->getEstado()){ ?>
           <option  value="<?=$prov->getRazonSocial();?>"><?=$prov->getRazonSocial();?></option>
         <?php } ?>
         <?php } ?>
     </datalist>
      </div>
      <div class="col s2 m2">
        <div class="input-field">
          <label for="costo">Costo</label> <input type ="number" name="costo" id="costo">
        </div>
      </div>

      <div class="col s2 m2">
        <div class="input-field">
          <select type ="Select" name="divisa" id="divisa">
            <option value="COP">COP</option>
              <option value="USD">USD</option>
              <option value="EUR">EUR</option>
            </select>
            <label>Divisa</label>
          </div>
      </div>
<div class="col s2 m2">
  <div class="input-field"> <label for="codProd">Codigo de Proveedor</label> <input type ="text" name="codProd" id='codigoProv' class="validate"/> </div>

</div>
      <div class="col s2 m2">
      </br>
        <div class="center">
    <button class="btn waves-effect waves-light blue darken-3" type="button" name="Agregar" value="Agregar" onclick='agregar()'>Agregar
      <i class="material-icons right">contact_phone</i>
    </button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6">
        <div class="row">
        <div class="col s12 m6">
        <div class="input-field"> <label for="nombre">Nombre</label> <input type ="text" name="nombre" class="validate" value="<?php echo set_value('nombre'); ?>"/> </div>
        <div class="input-field"> <label for="marca">Marca</label> <input type ="text" name="marca" class="validate" value="<?php echo set_value('marca'); ?>"/> </div>
        <div class="input-field"> <label for="peso">Peso (Kg)</label> <input type ="number" name="peso" class="validate" value="<?php echo set_value('peso'); ?>"/> </div>
        <div class="input-field"> <select type ="Select" id="tipo" name="tipo" onchange="Armar();">
            <option  disabled selected>Elija una opción</option>
            <option <?php if(set_value('tipo')=="Consumible"){echo "selected";} ?>value="Consumible">Consumible</option>
            <option <?php if(set_value('tipo')=="Equipo"){echo "selected";} ?>value="Equipo">Equipo</option>
            <option <?php if(set_value('tipo')=="Insumo"){echo "selected";} ?>value="Insumo">Insumo</option>
            <option <?php if(set_value('tipo')=="Servicio"){echo "selected";} ?>value="Servicio">Servicio</option>
            <option <?php if(set_value('tipo')=="Compuesto"){echo "selected";} ?>value="Compuesto">Compuesto</option>
          </select>
          <label>Tipo</label>
         </div>
       </div>
        <div class="col s12 m6">
        <div class="input-field"> <label for="modelo">Modelo</label> <input type ="text" name="modelo" class="validate" value="<?php echo set_value('modelo'); ?>"/></div>
        <div class="input-field"> <label for="iva">Iva(%)</label> <input placeholder="Ingrese 0 si es excento de esté" type ="number" name="iva" id="Diva"name="iva" onfocus="ivadefault();" class="validate" value="<?php echo set_value('iva'); ?>"/> </div>
        <div class="input-field"> <select type ="Select" name="unidadNegocio">
            <option  disabled selected>Elija una opción</option>
            <?php foreach($UnidadNegocio as $un){ ?>
              <?php if($un->getActivo()){ ?>
              <option <?php if(set_value('unidadNegocio')==$un->getId()){echo "selected";} ?> value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label>Unidad de negocio</label>
         </div>
        <div class="input-field"> <select type ="Select" name="idEstablecimiento">
            <option  disabled selected>Elija una opción</option>
            <?php foreach($establecimientos as $es){ ?>
				<?php if($es->getEstado()){ ?>
					<option <?php if(set_value('idEstablecimiento')==$es->getId()){echo "selected";} ?> value="<?=$es->getId();?>"><?=$es->getNombre();?></option>
				<?php } ?>
			<?php } ?>
          </select>
          <label>establecimiento Comercial</label>
         </div>
       </div>
     </div>
      </div>
      <div class="col s12 m6">
        <h5>Presentaciones</h5>
        </br>
          <div class="row">
          <div class="col s4 m4">
            <div class="input-field"> <select type ="Select" onchange="formatos();" name="unidadMedida" id="unidadMedida">
                <option sigla="" disabled selected>Elija una opción</option>
                <?php foreach($medidas as $un){ ?>
                  <?php if($un->getActivo()){ ?>
                  <option <?php if(set_value('unidadMedida')==$un->getId()){echo "selected";} ?> sigla="<?=$un->getSigla();?>" value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
                <?php } ?>
                <?php } ?>
              </select>
              <label>Unidad de Medida</label>
             </div>
          </div>
          <div class="col s4 m4" id="FormaEntra">
            <h5>Formato Entrada</h5>
            <div id="Entrada"></div>
          </div>
          <div class="col s4 m4" id="FormaSalida">
          <h5>Formato Salida</h5>
          <div id="Salida"></div>
          </div>
        </div>
         <div class="row center-align">
         <div class="col s12 m6" id="presEntrada">
           <h5>Presentación de entrada</h5>
           <div class="input-field"> <select type ="Select" onchange="formatoEntrada();" name="unidadEmbalajeEntrada" id="EmbalajeEntrada">
               <option  disabled selected>Elija una opción</option>
               <?php foreach($empaques as $un){ ?>
                 <?php if($un->getActivo()){ ?>
                 <option <?php if(set_value('unidadMedida')==$un->getId()){echo "selected";} ?> value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
               <?php } ?>
               <?php } ?>
             </select>
             <label>Unidad de Embalaje</label>
            </div>
            <div class="input-field"> <label for="cantidadEntrada">Cantidad por unidad de embalaje</label><input onchange="formatoEntrada();" id="CantEmbalajeEntrada" type ="number" step=any name="cantidadEntrada" class="validate" value="<?php echo set_value('conProd'); ?>"/> </div>
         </div>
         <div class="col s12 m6" id="presSalida">
          <h5>Presentación de salida</h5>
          <div class="input-field"> <select type ="Select" onchange="formatoSalida();" name="unidadEmbalajeSalida" id="EmbalajeSalida">
              <option  disabled selected>Elija una opción</option>
              <?php foreach($empaques as $un){ ?>
                <?php if($un->getActivo()){ ?>
                <option <?php if(set_value('unidadEmbalajeEntrada')==$un->getId()){echo "selected";} ?> value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
              <?php } ?>
              <?php } ?>
            </select>
            <label>Unidad de Embalaje</label>
           </div>
           <div class="input-field"> <label for="cantidadSalida">Cantidad por unidad de embalaje</label> <input onchange="formatoSalida();" id="CantEmbalajeSalida" type ="number" step=any name="cantidadSalida" class="validate" value="<?php echo set_value('conProd'); ?>"/> </div>
         </div>
          </div>
      </div>
    </div>
 </div>
 </div>
 <div id="compuesto" class="card-panel">
   <div class="card-panel">


  <h5>Armar Producto</h5>
  <table id="Tproductos" class="highlight bordered" border="1" cellpadding="3" style="table-layout:fixed">
    <thead>
      <tr>
        <th>Nombre producto</th>
        <th>cantidad</th>
        <th>Borrar</th>
      </tr>
    </thead>
  </table>
<input type ="text" name="cantidadesh" id="cantidadesh" hidden>
<input type ="text" name="productosh" id="productosh" hidden>
  <div class="row">
  <div class="col s5 m5">
  <div class="input-field"> <label for="producto">Productos</label>
    <input type ="text" list="listaproductos" name="productos" id="productos"></div>
  <datalist id="listaproductos">
      <?php foreach($productos as $prod){ ?>
        <?php if($prod->getActivo()){ ?>
        <option  value="<?=$prod->getNombre();?>"><?=$prod->getNombre();?></option>
      <?php } ?>
      <?php } ?>
  </datalist>
   </div>
   <div class="col s2 m2">
     <div class="input-field">
       <label for="cantidad">Cantidad</label> <input type ="number" name="cantidad" id="cantidad">
     </div>
   </div>
   <div class="col s2 m2">
   </br>
     <div class="center">
  <button class="btn waves-effect waves-light blue darken-3" type="button" name="AgregarProducto" value="AgregarProducto" onclick='agregarProducto()'>Agregar
   <i class="material-icons right">contact_phone</i>
  </button>
     </div>
   </div>
  </div>



 </div>
  </div>
   <div id="fichatecnica" class="card-panel">
       <div class="card-panel">

         <div class="file-field input-field">
                 <div class="btn blue darken-3">
                   <span>ficha tecnica</span>
                   <input type="file" id="firma" name="FichaTecnica"  hidden>
                 </div>
                 <div class="file-path-wrapper">
                   <input class="file-path validate" type="text">
             </div>
         </div>

         <div class="file-field input-field">
                 <div class="btn blue darken-3">
                   <span>Hoja de seguridad</span>
                   <input type="file" id="firma" name="HojaSeguridad"  hidden>
                 </div>
                 <div class="file-path-wrapper">
                   <input class="file-path validate" type="text">
             </div>
         </div>

       </div>

   </div>


 <div class="center">
 <button class="btn waves-effect waves-light blue darken-3" type="submit" name="Enviar" value="Enviar">Enviar
     <i class="material-icons right">send</i>
 </button>
   </div>

  <?php echo form_close();?>

  <div id="EditarModal" class="modal">
    <div class="modal-content">
      <div class="card-panel">
        <form name =modalcambioproveedor>
        <div class="input-field"> <label for="proveedorE">Proveedor</label> <input type ="text" list="listaProveedoresE" name="proveedorE" id="proveedorE"></div>
        <datalist id="listaProveedoresE">
            <?php foreach($proveedores as $prov){ ?>
              <?php if($prov->getEstado()){ ?>
              <option  value="<?=$prov->getRazonSocial();?>"><?=$prov->getRazonSocial();?></option>
            <?php } ?>
            <?php } ?>
        </datalist>
           <div class="input-field">
             <label for="costoE">Costo</label> <input type ="number" name="costoE" id="costoE">
           </div>
           <div class="input-field">
             <select type ="Select" name="divisaE" id="divisaE">
               <option <?php if(set_value('tipo')=="COP"){echo "selected";} ?>  value="COP">COP</option>
                 <option <?php if(set_value('tipo')=="USD"){echo "selected";} ?> value="USD">USD</option>
                 <option <?php if(set_value('tipo')=="EUR"){echo "selected";} ?> value="EUR">EUR</option>
               </select>
               <label>Divisa</label>
             </div>
         <div class="input-field"> <label for="codProdE">Codigo de Proveedor</label> <input type ="text" name="codProdE" id='codigoE' class="validate"/> </div>


              <div class="modal-footer">
          <button type="button" id=Modificarbtn onclick="ModificarFila()" class="btn waves-effect waves-light blue darken-3" >Modificar item</button>
            </div>
            </form>
            </div>
    </div>
  </div>


<script type="text/javascript" src="<?php echo base_url();?>assets/js/Producto/IngresarProducto.js"></script>
