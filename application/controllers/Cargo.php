<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Cargo extends MY_Controller {

  function __construct()
  {
    parent::__construct();


  $this->load->model('CargoModel');
  $this->load->model('PermisoModel');
  $this->load->model('AccesoModel');
  }

  public function index(){
    $this->logueado();
    $this->permiso('Cargo');
    $data['head']="Lista de cargos";
    $data['cargos']=$this->CargoModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Cargo/ListaCargo',$data);
    $this->load->view('footer');

  }

  public function nuevo(){
    $this->logueado();
    $this->permiso('Cargo');
    $data['head']="Ingresar un nuevo cargo";
    $data['permisos']=$this->PermisoModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Cargo/IngresarCargo',$data);
    $this->load->view('footer');

  }

  public function editar($id){
    $this->logueado();
    $this->permiso('Cargo');
    $data['head']="Editar informacion de un cargo";
    $data['editado']=$this->CargoModel->selectOne($id);
    $data['accesos']=$this->AccesoModel->selectOne($id);
    $data['permisos']=$this->PermisoModel->selectAll();
    foreach ($data['permisos'] as $permiso) {
      foreach ($data['accesos'] as $acceso) {
        if ($permiso->getId() == $acceso->getIdPermiso()) {
          $permiso->permitido = 1;
          # code...
        }
      }
    }
    $this->load->view('header',$data);
    $this->load->view('/Cargo/EditarCargo',$data);
    $this->load->view('footer');

}


  public function actualizar($id){
      $this->logueado();
      $this->permiso('Cargo');
      if($this->input->post('activo')==null){
        $data['activo']=0;
      }else{
        $data['activo']=1;
      }
      $permisos = $this->PermisoModel->selectAll();
                $acceso = new AccesoModel();

                $subdata['idCargo']=$id;
                $acceso->setData($subdata);
                $acceso->deleteOne();

      foreach ($permisos as $permiso) {
          //echo = $permiso->getNombre();
      $campos = str_replace(".","_",str_replace(" ","_",$permiso->getNombre()));
        if($this->input->post($campos) != NULL){
          $subdata['idPermiso']=$this->input->post($campos);
          //$subdata['idCargo']=$id;

          $acceso->setData($subdata);
          $acceso->insert();
        }
      }

      $data['nombre']=$this->input->post('nombre');


      $data['id']=$id;
      $cargo = new CargoModel();
      if($cargo->validate()){
          $cargo->setData($data);
          $cargo->update();

          $this->session->set_flashdata('message', 'Cargo editado Congrats!!');
          redirect('Cargo/index/');
      }else{
        $this->editar($id);
      }

  }

  public function guardar()
    {
        $this->logueado();
        $this->permiso('Cargo');
      $data['nombre']=$this->input->post('nombre');
      
      $cargo = new CargoModel();
      if($cargo->validate()){
          $cargo->setData($data);
         $id = $cargo->insert();

      $permisos = $this->PermisoModel->selectAll();
          foreach ($permisos as $permiso) {
            if($this->input->post($permiso->getNombre())!=null){
              $subdata['idPermiso']=$this->input->post($permiso->getNombre());
              $subdata['idCargo']=$id;
              $acceso =new AccesoModel();
              $acceso->setData($subdata);
              $acceso->insert();
            }
          }
          $this->session->set_flashdata('message', 'Cargo Agregado Congrats!!');
          redirect('Cargo/index/');
      }else{
        $this->nuevo();
     }


    }



}
