<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Compras extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('DocumentoProductoModel');
        $this->load->model('UnidadEmpaqueModel');
        $this->load->model('UnidadMedidaModel');
        $this->load->model('ProveedorModel');
        $this->load->model('UnidadNegocioModel');
        $this->load->model('ProductoModel');
        $this->load->model('ProductoxProveedorModel');
        $this->load->model('ProductoCompuestoModel');
        $this->load->model('DatosEmpresaModel');
        $this->load->model('CompraModel');
        $this->load->model('DetalleCompraModel');
        $this->load->model('LoteModel');
        $this->load->model('EquipoModel');

    }

public function cambiarDivisa(){

  if($this->input->post('divisa') != 'COP'){
    $result = $this->conversor_monedas($this->input->post('divisa'),'COP', 1);
    echo $result;
  }else{
    $result = 1;
    echo $result;
  }
}


    public function obtenerID(){
      $this->logueado();
      $this->permiso('Compras');
      $rs=$this->input->post('nombre');
      $prov=$this->ProveedorModel->selectId($rs);
      if(count($prov) === 1){
        $result = $prov[0]->getId();
        echo $result;
      }else{
        echo "-1";
      }
    }

public function autorizar(){
    $this->logueado();
    $this->permiso('Compras');
    $id=$this->input->post('id');
    $data['editado']=$this->CompraModel->selectOne($id);
    $fecha = new DateTime();
    $fecha->modify('last day of this month');
    $UltimoDia = $fecha->format('d');
    $DiaSemana = $fecha->format('N');
    $today=getdate();
    $Hoy = $today["mday"];
    $config = unserialize($this->session->userdata("configuracion"));
    $DiaInventario = $config->getDiaInventario();
    if(count($data['editado']) == 0){
      echo "no existe";
    //    $this->session->set_flashdata('message', 'La compra no existe');
    //    redirect('Compras/index');
    }else{
      if($data['editado'][0]->getEstado() != 1){
        echo "La compra no se puede autorizar";
      //  $this->session->set_flashdata('message', 'La compra no se puede enviar para aprobar');
      //  redirect('Compras/index');
      }else{
        if ($DiaSemana <= 1) {
          if($UltimoDia - $Hoy < ($DiaInventario + 1)){echo 'Recordar La fecha de revision de inventario'; exit();}
        }else {
          if($UltimoDia - $Hoy < $DiaInventario){echo 'Recordar La fecha de revision de inventario'; exit();}
        }
        echo "La compra fue autorizada con exito";
        $data['editado'][0]->autorizar($id);
      //  $this->session->set_flashdata('message', 'La compra fue enviada a aprobacion con exito');
      //  redirect('Compras/index');
      }

    }

}

public function llegoBodega(){
    $this->logueado();
    $this->permiso('Compras');
    $id=$this->input->post('id');
    $data['editado']=$this->CompraModel->selectOne($id);
    $fecha = new DateTime();
    $fecha->modify('last day of this month');
    $UltimoDia = $fecha->format('d');
    $DiaSemana = $fecha->format('N');
    $today=getdate();
    $Hoy = $today["mday"];
    $config = unserialize($this->session->userdata("configuracion"));
    $DiaInventario = $config->getDiaInventario();
    if(count($data['editado']) == 0){
    echo "La compra no existe";
    //    $this->session->set_flashdata('message', 'La compra no existe');
    //    redirect('Compras/index');
    }else{
      if($data['editado'][0]->getEstado() != 2){
        echo "no se puede ejecutar esta accion porfavor autorize el ingreso";
      //  $this->session->set_flashdata('message', 'La compra no se puede aprobar');
      //  redirect('Compras/index');
      }else{
        if ($DiaSemana <= 1) {
          if($UltimoDia - $Hoy < ($DiaInventario + 1)){echo 'Recordar La fecha de revision de inventario'; exit();}
        }else {
          if($UltimoDia - $Hoy < $DiaInventario){echo 'Recordar La fecha de revision de inventario'; exit();}
        }
        echo "La compra queda a la espera para registro de lotes y seriales";
        $data['editado'][0]->llegoBodega($id);
      //  $this->session->set_flashdata('message', 'La compra fue aprobada con exito');
      //  redirect('Compras/index');
      }

    }
}


