
<div class="row">
    <div class="col s10 offset-s1">
        <?php echo validation_errors('<div class="chip blue col s6">', '<i class="close material-icons">close</i></div>'); ?>
    </div>
</div>
<?php
echo form_open_multipart('Proveedor/actualizar/'. $editado[0]->getId(),array('id'=>'formulario'));
?>
<div class="row">
  <div class="col s12 m4 offset-m8">
    <div class="center">
      <a href="<?=site_url('Proveedor/index')?>">
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
    <input type="checkbox" <?php if($editado[0]->getEstado()){echo " checked ";} ?> name="Activo">
    <span class="lever blue darken-3"></span>
    Si
  </label>
</div>
</div>
</div>






<div class="row">
  <div class="col s12">
    <ul class="tabs">
      <li class="tab col s4"><a class="active blue-text" href="#info" >Información del Proveedor</a></li>
      <li class="tab col s4"></li>
      <li class="tab col s4"><a class="blue-text" href="#contacts">Contactos</a></li>
      <div class="indicator blue" style="z-index:1"></div>
    </ul>
  </div>
</div>
  <div id="info" class="col s12">
    <div class="card-panel">
      <div class="row">

<div class="col s6">
  <table id="NombreComercialT" class="highlight bordered" border="1" cellpadding="5" style="table-layout:fixed" >
    <thead><tr><th>Nombre comercial</th><th>Quitar</th></tr></thead>
    <?php
    $nombres =[];
    foreach($nombresComerciales as $name){
      $nombres[] =  $name->getNombre();
      echo "<tr><td> ". $name->getNombre()." </td><td> <i style='color:red' class='small material-icons' onclick='BorrarNombreComercial(this.parentNode.parentNode.rowIndex)'>delete</i>  </td></tr>";
    } ?>
  </table>
  <div class="row">
  <div class="col s12 m8">
   <div class="input-field"><label for="NombreComercial">Nombre comercial</label><input type ="text" name="NombreComercial" id="NombreComercial" /> </div>
   <input type ="text" name="NombreComercialh" id="NombreComercialh" hidden />
  </div>
  <div class="col m4 s5 offset-s3">
  </br>
      <div class="center">
  <button class="btn waves-effect waves-light blue darken-3" type="button" name="AgregarNombreComercial" value="AgregarNombreComercial" onclick='agregarNombreComercial()'>Agregar
    <i class="material-icons right">contact_phone</i>
  </button>
      </div>
  </div>
  </div>



  <table id="direcciones" class="highlight bordered" border="1" cellpadding="5" style="table-layout:fixed" >
  <thead>
  <tr>
  <th><p class='tooltipped truncate' data-delay='150' data-tooltip='Dirección'>Dirección</p></th>
  <th><p class='tooltipped truncate' data-delay='150' data-tooltip='Pais'>Pais</p></th>
  <th><p class='tooltipped truncate' data-delay='150' data-tooltip='Departamento'>Departamento</p></th>
  <th><p class='tooltipped truncate' data-delay='150' data-tooltip='Ciudad'>Ciudad</p></th>
  <th>Quitar</th>
  </tr>
  </thead>
  <?php
  $ciu = []; $direcciones = [];
  foreach($direccionesProveedor as $dir){
    $ciu[] = $dir->idCiudad;
    $direcciones[] = $dir->direccion;
    ?>
    <tr>
      <td><?php echo $dir->direccion; ?></td>
      <td><?php echo $dir->pais; ?></td>
      <td><?php echo $dir->departamento; ?></td>
      <td><?php echo $dir->ciudad; ?></td>
      <td> <i style='color:red' class='small material-icons' onclick='BorrarDireccion(this.parentNode.parentNode.rowIndex)'>delete</i>  </td>
    </tr>
    <?php  } ?>
  </table>

  <div class="row">
  <div class="col s12 m4">
  <div class="input-field"><select type ="Select" name="pais" id="pais" >
  <option  disabled selected>Elija una opción</option>
  <?php foreach($paises as $pais){ ?>
     <option  value="<?=$pais->getId();?>"><?=$pais->getNombre();?></option>
   <?php } ?>
  </select>
  <label>Pais</label>
  </div>
  </div>
     <div class="col s12 m4">
  <div class="input-field"><select type ="Select" name="departamento" id="departamento" >
  <option  disabled selected>Elija una opción</option>
  <?php foreach($departamentos as $departamento){ ?>
     <option  value="<?=$departamento->getId();?>"><?=$departamento->getNombre();?></option>
   <?php } ?>
  </select>
  <label>Departamento</label>
  </div>
       </div>
   <div class="col s12 m4">
  <div class="input-field"> <select type ="Select" name="ciudad" id="ciudad"/>
       <option  disabled selected>Elija una opción</option>
   <?php foreach($ciudades as $ciudad){ ?>
     <option  value="<?=$ciudad->getId();?>"><?=$ciudad->getNombre();?></option>
   <?php } ?>
  </select>
  <label>Ciudad</label>
  </div>
  </div>
  <input type ="text" name="direccionh" id="direccionh" hidden />
  <input type ="text" name="ciudadh" id="ciudadh" hidden />
  </div>
  <div class="row">
  <div class="col s12 m8">
  <div class="input-field"><label for="direccion">Dirección</label><input type ="text" name="direccion" id="direccion" /> </div>
  </div>
  <div class="col m4 s5 offset-s3">
  </br>
  <div class="center">
  <button class="btn waves-effect waves-light blue darken-3" type="button" name="AgregarDireccion" value="AgregarDireccion" onclick='agregarDireccion();'>Agregar
  <i class="material-icons right">contact_phone</i>
  </button>
  </div>
  </div>
  </div>

