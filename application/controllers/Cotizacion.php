
<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
class Cotizacion extends MY_Controller{

  function __construct()
  {
    parent::__construct();
  $this->load->model('UsuarioModel');
  $this->load->model('LaboratorioModel');
  $this->load->model('ResponsableModel');
  $this->load->model('ImagenModel');
  $this->load->model('EquipoModel');
  $this->load->model('ClasificacionModel');
    $this->load->model('SolicitudModel');
    $this->load->model('CotizacionModel');
    $this->load->model('ClienteModel');
    $this->load->model('AdministradorServicioModel');
    $this->load->model('FacturaModel');
    $this->load->model('GrupoEmpresarialModel');
    $this->load->model('OrdenesModel');

  }



  public function nuevo($id){
    $this->logueado();
    $this->permiso('Cotizaciones');
    $data['head']="Cotizaciones";
    $data['clientes']=$this->ClienteModel->selectAll();
    $data['equipos']=$this->SolicitudModel->selectAllCotizacion($id);
    $data['ordenes']=$this->OrdenesModel->selectOne($id);
    $data['id'] = $id;
            $this->load->view('header',$data);
            $this->load->view('/Equipo/generarCotizacion',$data);
            $this->load->view('footer');
  }

  public function aprobar($id){

   //$infoequipo = $this->input->post();
   $this->permiso('Cotizaciones');
   $today=getdate();
   $fecha =  $today["year"] . "-" . $today["mon"]. "-" . $today["mday"];
   $cotizacion = new CotizacionModel();
   $cotizacion->insert($id,$fecha);
   //foreach ($infoequipo['data'] as $data) {
     $solicitud = new SolicitudModel();
     $solicitud->colocarCotizacion($id);
     



   //  }

   $this->session->set_flashdata('message', 'Guardado con exito');
   redirect('Cotizacion/nuevo/' . $id);
 }


 public function borrarSuave($id){
  //$infoequipo = $this->input->post();
  $this->permiso('Cotizaciones');
  $fecha =  date('Y-m-d');
  //foreach ($infoequipo['data'] as $data) {
    $solicitud = new SolicitudModel();
    $solicitud->borrarSuave($id);
  //  }

  $this->session->set_flashdata('message', 'limpiado con exito');
  redirect('Cotizacion/nuevo/' . $id);
}



  public function ListaCotizacion(){
    $this->logueado();
    $this->permiso('Cotizaciones');
    $data['head']="Lista de Cotizaciones";
//    $responsable = new ResponsableModel();
//    $responsable->setIdUsuario($this->session->userdata("id"));
//    if($responsable->selectOne()){

    $data['cotizaciones']=$this->CotizacionModel->selectALl();
    $data['clientes']=$this->ClienteModel->selectAll();
    if($this->session->userdata("idCliente") == 2){
      $this->load->view('header',$data);
      $this->load->view('/Equipo/ListaCotizacion',$data);
      $this->load->view('footer');
    }else {
      redirect('Inicio/index');
    }
  }



