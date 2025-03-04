<?php
class DepartamentoModel extends CI_Model {

	private $id="";
	private $nombre="";
  private $idpais="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
		$this->id=$data['id'];
    $this->nombre=$data['nombre'];
    $this->idpais=$data['idpais'];
  }

  public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

  public function getIdPais()
    {
    return $this->idpais;
  }

    public function setIdPais($id)
    {
    $this->idpais=$idpais;
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
        $this->db->set('idpais', $this->idpais);
        $this->db->insert('departamento');
    	}

      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('departamento');
    		return $query->custom_result_object("DepartamentoModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('*')
                        ->where("id",$id)
                        ->from('departamento')
                        ->get();
    		return $query->custom_result_object("DepartamentoModel");
      }

      public function DepartamentosxPais($id)
      {
        $query=$this->db->select('*')
                        ->where("idpais",$id)
                        ->from('departamento')
                        ->get();
        return $query->custom_result_object("DepartamentoModel");
      }
}
?>
