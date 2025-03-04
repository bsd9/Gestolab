<!DOCTYPE html>
<html lang='en'>

<head>

  <head>
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/imgs/IconSid.ico">

    <meta charset="utf-8">
    <title><?= $head ?></title>
    <script src="<?= base_url(); ?>/assets/js/jquery-2.2.1.min.js" type="text/javascript"></script>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tables.css" media="screen,projection" />
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/bootstrap.min.css">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nav.css" media="screen,projection" />

    <!-- <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css"  media="screen,projection"/> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <nav>
      <div class="nav-wrapper white lighten-5">
        <a href="#!" <?php if ($this->session->has_userdata('id')) {
                        echo 'onclick="MostrarMenu()"';
                      } ?> class="brand-logo center">
          <img src="<?= base_url(); ?>/assets/img/metrolablogo.png" widht="105" height="105">
        </a>
        <a href="#!" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
    </nav>


    <?php if ($this->session->has_userdata('id')) { ?>


      <ul class="side-nav" id="mobile-demo">
        <li class="no-padding">
        <li onclick="OcultarMenu();"><a><i class="material-icons right">fast_rewind</i>Ocultar</a></li>
        <li class="divider"></li>
        <?php if ($this->session->userdata('idCliente') == 2) { ?>
          <?php if (in_array('Usuarios', $this->session->userdata('permisos'))) { ?>
            <li><a href="<?= site_url('Usuario/index') ?>">
                <i class="material-icons right">toc</i>
                Usuario Administrador</a></li>
            <li class="divider"></li>
          <?php } ?>
        <?php } else { ?>
          <?php if (in_array('Usuarios', $this->session->userdata('permisos'))) { ?>
            <li><a href="<?= site_url('Usuario/UsuariosCliente') ?>">
                <i class="material-icons right">toc</i>
                Usuarios </a></li>
            <li class="divider"></li>
          <?php } ?>
        <?php } ?>

        <?php if (in_array('Equipos', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Equipo/index') ?>"><i class="material-icons right">toc</i>Equipos</a></li>
          <li class="divider"></li>
        <?php } ?>

        <?php if (in_array('Dependencia', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Laboratorio/index') ?>"><i class="material-icons right">toc</i>Dependencias</a></li>
          <li class="divider"></li>
        <?php } ?>

        <?php if (in_array('Ordenes', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Ordenes/index') ?>"><i class="material-icons right">toc</i>Ordenar Servicios</a></li>
          <li class="divider"></li>
        <?php } ?>

        <?php if (in_array('Ordenes', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Ordenes/listaOrdenesClienteHistorial') ?>"><i class="material-icons right">toc</i>Historial de Servicios</a></li>
          <li class="divider"></li>
        <?php } ?>

        <?php if (in_array('Clientes', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Cliente/index') ?>"><i class="material-icons right">toc</i>Clientes</a></li>
          <li class="divider"></li>
        <?php }  ?>

        <?php if (in_array('Servicios', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Servicios/index') ?>"><i class="material-icons right">toc</i>Orden de Trabajos</a></li>
          <li class="divider"></li>
        <?php } ?>

        <?php if ($this->session->userdata('idCliente') == 2) { ?>
          <?php if (in_array('Servicio Cliente', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Servicios/ListaCliente') ?>"><i class="material-icons right">toc</i>Orden de Trabajos Cliente</a></li>
          <li class="divider"></li>
        <?php } ?>
        <?php } else { ?>
          <?php if (in_array('Servicio Cliente', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Servicios/ListaEquiposCliente') ?>"><i class="material-icons right">toc</i>Seguimiento Ordenes de Trabajo </a></li>
          <li class="divider"></li>
        <?php } ?>
        <?php } ?>

        <?php if (in_array('Cotizaciones', $this->session->userdata('permisos'))) { ?>
          <li><a href="<?= site_url('Cotizacion/ListaCotizacion') ?>"><i class="material-icons right">toc</i>Cotizaciones Aprobadas</a></li>
        <?php } ?>

        <?php if (in_array('Configuracion Sistema', $this->session->userdata('permisos'))) { ?>
          <li class="divider"></li>

          <ul class="collapsible">
            <li>
              <a class="collapsible-header">Configuracion Sistema</a>
              <div class="collapsible-body">
                <ul>

                  <?php if (in_array('Cargo', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('Cargo/index') ?>"><i class="material-icons right">toc</i>Cargo</a></li>
                    <li class="divider"></li>
                  <?php } ?>

                  <?php if (in_array('Clasificacion', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('Clasificacion/index') ?>"><i class="material-icons right">toc</i>Clasificacion</a></li>
                    <li class="divider"></li>
                  <?php } ?>

                  <?php if (in_array('Variable', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('Variable/index') ?>"><i class="material-icons right">toc</i>Magnitud</a></li>
                    <li class="divider"></li>
                  <?php } ?>

                  <?php if (in_array('AdministradorServicio', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('AdministradorServicio/index') ?>"><i class="material-icons right">toc</i>Administrar Servicio</a></li>
                    <li class="divider"></li>
                  <?php } ?>

                  <?php if (in_array('Empresa', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('GrupoEmpresarial/index') ?>"><i class="material-icons right">toc</i>Grupo Empresarial</a></li>
                    <li class="divider"></li>
                  <?php } ?>

                  <?php if (in_array('Establecimientos', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('EstablecimientoComercial/index') ?>"><i class="material-icons right">toc</i>Establecimiento Comercial</a></li>
                    <li class="divider"></li>
                  <?php } ?>

                  <?php if (in_array('Configuracion', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('Inicio/ConfiguracionFormatos') ?>"><i class="material-icons right">toc</i>Configuracion Formatos</a></li>
                    <li class="divider"></li>
                  <?php } ?>

                  <?php if (in_array('Resoluciones', $this->session->userdata('permisos'))) { ?>
                    <li><a href="<?= site_url('Resolucion/index') ?>"><i class="material-icons right">toc</i>Resoluciones de facturación</a></li>
                    <li class="divider"></li>
                  <?php } ?>


                </ul>
              </div>
          </ul>
          </li>
        <?php } ?>

        <ul class="collapsible">
          <li class="divider"></li>
          <li>
            <a class="collapsible-header">Cuenta</a>
            <div class="collapsible-body">
              <ul>
                <li><a href="<?= site_url('Inicio/logout') ?>"><i class="material-icons right">toc</i>Log
                    Out</a></li>
                <li class="divider"></li>
                <!-- <li><a href="<?= site_url('Inicio/EditarPerfil') ?>"><i class="material-icons right">toc</i>Editar Perfil</a></li>
											      <li class="divider"></li> -->
              </ul>
            </div>
          </li>
        </ul>
        </li>
        <li class="divider"></li>
      </ul>
    <?php } ?>
  </head>

<body>
  <script src="<?php echo base_url(); ?>assets/js/materialize.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.js"></script>
  <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.min.js"></script>-->

  <div id="LimiteFechas" class="modal">
    <div class="modal-content">
      <div class="card-panel">
        <h4>Generando Informe: <span id='NombreInforme'></span></h4>

        <div class="input-field">
          <select name="razonSocialid" id='razonSocialid'>
            <option value="0">Elija una opción</option>
            <?php foreach ($clientes as $cli) { ?>
              <option value="<?= $cli->getId(); ?>"><?= $cli->getRazonSocial(); ?></option>
            <?php } ?>
          </select>
          <label>Clientes</label>
        </div>

        <div class="modal-footer">
          <button onclick="irInforme()" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Generar</button>
          <div class="col s6">
            <buttom onclick=refresh() class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</buttom>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="LimiteFechasParcial" class="modal">
		<div class="modal-content">
			<div class="card-panel">
				<h4>Generando Informe de Ordenes de Trabajo: </h4>


				<div class="row">
					<div class="col s6">
						<div class="input-field"><label for="FechaInicialParcial">Fecha Inicial </label> <input type="date" name="FechaInicialParcial" id="FechaInicialParcial" class="datepicker"> <br /></div>
					</div>
					<div class="col s6">
						<div class="input-field"><label for="FechaFinalParcial">Fecha Final </label> <input type="date" name="FechaFinalParcial" id="FechaFinalParcial" class="datepicker"> <br /></div>
					</div>
				</div>
				<div class="modal-footer">
					<button onclick="irInformeParcial()" class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Generar</button>
					<div class="col s6">
						<button onclick=refresh() class=" modal-action modal-close btn waves-effect waves-light blue darken-3">Volver</button>

					</div>
				</div>
			</div>
		</div>
	</div>








  <?php if ($this->session->has_userdata('id')) { ?>


    <?php if (in_array('Descargas', $this->session->userdata('permisos'))) { ?>
      <div class="fixed-action-btn tooltipped horizontal" style="bottom: 290px; right: 24px;" data-position="top" data-delay="50" data-tooltip="Descargas">
        <a class="btn-floating btn-large blue darken-5">
          <i class="large material-icons">file_download</i>
        </a>
        <ul>
          <li><a onclick='AbrirModalInforme("Informe de Equipos")' class="btn-floating btn blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Informe Equipos"><i class="tiny material-icons ">file_download</i></a></li>
          <li><a onclick='AbrirModalInformeParcial("Informe de Ventas")' class="btn-floating btn blue darken-5 tooltipped" data-position="top" data-delay="20" data-tooltip="Informe Ordenes de Trabajo"><i class="tiny material-icons ">file_download</i></a></li>
        </ul>
      </div>
    <?php } ?>
    <div class="fixed-action-btn horizontal tooltipped click-to-toggle" style="bottom: 135px; right: 24px;" data-position="left" data-delay="50" data-tooltip="Menu">
      <a onclick="MostrarMenu()" class="btn-floating btn-large blue darken-5">
        <i class="material-icons">menu</i>
      </a>
    </div>
    <div class="fixed-action-btn horizontal tooltipped" style="bottom: 60px; right: 24px;" data-position="bottom" data-delay="50" data-tooltip="Opciones">
      <a class="btn-floating btn-large blue darken-5">
        <i class="large material-icons">view_module</i>
      </a>
      <ul id='listaAcciones'>
        <li><a href="<?= site_url('Inicio/logout') ?>" class="btn-floating btn-large tooltipped blue darken-5" data-position="top" data-delay="50" data-tooltip="Salir"><i class="material-icons">power_settings_new</i></a></li>
        <li><a href="<?= site_url('Inicio/index') ?>" class="btn-floating btn-large tooltipped blue darken-5" data-position="top" data-delay="50" data-tooltip="Home"><i class='material-icons tooltipped'>home</i></a>
        </li>
    </div>
    </ul>
    </div>
  <?php } ?>
  <div id="container center_div">
    <div class="center_div">
      <h3>
        <p class="text-center"><?= $head ?></p>
      </h3>
    </div>
    <div id="body">
      <?php if ($this->session->flashdata('message')) { ?>
        <div class="alert alert-success">
          <?= $this->session->flashdata('message') ?>
        </div>
      <?php } ?>

      <script type="text/javascript">
        var InformeGenerar;
        var urlInformeEquipos = "<?= site_url('Equipo/InformeEquipos') ?>";
        var urlInformeVentas = "<?= site_url('Servicios/InformeVentas') ?>";


        var tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        var tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';

        function updateTokens() {
          tokenName = '<?php echo $this->security->get_csrf_token_name(); ?>';
          tokenHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        }
      </script>

      <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/header.js"></script>