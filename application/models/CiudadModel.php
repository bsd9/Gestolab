<?php
class CiudadModel extends CI_Model {

	private $id="";
	private $nombre="";
  private $iddepartamento="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
		$this->id=$data['id'];
    $this->nombre=$data['nombre'];
    $this->iddepartamento=$data['iddepartamento'];
  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}


	public function getIdDepartamento()
		{
		return $this->iddepartamento;
	}

		public function setIdDepartamento($id)
		{
		$this->iddepartamento=$id;
	}

	public function getNombre()
    {
		return $this->nombre;
	}

    public function setNombre($nombre)
    {
		$this->nombre=$nombre;
	}


      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('ciudad');
    		return $query->custom_result_object("CiudadModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('ciudad')
                        ->get();
    		return $query->custom_result_object("CiudadModel");
      }
}
?>