  public function cotizacionPreviewPDF($id){
    $this->logueado();
    $this->permiso('Cotizaciones');
    $data['head']="Cotizaciones";
    $data['equipos']=$this->SolicitudModel->selectEquiposCotizadosPreview($id);
    $data['equiposPrecio']=$this->SolicitudModel->selectPreviewCotizacion($id);
    //$data['adminserv']=$this->AdministradorServicioModel->selectOne($data['equiposPrecio'][0]->servicio);
    $data['ordenes'] = $id;
    $data['Notas'] = $this->OrdenesModel->selectOne($id);
    $data['cotizacion']=$this->CotizacionModel->lastId();
    $data['cliente']=$this->ClienteModel->selectOnebyOrden($id);
    $nombreCliente =$this->ClienteModel->selectOnebyOrden($id);
    $data['asesor']=$this->UsuarioModel->selectOne($this->session->userdata('id'));
    $data['grupo']=$this->GrupoEmpresarialModel->selectOne(1);
    $today=getdate();
    $data['fecha']= $today["year"] . "-" . $today["mon"]. "-" . $today["mday"];

      $html=$this->load->view('Equipo/CotizacionPDF',$data, true);
      $html2=$this->load->view('Equipo/CotizacionPreviewPDFheader',$data, true);
	  $html3=$this->load->view('Equipo/CotizacionPDFFooter',$data, true);



      $this->load->library('m_pdf');
      $pdf = $this->m_pdf->load();


      //$stylesheet = file_get_contents("https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css");
      $stylesheet = file_get_contents(base_url() . 'assets/css/materialize.css');
	  //$stylesheet .= file_get_contents(base_url() . 'assets/css/cotizacion.css');

      $pdf->WriteHTML($stylesheet ,1);
      $pdf->SetHTMLHeader($html2);
      $pdf->SetHTMLFooter($html3);
      $pdf->AddPage('L', // L - landscape, P - portrait
          '', '', '', '',
          10, // margin_left
          10, // margin right
          80, // margin top
          60, // margin bottom
          11, // margin header
          20); // margin footer
      $pdf->WriteHTML($html, 0);

      $pdf->Output("COTG-" . $id .' ('.$nombreCliente[0]->getRazonSocial().')'. ".pdf", "I");


  }







  public function cotizacionPDF($id){
    $this->logueado();
    $this->permiso('Cotizaciones');
    $data['head']="Cotizaciones";
    $data['equipos']=$this->SolicitudModel->selectEquiposCotizados($id);
    $data['equiposPrecio']=$this->SolicitudModel->selectByCotizacion($id);
    //$data['adminserv']=$this->AdministradorServicioModel->selectOne($data['equiposPrecio'][0]->servicio);
    $data['Notas'] = $this->OrdenesModel->selectOne($id);
    $data['cotizacion']=$this->CotizacionModel->selectOne($id);
    $data['cliente']=$this->ClienteModel->selectOnebyOrden($id);
    $nombreCliente =$this->ClienteModel->selectOnebyOrden($id);
    $data['asesor']=$this->UsuarioModel->selectOne($data['cotizacion'][0]->getIdCreador());
    $data['grupo']=$this->GrupoEmpresarialModel->selectOne(1);


      $html=$this->load->view('/Equipo/CotizacionPDF',$data, true);
      $html2=$this->load->view('/Equipo/CotizacionPDFheader',$data, true);
      $html3=$this->load->view('/Equipo/CotizacionPDFFooter',$data, true);



      $this->load->library('m_pdf');
      $pdf = $this->m_pdf->load();


   
      $stylesheet = file_get_contents(base_url() . 'assets/css/materialize.css');

      $pdf->WriteHTML($stylesheet ,1);
      $pdf->SetHTMLHeader($html2);
      $pdf->SetHTMLFooter($html3);
      $pdf->AddPage('L', // L - landscape, P - portrait
          '', '', '', '',
          10, // margin_left
          10, // margin right
          80, // margin top
          60, // margin bottom
          11, // margin header
          20); // margin footer
      $pdf->WriteHTML($html, 0);

      $pdf->Output("COGT-" . $id.' ('.$nombreCliente[0]->getRazonSocial().')'.".pdf", "I");


  }

  public function actualizar($id){
    $this->permiso('Cotizaciones');
    $infoequipo = $this->input->post();
    $notas = $infoequipo["notas"];
    $ordenes = new OrdenesModel();
    $ordenes = $this->OrdenesModel->selectOne($id);
    $ordenes[0]->setNotas($notas); 
    $ordenes[0]->updateNotas($id); 
    $solicitud = new SolicitudModel();
    foreach ($infoequipo['data'] as $idequipo => $data) {
      $solicitud->setIdEquipo($idequipo);
      foreach ($data as $servicio => $valor) {
        
        $solicitud->setServicio($servicio);
        $solicitud->updatePrices($valor["valor"],
        $valor["cantidad"]/$valor["cantidadEquipos"],
        $valor["iva"],$id);
      }
    }
    $this->session->set_flashdata('message', 'Guardado con exito');
    redirect('Cotizacion/nuevo/' . $id);
  }



