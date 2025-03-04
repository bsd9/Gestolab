<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Clasificacion extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('ClasificacionModel');
    $this->load->model('UsuarioModel');
    
  }




  public function index(){
      $this->logueado();
      $this->permiso('Clientes');
      $data['head']="Clasificacion Equipos";
      $data['clasificacion']=$this->ClasificacionModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Clasificacion/ListaClasificacion',$data);
      $this->load->view('footer');
  }





  public function nuevo(){
      $this->logueado();
      $this->permiso('Clientes');
      $data['head']="Ingresar una nueva clasificacion ";
      $this->load->view('header',$data);
      $this->load->view('/Clasificacion/IngresarClasificacion',$data);
      $this->load->view('footer');

  }

  public function editar($id){
      $this->logueado();
      $this->permiso('Clientes');
      $data['head']="Editar informacion de una clasificacion";
      $data['editado']=$this->ClasificacionModel->selectOne($id);
        if(count($data['editado']) == 0){
          $this->session->set_flashdata('message', 'La clasificacion no existe');
          redirect('Clasificacion/index');
        }else{

          $this->load->view('header',$data);
          $this->load->view('/Clasificacion/EditarClasificacion',$data);
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


            $data['head']="Editar informacion de una clasificacion";
            
            $data['id']=$id;
            $data['logo']=0;
            if($subir){
              $data['logo']=$this->upload->data('file_name');
            }
            $data['head']="Ingresar una nueva clasificacion";
            $data['nombre']=$this->input->post('nombre');
            $data['familia']=$this->input->post('familia');


     	    $clasificacion = new ClasificacionModel();
            $clasificacion->setId($id);
            if($clasificacion->validate(0)){
              $clasificacion->setData($data);
              $clasificacion->update();
              $id  =  $clasificacion->getId();


              $this->session->set_flashdata('message', 'Clasificacion modificada Congrats!!');
              redirect('Clasificacion/index');
            }else{
              $data['head']="Editar informacion de una clasificacion";
              $data['editado']=$this->ClasificacionModel->selectOne($id);

                  $this->load->view('header',$data);
                  $this->load->view('/Clasificacion/EditarClasificacion',$data);
                  $this->load->view('footer');
            }
            $data['head']="Editar informacion de una clasificacion";
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
      $data['head']="Ingresar un nuevo clasificacion ";
      $data['nombre']=$this->input->post('nombre');
      $data['familia']=$this->input->post('familia');


      $clasificacion = new ClasificacionModel();
      if($clasificacion->validate(1) ){
        $clasificacion->setData($data);
        $id = $clasificacion->insert();


        $this->session->set_flashdata('message', 'Clasificacion Agregada Congrats!!');
        redirect('Clasificacion/index');
      }else{

        $this->load->view('header',$data);
        $this->load->view('/Clasificacion/IngresarClasificacion',$data);
        $this->load->view('footer');
      }


  }



}
