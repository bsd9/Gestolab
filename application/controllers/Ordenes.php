<?php

class Ordenes extends MY_Controller{

    function __construct()
    {
        parent::__construct();

        $this->load->model('ClienteModel');
        $this->load->model('CotizacionModel');
        $this->load->model('UsuarioModel');
        $this->load->model('OrdenesModel');
        $this->load->model('EquipoModel');
        $this->load->model('SolicitudModel');
        $this->load->model('AdministradorServicioModel');
        $this->load->model('VariableModel');
        $this->load->model('FacturaModel');


    }


    public function index(){
      $this->logueado();
      $this->permiso('Ordenes');
      $data['head']="Lista de Servicios";
      $idCliente =$this->session->userdata('idCliente');
      if ($idCliente == 2){
        $data['ordenes']=$this->OrdenesModel->selectAllAdmin();
              $this->load->view('header',$data);
              $this->load->view('/Ordenes/ListaOrdenes',$data);
              $this->load->view('footer');
        }else {
        $data['ordenes']=$this->OrdenesModel->selectAllNueva($this->session->userdata('idCliente'));
              $this->load->view('header',$data);
              $this->load->view('/Ordenes/ListaOrdenesClienteAprobar',$data);
              $this->load->view('footer');
        }

  }

  public function listaOrdenesCliente($id){
    $this->logueado();
    $this->permiso('Ordenes');
    $data['head']="Servicios por cotizar";
    if ($id == 2){
      $data['ordenes']=$this->OrdenesModel->selectAllAdmin();
      }else {
      $data['ordenes']=$this->OrdenesModel->selectAllNueva($id);
      }

      $this->load->view('header',$data);
      $this->load->view('/Ordenes/ListaOrdenesCliente',$data);
      $this->load->view('footer');
  
}

  public function listaOrdenesClienteHistorial(){
    $this->logueado();
    $this->permiso('Ordenes');
    $data['head']="Historial de Servicios Aprobados";
    $idCliente =$this->session->userdata('idCliente');
    
    if ($idCliente == 2){
      $data['ordenes']=$this->OrdenesModel->selectAllHistorial();
            $this->load->view('header',$data);
            $this->load->view('/Ordenes/ListaOrdenesHistorial',$data);
            $this->load->view('footer');
      }else {
      $data['ordenes']=$this->OrdenesModel->selectAllHistorialbyCliente($this->session->userdata('idCliente'));
            $this->load->view('header',$data);
            $this->load->view('/Ordenes/ListaOrdenesClienteHistorial',$data);
            $this->load->view('footer');
      }

}



public function solicitarServicios($id = 'a'){
    $this->logueado();
    $this->permiso('Equipos');
    $data['head']="Orden de Servicio";
//    $responsable = new ResponsableModel();
//    $responsable->setIdUsuario($this->session->userdata("id"));
//    if($responsable->selectOne()){

       if ($id == 'a') {
            $data['cliente']=$this->ClienteModel->selectAll();
            $data['idCliente']=0;
        } else {
            $data['cliente']=$this->ClienteModel->selectOne($id);
            if (count($data['cliente']) != 1) {
              $data['cliente']=$this->ClienteModel->selectAll();
              $data['idCliente']=0;
            }else {
              $data['cliente']=$data['cliente'][0];
              $data['idCliente']=1;
            }
      }
      $data['variable']=$this->VariableModel->selectVariableCliente($this->session->userdata("idCliente"));
      $data['administradorServicio']=$this->AdministradorServicioModel->selectAll();
      $data['showlab'] =1;
      $data['equipos']=$this->EquipoModel->selectAll($this->session->userdata("id"));
      $data['clientes']=$this->ClienteModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Ordenes/ReportarEquipos',$data);
      $this->load->view('footer');
//    }else {
//      $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
//      redirect('Inicio/index');
//    }
  }


  public function solicitarServiciosPorCliente($id){
    $this->logueado();
    $this->permiso('Equipos');
    $data['head']="Orden de Servicio";
//    $responsable = new ResponsableModel();
//    $responsable->setIdUsuario($this->session->userdata("id"));
//    if($responsable->selectOne()){

      $data['cliente']=$this->ClienteModel->selectOne($id);
      $data['variable']=$this->VariableModel->selectVariableCliente($id);
      $data['administradorServicio']=$this->AdministradorServicioModel->selectAll();
      $data['showlab'] =1;
      $data['equipos']=$this->EquipoModel->selectAllClienteEquipo($id);
      $data['clientes']=$this->ClienteModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Ordenes/ReportarEquiposCliente',$data);
      $this->load->view('footer');
//    }else {
//      $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
//      redirect('Inicio/index');
//    }
  }





   public function guardarSolicitud(){
    $today=getdate();

    $equiposh=explode(',',$this->input->post('equiposh'));
    $seviciosh=explode(',',$this->input->post('serviciosh'));
    if(count($seviciosh) <= 0){
      $this->session->set_flashdata('message', 'La solicitud esta vacia');
      redirect('Ordenes/index');
    }
      else{
   
    $data['fecha_solicitud'] =  $today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
    $dataorden["idCreador"]=$this->session->userdata('id');
    $dataorden["razonSocialcliente"]=$this->session->userdata('ncliente');
    $dataorden["idCliente"]=$this->session->userdata('idCliente');
    $dataorden["fechacreacion"]=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
    $dataorden["estado"]=1;
    $ordenes = new OrdenesModel();
    $ordenes->setData($dataorden);
    $data['idOrdenes']= $ordenes->insert();
    $solicitud = new SolicitudModel();
    for ($r=0; $r < count($equiposh); $r++) {
      $data['idEquipo'] = $equiposh[$r];
      $data['servicio'] = $seviciosh[$r];
      $solicitud->setData($data);
      $solicitud->insert();

    }



    $this->session->set_flashdata('message', 'Solicitudes enviadas');
    redirect('Ordenes/index');
  }
  }

