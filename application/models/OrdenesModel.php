<?php
class OrdenesModel extends CI_Model {


	private $id="";
	private $idCliente="";
	private $idCreador="";
	private $fechacreacion="";
	private $estado="";
	private $razonSocialcliente="";
	private $clienteNIT="";
	private $Notas ="";
	private $fechaAprobacion="";

	function __construct()
	{
		parent::__construct();
	}

	public function setData($data)
	{
		if(isset($data['id'])){$this->id=$data['id'];}
		if(isset($data['idCliente'])){$this->idCliente=$data['idCliente'];}
		if(isset($data['idCreador'])){$this->idCreador=$data['idCreador'];}
		if(isset($data['fechacreacion'])){$this->fechacreacion=$data['fechacreacion'];}
		if(isset($data['estado'])){$this->estado=$data['estado'];}
		if(isset($data['razonSocialcliente'])){$this->razonSocialcliente=$data['razonSocialcliente'];}
		}



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



	public function setIdCreador($idCreador)
	{
		$this->idCreador = $idCreador;
	}

	/**
	 * @return string
	 */
	public function getIdCliente()
	{
		return $this->idCliente;
	}

	/**
	 * @param string $idCliente
	 */
	public function setIdCliente($idCliente)
	{
		$this->idCliente = $idCliente;
	}

	/**
	 * @return string
	 */
	public function getFechaCreacion()
	{
		return $this->fechacreacion;
	}


	public function setFechaCreacion($fechacreacion)
	{
		$this->fechacreacion = $fechacreacion;
	}




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

	public function getNotas()
	{
		return $this->Notas;
	}

	/**
	 * @param string $notas
	 */
	public function setNotas($Notas)
	{
		$this->Notas = $Notas ;
	}




		/**
		 * @return string
		 */
		public function getRazonSocialCliente()
		{
			return $this->razonSocialcliente;
		}

		/**
		 * @param string $origenPedido
		 */
		public function setRazonSocialCliente($razonSocialcliente)
		{
			$this->razonSocialcliente = $razonSocialcliente;
		}

		public function getFechaAprobacion()
		{
			return $this->fechaAprobacion;
		}
	
	
		public function setFechaAprobacion($fechaAprobacion)
		{
			$this->fechaAprobacion = $fechaAprobacion;
		}


	public function insert()
	{


		$this->db->set('idCreador',$this->idCreador);
		$this->db->set('razonSocialcliente',$this->razonSocialcliente);
		$this->db->set('idCliente',$this->idCliente);
		$this->db->set('fechacreacion',$this->fechacreacion);
        $this->db->set('estado',$this->estado);
		

		$this->db->insert('ordenes');
		return $this->db->insert_id();
	}

	public function update()
	{

		$this->db->set('idCreador',$this->idCreador);
		$this->db->set('razonSocialcliente',$this->razonSocialcliente);
		$this->db->set('idCliente',$this->idCliente);
		$this->db->set('fechacreacion',$this->fechacreacion);
        $this->db->set('estado',$this->estado);
		$this->db->set('fechaAprobacion',$this->fechaAprobacion);


			$this->db->where("id",  $this->id);
			$this->db->update('ordenes');
		}

		public function updateAprobar()
	{

			$this->db->set('estado',$this->estado);
			$this->db->where("id",  $this->id);
			$this->db->set('fechaAprobacion',$this->fechaAprobacion);
			$this->db->update('ordenes');
		}


		
		public function updateNotas($id)
	{

			$this->db->set('Notas',$this->Notas);
			$this->db->where("id",  $this->id);
			$this->db->update('ordenes');
		}

public function selectAll($id)
	{
		$query=$this->db->select('ordenes.*
															')
										->from('ordenes')
										->where("idCliente", $id)
										->get();
		$ans1 = $query->custom_result_object("OrdenesModel");

		return $ans1;

	}

	
public function selectAllNueva($id)
{
	$query=$this->db->select('ordenes.*
														')
									->from('ordenes')
									->where("idCliente", $id)
									->where('ordenes.estado', 1)
									->get();
	$ans1 = $query->custom_result_object("OrdenesModel");

	return $ans1;

}

	public function selectAllAdmin()
	{
		$query=$this->db->select('ordenes.*
															')
										->from('ordenes')
										->where('ordenes.estado', 1)
										->get();
		$ans1 = $query->custom_result_object("OrdenesModel");

		return $ans1;

	}

	public function selectAllHistorial()
	{
		$query=$this->db->select('ordenes.*
															')
										->from('ordenes')
										->where('ordenes.estado', 2)
										->get();
		$ans1 = $query->custom_result_object("OrdenesModel");

		return $ans1;

	}

	public function selectAllHistorialbyCliente($id)
{
	$query=$this->db->select('ordenes.*
														')
									->from('ordenes')
									->where("idCliente", $id)
									->where('ordenes.estado', 2)
									->get();
	$ans1 = $query->custom_result_object("OrdenesModel");

	return $ans1;

}

	public function selectHistorial($id)
{
	$query=$this->db->select('ordenes.*
														')
									->from('ordenes')
									->where("idCliente", $id)
									->where('ordenes.estado', 2)
									->get();
	$ans1 = $query->custom_result_object("OrdenesModel");

	return $ans1;

}

	public function selectOne($id)
	{
    $query=$this->db->select('ordenes.*
		 													')
										->from('ordenes')



                    ->where("ordenes.id", $id)
										->get();
		return $query->custom_result_object("OrdenesModel");
	}

	
	public function ordenesId($id){

		$query=$this->db->select_max('ordenes.id')
			   ->from('ordenes')
			   ->where("ordenes.id", $id)
			   ->get();
		   return $query->custom_result_object("OrdenesModel");
		   }
	
		   


}


?>
