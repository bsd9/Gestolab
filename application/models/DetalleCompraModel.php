<?php
class DetalleCompraModel extends CI_Model {

	private $id="";
	private $idCompra="";
	private $idProducto="";
	private $cantidad="";
	private $precioUnitario="";
	private $descuento ="";
	private $costoCalculado = "";
  private $nombreProducto="";
	private $codigoProducto="";
	private $marcaProducto="";
	private $ivaProducto="";
	private $tipoProducto="";
	private $unidadMedida = "";
	private $cantidadEntrada = "";
	private $presentacionEntrada = "";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->idProducto=$data['idProducto'];
		$this->idCompra=$data['idCompra'];
		$this->cantidad=$data['cantidad'];
		$this->precioUnitario=$data['precioUnitario'];
		$this->descuento=$data['descuento'];
		$this->costoCalculado=$data['costoCalculado'];

		$this->unidadMedida=$data['unidadMedida'];
		$this->presentacionSalida=$data['presentacionSalida'];
		$this->cantidadSalida=$data['cantidadSalida'];

		$this->nombreProducto=$data['nombreProducto'];
		$this->codigoProducto=$data['codigoProducto'];
		$this->marcaProducto=$data['marcaProducto'];
		$this->ivaProducto=$data['ivaProducto'];
		$this->tipoProducto=$data['tipoProducto'];
  }

  public function getNombreProducto()
	{
		return $this->nombreProducto;
	}

	/**
	 * @param string $nombreProducto
	 */
	public function setNombreProducto($nombreProducto)
	{
		$this->nombreProducto = $nombreProducto;
	}

	/**
	 * @return string
	 */
	public function getCodigoProducto()
	{
		return $this->codigoProducto;
	}

	/**
	 * @param string $codigoProducto
	 */
	public function setCodigoProducto($codigoProducto)
	{
		$this->codigoProducto = $codigoProducto;
	}

	/**
	 * @return string
	 */
	public function getMarcaProducto()
	{
		return $this->marcaProducto;
	}

	/**
	 * @param string $marcaProducto
	 */
	public function setMarcaProducto($marcaProducto)
	{
		$this->marcaProducto = $marcaProducto;
	}

	/**
	 * @return string
	 */
	public function getIvaProducto()
	{
		return $this->ivaProducto;
	}

	/**
	 * @param string $ivaProducto
	 */
	public function setIvaProducto($ivaProducto)
	{
		$this->ivaProducto = $ivaProducto;
	}

	/**
	 * @return string
	 */
	public function getTipoProducto()
	{
		return $this->tipoProducto;
	}

	/**
	 * @param string $tipoProducto
	 */
	public function setTipoProducto($tipoProducto)
	{
		$this->tipoProducto = $tipoProducto;
	}


  	/**
  	 * @return string
  	 */
  	public function getUnidadMedida()
  	{
  		return $this->unidadMedida;
  	}

  	/**
  	 * @param string $unidadMedida
  	 */
  	public function setUnidadMedida($unidadMedida)
  	{
  		$this->unidadMedida = $unidadMedida;
  	}

  	/**
  	 * @return string
  	 */
  	public function getPresentacionEntrada()
  	{
  		return $this->presentacionEntrada;
  	}

  	/**
  	 * @param string $presentacionEntrada
  	 */
  	public function setPresentacionEntrada($presentacionEntrada)
  	{
  		$this->presentacionEntrada = $presentacionEntrada;
  	}

  	/**
  	 * @return string
  	 */
  	public function getCantidadEntrada()
  	{
  		return $this->cantidadEntrada;
  	}

  	/**
  	 * @param string $presentacionEntrada
  	 */
  	public function setCantidadEntrada($cantidadEntrada)
  	{
  		$this->cantidadEntrada = $cantidadEntrada;
  	}


	/**
	 * @return string
	 */
	public function getIdCompra()
	{
		return $this->idCompra;
	}

	/**
	 * @param string $id
	 */
	public function setIdCompra($idCompra)
	{
		$this->idCompra = $idCompra;
	}

	/**
	 * @return string
	 */
	public function getDescuento()
	{
		return $this->descuento;
	}

	/**
	 * @param string $id
	 */
	public function setDescuento($descuento)
	{
		$this->descuento = $descuento;
	}

	/**
		 * @return string
		 */
		public function getCostoCalculado()
		{
			return $this->costoCalculado;
		}

		/**
		 * @param string $id
		 */
		public function setCostoCalculado($costoCalculado)
		{
			$this->costoCalculado = $costoCalculado;
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
	public function getIdProducto()
	{
		return $this->idProducto;
	}

	/**
	 * @param string $idProducto
	 */
	public function setIdProducto($idProducto)
	{
		$this->idProducto = $idProducto;
	}

	/**
	 * @return string
	 */
	public function getCantidad()
	{
		return $this->cantidad;
	}

	/**
	 * @param string $cantidad
	 */
	public function setCantidad($cantidad)
	{
		$this->cantidad = $cantidad;
	}

	/**
	 * @return string
	 */
	public function getPrecioUnitario()
	{
		return $this->precioUnitario;
	}

	/**
	 * @param string $precio
	 */
	public function setPrecioUnitario($precio)
	{
		$this->precioUnitario = $precio;
	}

    public function insert()
    	{

$producto = new ProductoModel();
$prod = $producto->selectOne($this->idProducto);

			$this->unidadMedida = $prod->getUnidadMedida();
			$this->presentacionEntrada = $prod->getPresentacionEntrada();
			$this->cantidadEntrada = $prod->getCantidadEntrada();

        $this->db->set('nombreProducto',$this->nombreProducto);
        $this->db->set('codigoProducto',$this->codigoProducto);
        $this->db->set('marcaProducto',$this->marcaProducto);
        $this->db->set('ivaProducto',$this->ivaProducto);
        $this->db->set('tipoProducto',$this->tipoProducto);

        $this->db->set('unidadMedida', $this->unidadMedida);
        $this->db->set('presentacionEntrada', $this->presentacionEntrada);
        $this->db->set('cantidadEntrada', $this->cantidadEntrada);

        $this->db->set('idProducto', $this->idProducto);
				$this->db->set('idCompra', $this->idCompra);
				$this->db->set('cantidad', $this->cantidad);
				$this->db->set('precioUnitario', $this->precioUnitario);
				$this->db->set('descuento', $this->descuento);
				$this->db->set('costoCalculado', $this->costoCalculado);
        $this->db->insert('detallecompra');
    	}


      public function selectAll()
      {
				$query=$this->db->select('detallecompra.*, producto.nombre as idProducto,
																	Entrada.nombre as presentacionEntrada,
																	unidadmedida.nombre as unidadMedida')
                        ->from('detallecompra')
                        ->join("producto","producto.id=detallecompra.idProducto")
												->join("unidadmedida","detallecompra.unidadMedida=unidadmedida.id")
												->join("unidadempaque as Entrada","detallecompra.presentacionEntrada=Entrada.id")
                        ->get();
    		return $query->custom_result_object("DetalleCompraModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('detallecompra.*,
																	Entrada.nombre as presentacionEntrada,
																	unidadmedida.nombre as unidadMedida')
                        ->where("idCompra",$id)
                        ->from('detallecompra')
												->join("unidadmedida","detallecompra.unidadMedida=unidadmedida.id")
												->join("unidadempaque as Entrada","detallecompra.presentacionEntrada=Entrada.id")
                        ->get();
    		return $query->custom_result_object("DetalleCompraModel");
      }
			public function deleteDetallesCompra($id)
			{
				$query=$this->db->where("idCompra",$id)
												->delete('detallecompra');
			}

}
?>