</div>
<div class="col s6">

  <div class="col s12 m6">
<div class="input-field"> <label for="razonSocial">Razón Social </label> <input type ="text" name="razonSocial"  class="validate" value="<?php echo $editado[0]->getRazonSocial(); ?>"/> </div>
<div class="input-field"> <label for="NIT">NIT</label>  <input type ="text" name="NIT" class="validate" value="<?php echo $editado[0]->getNIT(); ?>"/> </div>
<div class="input-field"> <label for="fax">Fax</label>  <input type ="text" name="fax" class="validate" value="<?php echo $editado[0]->getFax(); ?>"/> </div>
  </div>
  <div class="col s12 m6">
<div class="input-field"> <label for="paginaWeb">Pagina web</label>  <input type ="text" name="paginaWeb" class="validate" value="<?php echo $editado[0]->getPaginaWeb(); ?>"/> </div>
</div>

</div>
</div>


<div class="row">
  <div class="col s6">
    <div class="card-image">
      <div class="card hoverable">
        <div class="center">
          <?php if ($editado[0]->getLogo() != '') {?>
            <img id="img" src="<?=base_url();?>/uploads/logo/<?php echo $editado[0]->getLogo(); ?>" widht="200" height="200">
      <?php } else{ ?>
        <img id="img" src="<?=base_url();?>/assets/imgs/logosid.png" widht="200" height="200">
      <?php } ?>
    </div>
    </div>
  </div>

  <div class="file-field input-field">
          <div class="btn blue darken-3">
            <span>Logo</span>
            <input type="file" id="firma" name="logo">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" onchange="previewFile()" type="text">
      </div>
  </div>
  </div>
  <div class="col s6">
    <textarea id="desc" name='notas' class="materialize-textarea"><?=$editado[0]->getNotas();?></textarea>
    <label id=labeldesc for="desc">Notas</label>
  </div>
