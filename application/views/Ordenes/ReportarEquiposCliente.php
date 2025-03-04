<div class ="card-panel">
  <div class="card-panel">
    <?php
    echo form_open('Ordenes/guardarSolicitudClientes',array('id'=>'formulario'));
    ?>

    <div class="card-panel">



      <div class="col s12 m10 offset-m1">
        <table id="productost" class="highlight bordered" border="1" cellpadding="5" style= "border collapse:collapse" >
          <thead>
            <tr>
              <th>Equipo</th>
              <th>Marca-Modelo</th>
              <th>Serial</th>
              <th>Servicio</th>
              <th>Editar</th>
            </tr>
          </thead>
        </table>
      </div>

      <div class="row">
        <div class="col s3 m3">

          <div  class="input-field"><label for="serial">Serial</label>
            <input type ="text" class="validate" name="serial" id="serial"  list="dataserial" onchange="nameByCodProducto(this.value)"/> </div>

            <datalist id="dataserial">
              <?php
              $codequ=[];
              foreach($equipos as $equ){
                ?>
                <?php if($equ->getFuncional() == 1){
                  $codequ[]=$equ->getSerial();
                  ?>

                  <option  value="<?=$equ->getSerial();?>"><?=$equ->getSerial();?></option>
                <?php } ?>
              <?php } ?>
            </datalist>
          </div>

          <div class="col s2 m2">

            <div class="input-field"><label for="equipo">Equipo</label>
              <input type ="text" list="listacodequipos"  onchange class="validate" name="equipo" id="nombre" /> </div>
              <datalist id="listacodequipos">
                <?php
                $equipoid=[];
                $equiname=[];
                foreach($equipos as $equ){
                  ?>
                  <?php if($equ->getFuncional() == 1){
                    $equiname[]=$equ->getNombre();
                    $equipoid[]=$equ->getId();
                    ?>

                    <option  value="<?=$equ->getNombre();?>"><?=$equ->getNombre();?></option>
                  <?php } ?>
                <?php } ?>
              </datalist>
            </div>
            <div class="col s3 m3">
              <div class="input-field"><label for="Marca-Modelo">Marca-Modelo</label>
                <input type ="text" list="listaMarca"  onchange="" class="validate" name="Marca-Modelo" id="Marca-Modelo" /> </div>
                <datalist id="listaMarca">
                  <?php
                  $marcaname=[];
                  foreach($equipos as $equ){
                    ?>
                    <?php if($equ->getFuncional() == 1){
                      $marcaname[]=$equ->getMarca()."-".$equ->getModelo();
                      ?>

                      <option  value="<?=$equ->getMarca()."-".$equ->getModelo();?>"><?=$equ->getMarca()."-".$equ->getModelo();?></option>
                    <?php } ?>
                  <?php } ?>
                </datalist>
              </div>


              <div style="margin-top: 14px">
                <select id="servicio"  name="servicio">
                  <option  disabled selected="">Elija opción</option>
                  <?php
                  foreach($administradorServicio as $servicios){
                    ?>
                    <?php if($servicios->getEstado() == 1){
                      ?>
                      <?php if($servicios->getVariable() == 1){?>
                        <?php
                        foreach($variable as $var){
                          ?>
                          <option  value="<?=$servicios->getNombre()?> - <?=$var->getTitulo()?>"><?=$servicios->getNombre()?> - <?=$var->getTitulo()?></option>
                        <?php } ?>
                      <?php }else{ ?>
                        <option  value="<?=$servicios->getNombre()?>"><?=$servicios->getNombre()?></option>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>

                </select>
              </div>


              <div class="col s12 m1">
              </br>
              <div class="center">
                <button class="btn waves-effect waves-light blue darken-3" type="button" name="Agregar" value="Agregar" onclick='agregarOrdenes()' >Agregar
                  <i class="material-icons right">contact_phone</i>
                </button>
              </div>
            </div>

          </div>
        </div>
        <div class="center">

          <input type ="text" class="validate" name="equiposh" id="equiposh"  hidden />
          <input type ="text" class="validate" name="serviciosh" id="serviciosh"  hidden />

          <button class="btn waves-effect waves-light blue darken-3"  name="Guardar" value="Guardar" style="bottom: 5px">Guardar
            <i class="material-icons right">send</i>
          </button>
        </div>

        <div id="EditarModal" class="modal">
          <div class="modal-content">
            <div class="card-panel">
              <div  class="input-field"><label for="serialE">Serial</label>
                <input type ="text" class="validate" name="serialE" id="serialE"  list="dataserialE" onchange="nameByCodProductoE(this.value)"/> </div>

                <datalist id="dataserialE">
                  <?php
                  foreach($equipos as $equ){
                    ?>
                    <?php if($equ->getFuncional() == 1){   ?>

                      <option  value="<?=$equ->getSerial();?>"><?=$equ->getSerial();?></option>
                    <?php } ?>
                  <?php } ?>
                </datalist>
                <div class="input-field"><label for="equipo">Equipo</label>
                  <input type ="text" list="listacodequiposE"  onchange class="validate" name="equipoE" id="nombreE" /> </div>
                  <datalist id="listacodequiposE">
                    <?php
                    foreach($equipos as $equ){
                      ?>
                      <?php if($equ->getFuncional() == 1){     ?>

                        <option  value="<?=$equ->getNombre();?>"><?=$equ->getNombre();?></option>
                      <?php } ?>
                    <?php } ?>
                  </datalist>
                  <div class="input-field"><label for="Marca-ModeloE">Marca-Modelo</label>
                    <input type ="text" list="listaMarcaE"  onchange="" class="validate" name="Marca-ModeloE" id="Marca-ModeloE" /> </div>
                    <datalist id="listaMarcaE">
                      <?php
                      foreach($equipos as $equ){
                        ?>
                        <?php if($equ->getFuncional() == 1){   ?>

                          <option  value="<?=$equ->getMarca()."-".$equ->getModelo();?>"><?=$equ->getMarca()."-".$equ->getModelo();?></option>
                        <?php } ?>
                      <?php } ?>
                    </datalist>



                    <select id="servicioE"  name="servicioE">
                      <?php
                      foreach($administradorServicio as $servicios){
                        ?>
                        <?php if($servicios->getEstado() == 1){
                          ?>
                          <?php if($servicios->getVariable() == 1){?>
                            <?php
                            foreach($variable as $var){
                              ?>
                              <option  value="<?=$servicios->getNombre()?> - <?=$var->getTitulo()?>"><?=$servicios->getNombre()?> - <?=$var->getTitulo()?></option>
                            <?php } ?>
                          <?php }else{ ?>
                            <option  value="<?=$servicios->getNombre()?>"><?=$servicios->getNombre()?></option>
                          <?php } ?>
                        <?php } ?>
                      <?php } ?>
                    </select>



                    <div class="modal-footer">
                      <button type="button" id=Modificarbtn onclick="ModificarFila()" class="btn waves-effect waves-light blue darken-3" >Modificar item</button>
                    </div>
                  </div>
                </div>
              </div>

              <input hidden type="text" name="button" id=button value="">


              <?php echo form_close();?>

 


            </div>
          </div>
          <script type="text/javascript" >
          var urlImagenes = '<?=site_url('Equipo/imagenes')?>'
          var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
          var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';

          function updateTokens(){
            tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
            tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
          }


          var codequ=<?=json_encode($codequ);?>;
          var marcaname=<?=json_encode($marcaname);?>;
          var equiname=<?=json_encode($equiname);?>;
          var equipoid=<?=json_encode($equipoid);?>;
          var dataSet=<?=json_encode([]);?>;

          var equipos = [];
          var servicios = [];



        </script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/Ordenes/ReportarEquipo.js"></script>
