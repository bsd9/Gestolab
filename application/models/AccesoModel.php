<?php
class AccesoModel extends CI_Model {

	private $id="";
	private $idCargo="";
	private $idPermiso="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->idCargo=$data['idCargo'];
    if(isset($data['idPermiso'])){$this->idPermiso=$data['idPermiso'];}
  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getIdCargo()
    {
		return $this->idCargo;
	}

    public function setIdCargo($idCargo)
    {
		$this->idCargo=$idCargo;
	}

	public function getIdPermiso()
    {
		return $this->idPermiso;
	}

    public function setIdPermiso($idPermiso)
    {
		$this->idPermiso=$idPermiso;
	}

    public function insert()
    	{
        $this->db->set('idCargo', $this->idCargo);
	      $this->db->set('idPermiso', $this->idPermiso);
        $this->db->insert('acceso');
    	}


      public function selectAll()
      {
    		$query=$this->db->select('*')
                        ->get('acceso');
    		return $query->custom_result_object("AccesoModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('acceso.*, permiso.nombre as nombrePermiso')
                        ->where("idCargo",$id)
												->join("permiso",'permiso.id=acceso.idPermiso')
                        ->from('acceso')
                        ->get();
    		return $query->custom_result_object("AccesoModel");
      }

			public function deleteOne()
      {
    		$query=$this->db->where("idCargo",$this->idCargo)
                        ->delete('acceso');
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
