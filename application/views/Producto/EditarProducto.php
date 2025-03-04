<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open_multipart('Producto/actualizar/' . $editado->getId() ,array('id'=>'formulario'));
?>
<div class="row">
  <div class="col s12 m4 offset-m8">
    <div class="center">
      <a href="<?=site_url('Producto/index')?>">
        <button class="btn waves-effect waves-light blue darken-3">Ver Ultimos modificadores
        <i class="material-icons right">send</i>
      </button>
    </a>
    </div>
  </div>
  <div class="col s12 m4 offset-m2">
  <h5>Activar</h5>
<div class="switch ">
  <label>
    No
    <input type="checkbox" <?php if($editado->getActivo()){echo " checked ";} ?> name="Activo">
    <span class="lever blue darken-3"></span>
    Si
  </label>
</div>
</div>
</div>
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

   <div id="aranceles" class="col s12">
     <div class="card-panel">
       <h5>Información Arancelaria</h5>
       <div class="row">
          <div class="col s12 m6">
            <div class="input-field"> <label for="posicion">Posicion Arancelaria</label> <input type ="text" name="posicion" class="validate" value="<?php echo $editado->getPosicion(); ?>"/> </div>
            <div class="input-field"> <label for="gravamenArancelario">Gravamen Arancelario</label> <input type ="text" name="gravamenArancelario" class="validate" value="<?php echo $editado->getGravamenArancelario(); ?>"/> </div>
            <div class="input-field"> <label for="gravamenIva">Gravamen Iva</label> <input type ="text" name="gravamenIva" class="validate" value="<?php echo $editado->getGravamenIva(); ?>"/> </div>
          </div>
          <div class="col s12 m6">
            <div class="input-field"> <label for="	notasInteres">Notas de interes importación</label> <textarea type ="text" name="notasInteres" class="materialize-textarea" /><?php echo $editado->getNotasInteres(); ?></textarea> </div>
          </div>
       </div>
     </div>
        </div>
   <div id="info" class="col s12">

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
       <?php for ($i=0; $i < count($editado->razonSocials); $i++) {?>
         <tr>
           <td><?=$editado->razonSocials[$i]?></td>
           <td><?=$editado->costos[$i]?></td>
           <td><?=$editado->divisas[$i]?></td>
           <td><?=$editado->CodsProd[$i]?></td>
           <td>
             <div class='center'>
               <i style='color:red' class='small material-icons' onclick='Borrar(this.parentNode.parentNode.parentNode.rowIndex)'>delete</i>
               <i style='color:orange' onclick='ModificarProveedor(<?=$i; ?>,this.parentNode.parentNode.parentNode)' class='material-icons tooltipped' data-position='bottom' data-delay=50 data-tooltip='Editar'>edit</i>
             </div>
           </td>
         </tr>
       <?php } ?>
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
            <option <?php if(set_value('tipo')=="COP"){echo "selected";} ?>  value="COP">COP</option>
              <option <?php if(set_value('tipo')=="USD"){echo "selected";} ?> value="USD">USD</option>
              <option <?php if(set_value('tipo')=="EUR"){echo "selected";} ?> value="EUR">EUR</option>
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
        <div class="input-field"> <label for="nombre">Nombre</label> <input type ="text" name="nombre" class="validate" value="<?php echo $editado->getNombre(); ?>"/> </div>
        <div class="input-field"> <label for="marca">Marca</label> <input type ="text" name="marca" class="validate" value="<?php echo $editado->getMarca(); ?>"/> </div>
        <div class="input-field"> <label for="peso">Peso (Kg)</label> <input type ="number" name="peso" class="validate" value="<?php echo $editado->getPeso(); ?>"/> </div>
        <div class="input-field"> <select type ="Select" id="tipo" name="tipo" onchange="Armar();">
            <option  disabled selected>Elija una opción</option>
            <option <?php if($editado->getTipo() == "Consumible"){echo "selected" ;} if($editado->getTipo() == "Compuesto"){echo "disabled ";}  ?> value="Consumible">Consumible</option>
            <option <?php if($editado->getTipo() == "Equipo"){echo "selected";} if($editado->getTipo() == "Compuesto"){echo "disabled ";} ?> value="Equipo">Equipo</option>
            <option <?php if($editado->getTipo() == "Insumo"){echo "selected";} if($editado->getTipo() == "Compuesto"){echo "disabled ";} ?> value="Insumo">Insumo</option>
            <option <?php if($editado->getTipo() == "Servicio"){echo "selected ";} if($editado->getTipo() == "Compuesto"){echo "disabled ";}?> value="Servicio">Servicio</option>
            <option <?php if($editado->getTipo() == "Compuesto"){echo "selected ";} else{echo "disabled ";}?> value="Compuesto">Compuesto</option>
          </select>
          <label>Tipo</label>
         </div>
       </div>
        <div class="col s12 m6">
        <div class="input-field"> <label for="modelo">Modelo</label> <input type ="text" name="modelo" class="validate" value="<?php echo $editado->getModelo(); ?>"/></div>
        <div class="input-field"> <label for="iva">Iva(%)</label> <input placeholder="Ingrese 0 si es excento de esté" type ="number" name="iva" class="validate" value="<?php echo $editado->getIva(); ?>"/> </div>
        <div class="input-field"> <select type ="Select" name="unidadNegocio">
            <option  disabled selected>Elija una opción</option>
            <?php foreach($UnidadNegocio as $un){ ?>
              <?php if($un->getActivo()){ ?>
              <option <?php if( $editado->getUnidadNegocio() == $un->getId()){echo "selected";} ?> value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
              <?php } ?>
            <?php } ?>
          </select>
          <label>Unidad de negocio</label>
         </div>
         <div class="input-field"> <select type ="Select" name="idEstablecimiento">
             <option  disabled selected>Elija una opción</option>
             <?php foreach($establecimientos as $es){ ?>
				<?php if($es->getEstado()){ ?>
					<option <?php if($editado->getIdEstablecimiento()==$es->getId()){echo "selected";} ?> value="<?=$es->getId();?>"><?=$es->getNombre();?></option>
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
                  <option <?php if($editado->getUnidadMedida() ==$un->getId()){echo "selected";} ?> sigla="<?=$un->getSigla();?>" value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
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
                 <option <?php if($editado->getPresentacionEntrada() == $un->getId()){echo " selected ";} ?> value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
               <?php } ?>
               <?php } ?>
             </select>
             <label>Unidad de Embalaje</label>
            </div>
            <div class="input-field"> <label for="cantidadEntrada">Cantidad por unidad de embalaje</label><input onchange="formatoEntrada();" id="CantEmbalajeEntrada" type ="number" name="cantidadEntrada" class="validate" step=any value="<?php echo $editado->getCantidadEntrada(); ?>"/> </div>
         </div>
         <div class="col s12 m6" id="presSalida">
          <h5>Presentación de salida</h5>
          <div class="input-field"> <select type ="Select" onchange="formatoSalida();" name="unidadEmbalajeSalida" id="EmbalajeSalida">
              <option  disabled selected>Elija una opción</option>
              <?php foreach($empaques as $un){ ?>
                <?php if($un->getActivo()){ ?>
                <option <?php if($editado->getPresentacionSalida() ==$un->getId()){echo "selected";} ?> value="<?=$un->getId();?>"><?=$un->getNombre();?></option>
              <?php } ?>
              <?php } ?>
            </select>
            <label>Unidad de Embalaje</label>
           </div>
           <div class="input-field"> <label for="cantidadSalida">Cantidad por unidad de embalaje</label> <input onchange="formatoSalida();" id="CantEmbalajeSalida" type ="number" name="cantidadSalida" class="validate" step=any value="<?php echo $editado->getCantidadSalida() ?>"/> </div>
         </div>
          </div>
      </div>
    </div>
 </div>
 </div>
 <div id="compuesto" class="col s12">
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

    <?php $products = [];
          $cants = [];
    if(isset($editado->subproductos)) {
      foreach ($editado->subproductos as $subprod) {?>
        <tr>
          <td><?php echo $subprod->getNombre(); $products[] = $subprod->getNombre()?></td>
          <td><?php echo $subprod->cantidad; $cants[] = $subprod->cantidad?></td>
          <td><div class='center'><i style='color:red' class='small material-icons' onclick='Borrar(this.parentNode.parentNode.parentNode.rowIndex)'>delete</i></div></td>
        </tr>
    <?php  }
    } ?>
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
   <div id="fichatecnica" class="col s12">
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

<script>
var costos = <?=json_encode($editado->costos)?>;
var divisas =<?=json_encode($editado->divisas)?>;

var codigos =<?=json_encode($editado->CodsProd)?>;
var proveedores = <?=json_encode($editado->razonSocials)?>;
var  products = <?=json_encode($products)?>;
var cantidades = <?=json_encode($cants)?>;
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Producto/EditarProducto.js"></script>