  public function generarFacturaPreforma($id){
    $this->logueado();
    $this->permiso('Cotizaciones');
      $data['factura']=$this->FacturaModel->selectOne($id);

      $data['imprimir']=0;
      $data['preforma']=1;

      if($data['factura'][0] != NULL ){
      $pedido=$this->CotizacionModel->selectOne($id);
      $data['equiposPrecio']=$this->SolicitudModel->selectByCotizacion($id);
      $data['adminserv']=$this->AdministradorServicioModel->selectOne($data['equiposPrecio'][0]->servicio);
      $data['cotizacion']=$this->CotizacionModel->selectOne($id);

  //generar aqui PDF
  $html=$this->load->view('Equipo/Factura',$data, true);
  $html2=$this->load->view('Equipo/FacturaFooter',$data, true);
  $html3=$this->load->view('Equipo/FacturaHeader',$data, true);
  $stylesheet = file_get_contents(base_url() . 'assets/css/materialize.css');

    $stylesheet .= file_get_contents(base_url() . 'assets/css/facturaIasotecg.css');


      $this->load->library('m_pdf');
      $pdf = $this->m_pdf->load();

      $pdf->SetHTMLHeader($html3);
      $pdf->SetHTMLFooter($html2);


      $pdf->AddPage('P', // L - landscape, P - portrait
          '', '', '', '',
          10, // margin_left
          10, // margin right
          69, // margin top
          40, // margin bottom
          15, // margin header
          20); // margin footer

      $pdf->WriteHTML($stylesheet ,1);
      $pdf->WriteHTML($html, 0);

      //  $pdf->SetY(-20);
      //  $pdf->SetX(50);
      //  $pdf->Cell( 0 , 0,$data['factura'][0]->Origen . $data['factura'][0]->TipoOrigen , 0, 0, 'L' );
      //  $pdf->SetX(120);
      //  $pdf->Cell( 0 , 0, 'Fecha cotizacion: ' .$data['factura'][0]->fechaPedido , 0, 0, 'L' );
      //  $pdf->SetX($pdf->lMargin);
      //  $pdf->Cell( 0 , 0, 'ID: ' . $data['factura'][0]->getIdPedido() , 0, 0, 'R' );
      $pdf->Output("factura" . $id . ".pdf", 'I');
      }else{
        $this->session->set_flashdata('message', 'Orden de servicio no aprobada');
        redirect('Cotizacion/ListaCotizacion');
      }
  }