  public function guardarSolicitudClientes(){
    $today=getdate();

    $equiposh=explode(',',$this->input->post('equiposh'));
    $seviciosh=explode(',',$this->input->post('serviciosh'));
    if(count($seviciosh) <= 0){
      $this->session->set_flashdata('message', 'La solicitud esta vacia');
      redirect('Ordenes/index');
    }
      else{
    $data['fecha_solicitud'] =  $today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
    $dataorden["idCreador"]=$this->session->userdata('id');
    $dataorden["razonSocialcliente"]=$this->session->userdata('ncliente');
    $dataorden["idCliente"]=$this->session->userdata('idCliente');
    $dataorden["fechacreacion"]=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
    $dataorden["estado"]=1;
    $ordenes = new OrdenesModel();
    $ordenes->setData($dataorden);
    $data['idOrdenes']= $ordenes->insert();
    $solicitud = new SolicitudModel();
    for ($r=0; $r < count($equiposh); $r++) {
      $data['idEquipo'] = $equiposh[$r];
      $data['servicio'] = $seviciosh[$r];
      $solicitud->setData($data);
      $solicitud->insert();

    }



    $this->session->set_flashdata('message', 'Solicitudes enviadas');
    redirect('Ordenes/index');
  }
  }


  public function Aprobar(){
      $this->logueado();
      $this->permiso('Ordenes');
      $id=$this->input->post('idOrden');
      $today=getdate();
      $fechaAprobacion=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
      $orden = $this->OrdenesModel->selectOne($id);
      if($orden[0]->getEstado() != 2){
          $cantidad = count($this->CotizacionModel->selectOne($id));
          if($cantidad != 0){
      $orden[0]->setFechaAprobacion($fechaAprobacion);     
      $orden[0]->setEstado(2);
      $orden[0]->updateAprobar();
      $factura = new FacturaModel();
      $factura->insert($id);

      
      $this->session->set_flashdata('message','La orden fue aprobada con Exitoo!!');
      redirect('Ordenes/index');
    }else{
      $this->session->set_flashdata('message', 'Esta orden tiene elementos por cotizar');
      redirect('Ordenes/index');
    }
  }else{
    $this->session->set_flashdata('message','Esta orden ya fue aprobada');
    redirect('Ordenes/index');
  }
  }


public function detalles(){
  $this->logueado();
  $this->permiso('Ordenes');
  $id=$this->input->post('id');
  $detalles=$this->SolicitudModel->selectOneService($id);
  $ans= "       <table class='bordered highlight'>
                <thead>
                <tr><th>Serial</th>
                <th>Equipo</th>
                <th>Marca-Modelo</th>
                <th>Servicio</th>
                </tr></thead>";
  foreach ($detalles as $deta) {
    $ans = $ans . "<tr>" .
    "<td>". $deta->serial ."</td>" .
    "<td>". $deta->equipo ."</td>" .
    "<td>". $deta->MarcaModelo."</td>" .
    "<td>". $deta->getServicio() ."</td>" .
    "</tr>";
  }
  echo $ans . "</table>";
}



    public function editar($id){
        $this->logueado();
        $this->permiso('Ordenes');
        $data['head'] = "Editando Orden  No." . $id;
        $data['editado']=$this->OrdenesModel->selectOne($id);

        if(count($data['editado']) == 0){
            $this->session->set_flashdata('message', 'La orden no existe');
            redirect('Ordenes/index');
        }else{

          if($data['editado'][0]->getEstado() != 1){
                $this->session->set_flashdata('message', 'La orden no puede ser modificada');
                redirect('Ordenes/index');
          }else{
            $data['editado'] = $data['editado'][0];
            //$data['editadoDetalle']= $this->DetallePedidoModel->selectOne($id);
            $data['cliente']=$this->ClienteModel->selectAll();
            $data['detalles']=$this->SolicitudModel->selectOneService($id);
            $data['administradorServicio']=$this->AdministradorServicioModel->selectAll();
            $data['equipos']=$this->EquipoModel->selectAll($this->session->userdata("id"));
            $data['variable']=$this->VariableModel->selectAll();
              $this->load->view('header',$data);
              $this->load->view('/Ordenes/EditarOrdenes',$data);
              $this->load->view('footer');
            }
          }
    }


    public function actualizar($id)
    {
      $this->logueado();
      $this->permiso('Ordenes');
      $today=getdate();

      $equiposh=explode(',',$this->input->post('equiposh'));
      $seviciosh=explode(',',$this->input->post('serviciosh'));
      if(count($seviciosh) <= 0){
        $this->session->set_flashdata('message', 'La solicitud esta vacia');
        redirect('Ordenes/index');
      }
        else{

      $data['fecha_solicitud'] =  $today["year"] . "-" . $today["mon"]. "-" . $today["mday"];
      $data['idOrdenes']= $id;
      $solicitud = new SolicitudModel();
      $solicitud->deleteAllService($id);
      for ($r=0; $r < count($equiposh); $r++) {
        $data['idEquipo'] = $equiposh[$r];
        $data['servicio'] = $seviciosh[$r];
        $solicitud->setData($data);
        $solicitud->insert();
      }

          $this->session->set_flashdata('message', 'Solicitud actualizada');
          redirect('Ordenes/index');
        }
  }





}
