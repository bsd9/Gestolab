<?php
 class FacturaModel extends CI_Model {


	private $id="";
	private $idCotizacion="";
  private $idOrden="";
	private $fecha="";
	private $nota="";
	private $estado="";
  private $numero = "";
  private $direccion="";
  private $ciudad="";
  private $telefono="";
  private $razonSocial="";
  private $NIT="";
  private $retefuente="";
  private $tipoPago="";
	private $fechaPago="";
	private $diasPago="";
  private $idResolucion ="";
  private $idCreador = '';
  private $fechaAnulacion= '';
  private $idAnulador= '';
  private $fechaCancelacion= '';
  private $idCancelador= '';

  private $footerFactura = '';
  private $observacionesPreforma= '';
  private $observacionesFactura= '';

  private $logoFactura = '';
  private $razonSocialEmpresa = '';
  private $NITEmpresa = '';
  private $telefonoEmpresa = '';
  private $direccionEmpresa = '';
  private $faxEmpresa = '';
  private $correoEmpresa = '';
  private $webEmpresa = '';

  private $tipoOrigenPedido ='';
  private $origenPedido='' ;
  private $idSolicitante='' ; 
  private $fechaSolicitud='';

	function __construct()
	{
		parent::__construct();
	}

	public function setData($data)
	{
		if(isset($data['id'])){$this->id=$data['id'];}
		if(isset($data['idCotizacion'])){$this->idCotizacion=$data['idCotizacion'];}
		if(isset($data['fecha'])){$this->fecha=$data['fecha'];}
		if(isset($data['nota'])){$this->nota=$data['nota'];}
		if(isset($data['estado'])){$this->estado=$data['estado'];}
		if(isset($data['numero'])){$this->numero=$data['numero'];}
    if(isset($data['direccion'])){$this->direccion=$data['direccion'];}
    if(isset($data['ciudad'])){$this->ciudad=$data['ciudad'];}
    if(isset($data['telefono'])){$this->telefono=$data['telefono'];}
    if(isset($data['retefuente'])){$this->retefuente=$data['retefuente'];}
    if(isset($data['tipoPago'])){$this->tipoPago=$data['tipoPago'];}
    if(isset($data['fechaPago'])){$this->fechaPago=$data['fechaPago'];}
    if(isset($data['diasPago'])){$this->diasPago=$data['diasPago'];}
    if(isset($data['idResolucion'])){$this->idResolucion=$data['idResolucion'];}

    if(isset($data['idCreador'])){$this->idCreador=$data['idCreador'];}
	}

	 /**
	  * @return string
	  */
	 public function getId()
	 {
		 return $this->id;
	 }

	 /**
	  * @param string $id
	  */
	 public function setId($id)
	 {
		 $this->id = $id;
	 }


   public function getNIT(){

 	   return $this->NIT;
 	}

 	public function setNIT($NIT){

 	    $this->NIT = $NIT;
 	}


  	public function getRazonSocial()
      {
  		return mb_strtoupper($this->razonSocial);
  	}

      public function setRazonSocial($nombre)
      {
  		$this->razonSocial= mb_strtoupper($nombre);
  	}


   /**
	  * @return string
	  */
	 public function getIdCreador()
	 {
		 return $this->idCreador;
	 }

	 /**
	  * @param string $idCotizacion
	  */
	 public function setIdCreador($idCreador)
	 {
		 $this->idCreador = $idCreador;
	 }

	 /**
	  * @return string
	  */
	 public function getIdCotizacion()
	 {
		 return $this->idCotizacion;
	 }

	 /**
	  * @param string $idCotizacion
	  */
	 public function setIdCotizacion($idCotizacion)
	 {
		 $this->idCotizacion = $idCotizacion;
	 }

   public function getIdOrden()
   {
     return $this->idOrden;
   }

   /**
    * @param string $idCotizacion
    */
   public function setIdOrden($idOrden)
   {
     $this->idOrden = $idOrden;
   }

	 /**
	  * @return string
	  */
	 public function getFecha()
	 {
		 return $this->fecha;
	 }

	 /**
	  * @param string $fecha
	  */
	 public function setFecha($fecha)
	 {
		 $this->fecha = $fecha;
	 }

	 /**
	  * @return string
	  */
	 public function getNota()
	 {
		 return $this->nota;
	 }

	 /**
	  * @param string $nota
	  */
	 public function setNota($nota)
	 {
		 $this->nota = $nota;
	 }

	 /**
	  * @return string
	  */
	 public function getEstado()
	 {
		 return $this->estado;
	 }

	 /**
	  * @param string $estado
	  */
	 public function setEstado($estado)
	 {
		 $this->estado = $estado;
	 }

	 /**
	  * @return string
	  */
	 public function getNumero()
	 {
		 return $this->numero;
	 }

	 /**
	  * @param string $numero
	  */
	 public function setNumero($numero)
	 {
		 $this->numero = $numero;
	 }

   /**
 	 * @return string
 	 */
 	public function getDireccion()
 	{
 		return $this->direccion;
 	}

 	/**
 	 * @param string $direccion
 	 */
 	public function setDireccion($direccion)
 	{
 		$this->direccion = $direccion;
 	}

 	/**
 	 * @return string
 	 */
 	public function getCiudad()
 	{
 		return $this->ciudad;
 	}

 	/**
 	 * @param string $ciudad
 	 */
 	public function setCiudad($ciudad)
 	{
 		$this->ciudad = $ciudad;
 	}


  public function getTelefono()
 	{
 		return $this->telefono;
 	}

 	/**
 	 * @param string $ciudad
 	 */
 	public function setTelefono($telefono)
 	{
 		$this->telefono = $telefono;
 	}


  public function getRetefuente()
 	{
 		return $this->retefuente;
 	}

 	/**
 	 * @param string $ciudad
 	 */
 	public function setRetefuente($retefuente)
 	{
 		$this->retefuente = $retefuente;
 	}

  /**
	 * @return string
	 */
	public function getTipoPago()
	{
		return $this->tipoPago;
	}

	/**
	 * @param string $tipoPago
	 */
	public function setTipoPago($tipoPago)
	{
		$this->tipoPago = $tipoPago;
	}

	/**
	 * @return string
	 */
	public function getFechaPago()
	{
		return $this->fechaPago;
	}

	/**
	 * @param string $fechaPago
	 */
	public function setFechaPago($fechaPago)
	{
		$this->fechaPago = $fechaPago;
	}

	/**
	 * @return string
	 */
	public function getDiasPago()
	{
		return $this->diasPago;
	}

	/**
	 * @param string $diasPago
	 */
	public function setDiasPago($diasPago)
	{
		$this->diasPago = $diasPago;
  }

  /**
	 * @return string
	 */
	public function getIdResolucion()
	{
		return $this->idResolucion;
	}

	/**
	 * @param string $diasPago
	 */
	public function setIdResolucion($idResolucion)
	{
		$this->idResolucion = $idResolucion;
  }

    /**
  	 * @return string
  	 */
  	public function getFooterFactura()
  	{
  		return $this->footerFactura;
  	}

  	/**
  	 * @param string $diasPago
  	 */
  	public function setFooterFactura($footerFactura)
  	{
  		$this->footerFactura = $footerFactura;
    }

    public function getObservacionesFactura()
  		{
  		return $this->observacionesFactura;
  	}

    public function setObservacionesFactura($obersvacionesFactura)
		{
		$this->observacionesFactura=$obersvacionesFactura;
	}

	public function getObservacionesPreforma()
		{
		return $this->observacionesPreforma;
	}

		public function setObservacionesPreforma($obersvacionesPreforma)
		{
		$this->observacionesPreforma=$obersvacionesPreforma;
	}


  public function getLogoFactura()
		{
		return $this->logoFactura;
	}

		public function setLogoFactura($logoFactura)
		{
		$this->logoFactura=$logoFactura;
	}

  public function getRazonSocialEmpresa()
		{
		return $this->razonSocialEmpresa;
	}

		public function setRazonSocialEmpresa($razonSocialEmpresa)
		{
		$this->razonSocialEmpresa=$razonSocialEmpresa;
	}

  public function getNITEmpresa()
		{
		return $this->NITEmpresa;
	}

		public function setNITEmpresa($NITEmpresa)
		{
		$this->NITEmpresa=$NITEmpresa;
	}

  public function getTelefonoEmpresa()
		{
		return $this->telefonoEmpresa;
	}

		public function setTelefonoEmpresa($telefonoEmpresa)
		{
		$this->telefonoEmpresa=$telefonoEmpresa;
	}

  public function getDireccionEmpresa()
		{
		return $this->direccionEmpresa;
	}

		public function setDireccionEmpresa($direccionEmpresa)
		{
		$this->direccionEmpresa=$direccionEmpresa;
	}



  public function getCorreoEmpresa()
		{
		return $this->correoEmpresa;
	}

		public function setCorreoEmpresa($correoEmpresa)
		{
		$this->correoEmpresa=$correoEmpresa;
	}

  public function getFaxEmpresa()
		{
		return $this->faxEmpresa;
	}

		public function setFaxEmpresa($faxEmpresa)
		{
		$this->faxEmpresa=$faxEmpresa;
	}


  public function getWebEmpresa()
		{
		return $this->webEmpresa;
	}

		public function setWebEmpresa($webEmpresa)
		{
		$this->webEmpresa=$webEmpresa;
	}


	public function getTipoOrigenPedido()
	{
		return $this->tipoOrigenPedido;
	}

	/**
	 * @param string $tipoOrigenPedido
	 */
	public function setTipoOrigenPedido($tipoOrigenPedido)
	{
		$this->tipoOrigenPedido = $tipoOrigenPedido;
	}

	/**
	 * @return string
	 */
	public function getOrigenPedido()
	{
		return $this->origenPedido;
	}

	/**
	 * @param string $origenPedido
	 */
	public function setOrigenPedido($origenPedido)
	{
		$this->origenPedido = $origenPedido;
	}

	public function insert($id)
	{

    $this->load->model('ConfiguracionModel');
    $configuracion = new ConfiguracionModel();
    $config = $configuracion->selectOne(1);

    $this->load->model('EstablecimientoComercialModel');
    $estableci = new EstablecimientoComercialModel();
    $estableci = $estableci->selectOne(1);

    $this->load->model('ResolucionFacturaModel');
    $resolucion = new ResolucionFacturaModel();
    $resolution = $resolucion->ResolucionUsada($estableci[0]->getId());
    $this->idResolucion = $resolution->id;

    $this->load->model('OrdenesModel');
    $ordenes = new OrdenesModel();
    $ordenes = $ordenes->selectOne($id);

    $this->load->model('ClienteModel');
    $cliente = new ClienteModel();
    $cliente = $cliente->selectOne($ordenes[0]->getIdCliente());

    $this->load->model('SolicitudModel');
    $solicitud = new SolicitudModel();
    $solicitud = $solicitud->selectOneOrden($id);



    $this->load->model('GrupoEmpresarialModel');
    $establecimiento = new EstablecimientoComercialModel();
    $empresa = new GrupoEmpresarialModel();
    $estable = $establecimiento->selectOne($estableci[0]->getId());
    $emp = $empresa->selectOne($estable[0]->getIdGrupoEmpresarial());

    $this->db->set('logoFactura',$estable[0]->getLogoFacturacion());
    $this->db->set('razonSocialEmpresa',$emp[0]->getRazonSocial());
    $this->db->set('NITEmpresa',$emp[0]->getNIT());
    $this->db->set('telefonoEmpresa',$emp[0]->getTelefono());
    $this->db->set('direccionEmpresa',$emp[0]->getDireccion());
    $this->db->set('faxEmpresa',$emp[0]->getFax());
    $this->db->set('correoEmpresa',$emp[0]->getCorreo());
    $this->db->set('webEmpresa',$emp[0]->getWeb());
    $this->db->set('footerFactura',$config->getFooterFactura());
    $this->db->set('observacionesPreforma',$config->getObservacionesPreforma());
    $this->db->set('observacionesFactura',$config->getObservacionesFactura());
    $this->db->set('tipoPago',$this->tipoPago);
		$this->db->set('fechaPago',$this->fechaPago);
		$this->db->set('diasPago',$this->diasPago);
    $this->db->set('idOrden',$id);
		$this->db->set('idCotizacion',$solicitud[0]->getIdCotizacion());
    $this->db->set('direccion',$cliente[0]->getDireccion());
    $this->db->set('ciudad',$cliente[0]->getCiudad());
    $this->db->set('razonSocial',$cliente[0]->getRazonSocial());
    $this->db->set('NIT',$cliente[0]->getNIT());
		$this->db->set('nota',$this->nota);
		$this->db->set('telefono', $cliente[0]->getTelefono());
		$this->db->set('retefuente',$this->retefuente);
		$this->db->set('idResolucion',$this->idResolucion);
		$this->db->set('estado', 0);
		$this->db->insert('factura');

		return $this->db->insert_id();
	}

  public function createFactura(){
    $this->load->model('ResolucionFacturaModel');
    $resolucion = new ResolucionFacturaModel();

    $numero=$resolucion->proximaFactura($this->idResolucion);
    $this->db->set('idCreador',$this->session->userdata('id'));
    $this->db->set('numero',$numero->ultimo + 1);
    $this->db->where('idCotizacion',$this->idCotizacion);
    $this->db->update('factura');
  }

	public function update()
	{

      $this->load->model('GrupoEmpresarialModel');
    $configuracion = new ConfiguracionModel();
    $config = $configuracion->selectOne(1);
    $factura = new FacturaModel();
    $fact = $factura->selectOne($this->idCotizacion);



    $establecimiento = new EstablecimientoComercialModel();
    $estable = $establecimiento->selectOne($fact[0]->getIdResolucion());
    $empresa = new GrupoEmpresarialModel();

    $emp = $empresa->selectOne($estable[0]->getIdGrupoEmpresarial());

    $this->db->set('logoFactura',$estable[0]->getLogoFacturacion());
    $this->db->set('razonSocialEmpresa',$emp[0]->getRazonSocial());
    $this->db->set('NITEmpresa',$emp[0]->getNIT());
    $this->db->set('telefonoEmpresa',$emp[0]->getTelefono());
    $this->db->set('direccionEmpresa',$emp[0]->getDireccion());
    $this->db->set('faxEmpresa',$emp[0]->getFax());
    $this->db->set('correoEmpresa',$emp[0]->getCorreo());
    $this->db->set('webEmpresa',$emp[0]->getWeb());

    $this->db->set('footerFactura',$config->getFooterFactura());
    $this->db->set('observacionesPreforma',$config->getObservacionesPreforma());
    $this->db->set('observacionesFactura',$config->getObservacionesFactura());
    $this->db->set('tipoPago',$this->tipoPago);
    $this->db->set('fechaPago',$this->fechaPago);
    $this->db->set('diasPago',$this->diasPago);
    $this->db->set('idCotizacion',$this->idCotizacion);
    $this->db->set('direccion',$this->direccion);
    $this->db->set('ciudad',$this->ciudad);
		$this->db->set('telefono',$this->telefono);
		$this->db->set('nota',$this->nota);
		$this->db->set('retefuente',$this->retefuente);
			$this->db->where('idCotizacion',$this->idCotizacion);
			$this->db->update('factura');
		}

	public function selectAll()
	{
		$query=$this->db->select('factura.*
                              ')
										->from('factura')
                    ->join("cotizacion" , "factura.idCotizacion=pedido.id")
                    ->join("ciudad" , "ciudad.id=factura.ciudad")
										->get();
		return $query->custom_result_object("FacturaModel");
	}

	public function selectOne($id)
	{
    $query=$this->db->select("factura.* ,
                              ciudad.nombre as ciudad,
                              ordenes.razonSocialCliente as RazonSocial,
                              resolucionfactura.prefijo as prefijo,
                              resolucionfactura.resolucion as resolucion,
                              resolucionfactura.fechaExpedicion as fechaResolucion,
                              resolucionfactura.desde as desdeResolucion,
                              resolucionfactura.hasta as hastaResolucion,
                              resolucionfactura.fechaVencimiento as fechaVencimiento,
                              cotizacion.fecha as fechaCotizacion,
                              resolucionfactura.idEstablecimiento as idResolucion,
                              DATE_FORMAT(factura.fecha,'%Y-%m-%d') as fecha,
                              DATE_FORMAT(factura.fechaPago,'%Y-%m-%d') as fechaPago
                              ")
										->where("factura.idCotizacion",$id)
                    ->from('factura')
                    ->join("cotizacion" , "factura.idCotizacion=cotizacion.id")
                    ->join("ciudad" , "ciudad.id=factura.ciudad")
                    ->join("resolucionfactura" , "resolucionfactura.id=factura.idResolucion")
                    ->join("ordenes", "ordenes.id = factura.idOrden")
										->get();
		return $query->custom_result_object("FacturaModel");
	}


	public function validate()
	{
		$this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
		return $this->form_validation->run();
	}

	public function anular($id){
$today=getdate();
    $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];

    $this->db->set('fechaAnulacion','1');
    $this->db->set('idAnulador',$this->session->userdata('id'));
		$this->db->set('estado','1');
		$this->db->where("id",  $id);
		$this->db->update('factura');
	}

	public function cancelar($id){
    $today=getdate();
    $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];

      $this->db->set('fechaCancelacion','1');
      $this->db->set('idCancelador',$this->session->userdata('id'));
			$this->db->set('estado','2');
			$this->db->where("id", $id);
			$this->db->update('factura');
	}


  public function aprobar($id,$fechaPago,$flete,$nota,$retefuente,$tipoPago){
    $today=getdate();
    $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
    $this->load->model('FacturaModel');
    $facturaModel = new FacturaModel();
    $factura = $facturaModel->selectOne($id);


    //$this->load->model('EnvioModel');
    //$envioModel = new EnvioModel();
    //$envio = $envioModel->selectOne($id);
    //if(count($envio) == 1){
      //$envio[0]->setGastos($flete);
      //$envio[0]->updateGasto();
    //}

    if(count($factura) == 1){

      $today=getdate();
      $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
      $this->db->set('retefuente',$retefuente);
      $this->db->set('nota',$nota);
      $this->db->set('tipoPago',$tipoPago);
      $this->db->set('fechaPago',$fechaPago);
      $this->db->set('fecha',$hoy);
      $this->db->set('estado','3');
      $this->db->where("idCotizacion",  $id);
      $this->db->update('factura');

      $factura[0]->createFactura();

      $CotizacionModel = new CotizacionModel();
      $cotizacion = $CotizacionModel->selectOne($id);
      $cotizacion[0]->updateCotizacion($id);


      }
    }


  public function actualizarIdCotizacion($id,$idCliente){

      $query=$this->db->select('equipo.*')
                      ->from('equipo')
                      ->join('laboratorio','laboratorio.id = equipo.idLaboratorio')
                      ->where("laboratorio.idCliente",$idcliente)
                      ->get();
      $afectados = $query->custom_result_object("EquipoModel");
      $idequipo = [];
      foreach ($afectados as  $equipo) {
        $idequipo[] = $equipo->getId();
      }

      $this->db->set('idCotizacion',$id);
      $this->db->where(['idCotizacion' => NULL]);
      $this->db->where('solicitud.valor !=', 0);
      $this->db->where_in('solicitud.idEquipo', $idequipo);
      $this->db->update('solicitud');


  }

  	public function anularFactura($id,$razon){
	$today=getdate();
	$hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
	  $this->db->set('estado','0');
	$this->db->where("id",  $id);
	$this->db->update('cotizacion');

		$this->db->set('razonAnulacion',$razon);
		$this->db->set('fechaAnulacion',$hoy);
		$this->db->set('estado','1');
		$this->db->where("idCotizacion",  $id);
		$this->db->update('factura');
 

  }

  public function enviarAprobar($id){
	$today=getdate();
	$hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
$this->db->set('tipoOrigenPedido',$this->tipoOrigenPedido);
$this->db->set('origenPedido',$this->origenPedido);
	$this->db->set('idSolicitante',$this->session->userdata('id'));
	$this->db->set('fechaSolicitud',$hoy);
	$this->db->set('estado','2');
	$this->db->where("idCotizacion",  $id);
	$this->db->update('factura');

	$this->db->set('estado','2');
	$this->db->where("id",  $id);
	$this->db->update('cotizacion');
}


}
?>
