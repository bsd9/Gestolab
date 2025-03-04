<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor extends MY_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('ProveedorModel');
    $this->load->model('DireccionProveedorModel');
    $this->load->model('ContactosProveedorModel');
    $this->load->model('PaisModel');
    $this->load->model('DepartamentoModel');
    $this->load->model('CiudadModel');
    $this->load->model('TelefonoModel');
    $this->load->model('NombreComercialProveedorModel');
    $this->load->model('ModificaProveedorModel');
    $this->load->model('EmpleadoModel');
  }


    public function detalles(){
      $this->logueado();
      $this->permiso('Proveedores');
        $id=$this->input->post('id');
          $data['head']="Informacion Extra:";
          $data['visible'] = 0;
          $data['proveedor'] =$this->ProveedorModel->selectOne($id);
          $data['proveedor'] = $data['proveedor'][0];
          $data['ultimoModificador'] =$this->ModificaProveedorModel->selectProveedorMod($id);

      $ans= $this->load->view('Proveedor/VistaProveedor',$data, TRUE);
      echo $ans;
    }

    public function ProveedorDetallado($id){
        $data['head']="Informacion Extra:";
        $data['proveedor'] =$this->ProveedorModel->selectOne($id);
        $data['proveedor'] = $data['proveedor'][0];
        $data['ultimoModificador'] =$this->ModificaProveedorModel->selectProveedorMod($id);
        $data['visible'] = 1;
        $this->load->view('header',$data);
        $this->load->view('/Proveedor/VistaProveedor',$data);
        $this->load->view('footer');
    }


  public function index(){
      $this->logueado();
      $this->permiso('Proveedores');
      $data['head']="Lista de proveedores";
      $data['proveedores']=$this->ProveedorModel->selectAll();
      $this->load->view('header',$data);
      $this->load->view('/Proveedor/ListaProveedor',$data);
      $this->load->view('footer');

  }

  public function direcciones(){
    $this->logueado();
    $this->permiso('Proveedores');
    $id=$this->input->post('id');
    $contacts=$this->DireccionProveedorModel->selectOne($id);
    if(count($contacts)==0){
      echo "no hay una direccion registrada";
    }else{
      $ans=
      "<table class='highlight bordered' border='1' cellpadding='3' >
      <thead>
      <tr>
      <th>direccion</th>
      <th>ciudad</th>
      <th>departamento</th>
      <th>pais</th>
      <th>nacional</th>
      </tr></thead>
      ";
      foreach($contacts as $contact){
        $ans=$ans."<tr><td>". $contact->direccion ."</td>";
        $ans=$ans."<td>". $contact->ciudad ."</td>";
        $ans=$ans."<td>". $contact->departamento ."</td>";
        $ans=$ans."<td>". $contact->pais ."</td>";
        if($contact->region){
          $ans=$ans."<td>Nacional</td>";
        }else{
          $ans=$ans."<td>Internacional</td>";
        }
      }
      $ans=$ans. "</table>";
      echo $ans;
    }

  }

  public function contactos(){
    $this->logueado();
    $this->permiso('Proveedores');
    $id=$this->input->post('id');
    $contacts=$this->ContactosProveedorModel->selectOne($id);
    if(count($contacts)==0){
      echo "no hay contacto asociado";
    }else{
      $ans=
      "<table class='highlight bordered' border='1' cellpadding='3' >
      <thead><tr>
      <th>nombre</th>
      <th>apellido</th>
      <th>cargo</th>
      <th>telefono</th>
      <th>ext</th>
      <th>celular</th>
      <th>email</th>
      <th>email2</th>
      </tr></thead>
      ";
      foreach($contacts as $contact){
        $ans=$ans."<tr><td>". $contact->getNombre() ."</td>";
        $ans=$ans."<td>". $contact->getApellido() ."</td>";
        $ans=$ans."<td>". $contact->getCargo() ."</td>";
        $ans=$ans."<td>". $contact->getTelefono() ."</td>";
        $ans=$ans."<td>". $contact->getExt() ."</td>";
        $ans=$ans."<td>". $contact->getCelular() ."</td>";
        $ans=$ans."<td>". $contact->getEmail() ."</td>";
        $ans=$ans."<td>". $contact->getEmail2() ."</td></tr>";
      }
      $ans=$ans. "</table>";
      echo $ans;
    }
  }

  public function nuevo(){
      $this->logueado();
      $this->permiso('Proveedores');
      $data['head']="Ingresar un nuevo proveedor";
      $data['ciudades']=$this->CiudadModel->selectAll();
      $data['departamentos']=$this->DepartamentoModel->SelectAll();
      $data['paises']=$this->PaisModel->SelectAll();
      $this->load->view('header',$data);
      $this->load->view('/Proveedor/IngresarProveedor',$data);
      $this->load->view('footer');

  }

  public function editar($id){
      $this->logueado();
      $this->permiso('Proveedores');
      $data['head']="Editar informacion de un proveedor";
      $data['editado']=$this->ProveedorModel->selectOne($id);
        if(count($data['editado']) == 0){
          $this->session->set_flashdata('message', 'El proveedor no existe');
          redirect('Proveedor/index');
        }else{
          $data['ciudades']=$this->CiudadModel->selectAll();
          $data['departamentos']=$this->DepartamentoModel->SelectAll();
          $data['paises']=$this->PaisModel->SelectAll();
          $data['contactos']= $this->ContactosProveedorModel->selectOne($id);
          $data['direccionesProveedor']= $this->DireccionProveedorModel->selectOne($id);
          $data['nombresComerciales']= $this->NombreComercialProveedorModel->selectOne($id);
          $this->load->view('header',$data);
          $this->load->view('/Proveedor/EditarProveedor',$data);
          $this->load->view('footer');
        }
  }


  public function actualizar($id){
    $this->logueado();
    $this->permiso('Proveedores');
        $config['upload_path']          = './uploads/logo/';
        $config['allowed_types']        = 'gif|jpg|png';
          $config['max_size']             = 100;
          $config['max_width']            = 1024;
          $config['max_height']           = 768;
          $config['encrypt_name']         = true;
      //    $config['file_name']         = $this->input->post('cedula');
          $this->load->library('upload', $config);
          $subir=1;
          if ( ! $this->upload->do_upload('logo'))
          {
                  $error = array('error' => $this->upload->display_errors());
                  $subir=0;
          }
          else {
            $edit=$this->ProveedorModel->selectOne($id);
                      unlink(base_url()."/uploads/firmas/".$edit[0]->getLogo());
                  $data2 = array('upload_data' => $this->upload->data());
          }


            $data['head']="Editar informacion de un proveedor";
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
            $data['head']="Ingresar un nuevo proveedor ";
            $data['razonSocial']=$this->input->post('razonSocial');
            $data['NIT']=$this->input->post('NIT');
            $data['fax']=$this->input->post('fax');
            $data['paginaWeb']=$this->input->post('paginaWeb');
            $data['notas']=$this->input->post('notas');

            $nombrecomerciales=explode(',',$this->input->post('NombreComercialh'));
            $ciudades=explode(',',$this->input->post('ciudadh'));
            $direcciones=explode(',',$this->input->post('direccionh'));
            $nombres=explode(',',$this->input->post('nombreh'));
            $apellidos=explode(',',$this->input->post('apellidoh'));
            $cargos=explode(',',$this->input->post('cargoh'));
            $telefonos=explode(',',$this->input->post('telefonoh'));
            $extenciones=explode(',',$this->input->post('extencionh'));
            $celuares=explode(',',$this->input->post('celularh'));
            $emails1=explode(',',$this->input->post('email1h'));
            $emails2=explode(',',$this->input->post('email2h'));

            $proveedor = new ProveedorModel();
            $proveedor->setId($id);
            if($proveedor->validate(0) ){
              $proveedor->setData($data);
              $proveedor->update();
              $idproveedor=$proveedor->getId();
              if($nombrecomerciales[0]!=""){
                $this->NombreComercialProveedorModel->deleteProveedorNombres($idproveedor);
                for ($i=0; $i<count($nombrecomerciales) ; $i++) {
                  $nombrecompercialtemp = new NombreComercialProveedorModel();
                  $datanombre["id_proveedor"]=$idproveedor;
                  $datanombre["nombre"]=$nombrecomerciales[$i];
                  $nombrecompercialtemp->setData($datanombre);
                  $nombrecompercialtemp->insert();
                }

              }
              $this->DireccionProveedorModel->deleteProveedorDireccion($idproveedor);
              for ($i=0; $i<count($direcciones) ; $i++) {
                $DireccionProveedortemp = new DireccionProveedorModel();
                $datadireccion["id_proveedor"]=$idproveedor;
                $datadireccion["direccion"]=$direcciones[$i];
                $datadireccion["ciudad"]=$ciudades[$i];
                $DireccionProveedortemp->setData($datadireccion);
                $DireccionProveedortemp->insert();
              }
              $this->ContactosProveedorModel->deleteProveedorContacto($idproveedor);
              for ($i=0; $i<count($nombres) ; $i++) {
                $contactotemp = new ContactosProveedorModel();
                $datacontacto["id_proveedor"]=$idproveedor;
                $datacontacto["nombre"]=$nombres[$i];
                $datacontacto["apellido"]=$apellidos[$i];
                $datacontacto["cargo"]=$cargos[$i];
                $datacontacto["telefono"]=$telefonos[$i];
                $datacontacto["ext"]=$extenciones[$i];
                $datacontacto["celular"]=$celuares[$i];
                $datacontacto["email"]=$emails1[$i];
                $datacontacto["email2"]=$emails2[$i];

                $contactotemp->setData($datacontacto);
                $contactotemp->insert();
              }
              $modificador = new ModificaProveedorModel();
              $moddata["Modificador"]=$this->session->userdata('id');
              $moddata["id_proveedor"]= $id;
              $modificador->setData($moddata);
              $modificador->insert();
              $this->session->set_flashdata('message', 'Proveedor modificado Congrats!!');
              redirect('Proveedor/index');
            }else{
              $data['head']="Editar informacion de un proveedor";
              $data['editado']=$this->ProveedorModel->selectOne($id);
              $data['ciudades']=$this->CiudadModel->selectAll();
                  $data['departamentos']=$this->DepartamentoModel->SelectAll();
                  $data['paises']=$this->PaisModel->SelectAll();
                  $data['contactos']= $this->ContactosProveedorModel->selectOne($id);
                  $data['direcciones']= $this->DireccionProveedorModel->selectOne($id);
                  $data['nombres']= $this->NombreComercialProveedorModel->selectOne($id);
                  $this->load->view('header',$data);
                  $this->load->view('/Proveedor/EditarProveedor',$data);
                  $this->load->view('footer');
            }

  }

  public function guardar()
  {

      $this->logueado();
      $this->permiso('Proveedores');

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
        $subir=0;
        $error = array('error' => $this->upload->display_errors());

        //$this->load->view('upload_form', $error);
      }
      else {

        $data2 = array('upload_data' => $this->upload->data());
        //$this->load->view('upload_success', $data);
      }

      if($subir){
        $data['logo']=$this->upload->data('file_name');
      }
      $data['head']="Ingresar un nuevo proveedor ";
      $data['razonSocial']=$this->input->post('razonSocial');
      $data['NIT']=$this->input->post('NIT');
      $data['fax']=$this->input->post('fax');
      $data['paginaWeb']=$this->input->post('paginaWeb');
      $data['notas']=$this->input->post('notas');
      $nombrecomerciales=explode(',',$this->input->post('NombreComercialh'));
      $ciudades=explode(',',$this->input->post('ciudadh'));
      $direcciones=explode(',',$this->input->post('direccionh'));
      $nombres=explode(',',$this->input->post('nombreh'));
      $apellidos=explode(',',$this->input->post('apellidoh'));
      $cargos=explode(',',$this->input->post('cargoh'));
      $telefonos=explode(',',$this->input->post('telefonoh'));
      $extenciones=explode(',',$this->input->post('extencionh'));
      $celuares=explode(',',$this->input->post('celularh'));
      $emails1=explode(',',$this->input->post('email1h'));
      $emails2=explode(',',$this->input->post('email2h'));
      $proveedor = new ProveedorModel();

      if( $nombres[0] != '' && $direcciones[0] != '' && $proveedor->validate(1) && count($direcciones) > 0  && count($nombres) > 0){
        $proveedor->setData($data);
        $proveedor->insert();
        $proveedor=$proveedor->obtenerID($proveedor->getNIT());
        $idproveedor=$proveedor[0]->getId();
        if ($nombrecomerciales[0]!="") {
          for ($i=0; $i<count($nombrecomerciales) ; $i++) {
            $nombrecompercialtemp = new NombreComercialProveedorModel();
            $datanombre["id_proveedor"]=$idproveedor;
            $datanombre["nombre"]=$nombrecomerciales[$i];
            $nombrecompercialtemp->setData($datanombre);
            $nombrecompercialtemp->insert();
          }
        }
if ($direcciones[0]!="" and count($direcciones) == count($ciudades)) {
        for ($i=0; $i<count($direcciones) ; $i++) {
          $DireccionProveedortemp = new DireccionProveedorModel();
          $datadireccion["id_proveedor"]=$idproveedor;
          $datadireccion["direccion"]=$direcciones[$i];
          $datadireccion["ciudad"]=$ciudades[$i];
          $DireccionProveedortemp->setData($datadireccion);
          $DireccionProveedortemp->insert();
        }
        }
        if($nombres[0]!=""){
          for ($i=0; $i<count($nombres) ; $i++) {
            $contactotemp = new ContactosProveedorModel();
            $datacontacto["id_proveedor"]=$idproveedor;
            $datacontacto["nombre"]=$nombres[$i];
            $datacontacto["apellido"]=$apellidos[$i];
            $datacontacto["cargo"]=$cargos[$i];
            $datacontacto["telefono"]=$telefonos[$i];
            $datacontacto["ext"]=$extenciones[$i];
            $datacontacto["celular"]=$celuares[$i];
            $datacontacto["email"]=$emails1[$i];
            $datacontacto["email2"]=$emails2[$i];
          
            $contactotemp->setData($datacontacto);
            $contactotemp->insert();
          }
        }

        $this->session->set_flashdata('message', 'Proveedor Agregado Congrats!!');
        redirect('Proveedor/index');
      }else{
        $data['head']="Ingresar un nuevo proveedor";
        $data['ciudades']=$this->CiudadModel->selectAll();
        $data['departamentos']=$this->DepartamentoModel->SelectAll();
        $data['paises']=$this->PaisModel->SelectAll();
        $this->load->view('header',$data);
        $this->load->view('/Proveedor/IngresarProveedor',$data);
        $this->load->view('footer');
      }


  }



}