  public function generarFactura($id){
    $this->logueado();
    $this->permiso('Cotizaciones');
    $pedido=$this->CotizacionModel->selectOne($id);
    $data['equiposPrecio']=$this->SolicitudModel->selectByCotizacion($id);
    $data['adminserv']=$this->AdministradorServicioModel->selectOne($data['equiposPrecio'][0]->servicio);
    $data['cotizacion']=$this->CotizacionModel->selectOne($id);


    if($pedido[0]->getEstado()== 3 || $pedido[0]->getEstado()== 0){
      $data['factura']=$this->FacturaModel->selectOne($id);

    //  $data['datosempresa']=$this->DatosEmpresaModel->selectOne();
      $data['imprimir']=0;
      $data['preforma']=0;
      if($data['factura'][0] != NULL ){
  //generar aqui PDF
  $html=$this->load->view('Equipo/Factura',$data, true);
  $html2=$this->load->view('Equipo/FacturaFooter',$data, true);
  $html3=$this->load->view('Equipo/FacturaHeader',$data, true);
  $stylesheet = file_get_contents(base_url() . 'assets/css/materialize.css');
  $stylesheet .= file_get_contents(base_url() . 'assets/css/facturaIasotecg.css');

      $this->load->library('m_pdf');
      $pdf = $this->m_pdf->load();

      $pdf->SetHTMLHeader($html3);
      $pdf->SetHTMLFooter($html2);


      $pdf->AddPage('P', // L - landscape, P - portrait
          '', '', '', '',
          10, // margin_left
          10, // margin right
          69, // margin top
          40, // margin bottom
          15, // margin header
          20); // margin footer

      $pdf->WriteHTML($stylesheet ,1);
      $pdf->WriteHTML($html, 0);

      //  $pdf->SetY(-20);
      //  $pdf->SetX(50);
      //  $pdf->Cell( 0 , 0,$data['factura'][0]->Origen . $data['factura'][0]->TipoOrigen , 0, 0, 'L' );
      //  $pdf->SetX(120);
      //  $pdf->Cell( 0 , 0, 'Fecha cotizacion: ' .$data['factura'][0]->fechaPedido , 0, 0, 'L' );
      //  $pdf->SetX($pdf->lMargin);
      //  $pdf->Cell( 0 , 0, 'ID: ' . $data['factura'][0]->getIdPedido() , 0, 0, 'R' );
      $pdf->Output("factura" . $id . ".pdf", 'I');
    } else{
      $this->session->set_flashdata('message', 'Orden de servicio no aprobada');
      redirect('Cotizacion/ListaCotizacion');
    }
    }else{
      $this->session->set_flashdata('message', 'El pedido no ha sido aprobado');
      redirect('Cotizacion/ListaCotizacion');
      }

  }

