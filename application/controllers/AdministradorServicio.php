<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class AdministradorServicio extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('AdministradorServicioModel');


  }




  public function index(){
      $this->logueado();
      $this->permiso('AdministradorServicio');
      $data['head']="Administrador de Servicios";
      $data['AdministradorServicio']=$this->AdministradorServicioModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/AdministradorServicio/ListaAdminServicio',$data);
      $this->load->view('footer');
  }




  public function nuevo(){
      $this->logueado();
      $this->permiso('AdministradorServicio');
      $data['head']="Ingresar nuevo Servicio";
      $this->load->view('header',$data);
      $this->load->view('/AdministradorServicio/IngresarAdminServicio',$data);
      $this->load->view('footer');

  }

  public function editar($id){
      $this->logueado();
      $this->permiso('AdministradorServicio');
      $data['head']="Editar servicio";
      $data['editado']=$this->AdministradorServicioModel->selectOne($id);
      $data['AdministradorServicio']=$this->AdministradorServicioModel->selectAll();
        if(count($data['editado']) == 0){
          $this->session->set_flashdata('message', 'La varibale no existe');
          redirect('AdministradorServicio/index');
        }else{

          $this->load->view('header',$data);
          $this->load->view('/AdministradorServicio/EditarAdminServicio',$data);
          $this->load->view('footer');
        }
  }


  public function actualizar($id){
    $this->logueado();
    $this->permiso('AdministradorServicio');
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
            $edit=$this->AdministradorServicioModel->selectOne($id);
            unlink(base_url()."/uploads/firmas/".$edit[0]->getLogo());
                  $data2 = array('upload_data' => $this->upload->data());
          }

            $data['head']="Ingresar nuevo servicio ";
            $data['nombre']=$this->input->post('nombre');
            $data['variable']=$this->input->post('variable');
            $data['unidadMedida']=$this->input->post('unidadMedida');
            $data['estado']=$this->input->post('estado');
            $data['precioPiso']=$this->input->post('precioPiso');
            $data['precioPublico']=$this->input->post('precioPublico');


     	      $AdministradorServicio = new AdministradorServicioModel();
            $AdministradorServicio->setId($id);
            if($AdministradorServicio->validate(0)){
              $AdministradorServicio->setData($data);
              $AdministradorServicio->update();



              $this->session->set_flashdata('message', 'Servicio modificado Congrats!!');
              redirect('AdministradorServicio/index');
            }else{
              $data['head']="Editar servicio";
              $data['editado']=$this->AdministradorServicioModel->selectOne($id);

                  $this->load->view('header',$data);
                  $this->load->view('/AdministradorServicio/EditarAdminServicio',$data);
                  $this->load->view('footer');
            }
            $data['head']="Editar servicio";
  }

  public function guardar()
  {

      $this->logueado();
      $this->permiso('AdministradorServicio');

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
      $data['head']="Ingresar un servicio";
      $data['nombre']=$this->input->post('nombre');
      $data['variable']=$this->input->post('variable');
      $data['unidadMedida']=$this->input->post('unidadMedida');
      $data['estado']=1;
      $data['precioPiso']=$this->input->post('precioPiso');
      $data['precioPublico']=$this->input->post('precioPublico');


      $AdministradorServicio = new AdministradorServicioModel();
      if($AdministradorServicio->validate(1) ){
        $AdministradorServicio->setData($data);
        $AdministradorServicio->insert();


        $this->session->set_flashdata('message', 'Servicio Agregado Congrats!!');
        redirect('AdministradorServicio/index');
      }else{

        $this->load->view('header',$data);
        $this->load->view('/AdministradorServicio/IngresarAdminServicio',$data);
        $this->load->view('footer');
      }


  }

public function historial(){
    $this->logueado();
    $id=$this->input->post('id');
    $movs=$this->AdministradorServicioModel->selectOne($id);
    $ans= "       <table class='bordered highlight'>
                  <thead>
                  <tr>
                  <th>Precio Piso</th>
                  <th>Precio Publico</th>";
    foreach ($movs as $mov) {

      $ans = $ans . "<tr>" .
      "<td>". $mov->getPrecioPiso()."</td>" .
      "<td>". $mov->getPrecioPublico() ."</td>" .


      "</tr>";
    }
    echo $ans . "</table>";

  }



}