public function verificar(){
    $this->logueado();
    $this->permiso('Compras');
    $id=$this->input->post('id');
    $data['editado']=$this->CompraModel->selectOne($id);
    $fecha = new DateTime();
    $fecha->modify('last day of this month');
    $UltimoDia= $fecha->format('d');
    $DiaSemana= $fecha->format('N');
    $today=getdate();
    $Hoy= $today["mday"];
    $config = unserialize($this->session->userdata("configuracion"));
    $DiaInventario= $config->getDiaInventario();
    if(count($data['editado']) == 0){
    echo "La compra no existe";
  //      $this->session->set_flashdata('message', 'La compra no existe');
  //      redirect('Compras/index');
    }else{

      if($data['editado'][0]->getEstado() != 3){
        echo "no es posible verificar la orden de compra revise el proceso";
  //      $this->session->set_flashdata('message', 'La compra no se puede aprobar');
  //      redirect('Compras/index');
      }else{
        if ($DiaSemana <= 1) {
          if($UltimoDia - $Hoy < ($DiaInventario + 1)){echo 'Recordar La fecha de revision de inventario'; exit();}
        }else {
          if($UltimoDia - $Hoy < $DiaInventario){echo 'Recordar La fecha de revision de inventario'; exit();}
        }
        $data['editado'][0]->verificar($id);
        echo "Orden de compra verificada";
  //      $this->session->set_flashdata('message', 'La compra fue cancelada con exito');
  //      redirect('Compras/index');
      }

    }

}

    public function index(){
        $this->logueado();
        $this->permiso('Compras');
        $data['head']="Lista de compras";
        $data['ordenes']=$this->CompraModel->selectAll();
        $data['proveedores']=$this->ProveedorModel->selectAll();
        $this->load->view('header',$data);
        $this->load->view('/Compras/ListarCompra',$data);
        $this->load->view('footer');
    }

public function detalles(){
  $this->logueado();
  $this->permiso('Compras');
    $id=$this->input->post('id');
  $detalles=$this->DetalleCompraModel->selectOne($id);
  $ans= "       <table class='bordered highlight'>
                <thead>
                <tr><th>Cod. Producto</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Costo Unitario</th>
                <th>Descuento</th>
                <th>Costo Total</th>
                <th>Cantidad en inventario</th></tr>
                </thead><tbody>";
  foreach ($detalles as $deta) {
    if($deta->getTipoProducto() == 'Consumible'){
          $lote=$this->LoteModel->selectOne($deta->getId());
    }else{
          $lote=$this->EquipoModel->selectOne($deta->getId());
    }
    if(count($lote) == 0){
      $cantingresada = 0;
    }else{
      $cantingresada = $lote[0]->Total;
    }
    $ans = $ans . "<tr>" .
    "<td>". $deta->getCodigoProducto() ."</td>" .
    "<td>". $deta->getNombreProducto() ."</td>" .
    "<td>". $deta->getCantidad() ."</td>" .
    "<td>". $deta->getPrecioUnitario() ."</td>" .
    "<td>". $deta->getDescuento() ."</td>" .
    "<td>". $deta->getCostoCalculado() ."</td>" .
    "<td>". $cantingresada ."</td>" .
    "</tr>";
  }
  echo $ans . "</tbody></table>";
}