  public function imprimirFactura($id){
    $this->logueado();
    $this->permiso('Cotizaciones');
      $pedido=$this->CotizacionModel->selectOne($id);
      $data['equiposPrecio']=$this->SolicitudModel->selectByCotizacion($id);
      $data['adminserv']=$this->AdministradorServicioModel->selectOne($data['equiposPrecio'][0]->servicio);
      $data['cotizacion']=$this->CotizacionModel->selectOne($id);


      if($pedido[0]->getEstado()==3){
        $data['factura']=$this->FacturaModel->selectOne($id);

        $data['imprimir']=1;
        $data['preforma']=0;
        if($data['factura'][0] != NULL ){
    //generar aqui PDF
    $html=$this->load->view('Equipo/Factura',$data, true);
    $html2=$this->load->view('Equipo/FacturaFooter',$data, true);
    $html3=$this->load->view('Equipo/FacturaHeader',$data, true);
    $stylesheet = file_get_contents(base_url() . 'assets/css/materialize.css');
    $stylesheet .= file_get_contents(base_url() . 'assets/css/facturaImp.css');
        $this->load->library('m_pdf');
        $pdf = $this->m_pdf->load();

        $pdf->SetHTMLHeader($html3);
        $pdf->SetHTMLFooter($html2);


        $pdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            16, // margin_left
            10, // margin right
            75, // margin top
            85, // margin bottom
            26, // margin header
            20); // margin footer

        $pdf->WriteHTML($stylesheet ,1);
        $pdf->WriteHTML($html, 0);

        //  $pdf->SetY(-20);
        //  $pdf->SetX(50);
        //  $pdf->Cell( 0 , 0,$data['factura'][0]->Origen . $data['factura'][0]->TipoOrigen , 0, 0, 'L' );
        //  $pdf->SetX(120);
        //  $pdf->Cell( 0 , 0, 'Fecha cotizacion: ' .$data['factura'][0]->fechaPedido , 0, 0, 'L' );
        //  $pdf->SetX($pdf->lMargin);
        //  $pdf->Cell( 0 , 0, 'ID: ' . $data['factura'][0]->getIdPedido() , 0, 0, 'R' );
        $pdf->Output("factura" . $id . ".pdf", 'I');
      } else{
        $this->session->set_flashdata('message', 'Orden de servicio no aprobada');
        redirect('Cotizacion/ListaCotizacion');
      }
      }else{
        $this->session->set_flashdata('message', 'El pedido no ha sido enviado');
        redirect('Cotizacion/ListaCotizacion');
      }



  }


  public function AprobarFactura(){
      $this->logueado();
      $this->permiso('Cotizaciones');
      $id=$this->input->post('id');
      $fecha = new DateTime();
      $fecha->modify('last day of this month');
      $UltimoDia = $fecha->format('d');
      $DiaSemana = $fecha->format('N');
      $today=getdate();
      $Hoy = $today["mday"];
      //$config = $this->ConfiguracionModel->selectOne(1);
      //$DiaInventario = $config->getDiaInventario();

      $data['editado']=$this->FacturaModel->selectOne($id);
      if(count($data['editado']) == 0){
      echo "El Pedido no existe";
      //    $this->session->set_flashdata('message', 'La Pedido no existe');
      //    redirect('Cotizacion/index');
        }else{

          $nota= $this->input->post('notasfactura');
          $retefuente=$this->input->post('retefuente');
          $tipoPago=$this->input->post('tipopago');
          $fechapago=$this->input->post('fechapago');
          $flete=$this->input->post('flete');



          if($fecha != '' and $flete !=''){
              $today=getdate();


              $fechapago = $fechapago ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];

              $data['editado'][0]->aprobar($id,$fechapago,$flete,$nota,$retefuente,$tipoPago);
                echo "El Pedido fue facturado con exito";
            }
          else{
            echo "Ingrese una fecha de pago";
          }
        //  $this->session->set_flashdata('message', 'La Pedido fue aprobada con exito');
        //  redirect('Cotizacion/ListaCotizacion');
        }

      }

      public function Anular(){
        $this->logueado();
        $this->permiso('Cotizaciones');
        $id=$this->input->post('id');
        $data['editado']=$this->FacturaModel->selectOne($id);
        if(count($data['editado']) == 0){
          echo "no existe";
        //    $this->session->set_flashdata('message', 'La Pedido no existe');
        //    redirect('Pedidos/index');
        }else{

          //  $this->session->set_flashdata('message', 'La Pedido no se puede enviar para aprobar');
          //  redirect('Pedidos/index');

            echo "el pedido fue anulado con exito";
            $data['editado'][0]->anularFactura($id,$this->input->post('razonAnula'));
          //  $this->session->set_flashdata('message', 'La Pedido fue enviada a aprobacion con exito');
          //  redirect('Pedidos/index');


        }
      }


public function EnviarAprobar(){
  $this->logueado();
  $this->permiso('Cotizaciones');
  $today=getdate();
  $fecha = new DateTime();
  $fecha->modify('last day of this month');
  $UltimoDia = $fecha->format('d');
  $DiaSemana = $fecha->format('N');
  $today=getdate();
  $Hoy = $today["mday"];
  //$config = $this->ConfiguracionModel->selectOne(1);
  //$DiaInventario = $config->getDiaInventario();
  $id=$this->input->post('id');
  $data['editado']=$this->FacturaModel->selectOne($id);
  if(count($data['editado']) == 0){
    echo "no existe";
  //    $this->session->set_flashdata('message', 'La Pedido no existe');
  //    redirect('Pedidos/index');
  }else{
    if($data['editado'][0]->getEstado() != 0 ){
      echo "el pedido no se puede enviar para aprobar";
    //  $this->session->set_flashdata('message', 'La Pedido no se puede enviar para aprobar');
    //  redirect('Pedidos/index');
    }else{

      $data['editado'][0]->setTipoOrigenPedido($this->input->post('tipoOrigenPedido'));
      $data['editado'][0]->setOrigenPedido($this->input->post('origenPedido'));
      $data['editado'][0]->enviarAprobar($id);
      echo "el pedido fue enviado a facturacion con exito";
      }

    //  $this->session->set_flashdata('message', 'La Pedido fue enviada a aprobacion con exito');
    //  redirect('Pedidos/index');
    }

  }



}




?>
