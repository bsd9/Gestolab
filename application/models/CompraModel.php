<?php
class CompraModel extends CI_Model {


	private $id="";
	private $idProveedor="";
	private $idCreador="";
	private $fechaCreacion="";
	private $idAprovador="";
	private $fechaAprovacion="";
	private $idExpedidor="";
	private $fechaExpedicion="";
	private $idClausurador="";
	private $fechaClausura="";
	private $estado="";
	private $divisa="";
	private $valorDivisa="";
	private $lugarEntrega="";
	private $fechaEntrega="";
	private $flete="";
	private $nacionalizacion="";
	private $aranceles="";
	private $fechapago="";
	private $diaspago="";
	private $modopago="";
	private $razonSocialProveedor="";
	private $NITProveedor="";
	private $pago= '';
	private $fechaPago= '';
	private $idPago= '';

private $observacionesCompra = '';

	function __construct()
	{
		parent::__construct();
	}

	public function setData($data)
	{
		if(isset($data['id'])){$this->id=$data['id'];}
		if(isset($data['idCreador'])){$this->idCreador=$data['idCreador'];}
		if(isset($data['fechaCreacion'])){$this->fechaCreacion=$data['fechaCreacion'];}
		if(isset($data['idAprovador'])){$this->idAprovador=$data['idAprovador'];}
		if(isset($data['fechaAprovacion'])){$this->fechaAprovacion=$data['fechaAprovacion'];}
		if(isset($data['idExpedidor'])){$this->idExpedidor=$data['idExpedidor'];}
		if(isset($data['fechaExpedicion'])){$this->fechaExpedicion=$data['fechaExpedicion'];}
		if(isset($data['idClausurador'])){$this->idClausurador=$data['idClausurador'];}
		if(isset($data['fechaClausura'])){$this->fechaClausura=$data['fechaClausura'];}
		if(isset($data['estado'])){$this->estado=$data['estado'];}
		if(isset($data['divisa'])){$this->divisa=$data['divisa'];}
		if(isset($data['valorDivisa'])){$this->valorDivisa=$data['valorDivisa'];}
		if(isset($data['lugarEntrega'])){$this->lugarEntrega=$data['lugarEntrega'];}
		if(isset($data['fechaEntrega'])){$this->fechaEntrega=$data['fechaEntrega'];}
		if(isset($data['flete'])){$this->flete=$data['flete'];}
		if(isset($data['nacionalizacion'])){$this->nacionalizacion=$data['nacionalizacion'];}
		if(isset($data['aranceles'])){$this->aranceles=$data['aranceles'];}
		if(isset($data['fechapago'])){$this->fechapago=$data['fechapago'];}
		if(isset($data['diaspago'])){$this->diaspago=$data['diaspago'];}
		if(isset($data['modopago'])){$this->modopago=$data['modopago'];}
		if(isset($data['idProveedor'])){$this->idProveedor=$data['idProveedor'];}
    if(isset($data['razonSocialProveedor'])){$this->razonSocialProveedor=$data['razonSocialProveedor'];}
		if(isset($data['NITProveedor'])){$this->NITProveedor=$data['NITProveedor'];}

  }
  public function getRazonSocialProveedor()
  {
    return $this->razonSocialProveedor;
  }

  /**
   * @param string $origenPedido
   */
  public function setRazonSocialProveedor($razonSocialProveedor)
  {
    $this->razonSocialProveedor = $razonSocialProveedor;
  }

  /**
   * @return string
   */
  public function getNITProveedor()
  {
    return $this->NITProveedor;
  }

  /**
   * @param string $origenPedido
   */
  public function setNITProveedor($NITProveedor)
  {
    $this->NITProveedor = $NITProveedor;
  }



	/**
	 * @return string
	 */
	public function getIdProveedor()
	{
		return $this->idProveedor;
	}

	/**
	 * @param string $facturaProveedor
	 */
	public function setIdProveedor($idProveedor)
	{
		$this->idProveedor = $idProveedor;
	}




	/**
	 * @return string
	 */
	public function getIdClausurador()
	{
		return $this->idClausurador;
	}

	/**
	 * @param string $idClausurador
	 */
	public function setIdClausurador($idClausurador)
	{
		$this->idClausurador = $idClausurador;
	}

	/**
	 * @return string
	 */
	public function getFechapago()
	{
		return $this->fechapago;
	}

	/**
	 * @return string
	 */
	public function getIdExpedidor()
	{
		return $this->idExpedidor;
	}

	/**
	 * @param string $idExpedidor
	 */
	public function setIdExpedidor($idExpedidor)
	{
		$this->idExpedidor = $idExpedidor;
	}

