<?php
class LoteModel extends CI_Model {

	private $id="";
	private $numero="";
	private $idDetalleCompra="";
	private $fechaRecepcion="";
	private $fechaVencimiento="";
	private $certificadoAnalisis="";
  private $estado="";
  private $cantidad="";
  private $costoReal="";
  private $idFactura = '';
  private $idProducto = '';
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->numero=$data['numero'];
		$this->idDetalleCompra=$data['idDetalleCompra'];
		$this->fechaRecepcion=$data['fechaRecepcion'];
    $this->fechaVencimiento=$data['fechaVencimiento'];
    if(isset($data['certificadoAnalisis'])){$this->certificadoAnalisis=$data['certificadoAnalisis'];}
    if(isset($data['estado'])){$this->estado=$data['estado'];}
    $this->cantidad=$data['cantidad'];
		if(isset($data['costoReal'])){$this->costoReal=$data['costoReal'];}
		$this->idFactura=$data['idFactura'];
		$this->idProducto=$data['idProducto'];

  }


  /**
	 * @return string
	 */
	public function getIdProducto()
	{
		return $this->idProducto;
	}

	/**
	 * @param string $numero
	 */
	public function setIdProducto($idProducto)
	{
		$this->idProducto = $idProducto;
	}

	/**
	 * @return string
	 */
	public function getIdFactura()
	{
		return $this->idFactura;
	}

	/**
	 * @param string $numero
	 */
	public function setIdFactura($idFactura)
	{
		$this->idFactura = $idFactura;
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
	public function getIdDetalleCompra()
	{
		return $this->idDetalleCompra;
	}

	/**
	 * @param string $idDetalleCompra
	 */
	public function setIdDetalleCompra($idDetalleCompra)
	{
		$this->idDetalleCompra = $idDetalleCompra;
	}

	/**
	 * @return string
	 */
	public function getFechaRecepcion()
	{
		return $this->fechaRecepcion;
	}

	/**
	 * @param string $fechaRecepcion
	 */
	public function setFechaRecepcion($fechaRecepcion)
	{
		$this->fechaRecepcion = $fechaRecepcion;
	}

	/**
	 * @return string
	 */
	public function getFechaVencimiento()
	{
		return $this->fechaVencimiento;
	}

	/**
	 * @param string $fechaVencimiento
	 */
	public function setFechaVencimiento($fechaVencimiento)
	{
		$this->fechaVencimiento = $fechaVencimiento;
	}

	/**
	 * @return string
	 */
	public function getCertificadoAnalisis()
	{
		return $this->certificadoAnalisis;
	}

	/**
	 * @param string $certificadoAnalisis
	 */
	public function setCertificadoAnalisis($certificadoAnalisis)
	{
		$this->certificadoAnalisis = $certificadoAnalisis;
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
	public function getCostoReal()
	{
		return $this->costoReal;
	}

	/**
	 * @param string $costoReal
	 */
	public function setCostoReal($costoReal)
	{
		$this->costoReal = $costoReal;
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

    public function insert()
    	{

          $prodmodel = new ProductoModel();
          $prod = $prodmodel->selectOne($this->idProducto);
          $this->db->set('cantidadEntrada', $prod->getCantidadEntrada());
        $this->db->set('numero', $this->numero);
        $this->db->set('idProducto', $this->idProducto);
	      $this->db->set('idDetalleCompra', $this->idDetalleCompra);
        $this->db->set('fechaRecepcion', $this->fechaRecepcion);
        $this->db->set('fechaVencimiento', $this->fechaVencimiento);
        $this->db->set('certificadoAnalisis', $this->certificadoAnalisis);
        $this->db->set('estado', $this->estado);
        $this->db->set('cantidad', $this->cantidad);
				$this->db->set('idFactura', $this->idFactura);
        $this->db->set('costoReal', 0);
				$this->db->where('id', $this->id);
        $this->db->insert('lote');
    	}

			public function update()
				{
          $this->db->set('numero', $this->numero);
          $this->db->set('fechaRecepcion', $this->fechaRecepcion);
          $this->db->set('fechaVencimiento', $this->fechaVencimiento);
          $this->db->set('certificadoAnalisis', $this->certificadoAnalisis);
          $this->db->set('estado', $this->estado);
          $this->db->set('cantidad', $this->cantidad);
					$this->db->where('id', $this->id);
					$this->db->update('lote');
				}

        public function updateCosto()
  				{
            $this->db->set('costoReal', $this->costoReal);
  					$this->db->update('lote');
  				}

      public function selectAll()
      {
    		$query=$this->db->select('lote.*,((lote.cantidad * lote.cantidadEntrada)/producto.cantidadEntrada) as cantidad,producto.codigoInterno as codigoInterno, producto.nombre as nombreProducto, detallecompra.idCompra as origen,"Entrada" as tipoOrigen,  Salida.nombre as presentacionSalida')
												->from('lote')
												->join("detallecompra","detallecompra.id=lote.idDetalleCompra")
												->join("producto","detallecompra.idProducto=producto.id")
                        ->join("unidadempaque as Salida","producto.presentacionEntrada=Salida.id")
												->get();
    		$ans1 = $query->custom_result_object("LoteModel");
				$id = [-1];
				foreach ($ans1 as  $p) {
					$id[] = $p->getId();
				}
				$query=$this->db->select('lote.*,((lote.cantidad * lote.cantidadEntrada)/producto.cantidadEntrada) as cantidad,producto.codigoInterno as codigoInterno,producto.nombre as nombreProducto, "--" as origen,"Entrada" as tipoOrigen,  Salida.nombre as presentacionSalida')
												->join("producto","producto.id=lote.idProducto")
                        ->join("unidadempaque as Salida","producto.presentacionEntrada=Salida.id")
												->from('lote')
												->where_not_in('lote.id',$id )
												->get();
				$ans2 = $query->custom_result_object("LoteModel");
					$ans = array_merge($ans1, $ans2);

					$query=$this->db->select('lote.*, (lotexpedido.cantidad * lotexpedido.cantidadSalida / producto.cantidadSalida) as cantidad,producto.codigoInterno as codigoInterno,producto.nombre as nombreProducto, detallepedido.idPedido as origen,"Salida" as tipoOrigen,  Salida.nombre as presentacionSalida ')
													->from('lotexpedido')
													->join("lote","lote.id=lotexpedido.idLote")
													->join("producto","producto.id=lotexpedido.idProducto")
													->join("detallepedido","detallepedido.id=lotexpedido.idDetallePedido")
	                        ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
													->get();
					$ans3 = $query->custom_result_object("LoteModel");
					$ans = array_merge($ans, $ans3);
					$query=$this->db->select('lote.*, (muestraxlote.cantidad * muestraxlote.cantidadSalida / producto.cantidadSalida) as cantidad,producto.codigoInterno as codigoInterno,producto.nombre as nombreProducto, muestra.idGrupo as origen,"Salida" as tipoOrigen,  Salida.nombre as presentacionSalida ')
													->from('muestraxlote')
													->join("lote","lote.id=muestraxlote.idLote")
													->join("producto","producto.id=muestraxlote.idProducto")
													->join("muestra","muestra.id=muestraxlote.idMuestra")
	                        ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
													->get();
					$ans3 = $query->custom_result_object("LoteModel");
					$ans = array_merge($ans, $ans3);
					return $ans;
      }

public function CostosInventario($fechaini, $fechafin){
  $query=$this->db->select('lote.*,((lote.cantidad * lote.cantidadEntrada)/producto.cantidadSalida) as cantidad,producto.codigoInterno as codigoInterno,producto.nombre as nombreProducto, Salida.nombre as presentacionSalida')
                  ->join("producto","producto.id=lote.idProducto")
                  ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
                  ->where("lote.fechaRecepcion <",$fechafin)
                  ->from('lote')
                  ->order_by('nombreProducto', 'ASC')
                  ->get();
  $ans1 = $query->custom_result_object("LoteModel");

    $query=$this->db->select('lote.*, sum((lotexpedido.cantidad * lotexpedido.cantidadSalida / producto.cantidadSalida)) as cantidad, Salida.nombre as presentacionSalida  ')
                    ->from('lotexpedido')
                    ->join("lote","lote.id=lotexpedido.idLote")
                    ->join("producto","producto.id=lote.idProducto")
                    ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
                    ->join("detallepedido","lotexpedido.idDetallePedido = detallepedido.id")
                    ->join("envio","envio.idPedido = detallepedido.idPedido")
                    ->where("envio.fechaEnvio <",$fechafin)
                    ->group_by("lote.id")
                    ->get();
    $ans2 = $query->custom_result_object("LoteModel");

    $query=$this->db->select('lote.*, sum((muestraxlote.cantidad * muestraxlote.cantidadSalida / producto.cantidadSalida)) as cantidad, Salida.nombre as presentacionSalida  ')
                    ->from('muestraxlote')
                    ->join("lote","lote.id=muestraxlote.idLote")
                    ->join("producto","producto.id=lote.idProducto")
                    ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
                    ->join("muestra","muestra.id=muestraxlote.idMuestra")
                    ->join("grupomuestras","grupomuestras.id=muestra.idGrupo")
                    ->where("grupomuestras.fechaEjecucion <",$fechafin)
                    ->group_by("lote.id")
                    ->get();
    $ans3 = $query->custom_result_object("LoteModel");
    $ans2 = array_merge($ans2,$ans3);
    $ans =[];
    foreach ($ans1 as $lote) {
      foreach ($ans2 as $negalote) {
        if($lote->getId() == $negalote->getId()){
          $lote->setCantidad($lote->getCantidad() - $negalote->getCantidad());
        }
      }
      if($lote->getCantidad() != 0){
        $ans[] = $lote;
				if($lote->getCostoReal() == 0){
          $idCompra = $lote->getIdDetalleCompra();
					$query=$this->db->select('((detallecompra.costoCalculado / detallecompra.cantidad) / detallecompra.cantidadEntrada) as costo')
                          ->where("detallecompra.id",$idCompra)
                          ->from('detallecompra')
                          ->get();
          $respond = $query->result();
          if(count($respond) != 0){
            $lote->CostoFinal = $respond[0]->costo * $lote->getCantidad();
          }else {
            $lote->CostoFinal = "Imposible de calcular";
          }
				}else {
							$lote->CostoFinal = ($lote->getCostoReal() / $lote->cantidadEntrada) * $lote->getCantidad();
				}
      }
    }
  return $ans;
}


			public function Inventario()
      {

				$query=$this->db->select('lote.*,((lote.cantidad * lote.cantidadEntrada)/producto.cantidadSalida) as cantidad,producto.codigoInterno as codigoInterno,producto.nombre as nombreProducto, Salida.nombre as presentacionSalida')
												->join("producto","producto.id=lote.idProducto")
                        ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
												->from('lote')
												->order_by('nombreProducto', 'ASC')
												->get();
				$ans1 = $query->custom_result_object("LoteModel");


					$query=$this->db->select('lote.*, sum((lotexpedido.cantidad * lotexpedido.cantidadSalida / producto.cantidadSalida)) as cantidad, Salida.nombre as presentacionSalida  ')
													->from('lotexpedido')
													->join("lote","lote.id=lotexpedido.idLote")
													->join("producto","producto.id=lote.idProducto")
	                        ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
													->group_by("lote.id")
													->get();
					$ans2 = $query->custom_result_object("LoteModel");

					$query=$this->db->select('lote.*, sum((muestraxlote.cantidad * muestraxlote.cantidadSalida / producto.cantidadSalida)) as cantidad, Salida.nombre as presentacionSalida  ')
													->from('muestraxlote')
													->join("lote","lote.id=muestraxlote.idLote")
													->join("producto","producto.id=lote.idProducto")
	                        ->join("unidadempaque as Salida","producto.presentacionSalida=Salida.id")
													->group_by("lote.id")
													->get();
					$ans3 = $query->custom_result_object("LoteModel");
					$ans2 = array_merge($ans2,$ans3);
					$ans =[];
					foreach ($ans1 as $lote) {
          	foreach ($ans2 as $negalote) {
          		if($lote->getId() == $negalote->getId()){
          			$lote->setCantidad($lote->getCantidad() - $negalote->getCantidad());
          		}
          	}
						if($lote->getCantidad() != 0){
							$ans[] = $lote;
						}
          }
          return $ans;
      }



      public function selectOne($id)
      {
    		$query=$this->db->select('*, sum(cantidad) as Total')
                        ->where("idDetalleCompra",$id)
                        ->from('lote')
												->group_by("idDetalleCompra")
                        ->get();
    		return $query->custom_result_object("LoteModel");
      }


			public function selectFactura($id)
      {
    		$query=$this->db->select('*')
                        ->where("idFactura",$id)
                        ->from('lote')
                        ->get();
    		return $query->custom_result_object("LoteModel");
      }

			public function selectLotesxProductos($id){
				$query=$this->db->select('lote.*,((lote.cantidad * lote.cantidadEntrada)/producto.cantidadSalida) as cantidad,producto.codigoInterno as codigoInterno,producto.nombre as nombreProducto')
												->join("producto","producto.id=lote.idProducto")
												->from('lote')
												->get();
				$ans1 = $query->custom_result_object("LoteModel");


					$query=$this->db->select('lote.*, sum((lotexpedido.cantidad * lotexpedido.cantidadSalida / producto.cantidadSalida)) as cantidad  ')
													->from('lotexpedido')
													->join("lote","lote.id=lotexpedido.idLote")
													->join("producto","producto.id=lote.idProducto")
													->group_by("lote.id")
													->get();
					$ans2 = $query->custom_result_object("LoteModel");

					$query=$this->db->select('lote.*, sum((muestraxlote.cantidad * muestraxlote.cantidadSalida / producto.cantidadSalida)) as cantidad  ')
													->from('muestraxlote')
													->join("lote","lote.id=muestraxlote.idLote")
													->join("producto","producto.id=lote.idProducto")
													->group_by("lote.id")
													->get();
					$ans3 = $query->custom_result_object("LoteModel");
					$ans2= array_merge($ans2, $ans3);
					$ans =[];
					foreach ($ans1 as $lote) {
						foreach ($ans2 as $negalote) {
							if($lote->getId() == $negalote->getId()){
								$lote->setCantidad($lote->getCantidad() - $negalote->getCantidad());
							}
						}
						if($lote->getCantidad() != 0 and $lote->getIdProducto() == $id){
							$ans[] = $lote;
						}
					}
					return $ans;
			}

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
