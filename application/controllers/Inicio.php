<?php

ini_set('max_execution_time', 0);
ini_set('memory_limit','2048M');
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('UsuarioModel');
    $this->load->model('LaboratorioModel');
    $this->load->model('ClienteModel');
    $this->load->model('ConfiguracionModel');
    $this->load->model('EquipoModel');

  }


  public function cambiarContrasena(){
    $this->logueado();
    $data['clientes']=$this->ClienteModel->selectAll();
    $data["head"]="Cambiar Contraseña";
    $this->load->vars($data);
    $this->load->view('header', $data);
    $this->load->view('Utileria/CambiarPassword');
    $this->load->view('footer');
  }

  public function guardarContrasena(){
    $this->logueado();
    $oldpass = $this->input->post('contrasena');
    $password = $this->input->post('newcontrasena');
    $reppass = $this->input->post('newrepcontrasena');
if($pass === $reppass){
    if($this->UsuarioModel->UpdateContrasena($this->session->userdata('id'),$oldpass,$password)){
      $this->session->set_flashdata('message', 'Contraseña editada con exito');
      redirect('Inicio/cambiarContrasena');
    }
    }else{
      $this->session->set_flashdata('message', 'porfavor repetir la nueva contraseña');
      redirect('Inicio/index');
    }
      //revisar que si sea la contra corrrecta y actualizar
  }


      public function index()
      {
          if(!$this->session->has_userdata('id')){
          $data['head'] = '';
            $data['clientes']=$this->ClienteModel->selectAll();
          $this->load->vars($data);
          $this->load->view('header', $data);
          $this->load->view('Utileria/login');
          $this->load->view('footer');
        }else{
          redirect('Inicio/Home');
        }
      }


      public function configuracionFormatos()
      {
          $this->logueado();
          $this->permiso('Configuracion');
          $data["head"] = "Configuracion";
          $data['config'] = $this->ConfiguracionModel->selectOne(1);
          $this->load->vars($data);
          $this->load->view('header', $data);
          $this->load->view('Utileria/ConfiguracionFormatos');
          $this->load->view('footer');
      }

      public function editarConfiguracionFormatos()
      {
          $this->logueado();
          $this->permiso('Configuracion');
          $config = new ConfiguracionModel();
          $config->setData($this->input->post());
          $config->updateFormatos();
          $this->session->set_flashdata('message', 'Informacion Actualizada');
          redirect('Inicio/home');
      }


public function home(){

  if($this->session->has_userdata('id')){
  $data['head'] = '';
  $data['clientes']=$this->ClienteModel->selectAll();
  $data["laboratorios"] = $this->LaboratorioModel->selectAll($this->session->userdata('id'));
  $data["conteo"] = $this->EquipoModel->selectCountIncidencia();
  if($this->session->userdata('idCliente')!=2){
  $this->load->view('header', $data);
  $this->load->view('Utileria/Home', $data);
  $this->load->view('footer');
  }else {
    $this->load->view('header', $data);
    $this->load->view('Utileria/HomeAdmin', $data);
    $this->load->view('footer');

  }

}else{
  $this->session->set_flashdata('message', 'Logueate para acceder');
  redirect('Inicio/index');
}
}

public function ModificarContrasena($token){
  if($this->UsuarioModel->existToken($token)){
    $data['head'] = 'Cambia tu Contraseña';
    $data['clientes']=$this->ClienteModel->selectAll();
    $data['token'] = $token;
    $this->load->vars($data);
    $this->load->view('header', $data);
    $this->load->view('Utileria/Cambiar');
    $this->load->view('footer');
  }else {
    $this->session->set_flashdata('message', 'Error');
    redirect('Inicio/index');
  }
}

