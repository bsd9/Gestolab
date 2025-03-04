<?php
class RecomendacionModel extends CI_Model {

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
			$this->db->delete('recomendacion');
		}
    public function insert()
    	{
        $this->db->set('idServicio', $this->idServicio);
	      $this->db->set('texto', $this->texto);
        $this->db->insert('recomendacion');
        return $this->db->insert_id();
    	}

			public function update()
				{
          $this->db->set('idServicio', $this->idServicio);
		      $this->db->set('texto', $this->texto);
					$this->db->where("id",  $this->id);
					$this->db->update('recomendacion');
				}

      public function selectAll()
      {
    		$query=$this->db->select('recomendacion.*')
                        ->from('recomendacion')
          //              ->join('dependencia','cargo.idDependencia = dependencia.id')
                        ->get();
    		return $query->custom_result_object("RecomendacionModel");
      }

      public function selectOne($id)
      {
    		$query=$this->db->select('recomendacion.*')
                        ->where("recomendacion.idServicio",$id)
                        ->from('recomendacion')
                        ->get();
    		return $query->custom_result_object("RecomendacionModel");
      }

			public function validate()
	    {
	        $this->form_validation->set_rules('nombre', "nombre", 'required',array('required'=>'El %s es un campo obligatorio'));
					return $this->form_validation->run();
	    }


}
?>
