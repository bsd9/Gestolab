<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Variable extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('VariableModel');
   

  }




  public function index(){
      $this->logueado();
      $this->permiso('Variable');
      $data['head']="Magnitud";
      $data['variable']=$this->VariableModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Variable/ListaVariable',$data);
      $this->load->view('footer');
  }




  public function nuevo(){
      $this->logueado();
      $this->permiso('Variable');
      $data['head']="Ingresar nueva magnitud";
      $this->load->view('header',$data);
      $this->load->view('/Variable/IngresarVariable',$data);
      $this->load->view('footer');

  }

  public function editar($id){
      $this->logueado();
      $this->permiso('Variable');
      $data['head']="Editar magnitud";
      $data['editado']=$this->VariableModel->selectOne($id);
        if(count($data['editado']) == 0){
          $this->session->set_flashdata('message', 'La Magnitud no existe');
          redirect('Variable/index');
        }else{

          $this->load->view('header',$data);
          $this->load->view('/Variable/EditarVariable',$data);
          $this->load->view('footer');
        }
  }


  public function actualizar($id){
    $this->logueado();
    $this->permiso('Variable');
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
            $edit=$this->VariableModel->selectOne($id);
            unlink(base_url()."/uploads/firmas/".$edit[0]->getLogo());
                  $data2 = array('upload_data' => $this->upload->data());
          }

            $data['head']="Ingresar nueva magnitud ";
            $data['titulo']=$this->input->post('titulo');
            $data['precioPiso']=$this->input->post('precioPiso');
            $data['precioPublico']=$this->input->post('precioPublico');


     	      $variable = new VariableModel();
            $variable->setId($id);
            if($variable->validate(0)){
              $variable->setData($data);
              $variable->update();
              


              $this->session->set_flashdata('message', 'Magnitud modificada Congrats!!');
              redirect('Variable/index');
            }else{
              $data['head']="Editar magnitud";
              $data['editado']=$this->VariableModel->selectOne($id);

                  $this->load->view('header',$data);
                  $this->load->view('/Variable/EditarVariable',$data);
                  $this->load->view('footer');
            }
            $data['head']="Editar Variable";
  }

  public function guardar()
  {

      $this->logueado();
      $this->permiso('Variable');

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
      $data['head']="Ingresar un Magnitud";
      $data['titulo']=$this->input->post('titulo');
      $data['precioPiso']=$this->input->post('precioPiso');
      $data['precioPublico']=$this->input->post('precioPublico');


      $variable = new VariableModel();
      if($variable->validate(1) ){
        $variable->setData($data);
        $variable->insert();


        $this->session->set_flashdata('message', 'Magnitud Agregada Congrats!!');
        redirect('Variable/index');
      }else{

        $this->load->view('header',$data);
        $this->load->view('/Variable/IngresarVariable',$data);
        $this->load->view('footer');
      }


  }

   public function historial(){
    $this->logueado();
      $id=$this->input->post('id');
    $movs=$this->VariableModel->selectOne($id);
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
