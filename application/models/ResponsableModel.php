<?php
class ResponsableModel extends CI_Model {

	private $id="";
	private $idLaboratorio="";
	private $idUsuario="";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->idUsuario=$data['idUsuario'];
    $this->idLaboratorio=$data['idLaboratorio'];
  }

	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}


  	public function getIdLaboratorio()
      {
  		return $this->idLaboratorio;
  	}

      public function setIdLaboratorio($idLaboratorio)
      {
  		$this->idLaboratorio=$idLaboratorio;
  	}


    	public function getIdUsuario()
        {
    		return $this->idUsuario;
    	}

        public function setIdUsuario($idUsuario)
        {
    		$this->idUsuario=$idUsuario;
    	}

    public function insert()
    	{
        $this->db->set('idUsuario', $this->idUsuario);
        $this->db->set('idLaboratorio', $this->idLaboratorio);
        $this->db->insert('responsable');
        return $this->db->insert_id();
    	}

			public function update()
				{
          $this->db->set('idUsuario', $this->idUsuario);
          $this->db->set('idLaboratorio', $this->idLaboratorio);
					$this->db->where("id",  $this->id);
					$this->db->update('responsable');
				}

      public function delete($id){
        $this->db->where("idUsuario", $id);
        $this->db->delete('responsable');
      }

      public function selectLabs($id)
      {
    		$query=$this->db->select('responsable.*')
                        ->from('responsable')
                         ->where("responsable.idUsuario",$id)
                         ->get();
    	 	return $query->custom_result_object("ResponsableModel");
      }

       public function selectOne()
       {
    	 	$query=$this->db->select('responsable.*')
                         ->where("responsable.idUsuario",$this->idUsuario)
                         ->where("responsable.idLaboratorio",$this->idLaboratorio)
                         ->from('responsable')
                         ->get();
    	 	return count($query->custom_result_object("LaboratorioModel")) >= 1 ;
       }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
