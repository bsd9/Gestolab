<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Servicios extends MY_Controller {

  function __construct()
  {
    parent::__construct();


      $this->load->model('CaracteristicaModel');
      $this->load->model('TransicionModel');
      $this->load->model('ServicioModel');
      $this->load->model('ProcedimientoModel');
      $this->load->model('RecomendacionModel');
      $this->load->model('ParteModel');
      $this->load->model('PermisoModel');
      $this->load->model('SolicitudModel');
      $this->load->model('EquipoModel');
      $this->load->model('DocumentoModel');
      $this->load->model('ClienteModel');
      $this->load->model('LaboratorioModel');
      $this->load->model('ResponsableModel');
      $this->load->model('ClasificacionModel');
  }

  public function InformeVentas($fechaini, $fechafin){
      $this->logueado();
      $this->permiso('Descargas');
      $data['InformeVentas'] = $this->ServicioModel->InformeVentas($fechaini, $fechafin);
      $this->load->view('Servicio/InformeVentas', $data);
  }

    public function PreDatos(){
      $this->logueado();
      $this->permiso('Servicios');
      $data['orden']=$this->OrdenesModel->selectAll();
      $data['equipo']=$this->EquipoModel->selectAll();
      }

  public function PostDatos(){
    $this->logueado();
    $this->permiso('Servicios');
    $post=$this->input->post();
    $titulo = $this->MagnitudModel->selectOne($this->input->post('idMagnitud'));
    $datamedida['idServicio']=$this->input->post('idServicio');

    $servicio = new ServicioModel();
    $servicio->setId($datamedida['idServicio']);
    $servicio->putTitulo("Informe de Calibración:" . $titulo[0]->getNombre());
    foreach ($post as $prueba => $informacion) {
      if (gettype($informacion) == 'array') {
        $datamedida['prueba'] = $prueba;
        foreach ($informacion as $repeticion => $datos) {
          if (gettype($datos) == 'array') {
            $datamedida['repeticion'] = $repeticion;
            foreach ($datos as $variable => $valor) {
              $datapatrones =[];
              $idsMedida = [];
              if(gettype($valor) == 'array'){
                foreach ($valor as $patron) {
                  $patronxmedida = new MedidaxPatronModel();
                  $patrones = $this->PatronModel->selectOne($patron);
                  $dataPatron ['vence'] = $patrones[0]->getVence();
                  $dataPatron ['lote'] = $patrones[0]->getLote();
                  $dataPatron ['valor'] = $patrones[0]->getValor();
                  $dataPatron ['codigo'] = $patrones[0]->getCodigo();
                  $dataPatron ['fecha'] = $patrones[0]->getFecha();
                  $dataPatron ['incertidumbre'] = $patrones[0]->getIncertidumbre();
                  $dataPatron ['idMagnitud'] = $patrones[0]->getIdMagnitud();
                  $dataPatron ['nombre'] = $patrones[0]->getNombre();
                  $patronxmedida->setData($dataPatron);
                  $patronesUsados[] = $patronxmedida;
                }
              }else {
                $datamedida['variable'] = $variable;
                $datamedida['valorMedido'] = $valor;
                $medida = new MedidaModel();
                $medida->setData($datamedida);
                $idsMedida[]=$medida->insert();
              }
            }
            foreach ($idsMedida as $idmedida) {
              $dataPatron['idMedida'] =$idmedida;
              foreach ($patronesUsados as $patronUsado) {
                $patronUsado->setIdMedida($dataPatron['idMedida']);
                $patronUsado->Insert();
              }
            }

          }



        }
      }
    }

    $this->session->set_flashdata('message', 'Pruebas agregadas con exito!!');
    redirect('Servicios/index/');
  }

  public function index(){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Lista de Ordenes de trabajo";
    $data['pendientes']=$this->SolicitudModel->selectServiceP();
    $data['finalizados']=$this->SolicitudModel->selectServiceF();
    $data['ejecucion']=$this->SolicitudModel->selectServiceE();
    $this->load->view('header',$data);
    $this->load->view('/Servicio/ListaServicioCliente',$data);
    $this->load->view('footer');

  }

  public function servicioEquipo($id){
    $this->logueado();
    if ($this->session->userdata('idCliente') == 2){ 
        $this->permiso('Servicios');
        $equipo = new EquipoModel();
        $equipo = $this->EquipoModel->selectOneEquipo($id);
    
        $data['head']= 'Servicios' ." ". ucwords(strtolower($equipo[0]->getNombre()));
        $data['servicios']=$this->SolicitudModel->selectServiceEquipo($id);
        $this->load->view('header',$data);
        $this->load->view('/Servicio/ListaServicio',$data);
        $this->load->view('footer');
    }else {
        $this->permiso('Servicio Cliente');
        $equipo = new EquipoModel();
        $equipo = $this->EquipoModel->selectOneEquipo($id);
    
        $data['head']= 'Servicios' ." ". ucwords(strtolower($equipo[0]->getNombre()));
        $data['servicios']=$this->SolicitudModel->selectServiceEquipoPendientes($id);
        $this->load->view('header',$data);
        $this->load->view('/Servicio/ListaServicio',$data);
        $this->load->view('footer');
    }


    

  }

  public function ListaCliente(){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Historial de ordenes de trabajo por cliente";
    $data['clientes']=$this->ClienteModel->selectAllServices();
    $this->load->view('header',$data);
    $this->load->view('/Servicio/ListaCliente',$data);
    $this->load->view('footer');


  }


  public function EquipoServicio($id){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Lista de Ordenes de trabajo";
    $data['clientes']=$this->ClienteModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Servicio/ListaCliente',$data);
    $this->load->view('footer');

  }

  public function subirdocs(){

      $nserv = $this->input->post('idServicio');
      $serv = $this->SolicitudModel->selectOne($nserv);

      $equ = $this->EquipoModel->selectOneEqui($serv[0]->getIdEquipo());
      if($equ[0]->getFuncional() == 1){
        if(count($serv) != 0){
          if($serv[0]->getEstado() == 5){


            $config['allowed_types']     = '*';
            $config['upload_path']       = './uploads-old/docs/equipos/';
            $this->load->library('upload', $config);
            $documentos = new DocumentoModel();
            if (!$this->upload->do_upload('Documentos')){
              $error = array('errorF' => $this->upload->display_errors());
      log_message('debug', json_encode($error));

            $this->session->set_flashdata('message', 'Error en archivo');
            redirect('Servicios/servicioEquipo/'. $serv[0]->getIdEquipo());
            }
            else{
              $datos = $this->upload->data();
              $doc['nombre']= $datos['file_name'];
              $doc['idEquipo']= $equ[0]->getID();
              $today=getdate();
              $documentos->setData($doc);
              $documentos->insert();
              $this->session->set_flashdata('message', 'Archivo subido con exito');
              redirect('Servicios/servicioEquipo/'. $serv[0]->getIdEquipo());
            }

        }else {
          $this->session->set_flashdata('message','No se puede subir archivo, servicio no finalizado' );
    redirect('Servicios/servicioEquipo/'. $serv[0]->getIdEquipo());

        }
      }else {
        $this->session->set_flashdata('message','No existe ese servicio');
    redirect('Servicios/servicioEquipo/'. $serv[0]->getIdEquipo());

      }
    }else{
      $this->session->set_flashdata('message', 'No se puede ejecutar esa accion con este servicio');
    redirect('Servicios/servicioEquipo/'. $serv[0]->getIdEquipo());

    }
  }

  public function comenzar(){
      $data['idServicio']=$this->input->post('id');
      $data['descripcion']='';
      $serv = $this->SolicitudModel->selectOne($data['idServicio']);
      $idEqu= $serv[0]->getIdEquipo();
      $equ = $this->EquipoModel->selectOneEqui($idEqu);
      if($equ[0]->getFuncional() == 1 || $equ[0]->getFuncional() == 3){
        if(count($serv) != 0){
          if($serv[0]->getEstado() == 0 || $serv[0]->getEstado() == NULL){
            $data['idResponsable'] = $this->session->userdata('id');
            $serv[0]->setIdResponsable($this->session->userdata('id'));
            $data['estado'] = 2;
            $serv[0]->setEstado(2);
            $serv[0]->estadoServicio();
            $equ[0]->setFuncional(4);
            $equ[0]->updateEstado();
            $today=getdate();
            $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
            $data['fecha'] = $hoy;
            $transicion = new TransicionModel();
            $transicion->setData($data);
            $transicion->insert();
            echo 'Se inicio el servicio con exito';
        }else {
          echo 'No se puede ejecutar esa accion con este servicio';
        }
      }else {
        echo 'No existe ese servicio';
      }
    }else{
      echo 'No se puede ejecutar esa accion con este servicio';
    }
  }


  public function iniciar(){
      $data['idServicio']=$this->input->post('id');
      $data['descripcion']='';
      $serv = $this->SolicitudModel->selectOne($data['idServicio']);
      $idEqu= $serv[0]->getIdEquipo();
      $equ = $this->EquipoModel->selectOneEqui($idEqu);
      if($equ[0]->getFuncional() == 4){
      if(count($serv) != 0){
        if($serv[0]->getEstado() != 2 and $serv[0]->getEstado() != 5){
          if($serv[0]->getIdResponsable() == 0  || $serv[0]->getEstado() == NULL){
            $serv[0]->setIdResponsable($this->session->userdata('id'));
          }
          if($serv[0]->getIdResponsable() == $this->session->userdata('id')){
            $data['idResponsable'] = $this->session->userdata('id');
            $data['estado'] = 2;
            $serv[0]->setEstado(2);
            $serv[0]->estadoservicio();
            $equ[0]->setFuncional(4);
            $equ[0]->updateEstado();
            $today=getdate();
            $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
            $data['fecha'] = $hoy;
            $transicion = new TransicionModel();
            $transicion->setData($data);
            $transicion->insert();
            echo 'Se inicio el servicio con exito';
          }else {
            echo 'Usted no es el responsable de este proceso';
          }
        }else {
          echo 'No se puede ejecutar esa accion con este servicio';
        }
      }else {
        echo 'No existe ese servicio';
      }
  }else{
    echo 'No se puede ejecutar esa accion con este servicio';
  }
}


  public function pausar(){
      $data['idServicio']=$this->input->post('id');
      $data['descripcion']=$this->input->post('desc');
      $serv = $this->SolicitudModel->selectOne($data['idServicio']);
      $idEqu= $serv[0]->getIdEquipo();
      $equ = $this->EquipoModel->selectOneEqui($idEqu);
      if($equ[0]->getFuncional() == 4){
      if(count($serv) != 0){
        if($serv[0]->getEstado() == 2){
          if($serv[0]->getIdResponsable() == $this->session->userdata('id')){
            $data['idResponsable'] = $this->session->userdata('id');
            $data['estado'] = 3;
            $serv[0]->setIdResponsable($this->session->userdata('id'));
            $serv[0]->setEstado(3);
            $serv[0]->estadoservicio();
            $equ[0]->setFuncional(4);
            $equ[0]->updateEstado();
            $today=getdate();
            $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
            $data['fecha'] = $hoy;
            $transicion = new TransicionModel();
            $transicion->setData($data);
            $transicion->insert();
            echo 'pausado con exito';
          }else {
            echo 'Usted no es el responsable de este proceso';
          }
        }else {
          echo 'No se puede ejecutar esa accion con este servicio';
        }
      }else {
        echo 'No existe ese servicio';
      }
  }else{
    echo 'No se puede ejecutar esa accion con este servicio';
  }
}

  public function detener(){
      $data['idServicio']=$this->input->post('id');
      $data['descripcion']=$this->input->post('desc');
      $serv = $this->SolicitudModel->selectOne($data['idServicio']);
      $idEqu= $serv[0]->getIdEquipo();
      $equ = $this->EquipoModel->selectOneEqui($idEqu);
      if($equ[0]->getFuncional() == 4){
      if(count($serv) != 0){
        if($serv[0]->getEstado() == 2 or $serv[0]->getEstado() == 3){
          if($serv[0]->getIdResponsable() == $this->session->userdata('id')){
            $data['idResponsable'] = $this->session->userdata('id');
            $serv[0]->setIdResponsable(NULL);
            $data['estado'] = 4;
            $serv[0]->setEstado(4);
            $serv[0]->estadoservicio();
            $equ[0]->setFuncional(4);
            $equ[0]->updateEstado();
            $today=getdate();
            $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
            $data['fecha'] = $hoy;
            $transicion = new TransicionModel();
            $transicion->setData($data);
            $transicion->insert();

            echo 'detenido con exito';
          }else {
            echo 'Usted no es el responsable de este proceso';
          }
        }else {
          echo 'No se puede ejecutar esa accion con este servicio';
        }
      }else {
        echo 'No existe ese servicio';
      }
  }else{
    echo 'No se puede ejecutar esa accion con este servicio';
  }
}

  public function finalizar(){
      $data['idServicio']=$this->input->post('id');
      $data['descripcion']=$this->input->post('desc');
      $serv = $this->SolicitudModel->selectOne($data['idServicio']);
      $idEqu= $serv[0]->getIdEquipo();
      $equ = $this->EquipoModel->selectOneEqui($idEqu);
      if($equ[0]->getFuncional() == 4){
      if(count($serv) != 0){
        if($serv[0]->getEstado() != 1){
          if($serv[0]->getIdResponsable() == $this->session->userdata('id')){
            $data['idResponsable'] = $this->session->userdata('id');
            $data['estado'] = 5;
            $today=getdate();
            $fecha=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
            $serv[0]->setFechaServicio($fecha);
            $serv[0]->setEstado(5);
            $serv[0]->serviciofinalizado();
            $equ[0]->setFuncional(1);
            $equ[0]->updateEstado();
            $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
            $data['fecha'] = $hoy;
            $transicion = new TransicionModel();
            $transicion->setData($data);
            $transicion->insert();
            echo 'Finalizado con exito';
          }else {
            echo 'Usted no es el responsable de este proceso';
          }
        }else {
          echo 'No se puede ejecutar esa accion con este servicio';
        }
      }else {
        echo 'No existe ese servicio';
      }
  }else{
    echo 'No se puede ejecutar esa accion con este servicio';
  }
}


public function NoFinalizar(){
  $data['idServicio']=$this->input->post('id');
  $data['descripcion']=$this->input->post('desc');
  $serv = $this->SolicitudModel->selectOne($data['idServicio']);
  $idEqu= $serv[0]->getIdEquipo();
  $equ = $this->EquipoModel->selectOneEqui($idEqu);
  if($equ[0]->getFuncional() == 4){
  if(count($serv) != 0){
    if($serv[0]->getEstado() != 1){
      if($serv[0]->getIdResponsable() == $this->session->userdata('id')){
        $data['idResponsable'] = $this->session->userdata('id');
        $data['estado'] = 6;
        $today=getdate();
        $fecha=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
        $serv[0]->setFechaServicio($fecha);
        $serv[0]->setEstado(6);
        $serv[0]->serviciofinalizado();
        $equ[0]->setFuncional(1);
        $equ[0]->updateEstado();
        $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
        $data['fecha'] = $hoy;
        $transicion = new TransicionModel();
        $transicion->setData($data);
        $transicion->insert();
        echo 'Servicio No Finalizado';
      }else {
        echo 'Usted no es el responsable de este proceso';
      }
    }else {
      echo 'No se puede ejecutar esa accion con este servicio';
    }
  }else {
    echo 'No existe ese servicio';
  }
}else{
echo 'No se puede ejecutar esa accion con este servicio';
}
}

  public function equipoInfo(){
    $this->logueado();
      $id=$this->input->post('id');
    $movs=$this->SolicitudModel->equipoInfo($id);
    $ans= "       <table class='bordered highlight'>
                  <thead>
                  <tr>
                  <th>Equipo</th>
                  <th>Marca-Modelo</th>
                  <th>Serial</th>
                  <th>Codigo Interno</th>
                  <th>Dependencia</th>
                  <th>Estado</th>
                  </tr></thead>";
    foreach ($movs as $mov) {
      if($mov->Estado == 0){
        $helper='Dado de baja';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->Estado == 1){
        $helper='Funcional';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->Estado == 3){
        $helper='Incidente';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->Estado == 4){
        $helper='Proceso Tecnico';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }

      $ans = $ans . "<tr>" .
      "<td>". $mov->equipo ."</td>" .
      "<td>". $mov->MarcaModelo ."</td>" .
      "<td>". $mov->serial ."</td>" .
      "<td>". $mov->Codigointerno ."</td>".
      "<td>". $mov->Dependencia ."</td>" .
      "<td>". $helper."</td>" .

      "</tr>";
    }
    echo $ans . "</table>";

  }




  public function historial(){
    $this->logueado();
      $id=$this->input->post('id');
    $movs=$this->TransicionModel->histoService($id);
    $ans= "       <table class='bordered highlight'>
                  <thead>
                  <tr>
                  <th>Tecnico</th>
                  <th>Fecha y hora</th>
                  <th>Estado solicitado</th>
                  <th>descripcion</th></tr></thead>";
    foreach ($movs as $mov) {
      if($mov->getEstado() == 1){
        $helper='Solicitado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->getEstado() == 2){
        $helper='Iniciado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->getEstado() == 3){
        $helper='Pausado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->getEstado() == 4){
        $helper='Detenido';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->getEstado() == 5){
        $helper='Finalizado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      if($mov->getEstado() == 6){
        $helper='No Finalizado';//"<p hidden>1</p><div class='text-center'><i style='color:green' class='glyphicon glyphicon-ok'></i></div>";
      }
      $ans = $ans . "<tr>" .
      "<td>". $mov->Tecnico ."</td>" .
      "<td>". $mov->getFecha() ."</td>" .
      "<td>". $helper."</td>" .
      "<td>". $mov->getDescripcion() ."</td>" .

      "</tr>";
    }
    echo $ans . "</table>";

  }






public function verEquipo(){
  $id=$this->input->post('id');
    $equipo = $this->ServicioEquipoModel->selectOne($id);
    $data['caracteristicas'] = array();
    if (count($equipo) >= 1) {
      $data["equipo"] = $equipo[0];
      $data['caracteristicas'] = $this->CaracteristicaModel->selectOne($equipo[0]->getId());
    }
    $ans  =  $this->load->view('Servicio/equipoServicio',$data, TRUE);
    echo $ans;
  }

public function datosEquipo()
  {
    $dataequipo=$this->input->post();
    $equipo = $this->ServicioEquipoModel->selectOne($dataequipo['idServicio']);
    if (count($equipo) >= 1) {
        $equipo[0]->setData($dataequipo);
        $equipo[0]->update();
        $equipo=$equipo[0];
        $dataequipo['id'] =$equipo->getId();
    }else {
      $equipo = new ServicioEquipoModel();
      $equipo->setData($dataequipo);
      $dataequipo['id'] = $equipo->insert();
      $equipo->setData($dataequipo);
    }
    $this->CaracteristicaModel->delete($equipo->getId());
    $caracteristica = new CaracteristicaModel();
    for ($i=0; $i < count($dataequipo['ValorVar']); $i++) {
      $datacaracterstica['valor'] = $dataequipo['ValorVar'][$i];
      $datacaracterstica['nombre'] = $dataequipo['NombreVar'][$i];
      $datacaracterstica['idEquipo'] = $dataequipo['id'];
      $caracteristica->setData($datacaracterstica);
      $caracteristica->insert();
    }

    $this->session->set_flashdata('message', 'Datos del equipo modificados con exito!!');
    redirect('Servicios/index/');
  }


  


   public function ListaEquipo($id){
     $this->logueado();
     $this->permiso('Servicios');
     $data['showlab'] =1;
     $data['showcustomer'] =0;
      $cliente = $this->ClienteModel->selectOne($id);

       $data['head']="Equipos " . $cliente[0]->getRazonSocial();
       $data['equipos']=$this->EquipoModel->selectEquiposCliente($id);
       $this->load->view('header',$data);
       $this->load->view('/Servicio/ListaEquipos',$data);
       $this->load->view('footer');

     }

     public function ListaEquiposCliente(){
      $this->logueado();
      $this->permiso('Servicio Cliente');
      
      $data['showlab'] =1;
      $data['showcustomer'] =0;
       $cliente = $this->ClienteModel->selectOne($this->session->userdata('idCliente'));
 
        $data['head']="Equipos " . $cliente[0]->getRazonSocial();
        $data['equipos']=$this->EquipoModel->selectEquiposClienteProcesoTecnico($this->session->userdata('idCliente'));
        $this->load->view('header',$data);
        $this->load->view('/Servicio/ListaEquiposCliente',$data);
        $this->load->view('footer');
 
      }


public function generarInforme($id){
 //generar el pdf
 $this->logueado();
 $this->permiso('Servicios');
 $serv = $this->SolicitudModel->selectOne($id);
  if($serv[0]->getEstado() == 5){
 $data['servicio'] = $this->SolicitudModel->selectOne($id);
 $data['trancicion']=$this->TransicionModel->histoService($id);
 $data['procedimientos'] = $this->ProcedimientoModel->selectOne($id);
 $data['partes'] =$this->ParteModel->selectOne($id);
 $data['recomendaciones'] = $this->RecomendacionModel->selectOne($id);
 //$data['equipo'] = $this->EquipoModel->selectOne($data['servicio'][0]->getIdEquipo());
 //$data['caracteristicas'] = $this->CaracteristicaModel->selectOne($data['equipo'][0]->getId());
 //$data['extras'] = $this->ExtraModel->selectOne($id);


//generar aqui PDF
 $html=$this->load->view('Servicio/informe',$data, true);
 $this->load->library('m_pdf');
 $pdf = $this->m_pdf->load();
 $stylesheet = file_get_contents(base_url() . 'assets/css/table.css');
 $stylesheet .= file_get_contents(base_url() . 'assets/css/materialize.css');

 $pdf->WriteHTML($stylesheet ,1);
 $pdf->AddPage('P', // L - landscape, P - portrait
 '', '', '', '',
 10, // margin_left
 10, // margin right
 10, // margin top
 10, // margin bottom
 0, // margin header
 0); // margin footer
 $pdf->WriteHTML($html, 0);
 $pdf->Output("Informe" . $id . ".pdf", "I");
}else {
  $this->session->set_flashdata('message', 'No se puede generar informe proceso no finalizado');
  redirect('Servicios/index/');
}

}
public function editarInforme($id){
  $this->logueado();
  $this->permiso('Servicios');
    $data['head'] ='Datos del servicio';
    $data['servicio'] = $this->ServicioModel->selectOne($id);
    $data['trancicion']=$this->TransicionModel->selectOne($id);
    $data['pruebas'] = array('informacion' => array());
    $data['procedimientos'] = $this->ProcedimientoModel->selectOne($id);
    $data['partes'] =$this->ParteModel->selectOne($id);
    $data['recomendaciones'] = $this->RecomendacionModel->selectOne($id);
    $data['extras'] = $this->ExtraModel->selectOne($id);
    $this->load->view('header',$data);
    $this->load->view('/Servicio/cambiarDatosInforme',$data);
    $this->load->view('footer');
  //sacar valores de las pruebas
}

public function modificarInforme($id){
$servicio = new ServicioModel();
$servicio->setCodigo($this->input->post('codigo'));
$servicio->setTitulo($this->input->post('titulo'));
$servicio->setFecha($this->input->post('fecha'));
$servicio->setFechaEjecucion($this->input->post('fechaEjecucion'));
$servicio->setId($id);
$servicio->putInform();

$procedimientos = $this->input->post('procedimiento');
$partes = $this->input->post('partes');
$recomendaciones = $this->input->post('recomendacion');


$Obj = new ProcedimientoModel();
$datainsert['idServicio'] = $id;
$Obj->delete($id);
  foreach ($procedimientos as $procedimiento) {
    $datainsert['texto'] = $procedimiento;
    $Obj->setData($datainsert);
    $Obj->insert();
  }

  $Obj = new ParteModel();
  $Obj->delete($id);
  foreach ($partes as $parte) {
    $datainsert['nombre'] = $parte;
    $Obj->setData($datainsert);
    $Obj->insert();
  }

  $Obj = new RecomendacionModel();
  $Obj->delete($id);
  foreach ($recomendaciones as $recomendacion) {
    $datainsert['texto'] = $recomendacion;
    $Obj->setData($datainsert);
    $Obj->insert();
  }


  $this->ExtraModel->delete($id);
  $caracteristica = new ExtraModel();
  $dataequipo = $this->input->post();
  for ($i=0; $i < count($dataequipo['ValorVar']); $i++) {
    $datacaracterstica['valor'] = $dataequipo['ValorVar'][$i];
    $datacaracterstica['nombre'] = $dataequipo['NombreVar'][$i];
    $datacaracterstica['idServicio'] = $id;
    $caracteristica->setData($datacaracterstica);
    $caracteristica->insert();
  }


  $this->session->set_flashdata('message', 'Datos del informe modificados con exito!!');
  redirect('Servicios/index/');

}



}
