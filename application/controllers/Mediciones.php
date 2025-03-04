<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Mediciones extends MY_Controller {

  function __construct()
  {
    parent::__construct();


  $this->load->model('PruebaModel');
  $this->load->model('MedidaModel');
  $this->load->model('PatronModel');
  $this->load->model('RepeticionModel');
  $this->load->model('MagnitudModel');
  $this->load->model('VariableModel');
  $this->load->model('PermisoModel');
  }

//pruebas!
  public function listaPruebas(){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Lista de Pruebas";
    $data['pruebas']=$this->PruebaModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Pruebas/listaPruebas',$data);
    $this->load->view('footer');
  }


  public function nuevaPrueba(){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Ingresar una nueva prueba";

    $data['magnitudes']=$this->MagnitudModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Pruebas/IngresarPrueba',$data);
    $this->load->view('footer');

  }


  public function editarPrueba($id){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Editar informacion de una prueba";
    $data['magnitudes']=$this->MagnitudModel->selectAll();
    $data['editado']=$this->PruebaModel->selectOne($id);
    $data['repeticiones']=$this->RepeticionModel->selectOne($id);
    $data['variables']=$this->VariableModel->selectOne($id);

    $this->load->view('header',$data);
    $this->load->view('/Pruebas/editarPrueba',$data);
    $this->load->view('footer');

  }

  public function actualizarPrueba($id){
      $this->logueado();
      $this->permiso('Servicios');
      $data['nombre']=$this->input->post('nombre');
      $data['idMagnitud']=$this->input->post('idMagnitud');
      $data['id']=$id;
      $indices = $this->input->post('indices');
      $titulos = $this->input->post('titulo');
      $Prueba = new PruebaModel();
      if($Prueba->validate()){
          $Prueba->setData($data);
          $Prueba->update();

          $repeticion = new RepeticionModel();
          $repeticion->delete($id);
        foreach ($indices as $indice) {
          $subdata['indice'] = $indice;
          $subdata['idPrueba'] = $id;
          $repeticion->setData($subdata);
          $repeticion->insert();
        }

        $repeticion = new VariableModel();
        $repeticion->delete($id);
      foreach ($titulos as $indice) {
        $subdata['titulo'] = $indice;
        $subdata['idPrueba'] = $id;
        $repeticion->setData($subdata);
        $repeticion->insert();
      }
          $this->session->set_flashdata('message', 'Prueba editada Congrats!!');
          redirect('Mediciones/listaPruebas/');
      }else{
        $this->editarPrueba($id);
      }

  }

  public function guardarPrueba()
    {
        $this->logueado();
        $this->permiso('Servicios');
      $data['nombre']=$this->input->post('nombre');
      $Prueba = new PruebaModel();
      $indices = $this->input->post('indices');
      $titulos = $this->input->post('titulo');
      $data['idMagnitud']=$this->input->post('idMagnitud');
      if($Prueba->validate()){
          $Prueba->setData($data);
         $id = $Prueba->insert();
         $repeticion = new RepeticionModel();
       foreach ($indices as $indice) {
         $subdata['indice'] = $indice;
         $subdata['idPrueba'] = $id;
         $repeticion->setData($subdata);
         $repeticion->insert();
       }

       $repeticion = new VariableModel();
     foreach ($titulos as $indice) {
       $subdata['titulo'] = $indice;
       $subdata['idPrueba'] = $id;
       $repeticion->setData($subdata);
       $repeticion->insert();
     }
          $this->session->set_flashdata('message', 'Prueba Agregada Congrats!!');
          redirect('Mediciones/listaPruebas/');
      }else{
        $this->nuevaPrueba();
     }


    }

//magnitudes
  public function index(){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Lista de Magnitudes";
    $data['magnitudes']=$this->MagnitudModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Magnitudes/ListaMagnitud',$data);
    $this->load->view('footer');
  }

  public function nuevaMagnitud(){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Ingresar una nueva magnitud";
    $data['magnitud']=$this->MagnitudModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Magnitudes/IngresarMagnitud',$data);
    $this->load->view('footer');

  }


  public function editarMagnitud($id){
    $this->logueado();
    $this->permiso('Servicios');
    $data['head']="Editar informacion de una magnitud";
    $data['editado']=$this->MagnitudModel->selectOne($id);
    $this->load->view('header',$data);
    $this->load->view('/Magnitudes/editarMagnitud',$data);
    $this->load->view('footer');

}


  public function actualizarMagnitud($id){
      $this->logueado();
      $this->permiso('Servicios');
      if($this->input->post('activo')==null){
        $data['activo']=0;
      }else{
        $data['activo']=1;
      }
      $data['nombre']=$this->input->post('nombre');
      $data['id']=$id;
      $Prueba = new MagnitudModel();
      if($Prueba->validate()){
          $Prueba->setData($data);
          $Prueba->update();
          $this->session->set_flashdata('message', 'Magnitud editada Congrats!!');
          redirect('Mediciones/index/');
      }else{
        $this->editarPrueba($id);
      }

  }

  public function guardarMagnitud()
    {
        $this->logueado();
        $this->permiso('Servicios');
      $data['nombre']=$this->input->post('nombre');
      $Prueba = new MagnitudModel();
      $indices = $this->input->post('indices');
      if($Prueba->validate()){
          $Prueba->setData($data);
         $id = $Prueba->insert();
          $this->session->set_flashdata('message', 'Magnitud Agregada Congrats!!');
          redirect('Mediciones/index/');
      }else{
        $this->nuevaPrueba();
     }


    }

    //agregar Medidas a un servicio para el informe

    //agregar patrones para los informes
    public function listaPatrones(){
      $this->logueado();
      $this->permiso('Servicios');
      $data['head']="Lista de patrones";
      $data['patrones']=$this->PatronModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Patrones/ListaPatrones',$data);
      $this->load->view('footer');
    }

    public function nuevoPatron(){
      $this->logueado();
      $this->permiso('Servicios');
      $data['head']="Ingresar un nuevo patron";

      $data['magnitudes']=$this->MagnitudModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Patrones/IngresarPatron',$data);
      $this->load->view('footer');

    }

    public function editarPatron($id){
      $this->logueado();
      $this->permiso('Servicios');
      $data['head']="Editar informacion de un patron";
      $data['editado']=$this->PatronModel->selectOne($id);
      $data['magnitudes']=$this->MagnitudModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Patrones/EditarPatron',$data);
      $this->load->view('footer');

  }

  public function guardarPatron(){
      $this->logueado();
      $this->permiso('Servicios');
      $data=$this->input->post();
      $cargo = new PatronModel();
      if($cargo->validate()){
          $cargo->setData($data);
          $cargo->insert();

          $this->session->set_flashdata('message', 'Patron editado Congrats!!');
          redirect('Mediciones/listaPatrones/');
      }else{
        $this->nuevoPatron();
      }

  }

    public function actualizarPatron($id){
        $this->logueado();
        $this->permiso('Servicios');
        $data=$this->input->post();
        if($this->input->post('estado')==null){
          $data['activo']=0;
        }else{
          $data['activo']=1;
        }
        $data['id']=$id;
        $cargo = new PatronModel();
        if($cargo->validate()){
            $cargo->setData($data);
            $cargo->update();

            $this->session->set_flashdata('message', 'Patron editado Congrats!!');
            redirect('Mediciones/listaPatrones/');
        }else{
          $this->editarPatron($id);
        }

    }

}