public function UpdatePassword($token){
  if($this->UsuarioModel->existToken($token)){
    $contrasena=$this->input->post('contrasena');
    $newcontrasena=$this->input->post('newcontrasena');
    if($contrasena === $newcontrasena){
      $this->UsuarioModel->UpdatePassword($token,$contrasena);
      $this->session->set_flashdata('message', 'Contraseña actualizada');
      $this->UsuarioModel->destroyToken($token);
      redirect('Inicio/index');
    }else {
      $this->session->set_flashdata('message', 'ambas contraseñas son diferentes');
      redirect('Inicio/ModificarContrasena/'. $token);
    }
    }

  }

public function RememberPassword(){
  $data['head'] = 'Solicitar Contraseña';
  $data['clientes']=$this->ClienteModel->selectAll();
  $this->load->vars($data);
  $this->load->view('header', $data);
  $this->load->view('Utileria/PedirCambio');
  $this->load->view('footer');
}

public function PedirPassword(){
$correo=$this->input->post('correo');
$users = $this->UsuarioModel->selectCorreo($correo);
if(count($users)!= 1){
  $this->session->set_flashdata('message', 'EL correo electronico no esta asignado a ninguna cuenta');
}else{
  $token = $this->UsuarioModel->ponerToken($correo);
  date_default_timezone_set("UTC");
  //usar la funcion de mail de codeigniter
  $urlaccess =  site_url('Inicio/ModificarContrasena') ."/". $token;
  $config['protocol'] = 'smtp';
  $config['smtp_host'] = 'ssl://smtp.gmail.com';
  $config['smtp_port'] = '465';
  $config['smtp_user'] = 'ascavigroupmail@gmail.com';
  $config['smtp_pass'] = '1763-9ascavi';
  $config['charset'] = "utf-8";
  $config['mailtype'] = "html";
  $config['validation'] = TRUE;
  $config['newline'] = "\r\n";
  $this->load->library('email', $config);
$this->email->from('ascavigroupmail@gmail.com', 'No Reply');
$this->email->to($correo);
$this->email->subject('Recuperacion de contraseña');
$this->email->message("acceda a la siguiente ruta para cambiar su contraseña del SIAL:\n ". $urlaccess .
"\nSi usted no a solicitado un cambio en su contraseña del SID porfavor hacer caso omiso a este mensaje" .
"\nPorfavor no responda a este correo, si desea enviar información comuniquese con el area tecnica");

  if($this->email->send()){
    $this->session->set_flashdata('message', 'Revisa la bandeja de entrada del correo que asignaste a la cuenta');
  }else{
    $this->session->set_flashdata('message', 'Error en el correo de la cuenta');
  }
}
  redirect('Inicio/index');
}

public function EditarPerfil(){
  if($this->session->has_userdata('id')){
    redirect("Usuario/editar/".$this->session->userdata('id'));
  }else{
    $this->session->set_flashdata('message', 'Logueate para acceder');
    redirect('Inicio/index');
  }
}

      public function login()
      {
          //el has antes del user data es lo mismo que pponer isset($this->session->userdata('id')), es para saber si la variable si existe o si esta seteada
        if(!$this->session->has_userdata('id')){
          $userdata['usuario']=$this->input->post('usuario');
          $userdata['password']=$this->input->post('password');
          $user= new UsuarioModel();
          if($user->validatelogin()){
            $user->setUsuario($userdata['usuario']);
            $user->setPassword($userdata['password']);
          if($user->loguearse()){
            //vista de cuando el login se hace correctamente
            redirect("Inicio/home");
            }else{
              //vista de cuando los datos de login son incorrectos
            $this->session->set_flashdata('message', 'Usuario y contraseña invalidos');
            redirect('Inicio/index');
          }
        }else{
          $this->session->set_flashdata('message', 'Usuario y contraseña vacios');
          redirect('Inicio/index');
            //vista de cuando falta un campo en el login
          }
        }else{
          redirect("Inicio/home");
          //vista de cuando ya esta logueado el usuario
        }
      }

      public function logout(){
    $this->session->sess_destroy();
    redirect('Inicio/index');
  //  redirect para que si se actualizen las variables de sesion a la vista del login por ejemplo o si quieren mostrar una vista distinta
  }


}