</div>
</div>
  </div>
  <div id="contacts" class="col s12">


    <div class="card-panel">
    <div class="row">
        <table id="contactos" class="highlight bordered" border="1" cellpadding="5" style="table-layout:fixed" >
          <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cargo</th>
            <th>Teléfono</th>
            <th>Extención</th>
            <th>Celular</th>
            <th>Email 1</th>
            <th>Email 2</th>

            <th>Quitar</th>
          </tr>
        </thead>
        <?php
        $Nombrec = [];
        $Apellidoc=[];
        $Cargoc=[];
        $Telefonoc=[];
        $Extc=[];
        $Celularc=[];
        $Emailc=[];
        $Email2c=[];


        foreach ($contactos as  $cont) {
          $Nombrec[] =$cont->getNombre();
          $Apellidoc[] =$cont->getApellido();
          $Cargoc[] =$cont->getCargo();
          $Telefonoc[] =$cont->getTelefono();
          $Extc[] =$cont->getExt();
          $Celularc[] =$cont->getCelular();
          $Emailc[] =$cont->getEmail();
          $Email2c[] =$cont->getEmail2();


          ?>
          <tr>
            <td><?php echo $cont->getNombre(); ?></td>
            <td><?php echo $cont->getApellido(); ?></td>
            <td><?php echo $cont->getCargo(); ?></td>
            <td><?php echo $cont->getTelefono(); ?></td>
            <td><?php echo $cont->getExt(); ?></td>
            <td><?php echo $cont->getCelular(); ?></td>
            <td><?php echo $cont->getEmail(); ?></td>
            <td><?php echo $cont->getEmail2(); ?></td>

            <td> <i style='color:red' class='small material-icons' onclick='BorrarContacto(this.parentNode.parentNode.rowIndex)'>delete</i></td>
          </tr>
        <?php }?>
        </table>

    </div>
    <input type='text' name="nombreh" id="nombreh" hidden />
    <input type='text' name="apellidoh" id="apellidoh" hidden />
    <input type='text' name="cargoh" id="cargoh" hidden />
    <input type='text' name="telefonoh" id="telefonoh" hidden />
    <input type='text' name="extencionh" id="extencionh" hidden />
    <input type='text' name="celularh" id="celularh" hidden />
    <input type='text' name="email1h" id="email1h" hidden />
    <input type='text' name="email2h" id="email2h" hidden />

      <div class="row">
        <div class="col s12 m2">
          <div class="input-field"><label for="Nombre">Nombre</label><input type ="text" name="Nombre" id="Nombre" /> </div>
          <div class="input-field"><label for="Email2">Email 2</label><input type ="text" name="Email2" id="Email2" /> </div>
        </div>
        <div class="col s12 m2">
        <div class="input-field"><label for="Apellido">Apellido</label><input type ="text" name="Apellido" id="Apellido" />
          <div class="input-field"><label for="Celular">Celular</label><input type ="text" name="Celular" id="Celular" /> </div>
         </div>

        </div>
        <div class="col s12 m2">
          <div class="input-field"><label for="Cargo">Cargo</label><input type ="text" name="Cargo" id="Cargo" /> </div>

        </div>
        <div class="col s12 m2">
          <div class="input-field"><label for="Telefono">Teléfono</label><input type ="text" name="Telefono" id="Telefono" /> </div>

        </div>
        <div class="col s12 m2">
        <div class="input-field"><label for="Extencion">Extención</label><input type ="text" name="Extencion" id="Extencion" /> </div>

        </div>
        <div class="col s12 m2">
        <div class="input-field"><label for="Email">Email</label><input type ="text" name="Email" id="Email" /> </div>
          <div class="center">
            <button class="btn waves-effect waves-light blue darken-3" type="button" name="Agregar" value="Agregar" onclick='agregarContacto()'>Agregar
              <i class="material-icons right">contact_phone</i>
            </button>
          </div>
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


      <div id="EditarModal" class="modal">
        <div class="modal-content">
          <div class="card-panel">
            <div class="row">
              <div class="col s12 m6">
                <div class="input-field"><label for="NombreE">Nombre</label><input type ="text" name="NombreE" id="NombreE" /> </div>
                <div class="input-field"><label for="Email2E">Email 2</label><input type ="text" name="Email2E" id="Email2E" /> </div>
              <div class="input-field"><label for="ApellidoE">Apellido</label><input type ="text" name="ApellidoE" id="ApellidoE" /> </div>
                <div class="input-field"><label for="LinkinE">Linkedin</label><input type ="text" name="LinkinE" id="LinkinE" /> </div>
                <div class="input-field"><label for="CargoE">Cargo</label><input type ="text" name="CargoE" id="CargoE" /> </div>
                <div class="input-field"><label for="CelularE">Celular</label><input type ="text" name="CelularE" id="CelularE" /> </div>
              </div>
              <div class="col s12 m6">
                <div class="input-field"><label for="TelefonoE">Teléfono</label><input type ="text" name="TelefonoE" id="TelefonoE" /> </div>
                <div class="input-field"><label for="TwitterE">Twitter</label><input type ="text" name="TwitterE" id="TwitterE" /> </div>
                <div class="input-field"><label for="ExtencionE">Extensión</label><input type ="text" name="ExtencionE" id="ExtencionE" /> </div>
                <div class="input-field"><label for="FacebookE">Facebook</label><input type ="text" name="FacebookE" id="FacebookE" /> </div>
                <div class="input-field"><label for="EmailE">Email</label><input type ="text" name="EmailE" id="EmailE" /> </div>
              </div>
            </div>
          </div>
                <div class="modal-footer">
              <button type="button" id=Modificarbtn onclick="ModificarFilaContacto()" class="btn waves-effect waves-light blue darken-3" >Modificar item</button>
                </div>
                </div>
        </div>
  <?php echo form_close();?>




