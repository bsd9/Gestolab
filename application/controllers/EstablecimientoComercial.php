<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class EstablecimientoComercial extends MY_Controller {

  function __construct()
  {
    parent::__construct();
  $this->load->model('GrupoEmpresarialModel');
  $this->load->model('EstablecimientoComercialModel');
  }



  public function index(){
    $this->logueado();
    $this->permiso('Establecimientos');
    $data['head']="Lista de Establecimientos";
    $data['EstablecimientoComerciales']=$this->EstablecimientoComercialModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/EstablecimientoComercial/ListaEstablecimiento',$data);
    $this->load->view('footer');

  }


  public function editar($id){
    $this->logueado();
    $this->permiso('Establecimientos');

    $data['gruposempresariales']=$this->GrupoEmpresarialModel->selectAll();
    $data['head']="Editar informacion de un Establecimiento Comercial";
    $data['editado']=$this->EstablecimientoComercialModel->selectOne($id);
    $this->load->view('header',$data);
    $this->load->view('/EstablecimientoComercial/EditarEstablecimiento',$data);
    $this->load->view('footer');

}


  public function actualizar($id){
      $this->logueado();
      $this->permiso('Establecimientos');
      $data['nombre']=$this->input->post('nombre');
      $data['idGrupoEmpresarial']=$this->input->post('idGrupoEmpresarial');

      $data['id']=$id;
      $today=getdate();
      $hoy = $today["year"] . "-" . $today["mon"]. "-" . $today["mday"];

$config['overwrite'] = TRUE;
$config['upload_path']          = './assets/imgs/';
$config['allowed_types']        = 'png|jpg';
$config['file_name']        = 'logoFacturacion' . $hoy . $data['nombre'];

$this->load->library('upload', $config);
    $subir=1;
if ( ! $this->upload->do_upload('logoFacturacion'))
{
  $error = array('error' => $this->upload->display_errors());
  $subir=0;
  //$this->load->view('upload_form', $error);
}
else {

  $data2 = array('upload_data' => $this->upload->data());
  //$this->load->view('upload_success', $data);
}
if($subir){
  $data['logoFacturacion']= 'logoFacturacion' . $hoy  . $data['nombre'] . $this->upload->data('file_ext');
}




$config['file_name']        = 'logocotizacion' . $hoy . $data['nombre'];
$this->upload->initialize($config);
    $subir=1;
if ( ! $this->upload->do_upload('logoCotizacion'))
{
  $error = array('error' => $this->upload->display_errors());
  $subir=0;
  //$this->load->view('upload_form', $error);
}
else {

  $data2 = array('upload_data' => $this->upload->data());
  //$this->load->view('upload_success', $data);
}

if($subir){
  $data['logoCotizacion']= 'logocotizacion' . $hoy . $data['nombre'] . $this->upload->data('file_ext');
}


$config['file_name']        = 'fondoCotizacion' . $hoy . $data['nombre'];
$this->upload->initialize($config);
    $subir=1;
if ( ! $this->upload->do_upload('fondoCotizacion'))
{
  $error = array('error' => $this->upload->display_errors());
  $subir=0;
  //$this->load->view('upload_form', $error);
}
else {

  $data2 = array('upload_data' => $this->upload->data());
  //$this->load->view('upload_success', $data);
}

if($subir){
  $data['fondoCotizacion']= 'fondoCotizacion' . $hoy . $data['nombre'] . $this->upload->data('file_ext');
}



if($this->input->post('activo')==null){
  $data['estado']=0;
}else{
  $data['estado']=1;
}

      $cargo = new EstablecimientoComercialModel();
      if($cargo->validate()){
          $cargo->setData($data);
          $cargo->update();
          $this->session->set_flashdata('message', 'Establecimiento Comercial editada Congrats!!');
          redirect('EstablecimientoComercial/index/');
      }else{

        $data['gruposempresariales']=$this->GrupoEmpresarialModel->selectAll();
        $data['head']="Editar informacion de una EstablecimientoComercial";
        $data['editado']=$this->EstablecimientoComercialModel->selectOne($id);
        $this->load->view('header',$data);
        $this->load->view('/EstablecimientoComercial/EditarEstablecimiento',$data);
        $this->load->view('footer');
      }

  }

  


}
