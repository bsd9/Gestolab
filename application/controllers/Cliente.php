<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('ClienteModel');
    $this->load->model('UsuarioModel');
    $this->load->model('PaisModel');
    $this->load->model('DepartamentoModel');
    $this->load->model('CiudadModel');

  }




  public function index(){
      $this->logueado();
      $this->permiso('Clientes');
      $data['head']="Lista de clientes";
      $data['clientes']=$this->ClienteModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Cliente/ListaCliente',$data);
      $this->load->view('footer');
  }



    public function users($id){
      $this->logueado();
      $this->permiso('Clientes');
      $data['head']="Usuarios";
      $data['clientes']=$this->ClienteModel->selectALL();
      $data['usuarios']=$this->UsuarioModel->selectUser($id);
      $data['clienteId']=$id;
      $this->load->view('header',$data);
      $this->load->view('/Usuario/ListarUsuariocliente',$data);
      $this->load->view('footer');
    }



  public function nuevo(){
      $this->logueado();
      $this->permiso('Clientes');
      $data['head']="Ingresar un nuevo cliente";
      $data['ciudades']=$this->CiudadModel->selectAll();
      $data['departamentos']=$this->DepartamentoModel->SelectAll();
      $data['paises']=$this->PaisModel->SelectAll();
      $this->load->view('header',$data);
      $this->load->view('/Cliente/IngresarCliente',$data);
      $this->load->view('footer');

  }

  public function editar($id){
      $this->logueado();
      $this->permiso('Clientes');
      $data['head']="Editar informacion de un cliente";
      $data['editado']=$this->ClienteModel->selectOne($id);
      $data['ciudades']=$this->CiudadModel->selectAll();
      $data['departamentos']=$this->DepartamentoModel->SelectAll();
      $data['paises']=$this->PaisModel->SelectAll();


        if(count($data['editado']) == 0){
          $this->session->set_flashdata('message', 'El cliente no existe');
          redirect('Cliente/index');
        }else{

          $this->load->view('header',$data);
          $this->load->view('/Cliente/EditarCliente',$data);
          $this->load->view('footer');
        }
  }


  public function actualizar($id){
    $this->logueado();
    $this->permiso('Clientes');
        $config['upload_path']          = './uploads/logo/';
        $config['allowed_types']        = 'gif|jpg|png';
          $config['max_size']             = 100;
          $config['max_width']            = 1024;
          $config['max_height']           = 768;
          $config['encrypt_name']         = true;
      //  $config['file_name']         = $this->input->post('cedula');
          $this->load->library('upload', $config);
          $subir=1;
          if ( ! $this->upload->do_upload('logo'))
          {
                  $error = array('error' => $this->upload->display_errors());
                                $subir=0;
          }
          else {
            $edit=$this->ClienteModel->selectOne($id);
            unlink(base_url()."/uploads/firmas/".$edit[0]->getLogo());
                  $data2 = array('upload_data' => $this->upload->data());
          }


            $data['head']="Editar informacion de un cliente";
            if($this->input->post('Activo')==null){
            $data['estado']=0;
          }else{
            $data['estado']=1;
          }
            $data['id']=$id;
            $data['logo']=0;
            if($subir){
              $data['logo']=$this->upload->data('file_name');
            }
            $data['head']="Ingresar un nuevo cliente ";
            $data['razonSocial']=$this->input->post('razonSocial');
            $data['NIT']=$this->input->post('NIT');
            $data['telefono']=$this->input->post('telefono');
            $data['direccion']=$this->input->post('direccion');
            $data['ciudad']=$this->input->post('ciudad');
            $data['departamento']=$this->input->post('departamento');
            $data['pais']=$this->input->post('pais');


     	    $cliente = new ClienteModel();
            $cliente->setId($id);
            if($cliente->validate(0)){
              $cliente->setData($data);
              $cliente->update();
              $idcliente=$cliente->getId();


              $this->session->set_flashdata('message', 'Cliente modificado Congrats!!');
              redirect('Cliente/index');
            }else{
              $data['head']="Editar informacion de un cliente";
              $data['editado']=$this->ClienteModel->selectOne($id);
              $data['ciudades']=$this->CiudadModel->selectAll();
              $data['departamentos']=$this->DepartamentoModel->SelectAll();
              $data['paises']=$this->PaisModel->SelectAll();

                  $this->load->view('header',$data);
                  $this->load->view('/Cliente/EditarCliente',$data);
                  $this->load->view('footer');
            }
            $data['head']="Editar informacion de un cliente";
  }

  public function guardar()
  {

      $this->logueado();
      $this->permiso('Clientes');

      $config['upload_path']          = './uploads/logo/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['max_size']             = 100;
      $config['max_width']            = 1024;
      $config['max_height']           = 768;
      $config['encrypt_name']         = true;

      $this->load->library('upload', $config);
          $subir=1;
      if ( ! $this->upload->do_upload('logo'))
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
        $data['logo']=$this->upload->data('file_name');
      }
      $data['head']="Ingresar un nuevo cliente ";
      $data['razonSocial']=$this->input->post('razonSocial');
      $data['NIT']=$this->input->post('NIT');
      $data['telefono']=$this->input->post('telefono');
      $data['direccion']=$this->input->post('direccion');
      $data['ciudad']=$this->input->post('ciudad');
      $data['departamento']=$this->input->post('departamento');
      $data['pais']=$this->input->post('pais');

      //var_dump($data);

      $cliente = new ClienteModel();
      if($cliente->validate(1) ){
        $cliente->setData($data);
        $idcliente = $cliente->insert();


        $this->session->set_flashdata('message', 'Cliente Agregado Congrats!!');
        redirect('Cliente/index');
      }else{

        $data['ciudades']=$this->CiudadModel->selectAll();
        $data['departamentos']=$this->DepartamentoModel->SelectAll();
        $data['paises']=$this->PaisModel->SelectAll();
        $this->load->view('header',$data);
        $this->load->view('/Cliente/IngresarCliente',$data);
        $this->load->view('footer');
      }


  }



}
