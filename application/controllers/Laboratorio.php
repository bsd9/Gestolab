
<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Laboratorio extends MY_Controller{

  function __construct()
  {
    parent::__construct();
  $this->load->model('UsuarioModel');
  $this->load->model('LaboratorioModel');
  $this->load->model('ResponsableModel');
  $this->load->model('ImagenModel');
  $this->load->model('EquipoModel');
  $this->load->model('ClasificacionModel');
    $this->load->model('ClienteModel');
    $this->load->model('PermisoModel');
  }

 public function index(){
    $this->logueado();
    $data['head']="Dependencias";
    $data['laboratorios']=$this->LaboratorioModel->selectAll($this->session->userdata("id"));
    $data['clientes']=$this->ClienteModel->selectAll();
 
    $this->load->view('header',$data);
    $this->load->view('/Laboratorio/ListaLaboratorio',$data);
    $this->load->view('footer');
  }

  public function nuevo(){
    $this->logueado();

    $data['head']="Dependencias";
  //  $responsable = new ResponsableModel();
  //  $responsable->setIdLaboratorio($id);
//    $responsable->setIdUsuario($this->session->userdata("id"));
  //  if($responsable->selectOne()){
        $data["mod"] = 0;
    $data['clientes']=$this->ClienteModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Laboratorio/nuevoLaboratorio',$data);
      $this->load->view('footer');
  //  }else {
  //    $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
  //    redirect('Inicio/index');
  //  }
  }

  public function guardar(){
    $this->logueado();
    $infoequipo = $this->input->post();
    $equipo = new LaboratorioModel();
    if($equipo->validate()){
      $equipo->setData($infoequipo);
      $equipo->setIdCliente($this->session->userdata("idCliente"));
      $id = $equipo->insert();
      $responsable = new ResponsableModel();
      $responsable->setIdLaboratorio($id);
      $responsable->setIdUsuario($this->session->userdata("id"));
      $responsable->insert();

      $responsable->setIdUsuario(2);
      $responsable->insert();


      $this->session->set_flashdata('message', 'Guardado con exito');
      redirect('Laboratorio/index');
    }else {
      $this->agregar();
    }

  }

  public function editar($id){
    $this->logueado();
    $data['head']="Laboratorio";
    $laboratorio = new LaboratorioModel();
    $laboratorio->setId($id);
    $laboratorios = $laboratorio->selectOne($this->session->userdata("id"));
    if(count($laboratorios) == 1){
      $data["mod"] = 1;
      $data["laboratorio"] = $laboratorios[0];
      $data['clientes']=$this->ClienteModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Laboratorio/nuevoLaboratorio',$data);
      $this->load->view('footer');
    }else {
      $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
      redirect('Inicio/home');
    }
  }

  public function actualizar($id){
    $this->logueado();
    $infoequipo = $this->input->post();
    $equipo = new LaboratorioModel();
    if($equipo->validate()){
      $equipo->setId($id);
      $equipo->setData($infoequipo);
      $equipo->update();
      $this->session->set_flashdata('message', 'Editado con exito');
      redirect('Laboratorio/index');
    }else {
      $this->editar($id);
    }
  }
}
?>
