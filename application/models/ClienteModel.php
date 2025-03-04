<?php
class ClienteModel extends CI_Model {

	private $id="";
	private $razonSocial="";
	private $NIT="";
	private $telefono="";
	private $direccion="";
	private $estado="";
	private $ciudad="";
	private $pais="";
	private $departamento="";


	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    if(isset($data['razonSocial'])){$this->razonSocial=$data['razonSocial'];}
    if(isset($data['NIT'])){$this->NIT=$data['NIT'];}
    if(isset($data['telefono'])){$this->telefono=$data['telefono'];}
    if(isset($data['direccion'])){$this->direccion=$data['direccion'];}
    if(isset($data['estado'])){$this->estado=$data['estado'];}
		if(isset($data['ciudad'])){$this->ciudad=$data['ciudad'];}
		if(isset($data['departamento'])){$this->departamento=$data['departamento'];}
		if(isset($data['pais'])){$this->pais=$data['pais'];}
  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getRazonSocial()
    {
		return mb_strtoupper($this->razonSocial);
	}

    public function setRazonSocial($nombre)
    {
		$this->razonSocial= mb_strtoupper($nombre);
	}



	public function getEstado()
    {
		return $this->estado;
	}

    public function setEstado($estado)
    {
		$this->estado=$estado;
	}


	public function getNIT(){

	   return $this->NIT;
	}

	public function setNIT($NIT){

	    $this->NIT = $NIT;
	}


	public function getTelefono(){

	   return $this->telefono;
	}

	public function setTelefono($telefono){

	    $this->telefono = $telefono;
	}

	public function getDireccion(){

	   return $this->direccion;
	}

	public function setDireccion($direccion){

	    $this->direccion = $direccion;
	}

	public function getCiudad(){

		 return $this->ciudad;
	}

	public function setCiudad($ciudad){

			$this->ciudad = $ciudad;
	}

	public function getDepartamento(){

		 return $this->departamento;
	}

	public function setDepartamento($departamento){

			$this->departamento = $departamento;
	}

	public function getPais(){

		 return $this->pais;
	}

	public function setPais($pais){

			$this->pais = $pais;
	}

    public function insert()
    	{
        $this->db->set('razonSocial', mb_strtoupper($this->razonSocial));
        $this->db->set('NIT', $this->NIT);
        $this->db->set('telefono', $this->telefono);
        $this->db->set('direccion', $this->direccion);
				$this->db->set('ciudad', $this->ciudad);
				$this->db->set('departamento', $this->departamento);
				$this->db->set('pais', $this->pais);
        $this->db->set('estado', 1);
        $this->db->insert('cliente');
        return $this->db->insert_id();
    	}


	public function update()
	    	{

          $this->db->set('razonSocial', mb_strtoupper ($this->razonSocial));
          $this->db->set('NIT', $this->NIT);
          $this->db->set('telefono', $this->telefono);
          $this->db->set('direccion', $this->direccion);
					$this->db->set('ciudad', $this->ciudad);
					$this->db->set('departamento', $this->departamento);
					$this->db->set('pais', $this->pais);
          $this->db->set('estado', $this->estado);
          $this->db->where("cliente.id",$this->id);
		  $this->db->update('cliente');

				}

       public function selectAll()
       {
    	 	$query=$this->db->select('cliente.*,ciudad.nombre as Ciudad,
				(SELECT count(*)
				FROM solicitud
				JOIN equipo on solicitud.idEquipo = equipo.id
				JOIN laboratorio on equipo.idLaboratorio = laboratorio.id
				WHERE cliente.id = laboratorio.idCliente and solicitud.idCotizacion is NULL) as solicitudes ')
												 ->from('cliente')
												 ->join('ciudad','cliente.ciudad = ciudad.id','left')
												 ->order_by('cliente.razonSocial')
                         ->get();
     	return $query->custom_result_object("ClienteModel");
       }

			 public function selectAllServices()
			 {
			 $query=$this->db->select('cliente.*')
												->from('cliente')
												->join('laboratorio', 'laboratorio.idCliente = cliente.id')
												->join('equipo', 'equipo.idLaboratorio = laboratorio.id')
												->join('solicitud', 'solicitud.idEquipo = equipo.id')
												->order_by('cliente.razonSocial')
												->group_by('cliente.id')
												
												 ->get();
			 return $query->custom_result_object("ClienteModel");
			 }



			 public function selectOne($id)
			 {
				$query=$this->db->select('cliente.*')
				->from('cliente')
				->where('cliente.id', $id)
				->get();
			return $query->custom_result_object("ClienteModel");
			 }

			 public function selectOnebyOrden($id)
			 {
				$query=$this->db->select('cliente.*, ordenes.id as ordenesN')
				->from('cliente')
				->join('ordenes','ordenes.idCliente = cliente.id')
				->where('ordenes.id', $id)
				->get();
			return $query->custom_result_object("ClienteModel");
			 }

			public function validate()
	   {
	        $this->form_validation->set_rules('razonSocial', "Razon Social", 'required',array('required'=>'El %s es un campo obligatorio'));
	        $this->form_validation->set_rules('telefono', "Telefono", 'required',array('required'=>'El %s es un campo obligatorio'));
	        $this->form_validation->set_rules('direccion', "Direccion", 'required',array('required'=>'La %s es un campo obligatorio'));
	        $this->form_validation->set_rules('NIT', "NIT", 'required',array('required'=>'El %s es un campo obligatorio'));
					$this->form_validation->set_rules('ciudad', "Ciudad", 'required',array('required'=>'La %s es un campo obligatorio'));
				return $this->form_validation->run();
	    }
		public function razonSocial($id){

			$query=$this->db->select_max('cliente.razonSocial')
				   ->from('cliente')
				   ->where("cliente.id", $id)
				   ->get();
			   return $query->custom_result_object("ClienteModel");
			   }

}
?>
