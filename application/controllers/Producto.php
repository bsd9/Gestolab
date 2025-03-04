  <?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends MY_Controller{

  function __construct()
  {
    parent::__construct();

    ini_set('max_execution_time', 0);
    $this->load->model('DocumentoProductoModel');
    $this->load->model('UnidadEmpaqueModel');
    $this->load->model('UnidadMedidaModel');
    $this->load->model('ProveedorModel');
    $this->load->model('UnidadNegocioModel');
    $this->load->model('ProductoModel');
    $this->load->model('ProductoxProveedorModel');
    $this->load->model('ProductoCompuestoModel');
    $this->load->model('EstablecimientoComercialModel');
    $this->load->model('ModificaProductoModel');
    $this->load->model('EmpleadoModel');
    $this->load->model('PedidoModel');
    $this->load->model('DetallePedidoModel');
  }

  public function InformeVentasUnidadNegocio($idunidad,$fechaIni,$fechaFin){
    $this->logueado();

    $this->permiso('Informes');
    $data['head']="Informe de ventas";
    $data['items']=$this->ProductoModel->InformeVentasUnidadNegocio($idunidad,$fechaIni,$fechaFin);
    $this->load->view('header',$data);
    $this->load->view('/Producto/InformeVentasUnidadNegocio',$data);
    $this->load->view('footer');
  }

public function detalles(){
  $this->logueado();
  $this->permiso('Productos');
    $id=$this->input->post('id');
      $data['head']="Informacion Extra:";
      $data['visible'] = 0;
  $data['producto'] =$this->ProductoModel->selectOne($id);
  $data['ultimoModificador'] = $this->ModificaProductoModel->selectProductoMod($id);
  $data['pedidosF'] =$this->PedidoModel->selectAllFacturedByProduct($data['producto']->getId());
  $data['pedidos'] =$this->PedidoModel->selectAllNotFacturedByProduct($data['producto']->getId());
  $ans= $this->load->view('/Producto/VistaProducto',$data, TRUE);
  echo $ans;
}

public function productoDetallado($id){
    $data['head']="Informacion Extra:";
    $data['producto'] =$this->ProductoModel->selectOne($id);
    $data['ultimoModificador'] =$this->ModificaProductoModel->selectProductoMod($id);
    $data['pedidosF'] =$this->PedidoModel->selectAllFacturedByProduct($data['producto']->getId());
    $data['pedidos'] =$this->PedidoModel->selectAllNotFacturedByProduct($data['producto']->getId());
    $data['visible'] = 0;
    $this->load->view('header',$data);
    $this->load->view('/Producto/VistaProducto',$data);
    $this->load->view('footer');
}

public function informeCompras(){
  $this->logueado();
  $this->permiso('Descargas');
  $data['InformeCompras']=$this->ProductoModel->selectInforme();
  $this->load->view('Producto/InformeCompras',$data);
}

  public function index(){
    $this->logueado();
    $this->permiso('Productos');
    $data['head']="Lista de productos";
    $data['productos']=$this->ProductoModel->selectAll();
    $this->load->view('header',$data);
    $this->load->view('/Producto/ListarProductos',$data);
    $this->load->view('footer');

  }
public function descarga(){
  $this->logueado();
  $this->permiso('Productos');
  $id = $this->input->post('id');
  $tipo = $this->input->post('tipo');
  $data = $this->DocumentoProductoModel->selectAllOf($id,$tipo);
  if($tipo =='Ficha Tecnica' && count($data) > 0){
    $url =base_url(). 'uploads/FichasTecnicas/' . $data[0]->getDoc();
    echo $url ;
  }
  if($tipo =="Hoja Seguridad" && count($data) > 0){
    $url =base_url(). 'uploads/HojasSeguridad/' . $data[0]->getDoc();
    echo $url ;
  }
  echo '';

}



public function agregarPrecio($id){
  $this->logueado();
  $this->permiso('Productos');
  $data['editado']=$this->ProductoModel->selectOne($id);
  if($data['editado'] === "nada"){
      $this->session->set_flashdata('message', 'El producto no existe');
      redirect('Producto/index');
    }else{
      $data['head']="Modificando Precio";
      $data['costos'] = $this->ProductoxProveedorModel->selectByProd($data['editado']->getId());
      foreach ($data['costos'] as $prodxprov) {
        if($prodxprov->getDivisa() != 'COP' ){
          $newCosto  = $this->conversor_monedas($prodxprov->getDivisa(),'COP', $prodxprov->getCosto());
          $prodxprov->setCosto($newCosto);
        }
      }
      $this->load->view('header',$data);
      $this->load->view('/Producto/DefinirPrecio',$data);
      $this->load->view('footer');
    }
}

public function guardarPrecio($id){
  $this->logueado();
  $this->permiso('Productos');
  $precioP = $this->input->post('ValorP');
  $precioT = $this->input->post('ValorT');
  if($precioP > $precioT){
    $this->session->set_flashdata('message', 'El precio piso no puede ser mayor al techo');
    redirect('Producto/agregarPrecio/'. $id);
  }else{
  $prod = new ProductoModel();
  $prod->setId($id);
  $prod->setPrecioTecho($precioT);
  $prod->setPrecioPiso($precioP);
  $prod->updatePrecio();

  $modificador = new ModificaProductoModel();
  $moddata["Modificador"]=$this->session->userdata('id');
  $moddata["id_producto"]= $id;
  $modificador->setData($moddata);
  $modificador->insert();
  $this->session->set_flashdata('message', 'Los precios han sido actualizados');
  redirect('Producto/index');
  }
}

  public function nuevo(){
    $this->logueado();
    $this->permiso('Productos');
    //$data['dato']=$this->conversor_monedas("USD","COP",1);
    //var_dump($data);
    $data['head']="Ingresar un nuevo producto";
    $data['productos']=$this->ProductoModel->selectAll();
    $data['empaques']=$this->UnidadEmpaqueModel->selectAll();
    $data['medidas']=$this->UnidadMedidaModel->selectAll();
    $data['UnidadNegocio']=$this->UnidadNegocioModel->selectAll();
    $data['proveedores']=$this->ProveedorModel->selectAll();
    $data['establecimientos']=$this->EstablecimientoComercialModel->selectAll();

    $this->load->view('header',$data);
    $this->load->view('Producto/IngresarProducto',$data);
    $this->load->view('footer');

  }

  public function editar($id){
    $this->logueado();
    $this->permiso('Productos');
    $data['head']="Editando producto";
    $data['productos']=$this->ProductoModel->selectAll();
    $data['empaques']=$this->UnidadEmpaqueModel->selectAll();
    $data['medidas']=$this->UnidadMedidaModel->selectAll();
    $data['UnidadNegocio']=$this->UnidadNegocioModel->selectAll();
    $data['proveedores']=$this->ProveedorModel->selectAll();
    $data['establecimientos']=$this->EstablecimientoComercialModel->selectAll();
    $data['editado']=$this->ProductoModel->selectOne($id);
    if($data['editado'] === "nada"){
        $this->session->set_flashdata('message', 'El producto no existe');
        redirect('Producto/index');
      }else{
        $this->load->view('header',$data);
        $this->load->view('/Producto/EditarProducto',$data);
        $this->load->view('footer');
      }
}


  public function actualizar($id)
    {
      $this->logueado();
      $this->permiso('Productos');
      $config['upload_path']          = './uploads/HojasSeguridad/';
      $config['allowed_types']        = 'doc|pdf|docx';
      $config['file_name']         = $this->input->post('nombre');
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('HojaSeguridad')){
        $error = array('errorH' => $this->upload->display_errors());
      }
      else{
        $HojaSeguridad = $this->upload->data();
      }

      $config['allowed_types']     = 'doc|pdf|docx';
      $config['upload_path']       = './uploads/FichasTecnicas/';
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('FichaTecnica')){
        $error = array('errorF' => $this->upload->display_errors());
      }
      else{
        $FichaTecnica = $this->upload->data();
      }
      if($this->input->post('Activo')==null){
        $data['activo']=0;
      }else{
        $data['activo']=1;
      }
      $data['id']=$id;
      $data['tipo'] = $this->input->post('tipo');
      $data['nombre'] = $this->input->post('nombre');
      $data['marca'] = $this->input->post('marca');
  //    $data['codProveedor'] = $this->input->post('codProd');
      $data['modelo'] = $this->input->post('modelo');
      $data['unidadNegocio'] = $this->input->post('unidadNegocio');
      $data['unidadMedida'] = $this->input->post('unidadMedida');
      $data['posicion'] = $this->input->post('posicion');
      $data['gravamenArancelario'] = $this->input->post('gravamenArancelario');
      $data['gravamenIva'] = $this->input->post('gravamenIva');
      $data['notasInteres'] = $this->input->post('notasInteres');
      $data['iva'] = $this->input->post('iva');
      $data['peso'] = $this->input->post('peso');
      $data['idEstablecimiento'] =$this->input->post('idEstablecimiento');

      if(isset($HojaSeguridad)){
        $infohoja['tipo']="Hoja Seguridad";
        $infohoja['doc']=$HojaSeguridad['file_name'];
      }

      if(isset($FichaTecnica)){
          $infoficha['tipo']="Ficha Tecnica";
          $infoficha['doc']=$FichaTecnica['file_name'];
      }

      $proveedores=explode(',',$this->input->post('proveedorh'));
      $costos=explode(',',$this->input->post('costoh'));
      $divisas=explode(',',$this->input->post('divisah'));
      $codigos=explode(',',$this->input->post('codigoh'));
      $cantidades=[];
      if($data['tipo'] == 'Compuesto'){
        $cantidades=explode(',',$this->input->post('cantidadesh'));
        $productos=explode(',',$this->input->post('productosh'));
        $data['presentacionEntrada'] = "null";
        $data['cantidadEntrada'] = "1";
        $data['presentacionSalida'] = "null";
        $data['cantidadSalida'] = "1";
      }else{
        $data['presentacionEntrada'] = $this->input->post('unidadEmbalajeEntrada');
        $data['cantidadEntrada'] = $this->input->post('cantidadEntrada');
        $data['presentacionSalida'] = $this->input->post('unidadEmbalajeSalida');
        $data['cantidadSalida'] = $this->input->post('cantidadSalida');
      }

      $producto = new ProductoModel();
      $producto->setId($id);
      if($producto->validate(0) and $proveedores[0]!=""){
          $producto->setData($data);
          $producto->update();
          $producto=$producto->selectId($producto->getNombre());
          $temp["idProducto"]=$producto[0]->getId();
          if(isset($HojaSeguridad)){
            $infohoja['idProducto']=$temp["idProducto"];
            $hs = new DocumentoProductoModel();
            $hs->setData($infohoja);
            $hs->insert();
          }
          if(isset($FichaTecnica)){
            $infoficha['idProducto']= $temp["idProducto"];
            $ft = new DocumentoProductoModel();
            $ft->setData($infoficha);
            $ft->insert();
          }
          $prov = new ProveedorModel();
          $provxprod = new ProductoxProveedorModel();
          $provxprod->delete($temp["idProducto"]);
          for ($i=0; $i<count($proveedores) ; $i++) {
            $proveedortemp = $prov->selectId($proveedores[$i]);
            if(count($proveedortemp) != 0){
              $temp["idProveedor"]=$proveedortemp[0]->getId();
              $temp["costo"]=$costos[$i];
              $temp["divisa"]=$divisas[$i];
              $temp["CodProd"]=$codigos[$i];
              $provxprod->setData($temp);
              $provxprod->insert();
            }
          }
          if(count($cantidades)  != 0){
            //aqui se ensambla el producto
            $produ= new ProductoModel();
            $productocompuesto = new ProductoCompuestoModel();
            $productocompuesto->delete($temp["idProducto"]);
            for ($i=0; $i<count($cantidades) ; $i++) {
              $prod = $produ->selectId($productos[$i]);
              if(count($prod) != 0){
                $temp["subproducto"]=$prod[0]->getId();
                $temp["cantidad"]=$cantidades[$i];
                $productocompuesto->setData($temp);
                $productocompuesto->insert();
              }
            }
          }

          $modificador = new ModificaProductoModel();
          $moddata["Modificador"]=$this->session->userdata('id');
          $moddata["id_producto"]= $id;
          $modificador->setData($moddata);
          $modificador->insert();
          $this->session->set_flashdata('message', 'Producto Modificado Congrats!!');
          redirect('Producto/index');
      }else{
        $this->nuevo();
      }



  }

  public function guardar()
    {
      $this->logueado();
      $this->permiso('Productos');
      $config['upload_path']          = './uploads/HojasSeguridad/';
      $config['allowed_types']        = 'doc|pdf|docx';
      $config['file_name']         = $this->input->post('nombre');
      $this->load->library('upload', $config);

      if (!$this->upload->do_upload('HojaSeguridad')){
        $error = array('errorH' => $this->upload->display_errors());
      }
      else{
        $HojaSeguridad = $this->upload->data();
      }

      $config['allowed_types']     = 'doc|pdf|docx';
      $config['upload_path']       = './uploads/FichasTecnicas/';
      $this->upload->initialize($config);

      if (!$this->upload->do_upload('FichaTecnica')){
        $error = array('errorF' => $this->upload->display_errors());
      }
      else{
        $FichaTecnica = $this->upload->data();
      }
      $data['idEstablecimiento'] =$this->input->post('idEstablecimiento');
      $data['tipo'] = $this->input->post('tipo');
      $data['nombre'] = $this->input->post('nombre');
      $data['marca'] = $this->input->post('marca');
    //  $data['codProveedor'] = $this->input->post('codProd');
      $data['modelo'] = $this->input->post('modelo');
      $data['unidadNegocio'] = $this->input->post('unidadNegocio');
      $data['unidadMedida'] = $this->input->post('unidadMedida');
      $data['posicion'] = $this->input->post('posicion');
      $data['gravamenArancelario'] = $this->input->post('gravamenArancelario');
      $data['gravamenIva'] = $this->input->post('gravamenIva');
      $data['notasInteres'] = $this->input->post('notasInteres');
      $data['iva'] = $this->input->post('iva');
      $data['peso'] = $this->input->post('peso');

      if(isset($HojaSeguridad)){
        $infohoja['tipo']="Hoja Seguridad";
        $infohoja['doc']=$HojaSeguridad['file_name'];
      }

      if(isset($FichaTecnica)){
          $infoficha['tipo']="Ficha Tecnica";
          $infoficha['doc']=$FichaTecnica['file_name'];
      }

      $proveedores=explode(',',$this->input->post('proveedorh'));
      $costos=explode(',',$this->input->post('costoh'));
      $divisas=explode(',',$this->input->post('divisah'));
      $codigos=explode('|,',$this->input->post('codigoh'));
      $cantidades=[];
      if($data['tipo'] == 'Compuesto'){
        $cantidades=explode(',',$this->input->post('cantidadesh'));
        $productos=explode(',',$this->input->post('productosh'));
        $data['presentacionEntrada'] = "null";
        $data['cantidadEntrada'] = "1";
        $data['presentacionSalida'] = "null";
        $data['cantidadSalida'] = "1";
      }else{
        $data['presentacionEntrada'] = $this->input->post('unidadEmbalajeEntrada');
        $data['cantidadEntrada'] = $this->input->post('cantidadEntrada');
        $data['presentacionSalida'] = $this->input->post('unidadEmbalajeSalida');
        $data['cantidadSalida'] = $this->input->post('cantidadSalida');
      }

      $producto = new ProductoModel();
      if($producto->validate(1) and $proveedores[0]!=""){
          $producto->setData($data);
          $producto->insert();
          $producto=$producto->selectId($producto->getNombre());
          $temp["idProducto"]=$producto[0]->getId();
          if(isset($HojaSeguridad)){
            $infohoja['idProducto']=$temp["idProducto"];
            $hs = new DocumentoProductoModel();
            $hs->setData($infohoja);
            $hs->insert();

          }
          if(isset($FichaTecnica)){
            $infoficha['idProducto']= $temp["idProducto"];
            $ft = new DocumentoProductoModel();
            $ft->setData($infoficha);
            $ft->insert();
          }
          $prov = new ProveedorModel();
          $provxprod = new ProductoxProveedorModel();
          for ($i=0; $i<count($proveedores) ; $i++) {
            $proveedortemp = $prov->selectId($proveedores[$i]);
            if(count($proveedortemp) != 0){
              $temp["idProveedor"]=$proveedortemp[0]->getId();
              $temp["costo"]=$costos[$i];
              $temp["divisa"]=$divisas[$i];
              $temp["CodProd"]= $codigos[$i];
              $provxprod->setData($temp);
              $provxprod->insert();
            }
          }
          if(count($cantidades != 0)){
            //aqui se ensambla el producto
            $produ= new ProductoModel();
            $productocompuesto = new ProductoCompuestoModel();
            for ($i=0; $i<count($cantidades) ; $i++) {
              $prod = $produ->selectId($productos[$i]);
              if(count($proveedortemp) != 0){
                $temp["subproducto"]=$prod[0]->getId();
                $temp["cantidad"]=$cantidades[$i];
                $productocompuesto->setData($temp);
                var_dump($temp);
                $productocompuesto->insert();
              }
            }
          }
          $this->session->set_flashdata('message', 'Producto Agregado Congrats!!');
          redirect('Producto/index');
      }else{
        $this->nuevo();
     }


    }



}