<!-- ################################################################################################################################ -->
    <?php
$iddeptsc=[];
$idciudad=[];
    $nombreciudad=[];
    foreach($ciudades as $ciudad){
    $iddeptsc[]=$ciudad->getIdDepartamento();
    $idciudad[]=$ciudad->getId();
    $nombreciudad[]=$ciudad->getNombre();
    }
    ?>
    <?php
    $idpais=[];
    $iddepts=[];
    $nombredept=[];
    foreach($departamentos as $depart){
    $idpais[]=$depart->getIdPais();
    $iddepts[]=$depart->getId();
    $nombredept[]=$depart->getNombre();
    }
    ?>

    <script>
    var ciudades = <?=json_encode($ciu)?>;
    var direcciones = <?=json_encode($direcciones)?>;
    $("#direccionh").val(direcciones);
    $("#ciudadh").val(ciudades);

    var nombre = <?=json_encode($Nombrec)?>;
    var apellido =<?=json_encode($Apellidoc)?>;
    var cargo = <?=json_encode($Cargoc)?>;
    var telefono = <?=json_encode($Telefonoc)?>;
    var extencion = <?=json_encode($Extc)?>;
    var celular =<?=json_encode($Celularc)?>;
    var email1 = <?=json_encode($Emailc)?>;
    var email2 = <?=json_encode($Email2c)?>;
  
      $("#nombreh").val(nombre);
      $("#apellidoh").val(apellido);
      $("#cargoh").val(cargo);
      $("#telefonoh").val(telefono);
      $("#extencionh").val(extencion);
      $("#celularh").val(celular);
      $("#email1h").val(email1);
      $("#email2h").val(email2);


      var nombreComercial = <?=json_encode($nombres)?>;
      $("#NombreComercialh").val(nombreComercial);

      var iddeptc = <?=json_encode($iddeptsc)?>;
      var idciudad = <?=json_encode($idciudad)?>;
      var nombrec = <?=json_encode($nombreciudad)?>;

      var datos=new Array();
      for(i=0;i<iddeptc.length;i++){
        datos[i]=new Array(iddeptc[i],idciudad[i],nombrec[i])
      }

      var idpais = <?=json_encode($idpais)?>;
      var iddep = <?=json_encode($iddepts)?>;
      var nombred = <?=json_encode($nombredept)?>;

      var datos1=new Array();
      for(i=0;i<iddeptc.length;i++){
        datos1[i]=new Array(idpais[i],iddep[i],nombred[i])
      }
  </script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/Proveedor/EditarProveedor.js"></script>