	/**
	 * @return string
	 */
	public function getFechaExpedicion()
	{
		return $this->fechaExpedicion;
	}

	/**
	 * @param string $fechaExpedicion
	 */
	public function setFechaExpedicion($fechaExpedicion)
	{
		$this->fechaExpedicion = $fechaExpedicion;
	}

	/**
	 * @param string $fechapago
	 */
	public function setFechapago($fechapago)
	{
		$this->fechapago = $fechapago;
	}

	/**
	 * @return string
	 */
	public function getDiaspago()
	{
		return $this->diaspago;
	}

	/**
	 * @param string $diaspago
	 */
	public function setDiaspago($diaspago)
	{
		$this->diaspago = $diaspago;
	}

	/**
	 * @return string
	 */
	public function getModopago()
	{
		return $this->modopago;
	}

	/**
	 * @param string $modopago
	 */
	public function setModopago($modopago)
	{
		$this->modopago = $modopago;
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

	/**
	 * @return string
	 */
	public function getIdCreador()
	{
		return $this->idCreador;
	}

	/**
	 * @param string $idCreador
	 */
	public function setIdCreador($idCreador)
	{
		$this->idCreador = $idCreador;
	}

	/**
	 * @return string
	 */
	public function getIdAprovador()
	{
		return $this->idAprovador;
	}

	/**
	 * @param string $idAprovador
	 */
	public function setIdAprovador($idAprovador)
	{
		$this->idAprovador = $idAprovador;
	}

	/**
	 * @return string
	 */
	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}

	/**
	 * @param string $fechaCreacion
	 */
	public function setFechaCreacion($fechaCreacion)
	{
		$this->fechaCreacion = $fechaCreacion;
	}

	/**
	 * @return string
	 */
	public function getFechaAprovacion()
	{
		return $this->fechaAprovacion;
	}

