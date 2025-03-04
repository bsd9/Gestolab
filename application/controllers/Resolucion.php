<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Resolucion extends MY_Controller {

  function __construct()
  {
    parent::__construct();

    $this->load->model('EstablecimientoComercialModel');
  $this->load->model('ResolucionFacturaModel');
  }


  public function index(){
    $this->logueado();
    $this->permiso('Resoluciones');
    $data['head']="Lista de Resoluciones";
    $data['Resoluciones']=$this->ResolucionFacturaModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Resolucion/ListaResolucion',$data);
    $this->load->view('footer');

  }

  public function nuevo(){
    $this->logueado();
    $this->permiso('Resoluciones');
    $data['head']="Ingresar un nueva Resolucion";
    $data['establecimientos']=$this->EstablecimientoComercialModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Resolucion/IngresarResolucion',$data);
    $this->load->view('footer');

  }

  public function editar($id){
    $this->logueado();
    $this->permiso('Resoluciones');
    $data['head']="Editar informacion de una Resolucion";
    $data['establecimientos']=$this->EstablecimientoComercialModel->selectAll();
    $data['editado']=$this->ResolucionFacturaModel->selectOne($id);
    $this->load->view('header',$data);
    $this->load->view('/Resolucion/EditarResolucion',$data);
    $this->load->view('footer');

}


  public function actualizar($id){
      $this->logueado();
      $this->permiso('Resoluciones');
      if($this->input->post('estado')==null){
        $data['estado']=0;
      }else{
        $data['estado']=1;
      }
$data['resolucion'] = $this->input->post('resolucion');
$data['fechaExpedicion'] = $this->input->post('fechaExpedicion');
$data['fechaVencimiento'] = $this->input->post('fechaVencimiento');
$data['tipo'] = $this->input->post('tipo');
$data['idEstablecimiento'] = $this->input->post('idEstablecimiento');
$data['prefijo'] = $this->input->post('prefijo');
$data['desde'] = $this->input->post('desde');
$data['hasta'] = $this->input->post('hasta');
$data['ultimo'] = $this->input->post('ultimo');
      $data['id']=$id;
      $resolucion = new ResolucionFacturaModel();
      if($resolucion->validate()){
          $resolucion->setData($data);
          $resolucion->update();
          $this->session->set_flashdata('message', 'Resolucion editada Congrats!!');
          redirect('Resolucion/index/');
      }else{
        $data['head']="Editar informacion de una Resolucion";
        $data['editado']=$this->ResolucionFacturaModel->selectOne($id);

        $data['establecimientos']=$this->EstablecimientoComercialModel->selectAll();
        $this->load->view('header',$data);
        $this->load->view('/Resolucion/EditarResolucion',$data);
        $this->load->view('footer');
      }

  }

  public function guardar()
    {
        $this->logueado();
        $this->permiso('Resoluciones');
        if($this->input->post('estado')==null){
          $data['estado']=0;
        }else{
          $data['estado']=1;
        }
  $data['resolucion'] = $this->input->post('resolucion');
  $data['fechaExpedicion'] = $this->input->post('fechaExpedicion');
  $data['fechaVencimiento'] = $this->input->post('fechaVencimiento');
  $data['tipo'] = $this->input->post('tipo');
  $data['idEstablecimiento'] = $this->input->post('idEstablecimiento');
  $data['prefijo'] = $this->input->post('prefijo');
  $data['desde'] = $this->input->post('desde');
  $data['hasta'] = $this->input->post('hasta');
  $data['ultimo'] = $this->input->post('ultimo');
      $resolucion = new ResolucionFacturaModel();
      if($resolucion->validate()){
          $resolucion->setData($data);
          $resolucion->insert();
          $this->session->set_flashdata('message', 'Resolucion Agregado Congrats!!');
          redirect('Resolucion/index/');
      }else{
        $data['head']="Ingresar un nuevo Resolucion";

        $data['establecimientos']=$this->EstablecimientoComercialModel->selectAll();
        $this->load->view('header',$data);
        $this->load->view('/Resolucion/IngresarResolucion',$data);
        $this->load->view('footer');
     }


    }



}
