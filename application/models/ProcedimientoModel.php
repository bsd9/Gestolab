<?php
class ProcedimientoModel extends CI_Model {

	private $id="";
	private $texto= "";
	private $idServicio = "";
	function __construct()
	{
		parent::__construct();
	}

    public function setData($data)
    {
    if(isset($data['id'])){$this->id=$data['id'];}
    $this->texto=$data['texto'];
    $this->idServicio=$data['idServicio'];
  }


	public function getId()
    {
		return $this->id;
	}

    public function setId($id)
    {
		$this->id=$id;
	}

	public function getIdServicio()
		{
		return $this->idServicio;
	}

		public function setIdServicio($idEquipo)
		{
		$this->idServicio=$idEquipo;
	}



	public function getTexto()
    {
		return $this->texto;
	}

    public function setTexto($nombre)
    {
		$this->texto=$nombre;
	}



	public function delete($id)
		{
			$this->db->where('idServicio', $id);
			$this->db->delete('procedimiento');
		}
    public function insert()
    	{
        $this->db->set('idServicio', $this->idServicio);
	      $this->db->set('texto', $this->texto);
        $this->db->insert('procedimiento');
        return $this->db->insert_id();
    	}

			public function update()
				{
          $this->db->set('idServicio', $this->idServicio);
		      $this->db->set('texto', $this->texto);
					$this->db->where("id",  $this->id);
					$this->db->update('procedimiento');
				}

      public function selectAll()
      {
    		$query=$this->db->select('procedimiento.*')
                        ->from('procedimiento')
          //              ->join('dependencia','cargo.idDependencia = dependencia.id')
                        ->get();
    		return $query->custom_result_object("ProcedimientoModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('procedimiento.*')
                        ->where("procedimiento.idServicio",$id)
                        ->from('procedimiento')
                        ->get();
    		return $query->custom_result_object("ProcedimientoModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