	/**
	 * @param string $fechaAprovacion
	 */
	public function setFechaAprovacion($fechaAprovacion)
	{
		$this->fechaAprovacion = $fechaAprovacion;
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
	public function getDivisa()
	{
		return $this->divisa;
	}

	/**
	 * @param string $divisa
	 */
	public function setDivisa($divisa)
	{
		$this->divisa = $divisa;
	}

	/**
	 * @return string
	 */
	public function getValorDivisa()
	{
		return $this->valorDivisa;
	}

	/**
	 * @param string $valorDivisa
	 */
	public function setValorDivisa($valorDivisa)
	{
		$this->valorDivisa = $valorDivisa;
	}

	/**
	 * @return string
	 */
	public function getLugarEntrega()
	{
		return $this->lugarEntrega;
	}

	/**
	 * @param string $lugarEntrega
	 */
	public function setLugarEntrega($lugarEntrega)
	{
		$this->lugarEntrega = $lugarEntrega;
	}

	/**
	 * @return string
	 */
	public function getFechaEntrega()
	{
		return $this->fechaEntrega;
	}

	/**
	 * @param string $fechaEntrega
	 */
	public function setFechaEntrega($fechaEntrega)
	{
		$this->fechaEntrega = $fechaEntrega;
	}

	/**
	 * @return string
	 */
	public function getFechaClausura()
	{
		return $this->fechaClausura;
	}

	/**
	 * @param string $fechaClausura
	 */
	public function setFechaClausura($fechaClausura)
	{
		$this->fechaClausura = $fechaClausura;
	}

	/**
	 * @return string
	 */
	public function getFlete()
	{
		return $this->flete;
	}

	/**
	 * @param string $flete
	 */
	public function setFlete($flete)
	{
		$this->flete = $flete;
	}

	/**
	 * @return string
	 */
	public function getNacionalizacion()
	{
		return $this->nacionalizacion;
	}

	/**
	 * @param string $nacionalizacion
	 */
	public function setNacionalizacion($nacionalizacion)
	{
		$this->nacionalizacion = $nacionalizacion;
	}

	/**
	 * @return string
	 */
	public function getAranceles()
	{
		return $this->aranceles;
	}

	/**
	 * @param string $aranceles
	 */
	public function setAranceles($aranceles)
	{
		$this->aranceles = $aranceles;
	}

	/**
	 * @return string
	 */
	public function getObservacionesCompra()
	{
		return $this->observacionesCompra;
	}

	/**
	 * @param string $aranceles
	 */
	public function setObservacionesCompra($observacionesCompra)
	{
		$this->observacionesCompra = $observacionesCompra;
	}


	public function insert()
	{
    $provee = new ProveedorModel();
    $prov = $provee->selectOne($this->idProveedor);
    $prov = $prov[0];
    $this->NITProveedor = $prov->getNIT();
    $this->razonSocialProveedor = $prov->getRazonSocial();
		$configuracion = new ConfiguracionModel();
		$config = $configuracion->selectOne(1);

		$this->db->set('observacionesCompra',$config->getObservacionesCompra());
		$this->db->set('idCreador',$this->idCreador);
		$this->db->set('fechaCreacion',$this->fechaCreacion);
		if($this->estado == '2'){
			$this->db->set('idExpedidor',$this->idExpedidor);
			$this->db->set('fechaExpedicion',$this->fechaExpedicion);
		}
    $this->db->set('razonSocialProveedor',$this->razonSocialProveedor);
    $this->db->set('NITProveedor',$this->NITProveedor);
		$this->db->set('idProveedor',$this->idProveedor);
		$this->db->set('estado',$this->estado);
		$this->db->set('divisa',$this->divisa);
		$this->db->set('valorDivisa',$this->valorDivisa);
		$this->db->set('lugarEntrega',$this->lugarEntrega);
		$this->db->set('fechapago',$this->fechapago);
		$this->db->set('diaspago',$this->diaspago);
		$this->db->set('modopago',$this->modopago);
		$this->db->insert('compra');
		return $this->db->insert_id();
	}

	public function update()
	{
		$configuracion = new ConfiguracionModel();
		$config = $configuracion->selectOne(1);

		$this->db->set('observacionesCompra',$config->getObservacionesCompra());
		if($this->estado == '2'){
			$this->db->set('idExpedidor',$this->idExpedidor);
			$this->db->set('fechaExpedicion',$this->fechaExpedicion);
		}
		$this->db->set('estado',$this->estado);
		$this->db->set('divisa',$this->divisa);
		$this->db->set('valorDivisa',$this->valorDivisa);
		$this->db->set('lugarEntrega',$this->lugarEntrega);
		$this->db->set('fechapago',$this->fechapago);
		$this->db->set('diaspago',$this->diaspago);
		$this->db->set('modopago',$this->modopago);
			$this->db->where("id",  $this->id);
			$this->db->where("estado", '1');
			$this->db->update('compra');
		}

	public function selectAll()
	{
		$query=$this->db->select('compra.*')
										->from('compra')
										->get();
		return $query->custom_result_object("CompraModel");
	}

	public function selectOne($id)
	{
		$query=$this->db->select('compra.* , empleado.nombre as idCreador,  sum(detallecompra.costoCalculado) as Total')
										->where("compra.id",$id)
										->from('compra')
										->join("empleado" , "empleado.id=compra.idCreador")
										->join("detallecompra" , "detallecompra.idCompra=compra.id")
										->group_by("compra.id")
										->get();
		$ans = $query->custom_result_object("CompraModel");
    if(count($ans) == 0){
      $query=$this->db->select('compra.* , empleado.nombre as idCreador, 0 as Total')
                      ->where("compra.id",$id)
                      ->from('compra')
                      ->join("empleado" , "empleado.id=compra.idCreador")
                      ->get();
      $ans = $query->custom_result_object("CompraModel");
    }
    return $ans;

	}


	public function validate()
	{
		$this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
		return $this->form_validation->run();
	}

	public function llegoBodega($id){
		$today=getdate();
		$hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
		$this->db->set('idAprobador',$this->session->userdata('id'));
		$this->db->set('fechaAprobacion',$hoy);
		$this->db->set('estado','3');
		$this->db->where("id",  $id);
		$this->db->update('compra');
	}

	public function ingresar($id){
		$today=getdate();
		$hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
		$this->db->set('fechaClausura',$hoy);
		$this->db->set('idClausurador',$this->session->userdata('id'));
			$this->db->set('estado','5');
			$this->db->where("id", $id);
			$this->db->update('compra');
	}

	public function verificar($id){
		$today=getdate();
		$hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
		$this->db->set('fechaVerificacion',$hoy);
		$this->db->set('idVerificador',$this->session->userdata('id'));
			$this->db->set('estado','4');
			$this->db->where("id", $id);
			$this->db->update('compra');
	}


  public function autorizar($id){
    $today=getdate();
    $hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
    $this->db->set('fechaExpedicion',$hoy);
    $this->db->set('idExpedidor',$this->session->userdata('id'));
      $this->db->set('estado','2');
      $this->db->where("id", $id);
      $this->db->update('compra');
  }

public function pagar($id){
	$today=getdate();
	$hoy=$today["year"] . "-" . $today["mon"]. "-" . $today["mday"] ." " . $today["hours"] . ":" . $today["minutes"] . ":". $today["seconds"];
	$this->db->set('fechaPago',$hoy);
	$this->db->set('idPago',$this->session->userdata('id'));
		$this->db->set('pago','1');
		$this->db->where("id", $id);
		$this->db->update('compra');
}


}
?>
