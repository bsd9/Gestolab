<?php
class PaisModel extends CI_Model {

	private $id="";
	private $nombre="";

	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
		$this->id=$data['id'];
    $this->nombre=$data['nombre'];
  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getNombre()
    {
		return $this->nombre;
	}

    public function setNombre($nombre)
    {
		$this->nombre=$nombre;
	}

    public function insert()
    	{
        $this->db->set('id', $this->id);
        $this->db->set('nombre', $this->nombre);
        $this->db->insert('pais');
    	}

      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('pais');
    		return $query->custom_result_object("PaisModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('pais')
                        ->get();
    		return $query->custom_result_object("PaisModel");
      }
}


?>
