<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class GrupoEmpresarial extends MY_Controller {

  function __construct()
  {
    parent::__construct();

  $this->load->model('GrupoEmpresarialModel');
  }

  public function index(){
    $this->logueado();
    $this->permiso('Empresa');
    $data['head']="Lista de grupos Empresariales";
    $data['gruposempresariales']=$this->GrupoEmpresarialModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/GrupoEmpresarial/ListaGrupoEmpresarial',$data);
    $this->load->view('footer');

  }


  public function editar($id){
    $this->logueado();
    $this->permiso('Empresa');
    $data['head']="Editar informacion de un grupo empresarial";
    $data['editado']=$this->GrupoEmpresarialModel->selectOne($id);
    $this->load->view('header',$data);
    $this->load->view('/GrupoEmpresarial/EditarGrupoEmpresarial',$data);
    $this->load->view('footer');

}


  public function actualizar($id){
      $this->logueado();
      $this->permiso('Empresa');
      $data=$this->input->post();
      if($this->input->post('estado')==null){
        $data['estado']=0;
      }else{
        $data['estado']=1;
      }
      $data['id']=$id;
      $dependencia = new GrupoEmpresarialModel();
      if($dependencia->validate()){
          $dependencia->setData($data);
          $dependencia->update();
          $this->session->set_flashdata('message', 'Grupo empresarial editada Congrats!!');
          redirect('GrupoEmpresarial/index/');
      }else{
        $data['head']="Editar informacion de un grupo empresarial";
        $data['editado']=$this->GrupoEmpresarialModel->selectOne($id);
        $this->load->view('header',$data);
        $this->load->view('/GrupoEmpresarial/EditarGrupoEmpresarial',$data);
        $this->load->view('footer');
      }

  }




}
