<?php
class CotizacionModel extends CI_Model {

	private $id="";
	private $fecha="";
	private $idCreador="";
	private $fondoCotizacion="";
	private $logoCotizacion="";
	private $cotizacion="";
	private $estado="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->fecha=$data['fecha'];

  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getFecha()
    {
		return $this->fecha;
	}

    public function setFecha($nombre)
    {
		$this->fecha=$nombre;
	}
	public function getIdCreador()
		{
		return $this->idCreador;
	}

		public function setIdCreador($idCreador)
		{
		$this->idCreador=$idCreador;
	}


	public function getEstado()
		{
		return $this->estado;
	}

		public function setEstado($estado)
		{
		$this->estado=$estado;
	}

	public function getLogoCotizacion()
	{
	return $this->logoCotizacion;
}

	public function setLogoCotizacion($logoCotizacion)
	{
	$this->logoCotizacion=$logoCotizacion;
}

public function getFondoCotizacion()
{
return $this->fondoCotizacion;
}

public function setFondoCotizacion($fondoCotizacion)
{
$this->fondoCotizacion=$lfondoCotizacion;
}

    public function insert($id,$fecha)
    	{

		$this->load->model('EstablecimientoComercialModel');
		$estableci = new EstablecimientoComercialModel();
		$estableci = $estableci->selectOne(1);

		$this->db->set('id', $id );
		$this->db->set('fondoCotizacion', $estableci[0]->getFondoCotizacion());
		$this->db->set('logoCotizacion', $estableci[0]->getLogoCotizacion());
        $this->db->set('fecha', $fecha);
			$this->db->set('estado', 1);
			$this->db->set('idCreador', $this->session->userdata("id"));
        $this->db->insert('cotizacion');
        
    	}


       public function selectAll()
       {
    	 	$query=$this->db->distinct()
				->select('cotizacion.*,cliente.razonSocial as cliente, factura.fecha as fechaFactura, factura.numero as numeroFactura')
				->from('cotizacion')
				->join('solicitud','solicitud.idCotizacion = cotizacion.id', 'left')
				->join('equipo','solicitud.idEquipo = equipo.id', 'left')
				->join('laboratorio','laboratorio.id = equipo.idLaboratorio', 'left')
				->join('cliente','cliente.id = laboratorio.idCliente', 'left')
				->join('factura','factura.idCotizacion = cotizacion.id','left')
				->where('cotizacion.id != ',  0)
				->order_by('cotizacion.id','DESC')
				->get();
     	return $query->custom_result_object("CotizacionModel");
       }

	   		public function lastId(){

			$query=$this->db->select_max('cotizacion.id')
			   	->from('cotizacion')
			   	->get();
		   	return $query->custom_result_object("CotizacionModel");
			   }




			 public function selectOne($id)
			 {
				$query=$this->db->select('cotizacion.*')
				->from('cotizacion')
				->where('cotizacion.id', $id)
				->get();
			return $query->custom_result_object("CotizacionModel");
			 }

			 public function updateCotizacion($id){

				 $this->db->set('estado','3');
				 $this->db->where("id",  $id);
				 $this->db->update('cotizacion');

			 }
			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }







}
?>
