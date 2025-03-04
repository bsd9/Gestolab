<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MY_Controller{

  function __construct()
  {
    parent::__construct();
  $this->load->model('UsuarioModel');
  $this->load->model('LaboratorioModel');
  $this->load->model('ResponsableModel');
    $this->load->model('ClienteModel');
    $this->load->model('PermisoModel');
    $this->load->model('CargoModel');
  }


function laboratorio(){
  $this->logueado();
  $this->permiso('Usuarios');
  $id=$this->input->post('id');

//sacar info de los laboratorios de cada persona y los demas datos que no se ven para un modal
}

public function nuevo($idCliente = null){
    $this->logueado();
    $this->permiso('Usuarios');
    $usua = $this->session->userdata("idCliente");
    $data['head']="Ingresar un nuevo Usuario";
    if ($usua == 2){
      $data['cargos'] = $this->CargoModel->selectAll();
    }else {
      $data['cargos'] = $this->CargoModel->selectNoAdmin();
    }
    $data['idCliente'] = $idCliente;
    $this->load->view('header',$data);
    $this->load->view('/Usuario/IngresarUsuario',$data);
    $this->load->view('footer');
}
  

  public function index(){
    $this->logueado();
    $this->permiso('Usuarios');
    $data['head']="Usuarios";
    $data['clientes']=$this->ClienteModel->selectAll();
    $data['usuarios']=$this->UsuarioModel->selectAll($this->session->userdata("idCliente"));
    $this->load->view('header',$data);
    $this->load->view('/Usuario/ListarUsuario',$data);
    $this->load->view('footer');
  }

  public function UsuariosCliente(){
    $this->logueado();
    $this->permiso('Usuarios');
    $data['head']="Usuarios";
    $data['clienteId'] = $this->session->userdata("idCliente");
    $data['clientes']=$this->ClienteModel->selectAll();
    $data['usuarios']=$this->UsuarioModel->selectAll($this->session->userdata("idCliente"));
    $this->load->view('header',$data);
    $this->load->view('/Usuario/ListarUsuariocliente',$data);
    $this->load->view('footer');
  }



public function responsabilidades($id){
  $this->logueado();
  $this->permiso('Usuarios');
  $data['head']="Responsabilidades";
  $usuario = new UsuarioModel();
  $usuario->setId($id);
  if ($this->session->userdata("tipo") == "General") {
    $data['clientes']=$this->ClienteModel->selectAll();
    $data['usuarios']=$usuario->selectOne($id);
    $data['laboratorios']=$this->LaboratorioModel->selectAll($id);
    $data['posibles']=$this->LaboratorioModel->selectAll($this->session->userdata("id"));
    $this->load->view('header',$data);
    $this->load->view('/Usuario/ListaResponsabilidades',$data);
    $this->load->view('footer');
  }else {
    $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
    redirect('Inicio/index');
  }

}

public function asignarResponsabilidades($id){
      $idLaboratorios=array_unique($this->input->post('idLaboratorio'));
      $responsable = new ResponsableModel();
      $responsable->delete($id);
      foreach ($idLaboratorios as $idLaboratorio) {
        $data["idLaboratorio"] = $idLaboratorio;
        $data["idUsuario"] = $id;
        $responsable->setData($data);
        $responsable->insert();
      }
      $this->session->set_flashdata('message', 'Cambios guardados');
      redirect('Usuario/index');
}


  public function editar($id){
    $this->logueado();
    $this->permiso('Usuarios');
    $data['head']="Editar informacion Personal";
    $data['editado']=$this->UsuarioModel->selectOne($id);
    $data['cargos'] = $this->CargoModel->selectAll();
        $data['clientes']=$this->ClienteModel->selectAll();
        $data["mod"] = 1;
        $this->load->view('header',$data);
        $this->load->view('/Usuario/EditarUsuario',$data);
        $this->load->view('footer');
      }



  public function actualizar($id)
    {
        $this->logueado();
        $this->permiso('Usuarios');

        $data['head']="Editar informacion personal";
      $data['id']=$id;
      $data['nombre']=$this->input->post('nombre');
      $data['apellidos']=$this->input->post('apellidos');
      $data['email']=$this->input->post('email');
      $data['usuario']=$this->input->post('usuario');
      $data['password']=$this->input->post('password');
      $data['fijo']=$this->input->post('fijo');
      $data['celular']=$this->input->post('celular');
      $data['idCargo']=$this->input->post('cargo');
      $data['activo']=$this->input->post('activo');

      $usuario = new UsuarioModel();
      if($usuario->validate(0)){
          $usuario->setData($data);
          $usuario->update();
          $this->session->set_flashdata('message', 'Usuario editado');
          $updatedUser = $usuario->selectOne($id);
          redirect('Cliente/users/' . $updatedUser[0]->getIdCliente());
      }else{
          $this->editar($id);
      }


  }




public function guardar($idCliente = null)
{
        $this->logueado();
        $this->permiso('Usuarios');

    
      $data['head'] = "Ingresar un nuevo usuario ";
      $data['nombre']=$this->input->post('nombre');
      $data['apellidos']=$this->input->post('apellidos');
      $data['email']=$this->input->post('email');
      $data['usuario']=$this->input->post('usuario');
      $data['password']=$this->input->post('password');
      $data['fijo']=$this->input->post('fijo');
      $data['celular']=$this->input->post('celular');
      $data['activo']= 1;
      $data['token']='NULL';
      $data['idCargo']=$this->input->post('cargo');
      if($idCliente == null){$idCliente = 2;}
      $data['idCliente']=$idCliente;

        $usuario = new UsuarioModel();
        if ($usuario->validate(0)) {
            $usuario->setData($data);
            $usuario->insert();
            $this->session->set_flashdata('message', 'Usuario Agregado Congrats!!');
            redirect('Cliente/users/' . $idCliente);
        } else {

            $this->load->view('header', $data);
            $this->load->view('/Usuario/IngresarUsuario', $data);
            $this->load->view('footer');
        }


    }




public function responsabilidadesc($id){
  $this->logueado();
  $data['head']="Responsabilidades";
  $usuario = new UsuarioModel();
  $usuario->setId($id);
    $data['clientes']=$this->ClienteModel->selectAll();
    $data['usuarios']=$usuario->selectAll($id);
    $data['laboratorios']=$this->LaboratorioModel->selectAll($id);
    $data['posibles']=$this->LaboratorioModel->selectAll($id);
    $this->load->view('header',$data);
    $this->load->view('/Usuario/ListaResponsabilidadesCliente',$data);
    $this->load->view('footer');



}


 public function dependencias($id){
    $this->logueado();
    $data['head']="Dependencias";
    $data['laboratorios']=$this->LaboratorioModel->selectAll($id);
    $data['clientes']=$this->ClienteModel->selectAll();

    $this->load->view('header',$data);
    $this->load->view('/Laboratorio/ListaLaboratorio',$data);
    $this->load->view('footer');
  }


}
