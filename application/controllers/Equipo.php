
<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Equipo extends MY_Controller{

  function __construct()
  {
    parent::__construct();
    $this->load->model('UsuarioModel');
    $this->load->model('LaboratorioModel');
    $this->load->model('ResponsableModel');
    $this->load->model('ImagenModel');
    $this->load->model('EquipoModel');
    $this->load->model('DocumentoModel');
    $this->load->model('ClasificacionModel');
    $this->load->model('IncidenciaModel');
    $this->load->model('SolicitudModel');
    $this->load->model('ClienteModel');
    $this->load->model('PermisoModel');
    $this->load->model('AnalisisPreliminarModel');
    $this->load->model('VariableModel');
    $this->load->model('VariablexEquipoModel');
  }

  public function index(){
    $this->logueado();
    $this->permiso('Equipos');
    $data['head']="Equipos";
    //    $responsable = new ResponsableModel();
    //    $responsable->setIdUsuario($this->session->userdata("id"));
    //    if($responsable->selectOne() || in_array('Equipos Administrador',$this->session->userdata('permisos'))){
    $data['showlab'] =1;
    $data['showcustomer'] =0;

    if(in_array('Equipos Administrador',$this->session->userdata('permisos'))){
      $data['equipos']=$this->EquipoModel->selectAllAdmin();
      $data['showcustomer'] =1;
    }else{
      $data['equipos']=$this->EquipoModel->selectAll($this->session->userdata("id"));
    }
    $data['clientes']=$this->ClienteModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Equipo/ListaEquipos',$data);
    $this->load->view('footer');
    //    }else {
    //      $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
    //      redirect('Inicio/index');
    //    }
  }

  
  public function InformeEquipos($id){
  $this->logueado();
  $this->permiso('Descargas');
  
  if ($id==0){
    $data['InformeEquipos']=$this->EquipoModel->informeEquipototal();
    $this->load->view('Equipo/InformeEquipos',$data);
  }else{
    $data['InformeEquipos']=$this->EquipoModel->informeEquipo($id);
    $this->load->view('Equipo/InformeEquipo',$data);
  }
}

  public function detalletecnico($id){

    $this->logueado();
    $this->permiso('Detalle Tecnico');
    $data['incidente']=$id;
    $data['head']="Añadir informacion adicional";
    $this->load->view('header',$data);
    $this->load->view('/Equipo/DetalleTecnico',$data);
    $this->load->view('footer');

  }

  public function guardardetalletecnico($id){

    $this->logueado();
    $this->permiso('Detalle Tecnico');
    $incidencia = new AnalisisPreliminarModel();
    $today=getdate();
    $incidenciadata['idIncidencia'] = $id;
    $incidenciadata['fecha'] =  $today["year"] . "-" . $today["mon"]. "-" . $today["mday"];
    $incidenciadata['descripcion'] = $this->input->post('descripcion');
    $incidencia->setData($incidenciadata);
    $incidencia->insert($id);
    $this->session->set_flashdata('message', 'Informacion Adicionada con exito');
    redirect('Equipo/index');
  }





  public function reportarIncidencia(){
    $id = $this->input->post('id');
    $varfun = 3;
    $equipo = new EquipoModel();
    $equipo->setId($id);
    $equipos = $equipo->selectOne($this->session->userdata("id"));
    if($equipos[0]->getFuncional()== 1 ){
      if (count($equipos) == 1) {
        $incidencia = new IncidenciaModel();
        $incidenciadata['idEquipo'] = $this->input->post('id');
        $incidenciadata['fecha'] = $this->input->post('fecha');
        $incidenciadata['descripcion'] = $this->input->post('descripcion');
        $incidencia->setData($incidenciadata);
        $incidencia->insert($id);
        echo "Incidencia reportada";
        $equipo->reportarInciden($this->input->post('id'));
      }else {
        echo "el equipo no existe";
      }

    }else {
      echo "No se puede reportar incidencia";
    }
  }

  public function listaLaboratorio($id){
    $this->logueado();
    $this->permiso('Equipos');
    $responsable = new ResponsableModel();
    $responsable->setIdLaboratorio($id);

    $responsable->setIdUsuario($this->session->userdata("id"));
    if($responsable->selectOne() || in_array('Equipos Administrador',$this->session->userdata('permisos'))){
      $data['showlab'] =0;

      $data['showcustomer'] =0;
      $laboratorios = new LaboratorioModel();
      $laboratorios->setId($id);
      if(in_array('Equipos Administrador',$this->session->userdata('permisos'))){
        $laboratorio = $laboratorios->selectOneAdmin();

      }else{
        $laboratorio = $laboratorios->selectOne($this->session->userdata("id"));
      }

      $data['head']="Equipos " . $laboratorio[0]->getNombre();
      $data['equipos']=$this->EquipoModel->selectLab($id);
      $this->load->view('header',$data);
      $this->load->view('/Equipo/ListaEquipos',$data);
      $this->load->view('footer');
    }else {
      $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
      redirect('Inicio/index');
    }
  }

  public function imagenes(){
    $this->logueado();
    $this->permiso('Equipos');
    $id = $this->input->post('id');
    $equipo = new EquipoModel();
    $equipo->setId($id);
    if(in_array('Equipos Administrador',$this->session->userdata('permisos'))) {
      $equipos = $equipo->selectOneAdmin();
    }else{
      $equipos = $equipo->selectOne($this->session->userdata("id"));
    }

    $data['equipo'] = $equipos[0];
    $data['imagenes'] = $this->ImagenModel->selectAll($id);
    $data['solicitudes'] = $this->SolicitudModel->selectAll($id);
    $data['incidencias'] = $this->IncidenciaModel->selectAll($id);
    $data["documentos"] = $this->DocumentoModel->selectAll($id);
    $data["variables"] = $this->VariablexEquipoModel->selectOne($id);
    $ans = $this->load->view('/Equipo/imagenes',$data,TRUE);
    echo $ans;

    
  }

  public function detallesequipo($id){
    $this->logueado();
    $this->permiso('Equipos');
    $data['head']="Equipo";
    $equipo = new EquipoModel();
    $equipo->setId($id);
    if(in_array('Equipos Administrador',$this->session->userdata('permisos'))){
      $equipos = $equipo->selectOneAdmin();
    }else{
      $equipos = $equipo->selectOne($this->session->userdata("id"));
    }

    $data['equipo'] = $equipos[0];
    $data['imagenes'] = $this->ImagenModel->selectAll($id);
    $data['solicitudes'] = $this->SolicitudModel->selectAll($id);
    $data['incidencias'] = $this->IncidenciaModel->selectAll($id);
    $data["documentos"] = $this->DocumentoModel->selectAll($id);
    $data["variables"] = $this->VariablexEquipoModel->selectOne($id);
    $this->load->view('header',$data);
    $this->load->view('/Equipo/imagenes',$data);
    $this->load->view('footer');

  }



  public function agregarEquipo(){
    $this->logueado();
    $this->permiso('Equipos');
    $data['head']="Equipos";
    //  $responsable = new ResponsableModel();
    //  $responsable->setIdLaboratorio($id);
    //    $responsable->setIdUsuario($this->session->userdata("id"));
    //  if($responsable->selectOne()){
    $data["mod"] = 0;
    //$laboratorio = new LaboratorioModel();
    $data['clientes']=$this->ClienteModel->selectAll();
    $data["laboratorios"] =$this->LaboratorioModel->selectAll($this->session->userdata("id"));
    $data["clasificacion"] = $this->ClasificacionModel->selectAll($this->session->userdata("id"));
    $data["variables"] = $this->VariableModel->selectAll();
    $data["equipo"] =  new EquipoModel();
    $this->load->view('header',$data);
    $this->load->view('/Equipo/agregarEquipo',$data);
    $this->load->view('footer');
    //  }else {
    //    $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
    //    redirect('Inicio/index');
    //  }
  }

  public function guardarEquipo(){
    $this->logueado();
    $this->permiso('Equipos');
    $equipo = new EquipoModel();
    $variablexequipo = new VariablexEquipoModel();
    $infoequipo = $this->input->post();
    $clase = $this->ClasificacionModel->getbyNombre($infoequipo['nombre']);
    $variables = explode(",",$infoequipo["idVariable"]);
    $cantidades = explode(",",$infoequipo["cantidad"]);
    if($equipo->validate() and count($clase)!= 0){
      $infoequipo['idClasificacion'] = $clase[0]->getId();
      $equipo->setData($infoequipo);
      $id = $equipo->insert();
      $data['idEquipo'] = $id;
      if($cantidades[0] != ""){
        for ($r=0; $r < count($cantidades); $r++) {
          $data['idVariable'] = $variables[$r];
          $data['cantidad'] = $cantidades[$r];
          $variablexequipo->setData($data);
          $variablexequipo->insert();
        }
      }
      $config['upload_path']          = './uploads-old/imgs/equipos/';
      $config['allowed_types']        = '*';
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('imagenes')){
        $error =array('errorI' => $this->upload->display_errors());
        log_message('debug', json_encode($error));
      }
      else{
        $datos = $this->upload->data();
        $img['nombre']= $datos['file_name'];
        $img['idEquipo']= $id;
        $today=getdate();
        $img['fecha'] =  $today["year"] . "-" . $today["mon"]. "-" . $today["mday"];
        $img['tipo']= ' ';
        $imagen = new ImagenModel();
        $imagen->setData($img);
        $imagen->insert();
      }

      $config['allowed_types']     = '*';
      $config['upload_path']       = './uploads-old/docs/equipos/';
      $this->upload->initialize($config);
      $documentos = new DocumentoModel();
      if (!$this->upload->do_upload('archivos')){
        $error = array('errorF' => $this->upload->display_errors());
        log_message('debug', json_encode($error));
      }
      else{
        $datos = $this->upload->data();
        $doc['nombre']= $datos['file_name'];
        $doc['idEquipo']= $id;
        $today=getdate();
        $documentos->setData($doc);
        $documentos->insert();
      }

      $this->session->set_flashdata('message', 'Guardado con exito');
      redirect('Equipo/index');
    }else {
      $this->agregarEquipo();
    }

  }

  public function editarEquipo($id){
    $this->logueado();
    $this->permiso('Equipos');
    $data['head']="Equipos";
    $responsable = new ResponsableModel();
    $equipo = new EquipoModel();
    $equipo->setId($id);
    $cliente = $this->UsuarioModel->selectOne($this->session->userdata("id")) ;
    $equipos = $equipo->selectOne($this->session->userdata("id"));
    if(count($equipos) >= 1){
      $data["equipo"] = $equipos[0];
      $laboratorio = new LaboratorioModel();

      $data["laboratorios"] = $laboratorio->selectAll($this->session->userdata("id"));
      $data["clasificacion"] = $this->ClasificacionModel->selectAll($this->session->userdata("id"));
      $data["variables"] = $this->VariableModel->selectAll();
      $data["equipoVariables"] = $this->VariablexEquipoModel->selectOne($id);


      $data["mod"] = 1;
      $data["imganes"] = $this->ImagenModel->selectAll($id);
      $data["documentos"] = $this->DocumentoModel->selectAll($id);
      $this->load->view('header',$data);
      $this->load->view('/Equipo/agregarEquipo',$data);
      $this->load->view('footer');
    }else if ($cliente[0]->getIdCliente() == 2) {

      $data["equipo"] = $equipos[0];
      $laboratorio = new LaboratorioModel();

      $data["laboratorios"] = $laboratorio->selectAll($this->session->userdata("id"));
      $data["clasificacion"] = $this->ClasificacionModel->selectAll($this->session->userdata("id"));
      $data["variables"] = $this->VariableModel->selectAll();
      $data["equipoVariables"] = $this->VariablexEquipoModel->selectOne($id);


      $data["mod"] = 1;
      $data["imganes"] = $this->ImagenModel->selectAll($id);
      $data["documentos"] = $this->DocumentoModel->selectAll($id);
      $this->load->view('header',$data);
      $this->load->view('/Equipo/agregarEquipo',$data);
      $this->load->view('footer');


    
    }else {
      $this->session->set_flashdata('message', 'No tiene acceso a modificar esa información');
      redirect('Inicio/home');
    }
  }



  public function actualizarEquipo($id){
    $this->logueado();
    $this->permiso('Equipos');
    $infoequipo = $this->input->post();
    $equipo = new EquipoModel();
    $variablexequipo = new VariablexEquipoModel();
    $variables = explode(",",$infoequipo["idVariable"]);
    $cantidades = explode(",",$infoequipo["cantidad"]);
    $clase = $this->ClasificacionModel->getbyNombre($infoequipo['nombre']);
    if($equipo->validate() and count($clase)!= 0){
      $infoequipo['idClasificacion'] = $clase[0]->getId();
      $equipo->setId($id);
      $equipo->setData($infoequipo);
      $equipo->update();

      $data['idEquipo'] = $id;
      $variablexequipo->delete($id);
      if($cantidades[0] != ""){
        for ($r=0; $r < count($cantidades); $r++) {
          $data['idVariable'] = $variables[$r];
          $data['cantidad'] = $cantidades[$r];
          $variablexequipo->setData($data);
          $variablexequipo->insert();
        }
      }
      $config['upload_path']          = './uploads-old/imgs/equipos/';
      $config['allowed_types']        = '*';
      $this->load->library('upload', $config);
      $imagen = new ImagenModel();
      $imagen->setIdEquipo($id);
      $imagen->deleteArray(explode(",",$this->input->post('imgs')));
      if (!$this->upload->do_upload('imagenes')){
        $error =array('errorI' => $this->upload->display_errors());
	log_message('debug', json_encode($error));
      }
      else{
        $datos = $this->upload->data();
        $img['nombre']= $datos['file_name'];
        $img['idEquipo']= $id;
        $today=getdate();
        $img['fecha'] =  $today["year"] . "-" . $today["mon"]. "-" . $today["mday"];
        $img['tipo']= ' ';

        $imagen->setData($img);
        $imagen->insert();
      }

      $config['allowed_types']     = '*';
      $config['upload_path']       = './uploads-old/docs/equipos/';
      $this->upload->initialize($config);
      $documentos = new DocumentoModel();
      $documentos->setIdEquipo($id);
      $documentos->deleteArray(explode(",",$this->input->post('docs')));
      if (!$this->upload->do_upload('archivos')){
        $error = array('errorF' => $this->upload->display_errors());
        log_message('debug', json_encode($error));
      }
      else{
        $datos = $this->upload->data();
        $doc['nombre']= $datos['file_name'];
        $doc['idEquipo']= $id;
        $today=getdate();
        $documentos->setData($doc);
        $documentos->insert();
      }


      $this->session->set_flashdata('message', 'Editado con exito');
      redirect('Equipo/index');
    }else {
      $this->editarEquipo($id);
    }
  }



}
?>