public function generarPDF($id){
  $this->logueado();
  $this->permiso('Compras');
    $data['orden']=$this->CompraModel->selectOne($id);
    $data['detalles']=$this->DetalleCompraModel->selectOne($id);
    $data['datosempresa']=$this->DatosEmpresaModel->selectOne();
//generar aqui PDF
    $html=$this->load->view('Compras/OrdenCompra',$data, true);
    $html3=$this->load->view('Compras/OrdenCompraHeader',$data, true);
    $this->load->library('m_pdf');
    $pdf = $this->m_pdf->load();
    $stylesheet = file_get_contents(base_url() . 'assets/css/materialize.css');
    $stylesheet .= file_get_contents(base_url() . 'assets/css/ordenCompra.css');

    $pdf->SetHTMLHeader($html3);
    $pdf->AddPage('L', // L - landscape, P - portrait
        '', '', '', '',
        10, // margin_left
        10, // margin right
        75, // margin top
        10, // margin bottom
        11, // margin header
        10); // margin footer
    $pdf->WriteHTML($stylesheet ,1);
    $pdf->WriteHTML($html, 0);
    $pdf->Output("OrdenCompra" . $id . ".pdf", "I");
}




    public function nuevo($id){
        $this->logueado();
        $this->permiso('Compras');
        //$data['dato']=$this->conversor_monedas("USD","COP",1);
        //var_dump($data);
        $data['head']="Ingresar una orden de compra";
        $data['proveedor']=$this->ProveedorModel->selectOne($id);
        if(count($data['proveedor']) == 0){
            $this->session->set_flashdata('message', 'El proveedor no existe');
            redirect('Proveedor/index');
        }else{
            $data['proveedor']=$data['proveedor'][0];
            $data['productos']=$data['proveedor']->getProducts();
            if(count($data['productos']) == 0){
                $this->session->set_flashdata('message', 'El proveedor no tiene productos');
                redirect('Proveedor/index');
            }else{
                $this->load->view('header',$data);
                $this->load->view('Compras/IngresarCompra',$data);
                $this->load->view('footer');
            }
        }

    }

    public function guardar($id)
    {
        $this->logueado();
        $this->permiso('Compras');
        $today=getdate();
        $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
        $boton = $this->input->post('button');
    //1: nuevo 2: enviado 3: aprobado y 4: cancelado
      $data['estado'] = "1";
      if($boton == "Guardar"){
        $data['estado'] = "1";
      }
      if($boton == "Enviar"){
        $data['estado'] = "2";
        $data['idExpedidor']= $this->session->userdata('id');
        $data['fechaExpedicion']=$hoy;
      }

      if($this->input->post('divisa') == 'EUR' or $this->input->post('divisa') == 'USD'){
        $data['divisa']=$this->input->post('divisa');
        $data['valorDivisa']=$this->conversor_monedas($this->input->post('divisa'),'COP', 1);
      }else{
        $data['divisa']='COP';
        $data['valorDivisa']=1;
      }
        $data['idProveedor'] = $id;

        $data['idCreador']= $this->session->userdata('id');
        $data['fechaCreacion']=$hoy;
        $data['lugarEntrega']=$this->input->post('lugarentrega');
        $data['fechaPrevista']=$this->input->post('fechaentrega');

        $data['fechapago']=$this->input->post('fechapago');
        $data['diaspago']=$this->input->post('diaspago');
        $data['modopago']=$this->input->post('modopago');
        $cantidades=explode(',',$this->input->post('cantidadesh'));
        $productos=explode(',',$this->input->post('productosh'));
        $descuentos=explode(',',$this->input->post('descuentosh'));
          if(count($cantidades != 0)){
        $compra = new CompraModel();
        $compra->setData($data);
        $subdata['idCompra'] = $compra->insert();


          //aqui se ensambla el producto
          $produ= new ProductoModel();
          $detallecompra = new DetalleCompraModel();
          for ($i=0; $i<count($cantidades) ; $i++) {
            $prod = $produ->selectId($productos[$i]);
            if(count($prod) != 0){
              $subdata["idProducto"]=$prod[0]->getId();
              $proveedorxProduct = $produ->selectProductoxProveedor($subdata["idProducto"],$id);
$proveedorxProduct = $proveedorxProduct[0];
              $subdata["cantidad"]=$cantidades[$i];
              $subdata["precioUnitario"]=$proveedorxProduct ->costo;
              $subdata["descuento"]=$descuentos[$i];
              $subdata['unidadMedida'] = $prod[0]->getUnidadMedida();
              $subdata['presentacionSalida'] =  $prod[0]->getPresentacionSalida();
              $subdata['cantidadSalida'] = $prod[0]->getCantidadSalida();
              $subdata['nombreProducto'] = $prod[0]->getNombre();
              $subdata['codigoProducto'] = $proveedorxProduct->CodProd;
              $subdata['marcaProducto'] = $prod[0]->getMarca();
              $subdata['ivaProducto'] = $prod[0]->getIva();
              $subdata['tipoProducto'] = $prod[0]->getTipo();
              $subdata["costoCalculado"]= (1 - ($subdata["descuento"] / 100) ) * $subdata["precioUnitario"] * $subdata["cantidad"];
              if($subdata["precioUnitario"] != "error"){
                $detallecompra->setData($subdata);
                $detallecompra->insert();
              }
            }
          }
          $this->session->set_flashdata('message', 'Compra generada con exito, es el numero:' . $subdata['idCompra']);
          redirect('Compras/index');
  //        redirect('Compras/nuevo/'.$id);
        }else{
          $this->session->set_flashdata('message', 'Orden de Compra vacia!!');
          redirect('Compras/index');
  //        redirect('Compras/nuevo/'.$id);
        }
        $this->nuevo($id);
    }

    public function editar($id){
        $this->logueado();
        $this->permiso('Compras');
        $data['head'] = "Editando Orden de compra No." . $id;
        $data['editado']=$this->CompraModel->selectOne($id);
        if(count($data['editado']) == 0){
            $this->session->set_flashdata('message', 'La compra no existe');
            redirect('Compras/index');
        }else{
          if($data['editado'][0]->getEstado() != 1){
                $this->session->set_flashdata('message', 'La compra no puede ser modificada');
                redirect('Compras/index');
          }else{
            $data['editado'] = $data['editado'][0];
            $prov = new ProveedorModel();
            $prov->setId($data['editado']->getIdProveedor());
          //  unset($data['editado']->getIdProveedor());
            $data['editadoDetalle']= $this->DetalleCompraModel->selectOne($id);
            $data['productos']=$prov->getProducts();
            $data['oldproductos']=$prov->getAllProducts();
              $this->load->view('header',$data);
              $this->load->view('/Compras/EditarCompra',$data);
              $this->load->view('footer');
            }
          }
    }


    public function actualizar($id)
    {
      $this->logueado();
      $this->permiso('Compras');
      $today=getdate();
      $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
  $boton = $this->input->post('button');
        $data['estado'] = "1";
  //1: nuevo 2: enviado 3: aprobado y 4: cancelado
    if($boton == "Guardar"){
      $data['estado'] = "1";
    }
    if($boton == "Enviar"){
      $data['estado'] = "2";
      $data['idExpedidor']= $this->session->userdata('id');
      $data['fechaExpedicion']=$hoy;
    }

    if($this->input->post('divisa') == 'EUR' or $this->input->post('divisa') == 'USD'){
      $data['divisa']=$this->input->post('divisa');
      $data['valorDivisa']=$this->conversor_monedas($this->input->post('divisa'),'COP', 1);
    }else{
      $data['divisa']='COP';
      $data['valorDivisa']=1;
    }
    //  $data['idProveedor'] = $id;
      $data['lugarEntrega']=$this->input->post('lugarentrega');
      $data['fechaPrevista']=$this->input->post('fechaentrega');
      $data['id']= $id;
      $data['fechapago']=$this->input->post('fechapago');
      $data['diaspago']=$this->input->post('diaspago');
      $data['modopago']=$this->input->post('modopago');
      $cantidades=explode(',',$this->input->post('cantidadesh'));
      $productos=explode(',',$this->input->post('productosh'));
      $descuentos=explode(',',$this->input->post('descuentosh'));
        if(count($cantidades != 0)){
      $compra = new CompraModel();

      $compra->setData($data);
      $subdata['idCompra'] = $id;
      $compra->update();
      $datoscompra = $compra->selectOne($id);

      $idprov= $datoscompra[0]->getIdProveedor();
        //aqui se ensambla el producto
        $produ= new ProductoModel();
        $detallecompra = new DetalleCompraModel();
        $detallecompra->deleteDetallesCompra($id);
        for ($i=0; $i<count($cantidades) ; $i++) {
          $prod = $produ->selectId($productos[$i]);
          if(count($prod) != 0){
            $subdata["idProducto"]=$prod[0]->getId();
            $proveedorxProduct = $produ->selectProductoxProveedor($subdata["idProducto"],$idprov);
            $proveedorxProduct = $proveedorxProduct[0];
            $subdata["cantidad"]=$cantidades[$i];
            $subdata["precioUnitario"]=$proveedorxProduct ->costo;
            $subdata["descuento"]=$descuentos[$i];
            $subdata['unidadMedida'] = $prod[0]->getUnidadMedida();
            $subdata['presentacionSalida'] =  $prod[0]->getPresentacionSalida();
            $subdata['cantidadSalida'] = $prod[0]->getCantidadSalida();
            $subdata['nombreProducto'] = $prod[0]->getNombre();
            $subdata['codigoProducto'] = $proveedorxProduct->CodProd;
            $subdata['marcaProducto'] = $prod[0]->getMarca();
            $subdata['ivaProducto'] = $prod[0]->getIva();
            $subdata['tipoProducto'] = $prod[0]->getTipo();
            $subdata["costoCalculado"]= (1 - ($subdata["descuento"] / 100) ) * $subdata["precioUnitario"] * $subdata["cantidad"];
            if($subdata["precioUnitario"] != "error"){
              $detallecompra->setData($subdata);
              $detallecompra->insert();
            }
          }
        }
        $this->session->set_flashdata('message', 'Compra modificada con exito');
        redirect('Compras/index');
  //      redirect('Compras/editar/'.$id);
      }else{
        $this->session->set_flashdata('message', 'Orden de Compra vacia!!');
        redirect('Compras/index');
  //      redirect('Compras/editar/'.$id);
      }
      $this->editar($id);
    }





}
